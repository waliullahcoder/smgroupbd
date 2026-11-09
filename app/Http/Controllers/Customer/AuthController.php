<?php

namespace App\Http\Controllers\Customer;

use App\HelperClass;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Order;
use App\Models\Review;
use App\Models\ShippingAddress;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

const API_TOKEN = "zabcxpps-3p2u0j8t-poamlcuh-vfukis8d-gveezohu";
const SID = "BONTONBULK";
const DOMAIN = "https://smsplus.sslwireless.com";

class AuthController extends Controller
{
    public function redirectLogin()
    {
        Session::forget('phone_number');
        return redirect()->route('customer.send-otp');
    }

    public function sendOtp(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('customer.otp');
        }

        $phone_number = $request->phone;
        $three_ch = substr($request->input('phone'), 0, 3);
        $two_ch = substr($request->input('phone'), 0, 2);
        $one_ch = substr($request->input('phone'), 0, 1);
        if ($three_ch == '+88') {
            $phone = substr($request->input('phone'), 3);
        } elseif ($two_ch == '+8' || $two_ch == '88') {
            $phone = substr($request->input('phone'), 2);
        } elseif ($one_ch == '8') {
            $phone = substr($request->input('phone'), 1);
        } else {
            $phone = $request->phone;
        }

        $otp = mt_rand(1000, 9999);
        $user = User::where('phone', $phone)->where('role', 0)->first();
        if (is_null($user)) {
            $user = User::create([
                'role' => 0,
                'phone' => $phone,
                'otp' => $otp,
                'otp_expire' => Carbon::now()->addMinutes(5),
            ]);
        } else {
            $user->update(['otp' => $otp, 'otp_expire' => Carbon::now()->addMinutes(5)]);
        }

        $msisdn = $phone;
        $messageBody = "Your Bonton Foods One Time Pin is " . $otp . ". It will expire in 5 minutes.";
        $csmsId = mt_rand(5, 15); // csms id must be unique
       // $this->singleSms($msisdn, $messageBody, $csmsId);
        Session::forget('phone_number');
        Session::put(['phone_number' => $phone_number]);
        if($request->has('resend')){
            return redirect()->route('customer.login')->withSuccessMessage('OTP Resend Successfully!');
        } else {
            return redirect()->route('customer.login');
        }
    }

    function singleSms($msisdn, $messageBody, $csmsId)
    {
        $params = [
            "api_token" => API_TOKEN,
            "sid" => SID,
            "msisdn" => $msisdn,
            "sms" => $messageBody,
            "csms_id" => $csmsId
        ];
        $url = trim(DOMAIN, '/') . "/api/v3/send-sms";
        $params = json_encode($params);

        return $this->callApi($url, $params);
    }


    public static function callApi($url, $params)
    {
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'Content-Length: ' . strlen($params),
            'accept:application/json'
        ));

        $response = curl_exec($ch);
        curl_close($ch);
        return $response;
    }

    public function login(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('customer.login_register');
            // if (Session::has('phone_number')) {
            //     return view('customer.login');
            // } else {
            //     return redirect()->route('customer.send-otp');
            // }
        }
        if ($request->isMethod('POST')) {
            $request->validate([
                'otp' => 'required',
            ]);

            $phone_number = $request->phone;
            $three_ch = substr($request->input('phone'), 0, 3);
            $two_ch = substr($request->input('phone'), 0, 2);
            $one_ch = substr($request->input('phone'), 0, 1);
            if ($three_ch == '+88') {
                $phone = substr($request->input('phone'), 3);
            } elseif ($two_ch == '+8' || $two_ch == '88') {
                $phone = substr($request->input('phone'), 2);
            } elseif ($one_ch == '8') {
                $phone = substr($request->input('phone'), 1);
            } else {
                $phone = $request->phone;
            }
            
            $otp = $request->otp;
            $user = User::where('phone', $phone)->where('status', 1)->where('otp', $otp)->first();
            $expired_user = User::where('phone', $phone)->where('status', 1)->where('otp', $otp)->where('otp_expire', '<', Carbon::now())->first();
            if (!is_null($user) && !is_null($expired_user)) {
                return redirect()->back()->with(['phone_number' => $phone_number, 'otp' => $otp])->withErrors("Your OTP has been Expired! please resend OTP");
            }

            if (!is_null($user) && $user->role == 0) {
                Auth::login($user);
                return redirect()->route('customer.orders')->withSuccessMessage('Logged in Successfully!');
            } elseif (!is_null($user) && $user->role == 1) {
                return redirect()->back()->with(['phone_number' => $phone_number, 'otp' => $otp])->withErrors("Please login to Admin Portal!");
            } elseif (!is_null($user) && $user->role == 2) {
                return redirect()->back()->with(['phone_number' => $phone_number, 'otp' => $otp])->withErrors("Please login to Client Portal!");
            } else {
                return redirect()->back()->with(['phone_number' => $phone_number, 'otp' => $otp])->withErrors("OTP doesn't Matched!");
            }

            // if (is_numeric(request()->email_or_phone)) {
            //     $column = 'phone';
            // } elseif (filter_var(request()->email_or_phone, FILTER_VALIDATE_EMAIL)) {
            //     $column = 'email';
            // } else {
            //     return redirect()->back()->withErrors('These credentials do not match our records.')->withInput();
            // }

            // $remember_me = $request->has('remember_me') ? true : false;
            // if (auth()->attempt(['phone' => $request->input('phone'), 'otp' => $request->input('otp')], $remember_me)) {
            //     return redirect()->route('customer.profile')->withSuccessMessage('Logged in Successfully!');
            // } else {
            //     return redirect()->back()->withInput($request->all())->withErrors("OTP doesn't Matched!");
            // }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('customer.login');
    }

    public function register(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('customer.login_register');
        }
        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required',
                'email' => 'required',
                'phone' => 'required',
                'password' => 'required|min:8',
            ]);

            $customer = User::create([
                'name' => $request->name,
                'role' => 0,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            Auth::login($customer);
            return redirect()->route('customer.profile')->withSuccessMessage('Registered Successfully!');
        }
    }

    public function profile(Request $request)
    {
        if ($request->isMethod('GET')) {
            return view('customer.profile');
        }
        if ($request->isMethod('POST')) {
            $request->validate([
                'name' => 'required',
                'phone' => 'required|unique:users,phone,' . auth()->user()->id,
            ]);
            
            if(!is_null($request->email)){
                $request->validate([
                    'email' => 'unique:users,email,' . auth()->user()->id,
                ]);
            }

            $user = User::findOrFail(Auth::user()->id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
            ]);

            if (!is_null($request->new_password)) {
                if (Hash::check($request->password, Auth::user()->password)) {
                    $user->update([
                        'password' => Hash::make($request->new_password),
                    ]);
                } else {
                    return redirect()->back()->withErrors("Password Doesn't Match!");
                }
            }

            return redirect()->back()->withSuccessMessage('Updated Successfully!');
        }
    }

    public function address(Request $request)
    {
        if ($request->isMethod('GET')) {
            if (request()->ajax()) {
                $locations = Location::where('parent_id', request('id'))->orderBy('name')->get();
                return response()->json(['status' => 'success', 'locations' => $locations]);
            }

            $address = ShippingAddress::where('user_id', Auth::user()->id)->first();
            $divisions = Location::whereNull('parent_id')->orderBy('name')->get();
            $districts = Location::where('district', 1)->orderBy('name')->get();
            $upozilas = Location::where('thana', 1)->orderBy('name')->get();
            return view('customer.address', compact('address', 'divisions', 'districts', 'upozilas'));
        }
        if ($request->isMethod('POST')) {
            $request->validate([
                'address_type' => 'required',
                'name' => 'required',
                'email' => 'email',
                'phone' => 'required',
                'division_id' => 'required',
                'district_id' => 'required',
                'upozila_id' => 'required',
                'street' => 'required',
            ]);

            $shipping_address = ShippingAddress::where('user_id', Auth::user()->id)->first();
            if (is_null($shipping_address)) {
                $shipping_address = new ShippingAddress();
            }
            $upozila = Location::where('id', $request->upozila_id)->first()->name;
            $district = Location::where('id', $request->district_id)->first()->name;
            $division = Location::where('id', $request->division_id)->first()->name;
            $address = $request->street . ', ' . $upozila . ', ' . $district . ', ' . $division;
            $shipping_address->user_id = Auth::user()->id;
            $shipping_address->address_type = $request->address_type;
            $shipping_address->name = $request->name;
            $shipping_address->email = $request->email;
            $shipping_address->phone = $request->phone;
            $shipping_address->street = $request->street;
            $shipping_address->address = $address;
            $shipping_address->division_id = $request->division_id;
            $shipping_address->district_id = $request->district_id;
            $shipping_address->upozila_id = $request->upozila_id;
            $shipping_address->save();
            return redirect()->back()->withSuccessMessage('Updated Successfully!');
        }
    }

    public function orders($id = null)
    {
        if (!is_null($id)) {
            $order = Order::with(['products'])->where('id', $id)->first();
            return view('customer.single_order', compact('order'));
        }

        return view('customer.orders');
    }

    public function returnOrders($id = null)
    {
        if (!is_null($id)) {
            $order = Order::with(['products'])->where('id', $id)->first();
            return view('customer.single_return_order', compact('order'));
        }
        $return_orders = Order::with('products')->where('user_id', Auth::user()->id)->whereNotNull('return_at')->get();
        return view('customer.return_orders', compact('return_orders'));
    }

    public function wishlist(Request $request)
    {
        if ($request->ajax() && $request->delete == 'true') {
            Wishlist::findOrFail($request->id)->delete();
            return response()->json(['status' => 'success']);
        }

        if ($request->ajax()) {
            $check_product = Wishlist::where('product_id', $request->id)->where('user_id', Auth::user()->id)->count();
            if ($check_product > 0) {
                return response()->json(['status' => 'error']);
            }

            Wishlist::create([
                'user_id' => Auth::user()->id,
                'product_id' => $request->id,
            ]);
            return response()->json(['status' => 'success']);
        }

        $wishlists = Wishlist::with(['product'])->where('user_id', Auth::user()->id)->latest('id')->get();
        return view('customer.wishlist', compact('wishlists'));
    }

    public function review(Request $request)
    {
        $request->validate([
            'star' => 'required',
            'product_id' => 'required',
            'product_id' => 'required',
            'description' => 'required',
        ]);

        // Images
        $images = $request->file('images');
        if (isset($images)) {
            $img_arr = [];
            foreach ($images as $key => $more_image) {
                $response = HelperClass::storeImage($more_image, 600, 'media/review/');
                if ($response['status'] == 'success') {
                    $img_arr[$key] = $response['path_name'];
                }
            }
            $images_path_names = trim(implode('|', $img_arr), '|');
            if (count($img_arr) == 0) {
                $images_path_names = NULL;
            }
        } else {
            $images_path_names = NULL;
        }

        Review::create([
            'product_id' => $request->product_id,
            'user_id' => Auth::user()->id,
            'star' => $request->star,
            'title' => $request->title,
            'description' => $request->description,
            'images' => $images_path_names,
        ]);

        return redirect()->back()->withSuccessMessage('Review Created Successfully!');
    }
}
