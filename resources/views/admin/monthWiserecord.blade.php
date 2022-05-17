<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <style>
        @import url("https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css");
    </style>
</head>

<body>
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
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a>

                        <div class="dropdown-menu dropdown-menu-end text-black" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle text-white" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        Select Month
                        </a>

                        <div class="dropdown-menu dropdown-menu-end text-black" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="/users/01">January</a>
                            <a class="dropdown-item" href="/users/02">February</a>
                            <a class="dropdown-item" href="/users/03">March</a>
                            <a class="dropdown-item" href="/users/04">April</a>
                            <a class="dropdown-item" href="/users/05">May</a>
                            <a class="dropdown-item" href="/users/06">June</a>
                            <a class="dropdown-item" href="/users/07">July</a>
                            <a class="dropdown-item" href="/users/08">August</a>
                            <a class="dropdown-item" href="/users/09">September</a>
                            <a class="dropdown-item" href="/users/10">October</a>
                            <a class="dropdown-item" href="/users/11">November</a>
                            <a class="dropdown-item" href="/users/12">December</a>

                        </div>
                    </li>
                 </ul>   
                 <ul class="ms-auto mb-0">
                 <li >
                         <form class="d-flex" action="/date-wise" method="post">
                            @csrf
                            <input class="form-control me-2" name="date" type="date" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                          </form>
                </li>
            </ul>
             </div>
        </div>
    </nav>
    <div>
      @if(session()->has('message'))
      <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">x</button>
        {{session()->get('message')}}
      </div>
      @endif
    </div>
    
    
    <div class="container">
        @if(sizeof($records))
        <table class="table table-hover mt-3 ml-3 border border-dark">
            <thead class="bg-dark text-white">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">EMPLOYEE ID</th>
                    <th scope="col">EMPLOYEE NAME</th>
                    <th scope="col">IS TAKEN</th>
                    <th scope="col">GUESTS</th>
                    <th scope="col">LUNCH DATE</th>
                </tr>
            </thead>
            <tbody>
              
                <?php
                $i=1;
                ?>
                @foreach ($records as $record)
                    <tr>
                        <th scope="row"><?php echo $i;$i++;?></th>
                        <td>{{ $record->user->emp_id }}</td>
                        <td>{{ $record->user->name }}</td>
                        <td>{{ $record->is_taken }}</td>
                        <td>{{ $record->guests }}</td>
                        <td>{{ date('d-m-Y', strtotime($record->created_at .' +1 day')) }}</td>
                    </tr>
                @endforeach
                <tr style="background-color: #3ff198">
                    <td>Total Person :</td>
                    <td>{{ sizeof($records) }}</td>
                    <td>Total Guests :</td>
                    <td>{{ $guests }}</td>
                    <td>Total : </td>
                    <td>{{ $guests + sizeof($records) }}</td>
                </tr>

            </tbody>
        </table>
@else
<h5 class="text-success text-center">Not Found Data</h5>
@endif
</div>
</body>
</html>
