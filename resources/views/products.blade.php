@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-xl-12 col-lg-12 col-md-12">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<!-- Simple Tables -->
				<div class="card">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h2 class="m-0 font-weight-bold text-primary">Product List</h2>
					</div>
					<div class="table-responsive">
						<table class="table align-items-center table-flush">
							<thead class="thead-light">
								<tr>
									<th>Product Name</th>
									<th>Image</th>
									<th>QrCode</th>
									<th>Product Code</th>
									<th>Category</th>
									<th>Supplier</th>
									<th>Root</th>
									<th>Buying Price</th>
									<th>Selling Price</th>
									<th>Product Quantity</th>
									<th>Buying Date</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($productslist as $product)
								<tr v-for="product in filtersearch" :key="product.id">
									<td>{{ $product->product_name }}</td>
									<td><img src="{{ asset($product->image) }}" id="img_size"></td>
									<td><img src="{{ asset($product->qrcode) }}" id="img_size"></td>
									<td>{{ $product->product_code }}</td>
									<td>{{ $product->category_name }}</td>
									<td>{{ $product->name }}</td>
									<td>{{ $product->root }}</td>
									<td>{{ $product->buying_price }}</td>
									<td>{{ $product->selling_price }}</td>
									<td>{{ $product->product_quantity }}</td>
									<td>{{ $product->buying_date }}</td>
									<td>
										<a href="store-products/{{ $product->id }}" class="btn btn-sm btn-primary">Edit</a>
										<a href="deleteProduct/{{ $product->id }}" class="btn btn-sm btn-danger" style="color: white">Delete</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
					<div class="card-footer"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection