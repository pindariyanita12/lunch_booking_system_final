<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/js-cookie/3.0.1/js.cookie.min.js"></script>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.8.10/themes/smoothness/jquery-ui.css" type="text/css">

    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.js"></script>
    <style>
        #spinner:not([hidden]) {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #spinner::after {
            content: "";
            width: 80px;
            height: 80px;
            border: 2px solid #f3f3f3;
            border-top: 3px solid #f25a41;
            border-radius: 100%;
            will-change: transform;
            animation: spin 1s infinite linear
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        #spinnerforarrivelunch:not([hidden]) {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        #spinnerforarrivelunch::after {
            content: "";
            width: 80px;
            height: 80px;
            border: 2px solid #f3f3f3;
            border-top: 3px solid #f25a41;
            border-radius: 100%;
            will-change: transform;
            animation: spin 1s infinite linear
        }

        @keyframes spin {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }
    </style>
    <title></title>
</head>


<body>
    <!-- Navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white">
        <div class="container-fluid">
            <a class="navbar-brand" href="{{ url('/user/welcome') }}">Lunch Booking</a>
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
                        <a class="nav-link" href="{{ url('/user/offday') }}"
                            style="cursor:pointer;">Off-Days</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <li class="nav-item dropdown bg-white">
                        <a class="nav-link dropdown-toggle text-dark" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            Welcome,
                            <script>
                                document.write(window.sessionStorage.getItem('name'));
                            </script>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="logout()" style="cursor: pointer">Logout</a></li>
                        </ul>
                    </li>

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
            <button class="btn btn-primary" style="width: 70%;" id="arrive_lunch" onclick="arriveLunch()">Sign for
                lunch</button>
        </div>
    </div>
    <div hidden id="spinner"></div>
    <div hidden id="spinnerforarrivelunch"></div>
</body>
<script>
    const spinner = document.getElementById("spinner");
    const spinnerforarrivelunch = document.getElementById("spinnerforarrivelunch");

    window.onload = function() {
        document.title = 'Welcome, ' + sessionStorage.getItem('name');
        var user_id = window.sessionStorage.getItem("user_id");
        var token = window.sessionStorage.getItem("token");
        url = '{{ env('API_URL') }}' + '/off-day';
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

                if (data.is_taken) {
                    disableafterlunch();
                }
                weekend_date = '';
                for (i = 0; i < data.offday.length; i++) {
                    weekend_date = weekend_date + data.offday[i].weekend + ',';
                }

                localStorage.setItem('date', weekend_date);
                disable_arrive_button();
            })
        enable_arrive_button();

        if (!sessionStorage.getItem('name')) {
            window.location.href = '{{ env('APP_URL') }}';
        }
    }

    function logout() {
        spinner.removeAttribute('hidden');
        sessionStorage.removeItem('taken');
        var user_id = sessionStorage.getItem("user_id");
        var token = sessionStorage.getItem("token");
        url = '{{ env('API_URL') }}' + '/signout';
        data = {
            user_id: user_id,
            token: token
        };

        params = {
            method: "post",
            headers: {
                "Content-type": "application/json",
                "Access-Control-Allow-Origin": "*",
            },
            body: JSON.stringify(data),
        };

        fetch(url, params).then(function(response) {
            spinner.setAttribute('hidden', '');
            if (response.status == 200) {
                sessionStorage.removeItem("user_id");
                sessionStorage.removeItem("name");
                sessionStorage.removeItem("token");
                sessionStorage.removeItem("date");
                sessionStorage.removeItem("code");
                sessionStorage.removeItem("mail");

                window.location.href = '{{ env('APP_URL') }}';
            } else if (response.status == 401) {
                alert("You are Unauthorized");
                location.reload();
            } else {
                alert("Something went wrong");
            }
        });
    }

    function arriveLunch() {
        spinnerforarrivelunch.removeAttribute('hidden');
        var user_id = sessionStorage.getItem("user_id");
        var token = window.sessionStorage.getItem("token");
        url = '{{ env('API_URL') }}' + '/lunch-taken';
        data = {
            user_id: user_id,
            token: token
        };
        params = {
            method: "post",
            headers: {
                "Content-type": "application/json",
            },
            body: JSON.stringify(data),
        };
        fetch(url, params).then(function(response) {
            spinnerforarrivelunch.setAttribute('hidden', '');
            if (response.status == 409) {
                alert("You already taken Lunch");

                disableafterlunch();
                location.reload();
            } else if (response.status == 404) {
                alert("Something went wrong");
                location.reload();
            } else if (response.status == 401) {
                alert("You are Unauthorized");
                location.reload();
            } else {
                alert("Enjoy your Lunch!");

                disableafterlunch();
                location.reload();
                return response.json();
            }
        });
    }

    function disable_arrive_button() {
        var today = new Date(),
            month = "" + (today.getMonth() + 1),
            day = "" + today.getDate(),
            tommorowDay = "" + (today.getDate() + 1),
            year = today.getFullYear();

        if (month.length < 2) {
            month = "0" + month;
        }
        if (day.length < 2) {
            day = "0" + day;
        }
        if (tommorowDay.length < 2) {
            tommorowDay = "0" + tommorowDay;
        }
        formatDate = [year, month, day].join("-");
        tommorowFormatDate = [year, month, tommorowDay].join("-");
        dateString = localStorage.getItem("date");
        dateArray = dateString.split(",");
        for (var i = 0; i <= dateArray.length; i++) {
            if (dateArray[i] == tommorowFormatDate) {
                document.getElementById("off_day_heading").innerHTML =
                    "Tomorrow is Off-Day!!!";
            } else if (dateArray[i] == formatDate) {
                document.getElementById("arrive_lunch").disabled = true;
                document.getElementById("off_day_heading").innerHTML =
                    "Today is Off-Day!!!";
                break;
            }
        }
    }

    function enable_arrive_button() {

        const t = new Date();
        let h = t.getHours();
        let m = t.getMinutes();
        if (h >= 12 && h <= 16) {
            if ((h == 12 && m >= 20) || h == 13 || h == 14 || h == 15 || (h == 16 && m == 0)) {
                document.getElementById("arrive_lunch").disabled = false;
            } else {
                document.getElementById("arrive_lunch").disabled = true;
            }
        } else {
            document.getElementById("arrive_lunch").disabled = true;
        }
    }

    function disableafterlunch() {

        document.getElementById("arrive_lunch").disabled = true;
        document.getElementById("arrive_lunch").innerText = 'Lunch Taken';

    }
</script>

</html>
