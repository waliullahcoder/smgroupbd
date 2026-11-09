<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Mail\RegisterMail;
use App\Models\Location;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\ShippingAddress;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if (request()->ajax()) {
            $locations = Location::where('parent_id', request('id'))->orderBy('name')->get();
            return response()->json(['status' => 'success', 'locations' => $locations]);
        }

        $divisions = Location::whereNull('parent_id')->orderBy('name')->get();
        if (Auth::check()) {
            $shipping_address = ShippingAddress::where('user_id', Auth::user()->id)->first();
            if (!is_null($shipping_address)) {
                $selected_district = Location::find($shipping_address->district_id);
                $selected_upozila = Location::find($shipping_address->upozila_id);
            } else {
                $shipping_address = NULL;
                $selected_district = NULL;
                $selected_upozila = NULL;
            }
        } else {
            $shipping_address = NULL;
            $selected_district = NULL;
            $selected_upozila = NULL;
        }
        return view('customer.checkout', compact('divisions', 'shipping_address', 'selected_district', 'selected_upozila'));
    }

    public function invoice()
    {
        $first = date('Y-m-01');
        $last = new Carbon('last day of this month');
        $order = Order::withTrashed()->select(['invoice'])->whereDate('created_at', '>=', $first)->whereDate('created_at', '<=', $last)->orderBy('id', 'desc')->first();
        if ($order) {
            $trim = str_replace("STOS", '', $order->invoice);
            $orderPrefix = (int)$trim + 1;
            $invoice = "STOS" . $orderPrefix;
        } else {
            $invoice = "STOS" . date('Y') . date('m') . '0001';
        }
        return $invoice;
    }

    public function checkoutStore(Request $request)
    {
        $this->validate($request, [
            'address_type' => 'required',
            'payment_method' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'division' => 'required',
            'district' => 'required',
            'upozila' => 'required',
            'street' => 'required',
        ]);

        $cart = session()->get('cart');
        if (is_array($cart) && count($cart) > 0) {

            DB::transaction(function () use ($request, $cart) {
                $total_without_discount = 0;
                $total_with_discount = 0;
                $discount = 0;
                foreach ($cart as $item) {
                    $total_without_discount += $item['price'] * $item['qty'];
                    $total_with_discount += ($item['price'] - $item['discount_tk']) * $item['qty'];
                    $discount += $item['discount_tk'] * $item['qty'];
                }

                if (!Auth::user()) {
                    $check_user = User::query();
                    $check_user->where(function ($query) use ($request) {
                        $query->where('phone', $request->phone);
                        if (!is_null($request->email)) {
                            $query->orWhere('email', $request->email);
                        }
                    });
                    $check_user = $check_user->first();
                    if (!is_null($check_user)) {
                        Auth::login($check_user);
                        $user = Auth::user();
                    } else {
                        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
                        $pass = array(); //remember to declare $pass as an array
                        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
                        for ($i = 0; $i < 8; $i++) {
                            $n = rand(0, $alphaLength);
                            $pass[] = $alphabet[$n];
                        }
                        $password = implode($pass);

                        $user = new User();
                        $user->name = $request->name;
                        $user->email  = $request->email;
                        $three_ch = substr($request->input('phone'), 0, 3);
                        $two_ch = substr($request->input('phone'), 0, 2);
                        if ($three_ch == '+88') {
                            $user->phone = substr($request->input('phone'), 3);
                        } elseif ($two_ch == '+8' || $two_ch == '88') {
                            $user->phone = substr($request->input('phone'), 2);;
                        } else {
                            $user->phone = $request->phone;
                        }
                        $user->password = Hash::make($password);
                        $user->status = 1;
                        $user->save();

                        Auth::login($user);
                        // if (@$user) {
                        //     $login_link = Route('customer.login');
                        //     $mailData = [
                        //         'name' => $request->name,
                        //         'phone' => $request->phone,
                        //         'email' => $request->email,
                        //         'password' => $password,
                        //         'login_link' => $login_link,
                        //     ];
                        //     Mail::to($request->email)->send(new RegisterMail($mailData));
                        // }
                    }
                } else {
                    $user = Auth::user();
                }

                $upozila = Location::where('id', $request->upozila)->first()->name;
                $district = Location::where('id', $request->district)->first()->name;
                $division = Location::where('id', $request->division)->first()->name;
                $address = $request->street . ', ' . $upozila . ', ' . $district . ', ' . $division;

                if (is_null($request->shipping_address_id)) {
                    $shipping_address = ShippingAddress::where('user_id', $user->id)->first();
                    if (is_null($shipping_address)) {
                        $shipping_address = ShippingAddress::create([
                            'user_id' => $user->id,
                            'address_type' => $request->address_type,
                            'name' => $request->name,
                            'email' => $request->email,
                            'phone' => $request->phone,
                            'street' => $request->street,
                            'address' => $address,
                            'division_id' => $request->division,
                            'district_id' => $request->district,
                            'upozila_id' => $request->upozila,
                        ]);
                    }
                } else {
                    $shipping_address = ShippingAddress::findOrFail($request->shipping_address_id);
                    $shipping_address->update([
                        'address_type' => $request->address_type,
                        'name' => $request->name,
                        'email' => $request->email,
                        'phone' => $request->phone,
                        'street' => $request->street,
                        'address' => $address,
                        'division_id' => $request->division,
                        'district_id' => $request->district,
                        'upozila_id' => $request->upozila,
                    ]);
                }

                $shipping_charge = $request->delivery_area == 'outside_city' ? $request->outside_charge : $request->inside_charge;
                $order = Order::create([
                    'company_id' => 1,
                    'order_id' => mt_rand(111111, 999999),
                    'invoice' => $this->invoice(),
                    'customer_id' => $user->id,
                    'user_name' => $request->name,
                    'user_phone' => $request->phone,
                    'shipping_address' => $address,
                    'order_code' => 'R' . mt_rand(111111, 999999),
                    'shipping_charge' => $shipping_charge,
                    'shipping_address_id' => $shipping_address->id,
                    'sub_total' => $total_without_discount,
                    'total' => $total_without_discount + $shipping_charge,
                    'discount' => $discount,
                    'paid' => 0,
                    'due' => $total_with_discount + $shipping_charge,
                    'order_type' => 'online',
                    'coupon_id' => NULL,
                    'order_note' => NULL,
                    'payment_method' => $request->payment_method,
                    'date' => date('Y-m-d'),
                    'pending_at' => Carbon::now(),
                ]);

                foreach ($cart as $item) {
                    $product = Product::findOrFail($item['product_id']);
                    $variant = ProductSku::find($item['variant_id']);
                    if (@$variant->discount_tk) {
                        $subtotal = (@$variant->price - @$variant->discount_tk) * $item['qty'];
                    } else {
                        $subtotal = (@$product->price->online_price - @$product->price->discount_tk) * $item['qty'];
                    }
                    OrderProduct::create([
                        'order_id' => $order->id,
                        'product_id' => $item['product_id'],
                        'variant_id' => $item['variant_id'],
                        'choose_options' => json_encode($item['choose_options']),
                        'sku' => $item['sku'],
                        'discount' => @$variant->discount_tk ?? @$product->price->discount_tk,
                        'sale_price' => @$variant->price ?? @$product->price->online_price,
                        'subtotal' => $subtotal,
                        'quantity' => $item['qty'],
                    ]);
                }
                session()->forget('cart');
            });
            return redirect()->route('customer.orders')->withSuccessMessage('Ordered Successfully!');
        } else {
            return redirect()->route('frontend.home')->withErrors('Please add some product into cart!');
        }
    }
}
