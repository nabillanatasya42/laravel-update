@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-xl-12 col-lg-12 col-md-12">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<!-- Simple Tables -->
				<div class="card">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h2 class="m-0 font-weight-bold text-primary">Vendors List</h2>
						<input type="text" placeholder="Search By Phone" v-model="searchTerm" class="form-control" style="width: 300px;margin-right: -900px;" />
			
					</div>
					<div class="table-responsive">
						<table class="table align-items-center table-flush">
							<thead class="thead-light">
								<tr>
                                    <th>Vendor Id</th>
									<th>Vendor Name</th>
                                    <th>Vendor Number</th>
									<th>Vendor Email</th>
                                    <th>Vendor Address</th>
                                    <th>Action</th>
								</tr>
                                @foreach($vendors as $vendors)
                                <tr>
                                    <td>{{ $vendors->id}}</td>
									<td>{{ $vendors->vendor_name}}</td>
                                    <td>{{ $vendors->vendor_num}}</td>
									<td>{{ $vendors->vendor_email}}</td>
                                    <td>{{ $vendors->vendor_address}}</td>
                                    <td>
                                        <a href="/DeleteVendorProfile/{{$vendors->id}}">Delete</a>
                                        <a href="/UpdateVendorForm/{{$vendors->id}}">Update</a>
                                    </td>
                                </tr>
                                @endforeach
							</thead>
						</table>
					</div>
					<div class="card-footer"></div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
