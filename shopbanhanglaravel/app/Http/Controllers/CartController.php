<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;
session_start();
class CartController extends Controller
{
    public function save_cart(Request $request){
        
        // tro toi name lay ra id, vi no co value chua id
        $productId = $request->productid_hidden;
        $quantity = $request->qty;
        // lay thong tin dua vao Id truyen vao
        $product_info = DB::table('tbl_products')->where('product_id', $productId)
        ->first();
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        // echo 'xin chao';
        
        // Cart::add('293ad', 'Product 1', 1, 9.99, 550);
        $data['id'] = $productId;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '123';
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        return Redirect::to('/show-cart');

    }
    public function show_cart(){
        $cate_product = DB::table('tbl_category_products')->where('category_status', '0')->orderBy('category_id', 'desc')
        ->get();
        $brand_product = DB::table('tbl_brand_products')->where('brand_status', '0')->orderBy('brand_id', 'desc')
        ->get();
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product);

    }
    public function delete_to_cart($rowId){
        Cart::update($rowId, 0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request){
        // tu bien request tro toi name rowId_cart la lay dc value value="{{$v_content->rowId}}"
        $rowId = $request->rowId_cart;
        $quantity = $request->cart_quantity;
        Cart::update($rowId, $quantity);
        return Redirect::to('/show-cart');
    }
}
