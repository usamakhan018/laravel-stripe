@extends('base')

@section('content')


<div class="d-flex flex-row">
	@foreach($products as $product)
	<div class="card m-4">
		<div class="card-header">{{ $product->name }}</div>
		<div class="card-body">
			<img src="" class="img-fluid">
			<p>{{ $product->description }}</p>
		</div>
		<div class="card-footer">
			<a href="{{ route('add_to_cart', $product->id) }}" class="btn btn-secondary">Add to cart</a>
			<a href="" class="btn btn-success">Checkout</a>
		</div>
	</div>
	@if($loop->index+1 % 3 == 0)
	</div><div class="d-flex flex-row">
	@endif
	@endforeach
</div>
@endsection