@extends('layout')
@section('content')
<section id="cart_items">
    
		<div class="container">
		<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{URL::to('/')}}">Home</a></li>
				  <li class="active">Thanh toan gio hang</li>
				</ol>
			</div>

			
			

			
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>
            <div class="container">
			
			<div class="table-responsive cart_info">
                <?php
                use Gloudemans\Shoppingcart\Facades\Cart;
                $content = Cart::content();
                ?>

				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Desciption</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
                        @foreach($content as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to('public/uploads/product/'.$v_content->options->image)}}"
                                width="50" alt="" />
                                </a>
							</td>
							<td class="cart_description">
								<h4><a href="#">{{$v_content->name}}</a></h4>
								<p>Web ID: 1089772</p>
							</td>
							<td class="cart_price">
								<p>{{number_format($v_content->price).' VND'}}</p>
							</td>
							<td class="cart_quantity">
								<div class="cart_quantity_button">
									<form action="{{URL::to('/update-cart-quantity')}}" method="post">
										@csrf
									<input class="cart_quantity_input" type="text" name="cart_quantity" value="{{$v_content->qty}}" >
									<input type="hidden" value="{{$v_content->rowId}}" name="rowId_cart"
									class="form control">
									<input type="submit" value="update" name="update_qty"
									class="btn btn-default btn-sm">
									</form>
								</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">
                                    <?php
                                        $subtotal = $v_content->price * $v_content->qty;
                                        echo number_format($subtotal).' '.'vnd';
                                    ?>
                                </p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->rowId)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                        @endforeach
                        
		
	
					</tbody>
				</table>
			</div>
		</div>
			<h4 style="margin:40px 0;font-size: 20px ">Chọn hình thức thanh toán:

            </h4>
            <form action="{{URL::to('/order-place')}}" method="post">
            @csrf
			<div class="payment-options">
					<span>
						<label><input name="payment_option" type="checkbox" value="1"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input name="payment_option" type="checkbox" value="2"> Pay in cash</label>
					</span>
					<span>
						<label><input name="payment_option" type="checkbox" value="3">International payment</label>
					</span>
                    <input type="submit" value="Đặt hàng" name="send_order_place"
									class="btn btn-primary btn-sm">
				</div>
                </form>
		</div>
	</section> <!--/#cart_items-->
@endsection