<nav class="navbar navbar-expand-lg navbar-light bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="/admindashboard">Lunch System</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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

                <li class="nav-item dropdown mt-2 ms-2">
                    <form action='/month-wise' method="get">
                        <select name="id" id="id" onchange="this.form.submit()">
                            <option value="" selected disabled>Choose</option>
                            <option value="1" {{ Request::get('id') == '1' ? 'selected' : '' }}>Jan</option>
                            <option value="2" {{ Request::get('id') == '2' ? 'selected' : '' }}>Feb</option>
                            <option value="3" {{ Request::get('id') == '3' ? 'selected' : '' }}>March</option>
                            <option value="4" {{ Request::get('id') == '4' ? 'selected' : '' }}>April</option>
                            <option value="5" {{ Request::get('id') == '5' ? 'selected' : '' }}>May</option>
                            <option value="6" {{ Request::get('id') == '6' ? 'selected' : '' }}>June</option>
                            <option value="7" {{ Request::get('id') == '7' ? 'selected' : '' }}>July</option>
                            <option value="8" {{ Request::get('id') == '8' ? 'selected' : '' }}>August</option>
                            <option value="9" {{ Request::get('id') == '9' ? 'selected' : '' }}>Sept</option>
                            <option value="10" {{ Request::get('id') == '10' ? 'selected' : '' }}>Oct</option>
                            <option value="11" {{ Request::get('id') == '11' ? 'selected' : '' }}>Nov</option>
                            <option value="12" {{ Request::get('id') == '12' ? 'selected' : '' }}>Dec</option>
                        </select>
                    </form>
                </li>
            </ul>
            <ul class="navbar-nav ms-auto mb-0">

                <li>
                    <form class="d-flex" action="/date-wise" method="get">

                        <input class="form-control me-2" value="{{ Request::get('date') }}" id="" name="date"
                            type="date" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success" onclick="myFunction()">Search</button>
                    </form>
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

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
