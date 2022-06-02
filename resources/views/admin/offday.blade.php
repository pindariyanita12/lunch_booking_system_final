<!DOCTYPE html>
<html lang="en">
<head>
    <title>Offdays</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('css/weekend_style.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

</head>

<body>
    @include('admin.navbar')
    <br>
    <h3 class="text-center">{{__('home.offdaytitle')}}</h3>
    <div class="container mt-5">
        <div class="image">
            <img src="{{ asset('Images/simform_logo.png') }}" class="img-fluid" alt="Responsive image">
        </div>
        <br>
        <div class="heading">

            <h2>Select Off Days</h2>
        </div>
        <hr>
        <div class="date-container">
            <form action="/add-weekend" method="POST">
                @csrf

                <div class="date">
                    <div class="input-group date" id="datepicker">
                        <input type="text" class="form-control" name="dates" multiple placeholder="select weekend date"
                            readonly value="{{ $dates }}">

                        <span class="input-group-append">
                            <span class="input-group-text bg-white">
                                <i class="fa fa-calendar" style="height: 25px"></i>
                            </span>
                        </span>
                    </div>
                </div>

                <div class="date-button">
                    <button class="btn1 btn-primary" style="width: 90%;height: 40px;">Add dates</button>
                </div>
            </form>
        </div>

    </div>

    <script type="text/javascript">
        $(function() {
            $('#datepicker').datepicker({
                format: 'yyyy-mm-dd',
                multidate: true,
            });
        });
    </script>
</body>

</html>
