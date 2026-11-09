<?php

namespace App\Http\Controllers\Investor;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\User;
use App\Models\Wallet;
use App\Models\Investor;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\InvestorProduct;
use App\Http\Controllers\Controller;
use App\Models\SalesList;
use App\Models\SalesReturnList;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 1) {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role == 2) {
                return redirect()->route('client.dashboard.index');
            } elseif (Auth::user()->role == 3) {
                return redirect()->route('investor.dashboard');
            } elseif (Auth::user()->role == 0) {
                return redirect()->route('customer.profile');
            }
        } else {
            if (!session()->has('intended_url')) {
                session(['intended_url' => url()->previous()]);
            }
            return view('investor.auth.login');
        }
    }

    public function login(Request $request)
    {
        $input = $request->all();
        if (auth()->attempt(array('user_name' => $input['user_name'], 'password' => $input['password']))) {
            return redirect()->route('investor.dashboard')->with('success', 'Logged in Successfully!');
        } else {
            return redirect()->back()->with('error', 'Invalid Email or Password!');
        }
    }

    public function dashboard(Request $request)
    {
        if ($request->ajax()) {
            $date = date('Y-m-d');
            $start_year = date('Y-m-d', strtotime($date . '-5 month'));
            $end_year = date('Y-m-d');

            $start    = new DateTime(date('Y-m-d', strtotime($start_year)));
            $start->modify('first day of this month');
            $end      = new DateTime(date('Y-m-d', strtotime($end_year)));
            $end->modify('first day of next month');
            $interval = DateInterval::createFromDateString('1 month');
            $period   = new DatePeriod($start, $interval, $end);

            $period_month = [];
            $period_sales = [];
            foreach ($period as $dt) {
                $start_date = $dt->format("Y-m-01");
                $end_date = $dt->format("Y-m-t");
                $sales = SalesList::with('sales')->where('product_id', $request->product_id)->whereHas('sales', function ($query) use ($start_date, $end_date) {
                    $query->where('date', '>=', $start_date)->where('date', '<=', $end_date);
                })->sum(DB::raw('amount - discount'));

                $salesReturn = SalesReturnList::with('return')->where('product_id', $request->product_id)->whereHas('return', function ($query) use ($start_date, $end_date) {
                    $query->where('date', '>=', $start_date)->where('date', '<=', $end_date)->where('approve', 1);
                })->sum(DB::raw('amount - sales_discount'));
                $totalSales = $sales - $salesReturn;

                $period_month[] = $dt->format("M-y");
                $period_sales[] = $totalSales;
            }
            return response()->json(['status' => 'success', 'month' => $period_month, 'sales_amount' => $period_sales]);
        }

        $investor_id = Auth::user()->investor->id;
        $total_invest = Wallet::where('investor_id', $investor_id)->where('type', 'Invest')->where('approved', 1)->sum('amount_in');
        $total_profit = Wallet::where('investor_id', $investor_id)->where('type', 'Profit')->where('approved', 1)->sum('amount_in');
        $total_sattlement = Wallet::where('investor_id', $investor_id)->where('type', 'Sattlement')->where('approved', 1)->sum('amount_out');
        $total_payment = Wallet::where('investor_id', $investor_id)->where('type', 'Payment')->where('approved', 1)->sum('amount_out');
        $info = [
            'total_invest' => $total_invest,
            'total_profit' => $total_profit,
            'total_payment' => $total_sattlement + $total_payment,
            'total_due' => $total_invest + $total_profit - $total_sattlement - $total_payment,
        ];
        $products = InvestorProduct::with('product')->where('investor_id', $investor_id)->whereHas('product', function ($query) {
            $query->where('status', 1);
        })->get();
        return view('investor.profile.dashbaord', compact('info', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        $admin = Auth::user();
        return view('investor.profile.index', compact('admin'));
    }

    public function settings(Request $request)
    {
        if ($request->isMethod('GET')) {
            $data = Investor::findOrFail(Auth::user()->investor->id);
            return view('investor.profile.settings', compact('data'));
        }

        if ($request->isMethod('POST')) {
            $data = Investor::findOrFail(Auth::user()->investor->id);
            if ($request->has('name')) {
                $data->update([
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                ]);
            }
            if ($request->has('bank')) {
                $data->update([
                    'bank' => $request->bank,
                    'branch' => $request->branch,
                    'account_name' => $request->account_name,
                    'account_no' => $request->account_no,
                ]);
            }
            if ($request->has('bkash')) {
                $data->update([
                    'bkash' => $request->bkash,
                    'rocket' => $request->rocket,
                    'nagad' => $request->nagad,
                ]);
            }
            return redirect()->back()->withSuccessMessage('Updated Successfully!');
        }
    }

    public function changeImages(Request $request)
    {
        $images = User::findOrFail(Auth::user()->id);
        $cover = $request->file('cover_image');
        if (isset($cover)) {
            $path = 'backend/images/avatar/';
            $file_name = 'cover-' . Str::random(40) . '.' . $cover->getClientOriginalExtension();
            $path_file_name = $path . $file_name;
            $cover->move($path, $file_name);
            if (file_exists($images->cover_image)) {
                unlink($images->cover_image);
            }
            $images->cover_image = $path_file_name;
        }

        $profile = $request->file('profile_image');
        if (isset($profile)) {
            $path = 'backend/images/avatar/';
            $file_name = 'profile-' . Str::random(40) . '.' . $profile->getClientOriginalExtension();
            $path_file_name = $path . $file_name;
            $profile->move($path, $file_name);
            if (file_exists($images->image)) {
                unlink($images->image);
            }
            $images->image = $path_file_name;
        }
        $images->save();
        return redirect()->back()->withSuccessMessage('Image Changed Successfully!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'email' => 'unique:users,email,' . Auth::user()->id,
            'name' => 'required',
        ]);
        $admin = User::findOrFail(Auth::user()->id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->phone = $request->phone;
        $admin->address = $request->address;
        $admin->save();
        return redirect()->back()->withSuccessMessage('Information Updated Successfully!');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $admin = User::findOrFail(Auth::user()->id);
        if (Hash::check($request->old_password, $admin->password)) {
            $admin->password = bcrypt($request->new_password);
            $admin->save();
            return redirect()->back()->withSuccessMessage('Updated Successfully!');
        } else {
            return redirect()->back()->withErrors('Old Password Does not Matched!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('investor.login.index');
    }
}
