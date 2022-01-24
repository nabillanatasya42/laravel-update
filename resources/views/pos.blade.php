@extends('layouts.app')

@section('content')
<div>
	<div class="container-fluid" id="container-wrapper">
		<div class="d-sm-flex align-items-center justify-content-between mb-4">
			<h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="./">Home</a></li>
				<li class="breadcrumb-item active" aria-current="page">Dashboard</li>
			</ol>
		</div>

		<div class="row mb-3">

			<!-- Area Chart -->
			<div class="col-xl-6 col-lg-6">
				<div class="card mb-4">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h5 class="m-0 font-weight-bold text-primary">Add New Order</h5>
						<a href="" class="btn btn-primary btn-sm">Add Customer</a>
					</div>
					<div class="card-body">
						<div class="table-responsive" style="font-size: 12px">
							<table class="table align-items-center table-flush">
								<thead class="thead-light">
									<tr>
										<th>Name</th>
										<th>Qty</th>
										<!--<th>Unit</th>
										<th>Total</th>-->
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									@php
									$total = 0 @endphp
									@php $total_qty = 0 @endphp


									@foreach ($cartproducts as $product)
									@php $total = $total + $product->sub_total @endphp
									@php $total_qty = $total_qty + $product->product_quantity @endphp
									<tr v-for="product in cartProduct" :key="$product->id">
										<td>{{ $product->product_name }}</td>
										<td>
											<div class="input-group bootstrap-touchspin bootstrap-touchspin-injected">

												<input type="text" class="form-control" value="{{ $product->product_quantity }}" style="width: 45px;">

											</div>
										</td>
										<!--<td>${{ $product->product_price }}</td>
										<td>${{ $product->sub_total }}</td>-->
										<td><a href="/add-to-cart-delete/{{ $product->id }}" class="btn btn-sm btn-danger" style="color: white;">X</a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
					<div class="card-footer">
						<div class="order-md-2 mb-4">
							<!--<ul class="list-group mb-3">
								<li class="list-group-item d-flex justify-content-between lh-condensed">
									<div>
										<h6 class="my-0">Total Quantity</h6>
									</div>
									<span class="text-muted">{{$total_qty}}</span>
								</li>
								<li class="list-group-item d-flex justify-content-between lh-condensed">
									<div>
										<h6 class="my-0">Sub Total</h6>
									</div>
									<span class="text-muted">${{ $total }}</span>
								</li>

								<li class="list-group-item d-flex justify-content-between bg-light">
									<div class="text-success">
										<h6 class="my-0">Total (USD)</h6>
									</div>
									<span class="text-success">${{ $total }}</span>
								</li>
							</ul>-->

							<form action="/orderDone" method="POST">
								@csrf
								<input type="hidden" value="{{ $total_qty }}" class="form-control" name="qty" id="exampleFormControlInput1">
								<input type="hidden" value="{{ $total }}" class="form-control" name="total" id="exampleFormControlInput1">
								<input type="hidden" value="{{ $total }}" class="form-control" name="sub_total" id="exampleFormControlInput1">
								<!--<div class="form-group">
									<label for="exampleFormControlSelect1">Select Customer</label>
								</div>
								<div class="form-group">
									<label for="exampleFormControlInput1">Pay</label>
									<input type="text" class="form-control" name="pay" id="exampleFormControlInput1">
								</div>
								<div class="form-group">
									<label for="exampleFormControlInput2">Due</label>
									<input type="text" class="form-control" name="due" id="exampleFormControlInput2">
								</div>
								<div class="form-group">
									<label for="exampleFormControlSelect2">Pay By</label>
									<select class="form-control" id="exampleFormControlSelect2" name="payBy">
										<option value="Cheque">Cheque</option>
										<option value="Hand Cash">Hand Cash</option>
										<option value="Gift Card">Gift Card</option>
									</select>
								</div>-->
								<button class="btn btn-success" type="submit">Submit</button>
							</form>
						</div>
					</div>
				</div>
			</div>

			<!-- Pie Chart -->
			<div class="col-xl-6 col-lg-6">
				<div class="card mb-4">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h5 class="m-0 font-weight-bold text-primary">Choose Products</h5>

						<input type="text" placeholder="Search" name="searchTerm" class="form-control" style="width: 300px;">
					</div>
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Home</a>
						</li>

					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
							<div class="card-body">
								<div class="row">
									@foreach ($productslist as $catProduct)

									<div class="col-lg-4 col-md-4 col-sm-6 col-6" v-for="catProduct in filterCatSearch">

										<div class="card" style="align-items: center; margin-bottom: 10px">
											<a class="btn btn-sm" @if( $catProduct->product_quantity > 0) href="/add-to-cart/{{ $catProduct->id }}" @else href="#" @endif onclick="addToCart(this)">
												<img src="/{{ $catProduct->qrcode }}" class="card-img-top" id="image_size" alt="...">
												<div class="card-body">
													<h5 class="card-title text-center">{{ $catProduct->product_name }}</h5>
													<td><span class="badge badge-success">Available <span class="badge badge-light">{{ $catProduct->product_quantity }}</span></span></td>
													
												</div>
											</a>
										</div>

									</div>
									@endforeach
								</div>
							</div>
						</div>
						<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
							<div class="card-body">
								<div class="row">

								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--Row-->

	</div>
</div>
@endsection