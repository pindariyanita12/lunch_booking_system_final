<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/weekend_style.css') }}">
    <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");
<<<<<<< HEAD
    </style>
</head>

<body>
=======
<<<<<<< HEAD:resources/views/admin/offday.blade.php
  </style>
=======
    </style>
>>>>>>> 1e7f7a5e44540f1714c36a1c05b4390d2559293d:resources/views/admin/login.blade.php
</head>
<body>
<<<<<<< HEAD:resources/views/admin/offday.blade.php
    <nav class="navbar navbar-expand-lg navbar-light bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="/admindashboard">Lunch System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-white" aria-current="page" href="/admindashboard">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="/offday">Off Day</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end text-black" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>
                <ul class="ms-auto mb-0">
                    <li>
                        <form class="d-flex" action="/date-wise" method="post">
                            @csrf
                            <input class="form-control me-2" name="date" type="date" placeholder="Search"
                                aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
=======
>>>>>>> 1e7f7a5e44540f1714c36a1c05b4390d2559293d:resources/views/admin/login.blade.php
>>>>>>> 1e7f7a5e44540f1714c36a1c05b4390d2559293d
    <div class="container">
        <div class="image">
            <img src="{{ asset('Images/simform_logo.png') }}" class="img-fluid" alt="Responsive image">
        </div>
        <br>
        <div class="heading">
<<<<<<< HEAD
            <h2>Login</h2>
=======
<<<<<<< HEAD:resources/views/admin/offday.blade.php
            <h2>Select Off Days</h2>
=======
            <h2>Login</h2>
>>>>>>> 1e7f7a5e44540f1714c36a1c05b4390d2559293d:resources/views/admin/login.blade.php
>>>>>>> 1e7f7a5e44540f1714c36a1c05b4390d2559293d
        </div>
        <hr>
        <div class="date-container">
            <form action="/api/add-weekend" method="POST">
<<<<<<< HEAD

=======

>>>>>>> 1e7f7a5e44540f1714c36a1c05b4390d2559293d

                <div class="date">
                    <div class="input-group date">
                        <input type="text" class="form-control" name="dates" multiple
<<<<<<< HEAD
=======
<<<<<<< HEAD:resources/views/admin/offday.blade.php
                            placeholder="select weekend date" readonly value="{{ $dates }}">
=======
>>>>>>> 1e7f7a5e44540f1714c36a1c05b4390d2559293d
                            placeholder="Enter The Email" value="">
                    </div>
                    <div class="input-group date">
                        <input type="text" class="form-control" name="dates" multiple
                            placeholder="Enter The Email" value="">
<<<<<<< HEAD
=======
>>>>>>> 1e7f7a5e44540f1714c36a1c05b4390d2559293d:resources/views/admin/login.blade.php
>>>>>>> 1e7f7a5e44540f1714c36a1c05b4390d2559293d

                    </div>
                </div>

                <div class="date-button">
<<<<<<< HEAD
                    <button class="btn btn-primary" style="width: 90%;height: 40px;">Add dates</button>
=======
                    <button class="btn1 btn-primary" style="width: 90%;height: 40px;">Add dates</button>
>>>>>>> 1e7f7a5e44540f1714c36a1c05b4390d2559293d
                </div>
            </form>
        </div>

    </div>
<<<<<<< HEAD
=======
<<<<<<< HEAD:resources/views/admin/offday.blade.php
    <script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                multidate: true,
            });
        });
    </script>
=======
>>>>>>> 1e7f7a5e44540f1714c36a1c05b4390d2559293d:resources/views/admin/login.blade.php
>>>>>>> 1e7f7a5e44540f1714c36a1c05b4390d2559293d
</body>

</html>
