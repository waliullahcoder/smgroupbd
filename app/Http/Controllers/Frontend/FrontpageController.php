<?php

namespace App\Http\Controllers\Frontend;

use App\HelperClass;
use App\Models\Page;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\Contact;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\PreOrderSetup;
use App\Models\SocialWork;
use App\Models\StaticSiteItem;
use Carbon\Carbon;
use DateTime;
use Illuminate\Support\Facades\DB;
use Exception;

class FrontpageController extends Controller
{
    public function home()
    {
        $sliders = Slider::where('status', 1)->get();
        $trending_products = Product::where('trending', 1)->where('status', 1)->orderBy('serial', 'asc')->get();
        $pre_orders = PreOrderSetup::where('status', 1)->limit(3)->get();
        return view('frontend.home', compact('sliders', 'trending_products', 'pre_orders'));
    }

    public function Collections()
    {
        $categories = Category::root()->where('status', 1)->where('show_frontend', 1)->orderBy('name', 'asc')->get();
        return view('frontend.collections', compact('categories'));
    }

    public function AboutUs()
    {
        $site_items = StaticSiteItem::latest()->first();
        $about = About::latest('updated_at')->first();
        $social_works = SocialWork::where('status', true)->latest('serial')->get();

        return view('frontend.about', compact('about', 'site_items', 'social_works'));
    }

    public function ContactUs(string $slug = NULL)
    {
        if (!is_null($slug)) {
            $product_id = Product::where('slug', $slug)->first()->id;
        } else {
            $product_id = NULL;
        }
        $product = Product::where('slug', $slug)->first();
        $contact = Contact::latest('updated_at')->first();
        return view('frontend.contact', compact('contact', 'product_id'));
    }

    public function products(Request $request, $slug = NULL)
    {
        if ($request->ajax() && $request->show_more == 1) {
            $query = Product::where('status', 1)->where('show_on_website', 1)->where('category_id', $request->category_id);
            $sort = explode('-', $request->sort);
            if ($request->sort != 'price-asc' && $request->sort != 'price-desc') {
                $query->orderBy($sort[0], $sort[1]);
            } elseif ($request->sort == 'price-asc' || $request->sort == 'price-desc') {
                $query->leftJoin('product_prices', 'product_prices.product_id', 'products.id')
                    ->orderBy('product_prices.online_price', $sort[1]);
            }
            $count = $query->count();
            $total_show = $request->showed + $request->show;
            $query->limit($total_show);
            $products = $query->get();
            $showed = count($products);
            $html = '';
            foreach ($products as $key => $product) {
                $html .= '<div
                    class="product-showcase card card-' . ($key + 1) . ' border border-solid border-slate-300 hover:shadow-lg rounded-md hover:scale-125 relative bg-white hover:z-10 h-full">
                    <div class="before:content-[] before:pt-[100%] before:block relative image-area">
                        <a href="' . Route('frontend.single-product', $product->slug) . '">
                            <img class="w-full rounded-md absolute inset-0 h-full object-cover"
                                src="' . (file_exists($product->thumbnail) ? asset($product->thumbnail) : asset('frontend/assets/images/default/no_image2.png')) . '" alt="product">
                        </a>
                    </div>
                    <p class="p-4 font-normal leading-5 text-slate-600 text-center overflow-hidden">
                        <a href="' . Route('frontend.single-product', $product->slug) . '">' . $product->name . '</a>
                    </p>
                </div>';
            }
            return response()->json(['status' => 'success', 'html' => $html, 'count' => $count, 'showed' => $showed]);
        }

        if ($request->ajax()) {
            $query = Product::where('status', 1)->where('show_on_website', 1)->where('category_id', $request->category_id);
            $sort = explode('-', $request->sort);
            if ($request->sort != 'price-asc' && $request->sort != 'price-desc') {
                $query->orderBy($sort[0], $sort[1]);
            } elseif ($request->sort == 'price-asc' || $request->sort == 'price-desc') {
                $query->leftJoin('product_prices', 'product_prices.product_id', 'products.id')
                    ->orderBy('product_prices.online_price', $sort[1]);
            }
            $count = $query->count();
            if ($request->show != 'all') {
                $query->limit($request->show);
            }
            $products = $query->get();
            $showed = count($products);
            $html = '';
            foreach ($products as $key => $product) {
                $html .= '<div
                    class="product-showcase card card-' . ($key + 1) . ' border border-solid border-slate-300 hover:shadow-lg rounded-md hover:scale-125 relative bg-white hover:z-10 h-full">
                    <div class="before:content-[] before:pt-[100%] before:block relative image-area">
                        <a href="' . Route('frontend.single-product', $product->slug) . '">
                            <img class="w-full rounded-md absolute inset-0 h-full object-cover"
                                src="' . (file_exists($product->thumbnail) ? asset($product->thumbnail) : asset('frontend/assets/images/default/no_image2.png')) . '" alt="product">
                        </a>
                    </div>
                    <p class="p-4 font-normal leading-5 text-slate-600 text-center overflow-hidden">
                        <a href="' . Route('frontend.single-product', $product->slug) . '">' . $product->name . '</a>
                    </p>
                </div>';
            }
            return response()->json(['status' => 'success', 'html' => $html, 'count' => $count, 'showed' => $showed]);
        }

        if (!is_null($slug)) {
            $category = Category::with('children')->where('slug', $slug)->first();
            $query = Product::with(['price', 'sku'])->where('status', 1)->where('show_on_website', 1)->where(function ($query) use ($category) {
                $childIds = $category->children->pluck('id')->toArray();
                $query->where('category_id', $category->id)->orWhereIn('category_id', $childIds);
            });
            if ($request->min_price || $max_price = $request->max_price) {
                $min_price = $request->min_price;
                $max_price = $request->max_price;
                $query->where(function ($q) use ($min_price, $max_price) {
                    $q->whereHas('price', function ($qq) use ($min_price, $max_price) {
                        $qq->where('sale_price', '>=', $min_price)
                            ->where('sale_price', '<=', $max_price);
                    });
                });
            }
            $products = $query->orderBy('id', 'desc')->paginate(8);
        } else {
            $category = NULL;
            $query = Product::with(['price', 'sku'])->where('status', 1);
            if ($request->min_price || $max_price = $request->max_price) {
                $min_price = $request->min_price;
                $max_price = $request->max_price;
                $query->where(function ($q) use ($min_price, $max_price) {
                    $q->whereHas('price', function ($qq) use ($min_price, $max_price) {
                        $qq->where('sale_price', '>=', $min_price)
                            ->where('sale_price', '<=', $max_price);
                    })->orWhereHas('sku', function ($qq) use ($min_price, $max_price) {
                        $qq->where('price', '>=', $min_price)
                            ->where('price', '<=', $max_price);
                    });
                });
            }

            if ($request->has('attribute')) {
                $attribute = $request->attribute;
                $query->where(function ($query) use ($attribute) {
                    foreach ($attribute as $key => $value) {
                        $str = '"' . $value . '"';
                        $query->orWhere('choice_options', 'like', '%' . $str . '%');
                    }
                });
            }
            $products = $query->where('show_on_website', 1)->orderBy('id', 'desc')->paginate(8);
        }
        return view('frontend.products', compact('products', 'category'));
    }

    public function search(Request $request)
    {
        $search_string = $request->search;
        $products = Product::where('status', 1)->where('show_on_website', 1)->where('name', 'LIKE', '%' . $search_string . '%')->orWhere('slug', 'LIKE', '%' . $search_string . '%')->orderBy('id', 'desc')->paginate(8);
        return view('frontend.products', compact('products', 'search_string'));
    }

    public function ajaxSearch(Request $request)
    {
        $query = $request->search;
        $products_query = Product::where('status', 1)->where('show_on_website', 1);

        $products_query = $products_query->where(function ($q) use ($query) {
            foreach (explode(' ', trim($query)) as $word) {
                $q->where('name', 'like', '%' . $word . '%')
                    ->orWhereHas('sku', function ($q) use ($word) {
                        $q->where('sku', 'like', '%' . $word . '%');
                    });
            }
        });
        $case1 = $query . '%';
        $case2 = '%' . $query . '%';
        $products_query->orderByRaw("CASE
                WHEN name LIKE '$case1' THEN 1
                WHEN name LIKE '$case2' THEN 2
                ELSE 3
                END");
        $products = $products_query->limit(4)->get();
        if (sizeof($products) > 0) {
            return view('frontend.partials.search_content', compact('products'));
        }
        return '0';
    }

    public static function stock($product_id)
    {
        $liftings = DB::table('view_liftings')->whereNotNull('date')->where('product_id', $product_id)->sum('qty');
        $lifting_returns = DB::table('view_lifting_returns')->whereNotNull('date')->where('product_id', $product_id)->sum('qty');
        $client_sales = DB::table('view_sales')->whereNotNull('date')->where('product_id', $product_id)->sum('qty');
        $sales_returns = DB::table('view_sales_returns')->whereNotNull('date')->where('product_id', $product_id)->sum('qty');
        $online_sales = DB::table('view_online_sales')->whereNotNull('store_id')->where('product_id', $product_id)->sum('qty');
        return $liftings + $sales_returns - $lifting_returns - $client_sales - $online_sales;
    }

    public function singleProduct(string $slug)
    {
        $related_products = collect(array());
        $shareComponent = NULL;

        $product = Product::with(['category', 'price', 'sku'])->where('slug', $slug)->where('status', 1)->first();
        if ($product) {
            $related_products = Product::with(['price'])->whereNotIn('id', [@$product->id])->where(function ($query) use ($product) {
                $query->where('vendor_id', @$product->vendor_id)
                    ->orWhere('category_id', @$product->category_id);
            })->where('status', 1)->where('show_on_website', 1)->inRandomOrder()->limit(16)->get();

            // Share Product
            $shareComponent = \Share::page(Route('frontend.single-product', @$product->slug), @$product->name)
                ->facebook()
                ->twitter()
                ->linkedin()
                ->telegram()
                ->whatsapp();
        } else {
            throw new Exception();
        }

        return view('frontend.single_product', compact('product', 'related_products', 'shareComponent'));
    }

    public function viewProduct(Request $request)
    {
        $shareComponent = NULL;
        $product = Product::with(['category', 'price', 'sku'])->findOrFail($request->id);
        if ($product) {
            // Share Product
            $shareComponent = \Share::page(Route('frontend.single-product', @$product->slug), @$product->name)
                ->facebook()
                ->twitter()
                ->linkedin()
                ->telegram()
                ->whatsapp();
        }
        return view('layouts.frontend.partial.modal_body', compact('product', 'shareComponent'))->render();
    }

    public function getVariantPrice(Request $request)
    {
        $product = Product::find($request->id);
        $quantity = $request->quantity;
        if ($product->product_type == 'Fashion') {
            $str = '';
            if (json_decode($product->choice_options) != null) {
                foreach (json_decode($product->choice_options) as $key => $choice) {
                    if ($key > 0) {
                        $str .= '-';
                    }
                    $str .= str_replace(' ', '', $request['attribute_id_' . $choice->attribute_id]);
                }
            }
            $variant = $product->sku->where('sku', $str)->first();
            $price = $variant->price;
            $discount_tk = $variant->discount_tk;
            $stock = HelperClass::stock($variant->id, 'Fashion');
        } else {
            $stock = HelperClass::stock($request->id, 'Consumer');
        }
        if ($quantity > $stock) {
            $quantity = $stock;
        }

        $data = array(
            'regular_price' => number_format($price, 2, '.'),
            'sale_price' => $discount_tk > 0 ? number_format($price - $discount_tk, 2, '.') : NULL,
            'discount_tk' => number_format($discount_tk, 2, '.'),
            'stock' => $stock,
            'variation' => $str,
            'variant_id' => @$variant->id,
            'sku' => @$variant->sku,
            'quantity' => $quantity,
        );
        return $data;
    }

    public function page(string $slug)
    {
        $page = Page::where('slug', $slug)->first();
        return view('frontend.page', compact('page'));
    }

    public function preOrder(string $slug)
    {
        $data = PreOrderSetup::where('slug', $slug)->first();
        return view('frontend.pre_order', compact('data'));
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

    public function preOrderStore(Request $request, string $slug)
    {
        DB::transaction(function () use ($request, $slug, &$order) {
            $data = PreOrderSetup::where('slug', $slug)->first();
            $delivery_date = new DateTime();
            $delivery_date->modify('+72 hours');

            $order = Order::create([
                'company_id' => 1,
                'order_id' => mt_rand(111111, 999999),
                'invoice' => $this->invoice(),
                'user_name' => $request->name,
                'user_phone' => $request->phone,
                'shipping_address' => $request->shipping_address,
                'order_code' => 'R' . mt_rand(111111, 999999),
                'shipping_charge' => 80,
                'sub_total' => $request->qty * $request->price,
                'total' => ($request->qty * $request->price) + 80,
                'discount' => 0,
                'paid' => 0,
                'due' => ($request->qty * $request->price) + 80,
                'order_type' => 'online',
                'coupon_id' => NULL,
                'order_note' => NULL,
                'payment_method' => 'COD',
                'date' => date('Y-m-d'),
                'potential_delivery_date' => $delivery_date->format('Y-m-d'),
                'pending_at' => Carbon::now(),
                'pre_order' => 1,
            ]);

            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $data->product_id,
                'discount' => 0,
                'sale_price' => $request->price,
                'subtotal' => $request->qty * $request->price,
                'quantity' => $request->qty,
            ]);
        });

        return redirect()->route('frontend.success-order')->with(compact('order'));
    }

    public function successOrder(Request $request)
    {
        if (session('order')) {
            $order = Order::with('products')->where('invoice', session('order')->invoice)->where('user_phone', session('order')->user_phone)->orderBy('id', 'desc')->first();
            return view('frontend.success', compact('order'));
        }
        return redirect()->route('frontend.home');
    }
}
