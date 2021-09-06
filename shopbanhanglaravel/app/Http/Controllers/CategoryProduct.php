<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Redirect;


session_start();
class CategoryProduct extends Controller
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
    public function add_category_product (){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function all_category_product (){
        $this->AuthLogin();

        // 2 dong nay la hien thi du lieu lay tu DB ra all_category_product
        $all_category_product = DB::table('tbl_category_products')->get();
        $manager_category_product = view('admin.all_category_product')
        ->with('all_category_product', $all_category_product);
        return view('admin_layout')->with('admin.all_category_product', $manager_category_product);
    }
    public function save_category_product (Request $request){
        $this->AuthLogin();

        // khai bao bien la 1 array
        $data = array();
        // category_name la ten cot trong database. category_product_name la name cua the input
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        // echo '<pre>';
        // print_r($data);
        // echo '</pre>';
        DB::table('tbl_category_products')->insert($data);
        Session::put('message', 'Them danh muc san pham thanh cong');
        return Redirect::to('/all-category-product');
    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();

        DB::table('tbl_category_products')->where('category_id', $category_product_id)
        ->update(['category_status'=>1]);
        Session::put('message', 'Kich hoat danh muc san pham thanh cong');
        return Redirect::to('/all-category-product');

    }
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();

        DB::table('tbl_category_products')->where('category_id', $category_product_id)
        ->update(['category_status'=>0]);
        Session::put('message', 'Kich hoat danh muc san pham that bai@@');
        return Redirect::to('/all-category-product');
    }
    public function edit_category_product($category_product_id){
        $this->AuthLogin();

        // tro vao database lay ra dong du lieu dau tien co id ma user click vao
        $edit_category_product = DB::table('tbl_category_products')
        ->where('category_id', $category_product_id)->get();
        // dua du lieu hien thi ra view 
        // tham so 1 cua with la key: de dung lap @foreach, tham so 2 la du lieu nao can hien thi
        $manager_category_product = view('admin.edit_category_product')
        ->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }
    public function update_category_product(Request $request, $category_product_id){
        $this->AuthLogin();

        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_products')->where('category_id', $category_product_id)
        ->update($data);
        Session::put('message', 'Cập nhật danh mục sản phẩm thành công');

        return Redirect::to('/all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();

        DB::table('tbl_category_products')->where('category_id', $category_product_id)
        ->delete();
        Session::put('message', 'Xoá danh mục sản phẩm thành công');

        return Redirect::to('/all-category-product');
    }
    //end function admin page
    public function show_category_home($category_id){
        $cate_product = DB::table('tbl_category_products')->where('category_status', '0')->orderBy('category_id', 'desc')
        ->get();
        $brand_product = DB::table('tbl_brand_products')->where('brand_status', '0')->orderBy('brand_id', 'desc')
        ->get();
        $category_by_id = DB::table('tbl_products')->join('tbl_category_products', 'tbl_products.category_id',
        'tbl_category_products.category_id')->where('tbl_products.category_id',$category_id)->get();
        $category_name = DB::table('tbl_category_products')->where('tbl_category_products.category_id'
        ,$category_id)->first();
        return view('pages.category.show_category')->with('category', $cate_product)->with('brand', $brand_product)
        ->with('category_by_id', $category_by_id)->with('category_name', $category_name);
    }
}
