<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Data Visualization Tool</title>
	<meta name="author" content="Chen">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- css -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</head>
<body>
	<!-- header nav bar -->

	<nav class="flex bg-gray-800 p-5">



		<div class="flex-grow lg:flex w-full items-center pl-2 pt-1">
			<a href="{{url('/')}}" class="block mx-4 my-2 text-white lg:inline-block hover:text-red-600">Home</a>
			<a href="{{url('/docs')}}" class="block mx-4 my-2 text-white lg:inline-block hover:text-red-600">Documentation</a>

            <!-- only display student button for user who have auth -->
            @auth
            <a href="{{url('/student')}}" class="block mx-4 my-2 text-white lg:inline-block hover:text-red-600">Student List</a>
            @endauth
		</div>

		<!-- login button -->
			<div class="flex-grow lg:flex mx-4 items-center">

			@auth
			<div class="hidden sm:flex sm:items-center sm:ml-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm text-white font-medium hover:text-red-600 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div>{{ Auth::user()->name }}</div>

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">

                    	<!-- redirect to student -->
                        <form method="GET" action="{{ route('student') }}">
                            @csrf

                            <x-dropdown-link :href="route('student')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('student') }}
                            </x-dropdown-link>

                        </form>

                        <!-- redirect to student page -->
                        <form method="GET" action="{{ route('student') }}">
                            @csrf

                            <x-dropdown-link :href="route('student')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('student Dataset') }}
                            </x-dropdown-link>

                        </form>

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>

                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

			@endauth

			@guest
			<a href="{{ route('login') }}" class="m-5 inline-block text-sm px-5 py-1 my-auto border rounded text-white bg-gray-800 border-white  hover:bg-red-700 ">LogIn</a>
			@if (Route::has('register'))
				<a href="{{ route('register') }}" class="m-5 inline-block text-sm px-5 py-1 my-auto border rounded text-white bg-red-700 border-white hover:bg-gray-800 ">SignUp</a>
			@endif
			@endguest

			</div>
		
	</nav>