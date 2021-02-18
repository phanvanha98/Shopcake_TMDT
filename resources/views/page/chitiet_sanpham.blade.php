@extends('master')
@section('content')
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Sản phẩm {{$sanpham->name}}</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="{{route('trang-chu')}}">Trang chủ</a> / <span>Thông tin chi tiết sản phẩm</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							<img src="source/image/product/{{$sanpham->image}}" alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title"><h2>{{$sanpham->name}}</h2></p>
								<p class="single-item-price">
									@if($sanpham->sale==0)
										<span class="flash-sale">{{number_format($sanpham->unit_price)}} đồng</span>
									@else
										<span class="flash-del">{{number_format($sanpham->unit_price)}} đồng</span>
										<span class="flash-sale">{{number_format(($sanpham->unit_price)-(($sanpham->unit_price)*($sanpham->sale))/100)}} đồng</span>
									@endif
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>{{$sanpham->description}}</p>
							</div>
							<div class="space20">&nbsp;</div>

							<!-- <p>Số lượng:</p> -->
							<div class="single-item-options">	
								<a class="add-to-cart" href="{{route('themgiohang',$sanpham->id)}}"><i class="fa fa-shopping-cart"></i></a>
								<div class="clearfix"></div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Mô tả</a></li>
						</ul>

						<div class="panel" id="tab-description">
							<p>{{$sanpham->description}}</p>
						</div>
						<div class="row">
						<?php foreach ($cmt as $cmtt): ?>
							<div class="card mt-2">
						    <div class="card-body">
						        <div class="row">
					        	    <div class="col-md-2">
					        	        <img src="https://image.ibb.co/jw55Ex/def_face.jpg" class="img img-rounded img-fluid"/>
					        	        <p class="text-secondary text-center">15 Minutes Ago</p>
					        	    </div>
					        	    <div class="col-md-10">
					        	    	 <p>
					        	            <strong class="float-left">{{$cmtt->user->full_name}}</strong>
					        	            <span class="float-right"><i class="text-warning fa fa-star"></i></span>
					                        <span class="float-right"><i class="text-warning fa fa-star"></i></span>
					        	            <span class="float-right"><i class="text-warning fa fa-star"></i></span>
					        	            <span class="float-right"><i class="text-warning fa fa-star"></i></span>
					        	            <span class="float-right"><i class="text-warning fa fa-star"></i></span>
        	       						</p>
					        	       <div class="clearfix"></div>
					        	        <p>{{$cmtt->cmt}}</p>
					        	        <p>
					        	            <a class="float-right btn text-white btn-danger"> <i class="fa fa-heart"></i> Like</a>
					        	       </p>
					        	    </div>
						        </div>
						    </div>
						</div>
						<?php endforeach ?>
					</div>
					<div class="row">{{$cmt->links()}}</div>
						<form action="{{route('getcomment',$sanpham->id)}}" method="get">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
							 
								   <label for="comment">Nhập đánh giá của bạn</label>
								   <input type="cmt" class="form-control" placeholder="Đánh giá" name="cmtt">
							 
							  	<button type="submit" class="btn btn-primary mt=2">Submit</button>
						</form>
					</div>
					<div class="space50">&nbsp;</div>
					<div class="beta-products-list">
						<h4>Sản phẩm tương tự</h4>
						<div class="row">
						@foreach($sp_tuongtu as $sptt)
							<div class="col-sm-4">
								<div class="single-item">
									@if($sptt->sale!=0)
										<div class="ribbon-wrapper"><div class="ribbon sale">Sale</div></div>
									@endif
									<div class="single-item-header">
										<a href="{{route('chitietsanpham',$sptt->id)}}"><img src="source/image/product/{{$sptt->image}}" alt="" height="150px"></a>
									</div>
									<div class="single-item-body">
										<p class="single-item-title">{{$sptt->name}}</p>
										<p class="single-item-price" style="font-size: 18px">
											@if($sptt->sale==0)
												<span class="flash-sale">{{number_format($sptt->unit_price)}} đồng</span>
											@else
												<span class="flash-del">{{number_format($sptt->unit_price)}} đồng</span>
												<span class="flash-sale">{{number_format(($sptt->unit_price)-(($sptt->unit_price)*($sptt->sale))/100)}} đồng</span>
											@endif
										</p>
									</div>
									<div class="single-item-caption">
										<a class="add-to-cart pull-left" href="{{route('themgiohang',$sptt->id)}}"><i class="fa fa-shopping-cart"></i></a>
										<a class="beta-btn primary" href="{{route('chitietsanpham',$sptt->id)}}">Details<i class="fa fa-chevron-right"></i></a>
										<div class="clearfix"></div>
									</div>
								</div>
							</div>
						@endforeach
						</div>
						<div class="row">{{$sp_tuongtu->links()}}</div>
					</div> <!-- .beta-products-list -->
				</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Best Sellers</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								<?php foreach ($best as $best ): ?>
									<div class="media beta-sales-item">
									<a class="pull-left" href="{{route('chitietsanpham',$best->id)}}"><img src="source/image/product/{{$best->image}}" alt=""></a>
									<div class="media-body">
										{{$best->name}}
										<span class="beta-sales-price">{{number_format(($best->unit_price)-(($best->unit_price)*($best->sale))/100)}}</span>
									</div>
								</div>	
								<?php endforeach ?>
							</div>
						</div>
					</div> <!-- best sellers widget -->
					<div class="widget">
						<h3 class="widget-title">New Products</h3>
						<div class="widget-body">
							<div class="beta-sales beta-lists">
								<?php foreach ($new as $key): ?>
									<div class="media beta-sales-item">
									<a class="pull-left" href="{{route('chitietsanpham',$key->id)}}"><img src="source/image/product/{{$key->image}}" alt=""></a>
									<div class="media-body">
										{{$key->name}}
										<span class="beta-sales-price">{{number_format(($key->unit_price)-(($key->unit_price)*($key->sale))/100)}}</span>
									</div>
								</div>
								<?php endforeach ?>
							</div>
						</div>
					</div> <!-- best sellers widget -->
				</div>
			</div>
		</div> <!-- #content -->
	</div> <!-- .container -->
	<script type="text/javascript">
		function capnhatsoluong(qty,id){
			console.log(qty.value);
			console.log(id);
		}
	</script>
@endsection