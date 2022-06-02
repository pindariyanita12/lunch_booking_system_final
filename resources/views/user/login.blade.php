<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
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
    <title>Login</title>
</head>
<script>

    sessionStorage.removeItem('user_id')
    sessionStorage.removeItem('name')
    sessionStorage.removeItem('token')
    sessionStorage.removeItem('date')
    sessionStorage.removeItem('code')
    sessionStorage.removeItem('mail')

    function checkLogin() {

        fetch("https://lunch-api.dev.local/signin", {

                method: "POST",
                headers: {
                    "Content-type": "application/json; charset=UTF-8"
                }

            })
            .then(response => response.json())
            .then(function(data) {

                if (window.sessionStorage.getItem('code') !== null && window.sessionStorage.getItem('code') !==
                    '' && window.sessionStorage.getItem('code') !== undefined) {
                    window.location.href = "https://lunch-app.dev.local/user/welcome";
                } else {

                    window.location.href = data.link;
                }
            });
    }
</script>

<body>
    <div class="login-container mx-auto">
        <div class="image">
            <img src="{{ url('/Images/simform_logo.png') }}" class="img-fluid" alt="Responsive image">
        </div>
        <br>
        <h3 class="login-heading"><i>Welcome Simformer,</i></h3>
        <hr>
        <form>
            <div class="login-button">
                <button type="button" onclick="checkLogin()" id="login-btn" class="btn btn-primary"><img
                        src="{{ url('/Images/microsoft (1).png') }}" alt="outlook" style="float: left;" width="25px"
                        height="22px">Login Using Outlook</button>
            </div>
        </form>
    </div>
</body>

</html>
