<?php

namespace App\Http\Controllers\Customer;

use App\HelperClass;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductSku;
use App\Models\Setting;
use App\Models\Attribute;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        if (!is_null($request->variant_id)) {
            $stock = HelperClass::stock($request->variant_id, 'Fashion');
        } else {
            $stock = HelperClass::stock($request->id, 'Consumer');
        }
        // if ($stock < 1) {
        //     return response()->json(['status' => 'error', 'data' => 'Stock Out']);
        // }

        $setting = Setting::first();

        $cart = session()->get('cart');
        if (is_null($cart)) {
            $data = $this->sessionData($request->id, $request->variant_id, $request->quantity);

            if (!is_null($request->variant_id)) {
                $cart = [
                    'product_' . $request->id . '_variant_' . $request->variant_id => $data
                ];
            } else {
                $cart = [
                    'product_' . $request->id => $data
                ];
            }
            session()->put('cart', $cart);

            $append =
                '<li class="minicart-item" id="cart-item-' . $data['product_id'] . '-v-' . $data['variant_id'] . '">
                    <div class="minicart-item-inner">
                        <div class="minicart-item-left">
                            <a class="minicart-item-photo"
                                href="' . Route('frontend.single-product', $data['slug']) . '"
                                title="' . $data['name'] . '">
                                <div class="ratio ratio-1x1"
                                    style="width: 75px;">
                                    <img class="fit-cover"
                                        src="' . asset(file_exists($data['thumbnail']) ? $data['thumbnail'] : @$setting->placeholder) . '"
                                        alt="' . $data['name'] . '">
                                </div>
                            </a>
                            <div class="cart-actions">
                                <a href="javascript:void(0)"
                                    class="action delete" title="Remove item" data-id="' . $data['product_id'] . '" data-variant="' . $data['variant_id'] . '">
                                    <i class="far fa-times"></i>
                                </a>
                                <a class="action edit"
                                    href="' . Route('frontend.single-product', $data['slug']) . '"
                                    title="Edit item">
                                    <i class="fas fa-pencil-alt"
                                        style="font-size: 80%;"></i>
                                </a>
                            </div>
                        </div>
                        <div class="minicart-item-details">
                            <div class="product-name">
                                <a href="' . Route('frontend.single-product', $data['slug']) . '">' . $data['name'] . '</a>
                            </div><div>';

            foreach ($data['choose_options'] as $key => $option) {
                $append .= $key . ' : ' . $option . ',  &nbsp; ';
            }
            $append .= '</div>';

            if ($data['discount_tk'] > 0) {
                $append .= '<div class="price-box"><span class="special-price">
                                <span class="price">TK ' . number_format($data['price'] - $data['discount_tk'], 2, '.') . '</span>
                            </span>
                            <span class="old-price">
                                <span class="price">TK ' . number_format($data['price'], 2, '.') . '</span>
                            </span></div>';
            } else {
                $append .= '<div class="price-box"><span class="special-price">
                                <span class="price">TK ' . number_format($data['price'], 2, '.') . '</span>
                            </span></div>';
            }
            $append .= '</div>
                        <div class="minicart-item-actions">
                            <div class="details-qty qty">
                                <label class="label"
                                    for="cart-item-' . $data['product_id'] . $data['variant_id'] . '-qty">Qty</label>
                                    <div>
                                        <input type="number" size="4"
                                            class="item-qty cart-item-qty"
                                            maxlength="12" id="cart-item-' . $data['product_id'] . '-v-' . $data['variant_id'] . '-qty"
                                            value="' . $data['qty'] . '">
                                    </div>
                            </div>
                        </div>
                    </div>
                </li>';

            if ($request->ajax()) {
                $price = ($data['price'] - $data['discount_tk']) * $data['qty'];
                return response()->json(['status' => 'success', 'append' => $append, 'total_cart_items' => 1, 'total_cart_price' => $price]);
            } else {
                return redirect()->route('customer.checkout')->withSuccessMessage('Product Added Successfully!');
            }
        }

        $selector = '#cart-item-' . $request->id . '-v-' . $request->variant_id . '-qty';
        if (!is_null($request->variant_id)) {
            if (isset($cart['product_' . $request->id . '_variant_' . $request->variant_id])) {
                $cart['product_' . $request->id . '_variant_' . $request->variant_id]['qty'] += $request->quantity;
                session()->put('cart', $cart);
                $total_cart_price = 0;
                foreach ($cart as $item) {
                    $total_cart_price += ($item['price'] - $item['discount_tk']) * $item['qty'];
                }
                if ($request->ajax()) {
                    return response()->json(['status' => 'quantity_updated', 'qty' => $cart['product_' . $request->id . '_variant_' . $request->variant_id]['qty'], 'selector' => $selector, 'total_cart_price' => number_format($total_cart_price, 2)]);
                } else {
                    return redirect()->route('customer.cart')->withSuccessMessage('Product Added Successfully!');
                }
            }
        } else {
            if (isset($cart['product_' . $request->id])) {
                $cart['product_' . $request->id]['qty'] += $request->quantity;
                session()->put('cart', $cart);
                $total_cart_price = 0;
                foreach ($cart as $item) {
                    $total_cart_price += ($item['price'] - $item['discount_tk']) * $item['qty'];
                }
                if ($request->ajax()) {
                    return response()->json(['status' => 'quantity_updated', 'qty' => $cart['product_' . $request->id]['qty'], 'selector' => $selector, 'total_cart_price' => number_format($total_cart_price, 2)]);
                } else {
                    return redirect()->route('customer.cart')->withSuccessMessage('Product Added Successfully!');
                }
            }
        }

        $data = $this->sessionData($request->id, $request->variant_id, $request->quantity);

        if (!is_null($request->variant_id)) {
            $cart['product_' . $request->id . '_variant_' . $request->variant_id] = $data;
        } else {
            $cart['product_' . $request->id] = $data;
        }
        session()->put('cart', $cart);

        $append =
            '<li class="minicart-item" id="cart-item-' . $data['product_id'] . '-v-' . $data['variant_id'] . '">
                <div class="minicart-item-inner">
                    <div class="minicart-item-left">
                        <a class="minicart-item-photo"
                            href="' . Route('frontend.single-product', $data['slug']) . '"
                            title="' . $data['name'] . '">
                            <div class="ratio ratio-1x1"
                                style="width: 75px;">
                                <img class="fit-cover"
                                    src="' . asset(file_exists($data['thumbnail']) ? $data['thumbnail'] : @$setting->placeholder) . '"
                                    alt="' . $data['name'] . '">
                            </div>
                        </a>
                        <div class="cart-actions">
                            <a href="javascript:void(0)"
                                class="action delete" title="Remove item" data-id="' . $data['product_id'] . '" data-variant="' . $data['variant_id'] . '">
                                <i class="far fa-times"></i>
                            </a>
                            <a class="action edit"
                                href="' . Route('frontend.single-product', $data['slug']) . '"
                                title="Edit item">
                                <i class="fas fa-pencil-alt"
                                    style="font-size: 80%;"></i>
                            </a>
                        </div>
                    </div>
                    <div class="minicart-item-details">
                        <div class="product-name">
                            <a href="' . Route('frontend.single-product', $data['slug']) . '">' . $data['name'] . '</a>
                        </div><div>';

        foreach ($data['choose_options'] as $key => $option) {
            $append .= $key . ' : ' . $option . ',  &nbsp; ';
        }
        $append .= '</div>';

        if ($data['discount_tk'] > 0) {
            $append .= '<div class="price-box"><span class="special-price">
                            <span class="price">TK ' . number_format($data['price'] - $data['discount_tk'], 2, '.') . '</span>
                        </span>
                        <span class="old-price">
                            <span class="price">TK ' . number_format($data['price'], 2, '.') . '</span>
                        </span></div>';
        } else {
            $append .= '<div class="price-box"><span class="special-price">
                            <span class="price">TK ' . number_format($data['price'], 2, '.') . '</span>
                        </span></div>';
        }
        $append .= '</div>
                    <div class="minicart-item-actions">
                        <div class="details-qty qty">
                            <label class="label"
                                for="cart-item-' . $data['product_id'] . $data['variant_id'] . '-qty">Qty</label>
                                <div>
                                    <input type="number" size="4"
                                        class="item-qty cart-item-qty"
                                        maxlength="12" id="cart-item-' . $data['product_id'] . '-v-' . $data['variant_id'] . '-qty"
                                        value="' . $data['qty'] . '">
                                </div>
                        </div>
                    </div>
                </div>
            </li>';

        if ($request->ajax()) {
            $cart = session()->get('cart');
            $total_cart_price = 0;
            foreach ($cart as $item) {
                $total_cart_price += ($item['price'] - $item['discount_tk']) * $item['qty'];
            }
            return response()->json(['status' => 'success', 'append' => $append, 'total_cart_items' => count($cart), 'total_cart_price' => $total_cart_price]);
        } else {
            return redirect()->route('customer.checkout')->withSuccessMessage('Product Added Successfully!');
        }
    }

    public function updateCart(Request $request)
    {
        $cart = session()->get('cart');
        if (!is_null($request->variant_id)) {
            $query = 'product_' . $request->product_id . '_variant_' . $request->variant_id;
        } else {
            $query = 'product_' . $request->product_id;
        }

        if (isset($cart[$query])) {
            $cart[$query]['qty'] = $request->quantity;
            session()->put('cart', $cart);
            $cart = session()->get('cart');
            $total_cart_price = 0;
            foreach ($cart as $item) {
                $total_cart_price += ($item['price'] - $item['discount_tk']) * $item['qty'];
            }
            $delivery_charge = \App\Models\DeliveryCharge::first();
            $total_with_shipping = $total_cart_price + @$delivery_charge->inside_charge;
            if ($request->ajax()) {
                return response()->json(['status' => 'success', 'query' => $query, 'qty' => $cart[$query]['qty'], 'subtotal' => $cart[$query]['qty'] * ($cart[$query]['price'] - $cart[$query]['discount_tk']), 'product_id' => $request->product_id, 'total_cart_price' => number_format($total_cart_price, 2), 'total_with_shipping' => number_format($total_with_shipping, 2)]);
            }
        }
    }

    protected function sessionData($product_id, $variant_id, $quantity)
    {
        $product = Product::findOrFail($product_id);
        $selected_attr = [];
        if (!is_null($variant_id)) {
            $variant = ProductSku::findOrFail($variant_id);
            $options = json_decode($product->choice_options);
            $selected_options = explode('-', $variant->sku);
            foreach ($options as $option) {
                foreach ($selected_options as $item) {
                    if (in_array($item, $option->values)) {
                        $attribute = Attribute::find($option->attribute_id);
                        $selected_attr[@$attribute->name] = $item;
                    }
                }
            }
        }
        return [
            'product_type' => $product->product_type,
            'product_id' => $product_id,
            'variant_id' => $variant_id,
            'choose_options' => $selected_attr,
            'sku' => @$variant->sku,
            'name' => $product->name,
            'price' => @$product->price->online_price ?? @$variant->price,
            'discount_tk' => @$product->price->discount_tk ?? @$variant->discount_tk,
            'slug' => $product->slug,
            'thumbnail' => $product->thumbnail,
            'qty' => $quantity,
        ];
    }

    public function cart()
    {
        return view('customer.cart');
    }

    public function removeFromCart(Request $request)
    {
        $selector = '#cart-item-' . $request->id . '-v-' . $request->variant_id;
        $cart = session()->get('cart');
        if (!is_null($request->variant_id)) {
            if (isset($cart['product_' . $request->id . '_variant_' . $request->variant_id])) {
                unset($cart['product_' . $request->id . '_variant_' . $request->variant_id]);
            }
        } else {
            if (isset($cart['product_' . $request->id])) {
                unset($cart['product_' . $request->id]);
            }
        }
        session()->put('cart', $cart);
        $cart = session()->get('cart');
        $total_cart_price = 0;
        foreach ($cart as $item) {
            $total_cart_price += ($item['price'] - $item['discount_tk']) * $item['qty'];
        }
        return response()->json(['status' => 'success', 'selector' => $selector, 'total_cart_items' => count($cart), 'total_cart_price' => $total_cart_price]);
    }
}
