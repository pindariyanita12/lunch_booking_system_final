<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.css">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.js"></script>
    <script src="{{ asset('/js/script.js') }}"></script>
    <title></title>
</head>
<script>
    baseUrl = 'https://lunch-api.dev.local';
    window.onload = function() {
        document.title = 'Welcome, ' + sessionStorage.getItem('name');
        var user_id = window.sessionStorage.getItem("user_id");
        var token = window.sessionStorage.getItem("token");
        url = baseUrl + '/off-day';
        data = {
            "user_id": user_id,
            "token": token
        };
        params = {
            method: 'post',
            headers: {
                'Content-type': 'application/json'
            },
            body: JSON.stringify(data)
        };

        fetch(url, params)
            .then((response) => {
                return response.json();
            }).then((data) => {
                weekend_date = '';
                for (i = 0; i < data.length; i++) {
                    weekend_date = weekend_date + data[i].weekend + ',';
                }

                localStorage.setItem('date', weekend_date);
                disable_arrive_button();
            })

        enable_arrive_button();
        if (!sessionStorage.getItem('name')) {
            window.location.href = "https://lunch-app.dev.local/";
        }
    }
</script>

<body>

    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="https://lunch-app.dev.local/user/welcome">Lunch Booking</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ url('/user/welcome') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/user/offday') }}" style="cursor:pointer;">Off-Days</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item mt-1 me-1" id="myname">
                        Welcome,
                        <script>
                            document.write(window.sessionStorage.getItem('name'));
                        </script>
                    </li>
                    <button class="btn btn-success" onclick="logout()">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <div class="off_day_heading" id="off_day_heading">
    </div>
    <div class="container">
        <div class="image">
            <img src="{{ url('/Images/simform_logo.png') }}" class="img-fluid" alt="Responsive image">
        </div>
        <br>
        <div class="request-heading">
            <h2>Your Lunch</h2>
        </div>
        <hr>

        <div class="request-button">
            <button class="btn btn-primary" style="width: 70%;" id="arrive_lunch" onclick="arriveLunch()">Arrive for
                Lunch</button>
        </div>
    </div>
</body>

</html>
