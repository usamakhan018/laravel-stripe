@extends('base')

@section('content')

add product

<form method="post" action="{{ route('create') }}" enctype="multipart/form-data">
	@csrf
	@method('POST')
	<input type="text" name="name" placeholder="Name" class="form-control mt-2">
	<textarea name="description" placeholder="Description" class="form-control mt-2" rows="10"></textarea>
	<input type="file" name="image" placeholder="image" class="form-control mt-2">
	<input type="number" name="price" placeholder="Price" class="form-control mt-2">
	<input type="submit" name="submit" value="Submit" class="form-control btn-secondary mt-4">
</form>

@endsection