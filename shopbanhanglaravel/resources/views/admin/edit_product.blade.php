@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                Cập nhật sản phẩm
                </header>
                <?php
                            use Illuminate\Support\Facades\Session;
                            $message = Session::get('message');
                            if($message){
                            echo '<span class="text-alert">'.$message.'</span>';
                            Session::put('message', null);
                            }
                        ?>
                <div class="panel-body">
                    <!-- key cua with qua ben blade la thanh variable -->
                    
                    
                    <div class="position-center">
                        @foreach($edit_product as $key => $pro)
                        <form role="form" action="{{URL::to('/update-product/'.$pro->product_id)}}" method="post"
                        enctype="multipart/form-data"
                        >
                        @csrf 
                        <!-- @csrf: tu tao ra input token, de security -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên san pham</label>
                            <input type="text" value="{{$pro->product_name}}"  name="product_name" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">giá</label>
                            <input type="text" value="{{$pro->product_price}}"  name="product_name" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                            <input type="file" value="{{$pro->product_image}}"  name="product_image" class="form-control" id="exampleInputEmail1" >
                            <img src="{{URL::to('public/uploads/product/'.$pro->product_image)}}" height="200" width="200"
                            
                            >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                            <textarea style="resize: none"  rows="5" type="password" name="product_desc" class="form-control" id="exampleInputPassword1" 
                            >{{$pro->product_desc}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Nôi dung sản phẩm</label>
                            <textarea style="resize: none"  rows="5" type="password" name="product_desc" class="form-control" id="exampleInputPassword1" 
                            >{{$pro->product_content}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Danh mục sản phẩm</label>
                            <select name="product_cate" class="form-control input-sm m-bot15">
                            @foreach($cate_product as $key => $cate)
                                @if($cate->category_id == $pro->category_id)

                                <option selected value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                @else
                                <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>

                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Thương hiệu</label>
                        <select name="product_brand" class="form-control input-sm m-bot15">
                            
                                @foreach($brand_product as $key => $brand)
                                @if($brand->brand_id == $pro->brand_id)
                                <option selected value="{{$brand->brand_id}}">{{$brand->brand_name}} : {{$brand->brand_desc}}</option>
                                @else
                                <option value="{{$brand->brand_id}}">{{$brand->brand_name}} : {{$brand->brand_desc}}</option>

                                @endif
                                @endforeach
                        </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">hiển thị</label>
                        <select name="product_status" class="form-control input-sm m-bot15">
                                <option value="0">ẨN</option>
                                <option value="1">Hiển thị</option>
                            
                        </select>
                        </div>

                        <button type="submit" name="add_product" class="btn btn-info">Cập nhật sản phẩm</button>
                        </form>
                        @endforeach
                    </div>
                </div>
            </section>

    </div>
    
</div>
@endsection