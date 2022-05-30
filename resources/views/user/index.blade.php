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
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar-scheduler@5.11.0/main.min.js"></script>
    <!--<script src="{{asset('/js/script.js') }}"></script> -->
       <title>Loading</title>
</head>
<script>

    window.onload = function () {

        let paramString = (window.location.href).substring(
            (window.location.href).indexOf("?code") + 1,
            (window.location.href).lastIndexOf("&state")
        );
        let queryString = new URLSearchParams(paramString);
        sessionStorage.setItem("code", queryString);
        url = 'http://localhost:8000/api/getdata';
        data = {
            "code": sessionStorage.getItem("code").substring(5),
        };
        params = {
            method: 'post',
            redirect: 'follow',
            headers: {
                'Content-type': 'application/json',
                'Access-Control-Allow-Origin': '*'
            },
            body: JSON.stringify(data)
        };

        fetch(url, params).then(function (response) {

            return response.json();

        }).then(function (data) {

            var name = data.user.name;
            var user_id = data.user.id;
            var mail = data.user.mail;
            var token = data.user.remember_token;

            window.sessionStorage.setItem('mail', mail);
            window.sessionStorage.setItem('user_id', user_id);
            window.sessionStorage.setItem('token', token);
            window.sessionStorage.setItem('name', name);
            window.location.href = "http://localhost:8000/user/welcome";

        });
    }

</script>
</html>