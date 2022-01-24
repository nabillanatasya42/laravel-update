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
			<!-- Table 1 -->
			<div class="col-xl-12 col-lg-12">
				<div class="card mb-4">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h5 class="m-0 font-weight-bold text-primary">Order Details</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<ul class="list-group">
								<li class="list-group-item"><b>Name : </b>{{ $orders[0]->name }}</li>
								<li class="list-group-item"><b>Phone : </b>{{ $orders[0]->phone }}</li>
								<li class="list-group-item"><b>Address : </b>{{ $orders[0]->address }}</li>
								<li class="list-group-item"><b>Order Status : </b>{{ $orders[0]->status }}</li>
								<li class="list-group-item"><b>Date : </b>{{ $orders[0]->order_date }}</li>

							</ul>
						</div>
					</div>
				</div>
			</div>

			<!-- Table 2 
			<div class="col-xl-6 col-lg-6">
				<div class="card mb-4">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h5 class="m-0 font-weight-bold text-primary">Order Details</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<ul class="list-group">
								<li class="list-group-item"><b>Sub Total : </b>{{ $orders[0]->sub_total }}$</li>
								<li class="list-group-item"><b>Vat : </b>{{ $orders[0]->vat }}%</li>
								<li class="list-group-item"><b>Total : </b>{{ $orders[0]->total }}$</li>
								<li class="list-group-item"><b>Pay Amount : </b>{{ $orders[0]->pay }}$</li>
								<li class="list-group-item"><b>Due Amount : </b>{{ $orders[0]->due }}$</li>
							</ul>
						</div>
					</div>
				</div>
			</div>-->
		</div>

		<div class="row mb-3">
			<!-- Table 3 -->
			<div class="col-xl-12 col-lg-12">
				<div class="card mb-4">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h5 class="m-0 font-weight-bold text-primary">Ordered Products</h5>
					</div>
					<div class="card-body">
						<div class="table-responsive">
							<table class="table align-items-center table-flush">
								<thead class="thead-light">
									<tr>
										<th>Product Name</th>
										<th>QrCode</th>
										<th>Image</th>
										<th>Qty</th>

									</tr>
								</thead>
								<tbody>
									@foreach ($details as $product)

									<tr v-for="product in cartProduct" :key="$product->id">
										<td>{{ $product->product_name }}</td>
										<td><img src="{{ asset($product->qrcode) }}" id="img_size" /></td>
										<td><img src="{{ asset($product->image) }}" id="img_size" /></td>

										<td>
											{{ $product->product_quantity }}
										</td>


									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--Row-->

	</div>
</div>

@endsection