<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;
session_start();

class BrandProduct extends Controller
{
    public function AuthLogin(){
        // function xac thuc dang nhap
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('/dashboard');
        }else {
            return Redirect::to('/admin')->send();
        }
    }
    public function add_brand_product (){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function all_brand_product (){
        $this->AuthLogin();

        // 2 dong nay la hien thi du lieu lay tu DB ra all_brand_product
        $all_brand_product = DB::table('tbl_brand_products')->get();
        $manager_brand_product = view('admin.all_brand_product')
        ->with('all_brand_product', $all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product', $manager_brand_product);
    }
    public function save_brand_product (Request $request){
        // khai bao bien la 1 array
        $this->AuthLogin();

        $data = array();
        // brand_name la ten cot trong database. brand_product_name la name cua the input
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        DB::table('tbl_brand_products')->insert($data);
        Session::put('message', 'Them danh muc san pham thanh cong');
        return Redirect::to('/add-brand-product');
    }
    public function active_brand_product($brand_product_id){
        $this->AuthLogin();

        DB::table('tbl_brand_products')->where('brand_id', $brand_product_id)
        ->update(['brand_status'=>1]);
        Session::put('message', 'Kich hoat danh muc san pham thanh cong');
        return Redirect::to('/all-brand-product');

    }
    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();

        DB::table('tbl_brand_products')->where('brand_id', $brand_product_id)
        ->update(['brand_status'=>0]);
        Session::put('message', 'Kich hoat danh muc san pham that bai@@');
        return Redirect::to('/all-brand-product');
    }
    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();

        // tro vao database lay ra dong du lieu dau tien co id ma user click vao
        $edit_brand_product = DB::table('tbl_brand_products')
        ->where('brand_id', $brand_product_id)->get();
        // dua du lieu hien thi ra view 
        // tham so 1 cua with la key: de dung lap @foreach, tham so 2 la du lieu nao can hien thi
        $manager_brand_product = view('admin.edit_brand_product')
        ->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }
    public function update_brand_product(Request $request, $brand_product_id){
        $this->AuthLogin();

        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand_products')->where('brand_id', $brand_product_id)
        ->update($data);
        Session::put('message', 'Cập nhật thương hiệu sản phẩm thành công');

        return Redirect::to('/all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();

        DB::table('tbl_brand_products')->where('brand_id', $brand_product_id)
        ->delete();
        Session::put('message', 'Xoá thương hiệu sản phẩm thành công');
        return Redirect::to('/all-brand-product');
    }
    // end function admin page
    public function show_brand_home($brand_id){
        $cate_product = DB::table('tbl_category_products')->where('category_status', '0')->orderBy('category_id', 'desc')
        ->get();
        $brand_product = DB::table('tbl_brand_products')->where('brand_status', '0')->orderBy('brand_id', 'desc')
        ->get();
        $brand_by_id = DB::table('tbl_products')->join('tbl_brand_products', 'tbl_products.brand_id',
        'tbl_brand_products.brand_id')->where('tbl_products.brand_id',$brand_id)->get();
        $brand_name = DB::table('tbl_brand_products')->where('tbl_brand_products.brand_id'
        ,$brand_id)->limit(1)->get();
        return view('pages.brand.show_brand')->with('category', $cate_product)->with('brand', $brand_product)
        ->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name);
    }
}
