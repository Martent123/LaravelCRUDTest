<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>CRUD TEST</title>
	<meta name="author" content="Chen">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
	<!-- css -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
	<!-- header nav bar -->

	<nav class="flex bg-gray-800 p-5">



		<div class="flex-grow lg:flex w-full items-center pl-2 pt-1">
			<a href="{{url('/')}}" class="block mx-4 my-2 text-white lg:inline-block hover:text-red-600">Home</a>
			<a href="{{url('/docs')}}" class="block mx-4 my-2 text-white lg:inline-block hover:text-red-600">Documentation</a>

		</div>

		
	</nav>