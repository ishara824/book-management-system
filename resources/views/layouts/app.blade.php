
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">

    <style>
        #background-image{
            background-image: url('/images/background1.jpg');
            height: 500px;
        }
    </style>

</head>
<body>
<shortcut></shortcut>
<div id='app'></div>
<div>
    <nav class="navbar navbar-expand-lg bg-dark">
        <a class="navbar-brand" href="{{ url('/') }}">Book Store</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        @auth('staff')
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('staff.dashboard') }}">Home <span class="sr-only">(current)</span></a>
                </li>
                @role('admin','staff')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('list.user.ui') }}">Users</a>
                </li>
                @endrole
                @role(['admin','editor'], 'staff')
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('assign.book.ui') }}">Assign Books</a>
                </li>
                @endrole
            </ul>

            <form action="{{ route('staff.logout') }}" method="post" class="form-inline my-2 my-lg-0">
                @csrf
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
            </form>
        </div>
        @endauth

        @auth('reader')
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('reader.dashboard') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('reader.borrowedBooks.ui') }}">Borrowed History</a>
                    </li>
                </ul>
                <form action="{{ route('reader.logout') }}" method="post" class="form-inline my-2 my-lg-0">
                    @csrf
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button>
                </form>
            </div>
        @endauth
    </nav>
    <main class="py-4 main-content" id="content" style="margin-bottom: 3%;margin-top: 3%;">
        @yield('content')
    </main>
</div>
<div>
</div>
</body>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/app.js') }}"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
