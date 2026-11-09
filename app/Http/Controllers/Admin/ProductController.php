<?php

namespace App\Http\Controllers\Admin;

use App\HelperClass;
use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProductPrice;
use App\Models\LiftingProduct;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Services\ActionButtons\ActionButtons;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $model = Product::with(['price', 'category', 'attribute'])
                ->orderBy('id', 'desc');
            $type = request('type');
            if (!empty($type) && $type == 'trash') {
                $model->onlyTrashed();
            }
            return DataTables::eloquent($model)
                ->addColumn('checkbox', function ($row) {
                    $lifting = LiftingProduct::where('product_id', $row->id)->first();
                    if (is_null($lifting)) {
                        $checkbox = '<div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input ';
                        if (!empty(request('type')) && request('type') == "trash") {
                            $checkbox .= 'trash_multi_checkbox';
                        } else {
                            $checkbox .= 'multi_checkbox';
                        }
                        $checkbox .= '" id="' . $row->id . '" name="multi_checkbox[]" value="' . $row->id . '"><label for="' . $row->id . '" class="custom-control-label"></label></div>';
                        return $checkbox;
                    }
                })
                ->addColumn('image', function ($row) {
                    return file_exists($row->thumbnail) ? '<img src="' . asset($row->thumbnail) . '" height="30" alt="' . $row->name . '">' : 'No Image';
                })
                ->addColumn('status', function ($row) {
                    $status = '<div class="form-check form-switch">
                    <input class="form-check-input change-status c-pointer" data-url="' . Route('admin.product.edit', $row->id) . '" type="checkbox" name="status" ' . ($row->status == 1 ? 'checked' : '') . '>
                    </div>';
                    return $status;
                })
                ->addColumn('actions', function ($row) {
                    $type = request('type');
                    $data = [
                        'id' => $row->id,
                        'edit' => !empty($type) && $type == 'trash' ? false : true,
                    ];

                    $lifting = LiftingProduct::where('product_id', $row->id)->first();
                    $delete = 'yes';
                    if (!is_null($lifting)) {
                        $delete = 'no';
                    }
                    $additionalBtn = '<a href="' . Route('admin.product.attributes', $row->id) . '" class="btn btn-sm btn-secondary border-0 px-10px tt" data-bs-toggle="tooltip" data-bs-placement="top" title="View Attributes"><i class="fas fa-eye"></i></a>';
                    return ActionButtons::actions($data, $additionalBtn, $delete);
                })
                ->rawColumns(['checkbox', 'image', 'status', 'actions'])
                ->make(true);
        }
        $title = 'Product Setup';
        return view('admin.product.index', compact('title'));
    }

    public function attributes(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $back_link = '';
        return view('admin.product.product_attributes', compact('product', 'back_link'));
    }

    public function attributesUpdate(Request $request, string $id)
    {
        $product = Product::findOrFail($id);
        $product->update([
            'status' => $request->has('status') ? 1 : 0,
            'trending' => $request->has('trending') ? 1 : 0,
            'featured' => $request->has('featured') ? 1 : 0,
            'top_rated' => $request->has('top_rated') ? 1 : 0,
            'best_selling' => $request->has('best_selling') ? 1 : 0,
        ]);
        return redirect()->route('admin.product.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if ($request->ajax() && $request->has('code')) {
            $exist = Product::withTrashed()->where('code', $request->code)->count();
            if ($exist > 0) {
                return response()->json(['status' => 'exist']);
            }
            return response()->json(['status' => 'success']);
        }

        if ($request->ajax()) {
            $child_categories = Category::where('parent_id', $request->id)->where('status', 1)->get();
            return response()->json(['status' => 'success', 'child_categories' => $child_categories]);
        }

        $title = 'Add New Product';
        $categories =  Category::root()->where('status', 1)->get();
        $attributes = Attribute::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.product.create', compact('title', 'categories', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            // 'thumbnail' => 'image',
            'category_id' => 'required',
            'code' => 'required|unique:products,code',
        ]);

        $exist = Product::withTrashed()->where('code', $request->code)->count();
        if ($exist > 0) {
            return redirect()->back()->withErrors('Product code already exists!')->withInput();
        }

        DB::transaction(function () use ($request) {
            // Product Other Images
            $more_images = $request->file('more_images');
            if (isset($more_images)) {
                foreach ($more_images as $key => $more_image) {
                    $response = HelperClass::storeImage($more_image, 800, 'media/product/');
                    if ($response['status'] == 'success') {
                        $img_arr[$key] = $response['path_name'];
                    }
                }
                $more_images_path_names = trim(implode('|', $img_arr), '|');
            } else {
                $more_images_path_names = NULL;
            }

            if ($request->product_type == 'Consumer' || is_null($request->product_type)) {
                $slug = HelperClass::generateUniqueSlug(Product::class, 'slug', $request->name);

                // Store Product
                $product = Product::create([
                    'company_id' => Auth::user()->company_id ?? 1,
                    'product_type' => $request->product_type ?? 'Consumer',
                    'category_id' => $request->category_id,
                    'attribute_id' => $request->attribute_id,
                    'code' => $request->code,
                    'name' => $request->name,
                    'slug' => $slug,
                    'thumbnail' => isset($request->thumbnail) ? HelperClass::saveImage($request->thumbnail, 800, 'media/product/') : NULL,
                    'more_images' => $more_images_path_names,
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                    'additional_info' => $request->additional_info,
                    'meta_title' => $request->meta_title,
                    'meta_description' => $request->meta_description,
                    'meta_keyword' => $request->meta_keyword,
                    'video_id' => $request->video_id,
                    'alert_quantity' => $request->alert_quantity,
                    'ctn_size' => $request->ctn_size ?? 0,
                    'trending' => $request->trending ?? 0,
                    'serial' => $request->serial ?? 0,
                    'created_by' => Auth::user()->id,
                ]);

                // Add Product Price
                ProductPrice::create([
                    'product_id' => $product->id,
                    'lifting_price' => $request->lifting_price,
                    'sale_price' => $request->sale_price,
                    'online_price' => $request->online_price,
                    'discount' => isset($request->discount) ? $request->discount : 0,
                    'discount_tk' => isset($request->discount_tk) ? $request->discount_tk : 0,
                ]);
            }
        });

        return redirect()->route('admin.product.index')->withSuccessMessage('Added Successfully!');
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
    public function edit(Request $request, string $id)
    {
        if ($request->ajax() && $request->has('status')) {
            $data = Product::findOrFail($id);
            $data->update(['status' => !$data->status]);
            return response()->json(['status' => 'success']);
        }

        if ($request->ajax() && $request->has('code')) {
            $exist = Product::withTrashed()->whereNot('id', $id)->where('code', $request->code)->count();
            if ($exist > 0) {
                return response()->json(['status' => 'exist']);
            }
            return response()->json(['status' => 'success']);
        }

        if ($request->ajax() && $request->has('getCategories')) {
            $child_categories = Category::where('parent_id', $request->id)->where('status', 1)->get();
            return response()->json(['status' => 'success', 'child_categories' => $child_categories]);
        }

        $data = Product::findOrFail($id);
        $link = Route('admin.product.update', $data->id);
        $parent_id = NULL;
        $child_id = NULL;
        $subchild_id = NULL;

        $product_category = $data->category;
        if (@$product_category->parent_id) {
            $check_parent = Category::findOrFail($product_category->parent_id);
            if ($check_parent->parent_id) {
                $parent_id = $check_parent->parent_id;
                $child_id = $check_parent->id;
                $subchild_id = $data->category->id;
            } else {
                $parent_id = $check_parent->id;
                $child_id = $data->category->id;
            }
        } else {
            $parent_id = @$data->category->id;
        }

        $parent_categories =  Category::root()->where('status', 1)->get();
        $child_categories = Category::where('parent_id', $parent_id)->get();
        $subchild_categories = Category::where('parent_id', $child_id)->get();
        $title = 'Update Product';
        $attributes = Attribute::where('status', 1)->orderBy('name', 'asc')->get();
        return view('admin.product.edit', compact('title', 'attributes', 'data', 'link', 'parent_id', 'child_id', 'subchild_id', 'parent_categories', 'child_categories', 'subchild_categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required',
            'code' => 'required|unique:products,code,' . $id,
        ]);

        $exist = Product::withTrashed()->whereNot('id', $id)->where('code', $request->code)->count();
        if ($exist > 0) {
            return redirect()->back()->withErrors('Product code already exists!')->withInput();
        }

        DB::transaction(function () use ($request, $id) {
            $product = Product::findOrFail($id);

            // Product Other Images
            $more_images = $request->file('more_images');
            if (isset($more_images)) {
                foreach ($more_images as $key => $more_image) {
                    $response = HelperClass::storeImage($more_image, 800, 'media/product/');
                    if ($response['status'] == 'success') {
                        $img_arr[$key] = $response['path_name'];
                    }
                }
                $more_images_path_names = trim(implode('|', $img_arr), '|');

                $old_more_images = explode('|', $product->more_images);
                foreach ($old_more_images as $key => $image) {
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }
            } else {
                $more_images_path_names = $product->more_images;
            }

            $slug = HelperClass::generateUniqueSlug(Product::class, 'slug', $request->name);

            // Update Product
            $product->update([
                'company_id' => Auth::user()->company_id ?? 1,
                'product_type' => $request->product_type ?? 'Consumer',
                'attribute_id' => $request->attribute_id,
                'category_id' => $request->category_id,
                'name' => $request->name,
                'code' => $request->code,
                'slug' => $slug,
                'thumbnail' => isset($request->thumbnail) ? HelperClass::saveImage($request->thumbnail, 800, 'media/product/', $product->thumbnail) : $product->thumbnail,
                'more_images' => $more_images_path_names,
                'short_description' => $request->short_description,
                'description' => $request->description,
                'additional_info' => $request->additional_info,
                'meta_title' => $request->meta_title,
                'meta_description' => $request->meta_description,
                'meta_keyword' => $request->meta_keyword,
                'video_id' => $request->video_id,
                'alert_quantity' => $request->alert_quantity,
                'ctn_size' => $request->ctn_size ?? 0,
                'trending' => $request->trending ?? 0,
                'serial' => $request->serial ?? 0,
                'updated_by' => Auth::user()->id,
            ]);

            $product->price()->updateOrCreate(
                ['product_id' => $product->id], // Matching condition
                [
                    'lifting_price' => $request->lifting_price,
                    'sale_price' => $request->sale_price,
                    'online_price' => $request->online_price,
                    'discount' => $request->discount ?? 0,
                    'discount_tk' => $request->discount_tk ?? 0,
                ]
            );
        });

        return redirect()->route('admin.product.index')->withSuccessMessage('Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Recovery Deleted Data
        if (request()->has('recovery') && request('recovery') == 'true') {
            $data = Product::onlyTrashed()->findOrFail($id);
            $data->restore();
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items Permanent
        if (request()->has('id') && request()->has('parmanent') && request('parmanent') == 'true') {
            foreach (request('id') as $id) {
                $data = Product::onlyTrashed()->findOrFail($id);
                if (count($data->orderProducts) == 0) {
                    if (file_exists($data->thumbnail)) {
                        unlink($data->thumbnail);
                    }
                    $old_more_images = explode('|', $data->more_images);
                    foreach ($old_more_images as $key => $image) {
                        if (file_exists($image)) {
                            unlink($image);
                        }
                    }
                    if (file_exists($data->video)) {
                        unlink($data->video);
                    }
                    ProductPrice::where('product_id', $id)->delete();
                    $data->forceDelete();
                } else {
                    return response()->json(['status' => 'error']);
                }
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item Permanent
        if (request()->has('parmanent') && request('parmanent') == 'true') {
            $data = Product::onlyTrashed()->findOrFail($id);
            if (count($data->orderProducts) == 0) {
                if (file_exists($data->thumbnail)) {
                    unlink($data->thumbnail);
                }
                $old_more_images = explode('|', $data->more_images);
                foreach ($old_more_images as $key => $image) {
                    if (file_exists($image)) {
                        unlink($image);
                    }
                }
                if (file_exists($data->video)) {
                    unlink($data->video);
                }
                ProductPrice::where('product_id', $id)->delete();
                $data->forceDelete();
            } else {
                return response()->json(['status' => 'error']);
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Multiple Items
        if (request()->has('id')) {
            foreach (request('id') as $id) {
                $data = Product::findOrFail($id);
                if (count($data->orderProducts) == 0) {
                    $data->update(['deleted_by' => Auth::user()->id]);
                    $data->delete();
                } else {
                    return response()->json(['status' => 'error']);
                }
            }
            return response()->json(['status' => 'success']);
        }

        // Delete Single Item
        $data = Product::findOrFail($id);
        if (count($data->orderProducts) == 0) {
            $data->update(['deleted_by' => Auth::user()->id]);
            $data->delete();
        } else {
            return response()->json(['status' => 'error']);
        }
        return response()->json(['status' => 'success']);
    }
}
