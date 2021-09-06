@extends('admin_layout')
@section('admin_content')
<div class="row">
    <div class="col-lg-12">
            <section class="panel">
                <header class="panel-heading">
                Cập nhật thương hiệu sản phẩm
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
                    @foreach($edit_brand_product as $key => $edit_value)

                    
                    <div class="position-center">
                    <form role="form" action="{{URL::to('/update-brand-product/'.$edit_value->brand_id)}}" method="post">
                        @csrf 
                        <!-- @csrf: tu tao ra input token, de security -->
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input type="text" value="{{$edit_value->brand_name}}" name="brand_product_name" class="form-control" id="exampleInputEmail1" >
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Mô tả danh mục</label>
                            <textarea style="resize: none"  rows="5" type="password" name="brand_product_desc" class="form-control" id="exampleInputPassword1" 
                            >{{$edit_value->brand_desc}}</textarea>
                        </div>

                        <button type="submit" name="add_brand_product" class="btn btn-info">Cập nhật danh mục</button>
                    </form>
                    </div>
                    @endforeach
                </div>
            </section>

    </div>
    
</div>
@endsection