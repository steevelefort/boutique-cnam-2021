<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Libs\Common;
use App\Models\Product;
use Illuminate\Http\Request;
// use App\Models\StaticProducts;

class ProductController extends Controller
{
    public function index() {
        //$products = StaticProducts::get();
        $products = Product::orderBy('name')->get();
        return view("products.index")
            ->with('products',$products)
            ;
    }

    public function showProduct($id) {
        $product = Product::findOrFail($id);

        if ($product!==null)
            return view("products.product")->withProduct($product);

        return view("error")
                ->with("code",404)
                ->with("message","Ce produit n'existe pas");
    }

    public function addToCart(Request $request, $id) {
        $product = Product::findOrFail($id);
        $cart = $request->session()->get('cart',[]);

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

    public function createProduct() {
        return view("products.create");
    }

    public function saveProduct(ProductRequest $request) {

        $product = Product::create($request->all());

        if ($request->image != null) {
            $image = $product->id . '.' . $request->image->extension();
            $request->file('image')->move(public_path('images'), $image);
            $product->image = $image;
            $product->save();
        }

        return redirect('/');

    }

}
