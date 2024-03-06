<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>@yield('title')</title>
</head>
<body>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
	<div class="container">


		<div class="dropdown">
			@php($total = 0)
			@foreach((array) session('cart') as $product)
			@php($total = $product['price'] * $product['quantity'])
			@endforeach
		  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
		    Cart <span class="badge bg-warning">{{ count(session('cart')) }}</span>
		  </button>
		  <ul class="dropdown-menu">
		  	@foreach(session('cart') as $product)
		    <li class="dropdown-item">
		    	<div class="card mb-3" style="width: 500px;">
				  <div class="row">
				    <div class="col-md-4">
				      <img src="{{ asset('products/'.$product['image']) }}" class="img-fluid" alt="...">
				    </div>
				    <div class="col-md-8">
				      <div class="card-body">
				        <h5 class="card-title">{{ $product['name']}}</h5>
				        <p class="card-text"><b>Price:</b>&nbsp;{{ $product['price'] }}&nbsp;&nbsp;<b>Quantity: {{ $product['quantity'] }}</b></p>
				        <p class="card-text"><small class="text-body-secondary">Last updated 3 mins ago</small></p>
				      </div>
				    </div>
				  </div>
				</div>
		    </li>
		   @endforeach
		    
		    <li class="dropdown-item"><a href="{{ route('cart') }}">View all</a></li>
		  </ul>
		</div>


	</div>
    <div class="container">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>