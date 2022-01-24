@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-xl-12 col-lg-12 col-md-12">
		<div class="card shadow-sm my-5">
			<div class="card-body p-0">
				<div class="row">
					<div class="col-lg-12">
						<div class="login-form">
							<div class="text-center">
								<h1 class="h4 text-gray-900 mb-4">Add Vendor</h1>
							</div>

                            @if(Session::has('vendor_update'))
                            <span>{{Session::get('vendor_update')}}</span>
                            @endif

                            <br>
                            <br>
                            <form action="{{route('update.vendor')}}" method="POST" enctype="multipart/form-data">
								@csrf
                                <input type= "hidden" name="id" value="{{$vendors->id}}">
								<div class="form-group">
									<div class="form-row">
										<div class="col-mstore-productd-6">
											<input type="text" class="form-control" placeholder="Enter Vendor Name" name="vendor_name" value="{{$vendors->vendor_name}}">
                                        </div>
									</div>
								</div>

								<div class="form-group">
									<div class="form-row">
										<div class="col-md-4">
											<input type="text" class="form-control" placeholder="Enter Vendor Number" name="vendor_num" value="{{$vendors->vendor_num}}">
								        </div>
                                    </div>
                                </div>

			                    <div class="form-group">
									<div class="form-row">
										<div class="col-mstore-productd-6">
											<input type="text" class="form-control" placeholder="Enter Vendor Email" name="vendor_email" value="{{$vendors->vendor_email}}">
										</div>
									</div>
								</div>

                                <div class="form-group">
									<div class="form-row">
										<div class="col-mstore-productd-6">
											<input type="text" class="form-control" placeholder="Enter Vendor Address" name="vendor_address" value="{{$vendors->vendor_address}}">
										</div>
									</div>
								</div>
							

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Submit</button>
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
