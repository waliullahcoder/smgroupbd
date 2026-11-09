<?php

namespace App\Http\Controllers\Admin;

use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\User;
use App\Models\Region;
use App\Models\Client;
use App\Models\Product;
use App\Models\RetailSale;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 1) {
                return redirect()->route('admin.dashboard');
            } elseif (Auth::user()->role == 0) {
                return redirect()->route('customer.profile');
            } elseif (Auth::user()->role == 3) {
                return redirect()->route('investor.dashboard');
            }
        } else {
            // if (!session()->has('intended_url')) {
            //     session(['intended_url' => url()->previous()]);
            // }
            return view('admin.auth.login');
        }
    }

    public function login(Request $request)
    {
        $user = User::where('user_name', $request->user_name)->where('status', 0)->first();
        if ($user) {
            return redirect()->back()->with('error','User not Exists!');
        }

        $input = $request->all();
        if (auth()->attempt(array('user_name' => $input['user_name'], 'password' => $input['password']))) {
            return redirect()->route('admin.dashboard')->with('success', 'Logged in Successfully!');
        } else {
            return redirect()->back()->with('error', 'Invalid Email or Password!');
        }
    }

    public function dashboard()
    {
     
        if (request()->ajax()) {
            $start = new DateTime('first day of -1 year');
            $end = new DateTime('first day of next month');
            $interval = new DateInterval('P1M');
            $period = new DatePeriod($start, $interval, $end);

            $months = [];
            $month_sales = [];
            $month_collections = [];
            foreach ($period as $dt) {
                $start_date = $dt->format("Y-m-01");
                $end_date = $dt->format("Y-m-t");

                $sales = DB::table('view_sales')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('amount');
                $salesReturn = DB::table('view_sales_returns')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('amount');
                $totalSales = $sales - $salesReturn;
                $collections = DB::table('view_collection_history')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->where('collection_type', '!=', 'adjust')->sum('amount');

                $months[] = $dt->format("M-y");
                $month_sales[] = $totalSales;
                $month_collections[] = $collections;
            }
            $monthlyData = [
                'month' => $months,
                'sales_amount' => $month_sales,
                'collection_amount' => $month_collections,
            ];

            $start = new DateTime('first day of -2 month');
            $end = new DateTime('first day of next month');
            $interval = DateInterval::createFromDateString('7 day');
            $period   = new DatePeriod($start, $interval, $end);

            $weeks = [];
            $weekly_sales = [];
            $weekly_collections = [];
            foreach ($period as $dt) {
                $start_date = date('Y-m-d', strtotime('20-12-2023'));
                $end_date = $dt->format("Y-m-d");

                $sales = DB::table('view_sales')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('amount');
                $salesReturn = DB::table('view_sales_returns')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->sum('amount');
                $totalSales = $sales - $salesReturn;
                $collections = DB::table('view_collection_history')->where('date', '>=', $start_date)->where('date', '<=', $end_date)->where('collection_type', '!=', 'adjust')->sum('amount');

                if ($end_date < date('Y-m-d')) {
                    $weeks[] = $dt->format("d-M");
                    $weekly_sales[] = $totalSales;
                    $weekly_collections[] = $collections;
                }
            }
            $weeklyData = [
                'weeks' => $weeks,
                'sales_amount' => $weekly_sales,
                'collection_amount' => $weekly_collections,
            ];

            return response()->json(['status' => 'success', 'monthlyData' => $monthlyData, 'weeklyData' => $weeklyData]);
        }

        $sales = DB::table('view_sales')->sum('amount');
        $salesReturn = DB::table('view_sales_returns')->sum('amount');
        $totalSales = $sales - $salesReturn;
        $collections = DB::table('view_collection_history')->where('collection_type', '!=', 'adjust')->sum('amount');
        $outstanding = $totalSales - $collections;
        $total_clients = Client::where('status', 1)->count();
        $lifting = DB::table('view_liftings')->sum('amount');
        $liftingReturn = DB::table('view_lifting_returns')->sum('amount');
        $payment = DB::table('view_payments')->whereNotIn('type', ['adjust', 'return'])->sum('amount');
        $paymentDue = $lifting - ($liftingReturn + $payment);
        $stock_value = 0;

        // Get all product_ids involved in lifting
        $product_ids = DB::table('view_liftings')
            ->select('product_id')
            ->distinct()
            ->pluck('product_id');

        // Preload sums grouped by product_id
        $liftings = DB::table('view_liftings')
            ->select('product_id', DB::raw('SUM(qty) as qty'), DB::raw('SUM(amount) as amount'))
            ->groupBy('product_id')
            ->get()
            ->keyBy('product_id');

        $lifting_returns = DB::table('view_lifting_returns')
            ->select('product_id', DB::raw('SUM(qty) as qty'))
            ->groupBy('product_id')
            ->get()
            ->pluck('qty', 'product_id');

        $sales = DB::table('view_sales')
            ->select('product_id', DB::raw('SUM(qty) as qty'))
            ->groupBy('product_id')
            ->get()
            ->pluck('qty', 'product_id');

        $sales_returns = DB::table('view_sales_returns')
            ->select('product_id', DB::raw('SUM(qty) as qty'))
            ->groupBy('product_id')
            ->get()
            ->pluck('qty', 'product_id');

        $retail_sales = DB::table('view_retail_sales')
            ->select('product_id', DB::raw('SUM(qty) as qty'))
            ->groupBy('product_id')
            ->get()
            ->pluck('qty', 'product_id');

        $online_sales = DB::table('view_online_sales')
            ->whereNotNull('store_id')
            ->select('product_id', DB::raw('SUM(qty) as qty'))
            ->groupBy('product_id')
            ->get()
            ->pluck('qty', 'product_id');

        // Process per product
        foreach ($product_ids as $product_id) {
            $lifting = $liftings[$product_id] ?? null;

            if (!$lifting || $lifting->qty == 0) {
                continue; // avoid divide by zero or missing data
            }

            $avg_price = $lifting->amount / $lifting->qty;

            $lifting_return_qty = $lifting_returns[$product_id] ?? 0;
            $sales_qty = $sales[$product_id] ?? 0;
            $sales_return_qty = $sales_returns[$product_id] ?? 0;
            $retail_sales_qty = $retail_sales[$product_id] ?? 0;
            $online_sales_qty = $online_sales[$product_id] ?? 0;

            $balance_qty = $lifting->qty + $sales_return_qty - $lifting_return_qty - $sales_qty - $retail_sales_qty - $online_sales_qty;
            $stock_value += $balance_qty * $avg_price;
        }


        $today_retail_sales = RetailSale::where('date', date('Y-m-d'))->get();
        $total_products = Product::where('status', true)->count();
        $info = [
            'customers' => $today_retail_sales->count(),
            'total_sales' => $today_retail_sales->sum('receive_amount'),
            'cash_in' => $today_retail_sales->sum('receive_amount'),
            'due' => 0,
            'total_products' => number_format($total_products),
            'sales' => number_format($totalSales, 2),
            'collections' => number_format($collections, 2),
            'outstanding' => number_format($outstanding, 2),
            'payment_due' => number_format($paymentDue, 2),
            'stock_value' => number_format($stock_value, 2),
        ];

        $RegionSales = [];
        $regions = Region::where('status', 1)->orderBy('name', 'asc')->get();
        foreach ($regions as $region) {
            $sales = DB::table('view_sales')->where('region_id', $region->id)->sum('amount');
            $salesReturn = DB::table('view_sales_returns')->where('region_id', $region->id)->sum('amount');
            $totalSales = $sales - $salesReturn;
            $data = [
                'name' => $region->name,
                'amount' => $totalSales
            ];
            array_push($RegionSales, $data);
        }

        return view('admin.profile.dashbaord', compact('info', 'RegionSales'));
    }

    /**
     * Manage Sidebar
     */
    public function sidebar()
    {
        if (!Session::has('sidebar-collapse')) {
            Session()->put('sidebar-collapse', 'active');
        } else {
            Session::forget('sidebar-collapse');
        }
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
        return view('admin.profile.index', compact('admin'));
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
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

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login.index');
    }
}
