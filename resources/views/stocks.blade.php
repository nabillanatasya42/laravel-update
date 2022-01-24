@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-xl-12 col-lg-12 col-md-12">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<!-- Simple Tables -->
				<div class="card">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h2 class="m-0 font-weight-bold text-primary">Stock List</h2>

					</div>
					<div class="table-responsive">
						<table class="table align-items-center table-flush">
							<thead class="thead-light">
								<tr>
									<th>Product Name</th>
									<th>Product Code</th>
									<th>Image</th>
									<th>Category</th>
									<th>Buying Price</th>
									<th>Status</th>
									<th>Quantity</th>

								</tr>
							</thead>
							<tbody>
								@foreach ($productslist as $product)
								<tr>
									<td>{{ $product->product_name }}</td>
									<td>{{ $product->product_code }}</td>
									<td><img src="{{ asset($product->image) }}" id="img_size"></td>
									<td>{{ $product->category_name }}</td>
									<td>{{ $product->buying_price }}</td>
									<td>
										@if($product->product_quantity >= 1)
										<span class="badge badge-success">Available</span>
										@else
										<span class="badge badge-danger">Stock Out</span>
										@endif
									</td>
									<td>{{ $product->product_quantity }}</td>

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