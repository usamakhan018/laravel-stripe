@extends('base')


@section('content')
<div class="row">
	<h3 class="text-center">Cart</h3><br><br>
	<table>
		<thead>
			<tr>
				<th>Image</th>
				<th>Name</th>
				<th>Price</th>
				<th>Quantity</th>
				<th>Total</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			@foreach(session('cart') as $product)
			<tr id="product_{{ $product['id'] }}" onchange="updateCart({{$product['id']}})">
				<td><img src="{{ asset('products/'.$product['image']) }}" width="150px"></td>
				<td>{{ $product['name'] }}</td>
				<td>{{ $product['price'] }}</td>
				<td><input type="number" min="1" name="quantity" id="quantity" class="form-control" value="{{ $product['quantity'] }}"></td>
				<td>{{ $product['price'] * $product['quantity'] }}</td>
				<td><button onclick="removeProduct({{ $product['id'] }})" class="btn btn-danger">Remove From Cart</button></td>
			</tr>
			@endforeach
		</tbody>
		<tfoot>
			<tr>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td><a class="btn btn-warning" href="{{ route('index') }}">Continue Shopping</a></td>
				<td><a class="btn btn-secondary" href="{{ route('checkout') }}">Checkout</a></td>
			</tr>
		</tfoot>
	</table>
</div>

<script type="text/javascript">
	function removeProduct(id) {
		$.ajax({
			url: "{{ route('remove_product') }}",
			method: 'post',
			data: {_token: "{{ csrf_token() }}", id: id},
			success: () => {window.location.reload(	)}

		})
	}

	function updateCart(id){
		quantity = $('#product_'+id).children('td').children('#quantity').val()
		console.log(quantity)
		$.ajax({
			url: "{{ route('update_cart') }}",
			method: 'post',
			data: {_token: "{{ csrf_token() }}", id: id, quantity: quantity},
			success: () => {window.location.reload()},
		})
	}
</script>
@endsection