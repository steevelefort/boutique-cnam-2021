<?php

namespace App\Http\Controllers;

use App\Libs\Common;
use Illuminate\Http\Request;
use App\Models\StaticProducts;

class ProductController extends Controller
{
    public function index() {
        $products = StaticProducts::get();
        return view("products.index")->withProducts($products);
    }

    public function showProduct($id) {
        $products = StaticProducts::get();

        $product = null;
        foreach ($products as $item) {
            if ($item->id == $id) $product = $item;
        }

        if ($product!==null)
            return view("products.product")->withProduct($product);

        return view("error")
                ->with("code",404)
                ->with("message","Ce produit n'existe pas");
    }

    public function addToCart(Request $request, $id) {
        $products = StaticProducts::get();
        $cart = $request->session()->get('cart',[]);

        $product = null;
        foreach ($products as $item) {
            if ($item->id == $id) $product = $item;
        }

        if ($product!==null) {
            $found = false;
            foreach ($cart as $line) {
                if ($line->id == $id) {
                    $line->quantity++;
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $product->quantity = 1;
                array_push($cart,$product);
            }
            $request->session()->put('cart',$cart);
            return redirect(url('/cart'));
        } else {
            return view("error")
                ->with("code",404)
                ->with("message","Ce produit n'existe pas");
        }

    }

    public function viewCart(Request $request){
        $cart = $request->session()->get('cart',[]);

        $total = 0;
        $vat = 0;
        foreach ($cart as $product) {
            $total = $product->quantity*$product->price;
            $vat = Common::computeVAT($total, $product->vat);
        }
        return view("cart.index")
            ->withTotal($total)
            ->withVat($vat);
    }


}
