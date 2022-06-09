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
                    <a class="nav-link text-white" href="/offday">Off Days</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white" href="/daily-dishes">Reports</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/totalemployee">Employee</a>
                </li>
        </div>
        </ul>

        <ul class="navbar-nav ms-auto mb-0 ">
             @php $locale = session()->get('locale'); @endphp
            <li class="nav-item dropdown bg-dark">
                <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ session('locale') }}
                </a>
                <ul class="dropdown-menu" >
                    <li><a class="dropdown-item" selected href="/lang/en">English</a></li>

                    <li><a class="dropdown-item" href="/lang/hi">Hindi</a></li>
                </ul>

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


