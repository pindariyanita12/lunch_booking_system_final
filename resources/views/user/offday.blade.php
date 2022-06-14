<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.css">
    <link rel="stylesheet" href="{{ asset('css/style2.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.js"></script>
    <title>Off Days</title>
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

        img {
            height: 50px;
            margin: auto;
            display: block;
            margin-top: 15%;
        }
    </style>

</head>

<body>
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
                        <a class="nav-link" style="cursor: pointer;">Off-Days</a>
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

    <div class="row full-calendar">
        <div id='calendar'></div>
    </div>
    <div id="loading" style="display:none;">
        <img id="loading-image" src="https://c.tenor.com/wpSo-8CrXqUAAAAi/loading-loading-forever.gif"
            alt="Loading..." />
    </div>
    <div hidden id="spinner"></div>
</body>

<script>
    const spinner = document.getElementById("spinner");
    $(document).ready(function() {
        offDay();
    });

    function logout() {
        spinner.removeAttribute('hidden');
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

    function offDay() {
        $('#loading').css('display', 'block');
        var user_id = sessionStorage.getItem("user_id");
        var token = sessionStorage.getItem("token");
        url = '{{ env('API_URL') }}' + '/off-day';
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
        fetch(url, params)

            .then((response) => {
                $('#loading').css('display', 'none');
                return response.json();
            })
            .then((data) => {
                date = data.offday.map((obj) => {
                    return {
                        title: "off-day",
                        start: obj.weekend,
                    };
                });
                weekend(date);
                weekend_date = "";
                for (i = 0; i < data.length; i++) {
                    weekend_date = weekend_date + data[i].weekend + ",";
                }
                localStorage.setItem("date", weekend_date);
            });
    }

    function weekend(offDates) {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {

            initialView: 'dayGridMonth',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events: offDates,
            eventColor: ' #7d7f7c',

        });

        calendar.render();
    }
</script>

</html>
