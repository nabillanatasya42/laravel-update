@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
	<div class="col-xl-12 col-lg-12 col-md-12">
		<div class="row">
			<div class="col-lg-12 mb-4">
				<!-- Simple Tables -->
				<div class="card">
					<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
						<h2 class="m-0 font-weight-bold text-primary">Today Order List</h2>
						<input type="text" placeholder="Search By Phone" v-model="searchTerm" class="form-control" style="width: 300px;margin-right: -900px;" />
			
					</div>
					<div class="table-responsive">
						<table class="table align-items-center table-flush">
							<thead class="thead-light">
								<tr>
									<th>Name</th>
									<th>Address</th>
									<th>Phone</th>
									
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($orders as $order)
								<tr v-for="order in filtersearch" :key="order.id">
									<td>{{ $order->name }}</td>
									<td>{{ $order->address }}</td>
									<td>{{ $order->phone }}</td>
									
									<td>
										<select class="form-control" id="status_{{ $order->id }}" name="status[]">
											<option value="Pending" @if($order->status == "Pending") selected @endif >Pending</option>
											<option value="Accepted" @if($order->status == "Accepted") selected @endif>Accepted</option>
											<option value="Cancel" @if($order->status == "Cancel") selected @endif>Cancel</option>
											<option value="Completed" @if($order->status == "Completed") selected @endif>Completed</option>
										</select>
									</td>
									<td>
										<a href="#" onclick="UpdateStatus('{{ $order->id }}')" class="btn btn-sm btn-primary">Update</a>
										<a href="/order-details/{{ $order->id}}" class="btn btn-sm btn-primary">View</a>
										<a href="/delete-order/{{ $order->id }}" class="btn btn-sm btn-danger">Delete</a>
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
<script>
	function UpdateStatus(order_id) {
		var status = document.getElementById("status_" + order_id).value;
		window.location.href = "/update-order-status/" + order_id + "/" + status;
	}
</script>
@endsection