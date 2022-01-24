@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-xl-12 col-lg-12 col-md-12">
		<div class="card shadow-sm my-5">
			<div class="card-body p-0">
				<div class="row">
					<div class="col-lg-12">
						<router-link to="/product" class="btn btn-primary float-right" style="margin-top: 6px;margin-right: 6px;">All Product</router-link>
						<div class="login-form">
							<div class="text-center">
								<h1 class="h4 text-gray-900 mb-4">Edit Product</h1>
							</div>
							<form action='/updateProduct/{{ $productslist->id }}' method="POST" enctype="multipart/form-data">
								@csrf
								<div class="form-group">
									<div class="form-row">
										<div class="col-md-6">
											<input type="text" value="{{ $productslist->product_name }}" class="form-control" id="exampleInputFirstName" placeholder="Enter Product Name" name="product_name">

										</div>
										<div class="col-md-6">
											<input type="number" value="{{ $productslist->product_code }}" class="form-control" id="exampleInputEmail" placeholder="Enter Product Code" name='product_code'>
											<input type="hidden" name="id" value="{{ $productslist->id }}" />
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="form-row">
										<div class="col-md-4">
											<input type="text" value="{{ $productslist->root }}" class="form-control" id="exampleInputPhone" placeholder="Enter root" name='root'>

										</div>
										<div class="col-md-4">
											<input type="number" value="{{ $productslist->buying_price }}" class="form-control" id="exampleInputSalary" placeholder="Enter Buying Price" name='buying_price'>

										</div>
										<div class="col-md-4">
											<input type="number" value="{{ $productslist->selling_price }}" class="form-control" id="exampleInputSalary" placeholder="Enter Selling Price" name='selling_price'>

										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="form-row">
										<div class="col-md-6">
											<input type="date" value="{{ $productslist->buying_date }}" class="form-control" id="exampleInputAddress" placeholder="Enter Buying Date" name='buying_date'>

										</div>
										<div class="col-md-6">
											<input type="number" value="{{ $productslist->product_quantity }}" class="form-control" id="exampleInputNid" placeholder="Enter Product Quantity" name='product_quantity'>

										</div>
									</div>
								</div>
								<div class="form-group">
									<div class="form-row">
										<div class="col-md-6">
											<div class="custom-file">
												<input type="file" class="custom-file-input" name="newImage" id="customFile" onchange="onFileSelected">
												<label class="custom-file-label" for="customFile">Choose file</label>
											</div>
										</div>
										<div class="col-md-6">
											<img src="{{ asset($productslist->image) }}" style="width: 146px">
										</div>
									</div>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Update</button>
								</div>

							</form>
							<div class="text-center">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection