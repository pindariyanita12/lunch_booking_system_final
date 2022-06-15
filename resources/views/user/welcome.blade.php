@extends('layouts.user-app')
@section('container')
    @if (session()->has('alert'))
        <div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert">x</button>
            {{ session()->get('alert') }}
        </div>
    @endif
    <h2 class="text-center"> {{ !$lunchAvailabiltyTomorrow ? ' ' : 'Tomorrow is off day..' }}</h2>
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
            @if (!$lunchAvailabiltyToday)
                @php($start = \Carbon\Carbon::createFromTimeString('12:00'))
                @php($end = \Carbon\Carbon::createFromTimeString('20:00'))
                @if ($isLunchTaken)
                    Lunch taken..!!
                @elseif(\Carbon\Carbon::now('Asia/Kolkata')->between($start, $end))
                    <a class="btn btn-primary" style="width: 70%;" href="{{ route('lunchTaken') }}">Sign for
                        lunch</a>
                @else
                    Lunch entry is not available
                @endif
            @else
                Today lunch facility is not available
            @endif
        </div>
        <div class="text-center">
            People taken lunch last 10 minutes {{ $record }}
        </div>
    </div>

    <footer class="text-center mt-4" style="font-size:15px">
        <p>You can sign for lunch between 12:30 AM to 4:00 PM</p>
        <p>From: Monday to Friday</p>
    </footer>
@endsection

@push('scripts')
    <script>
        const spinner = document.getElementById("spinner");
        const spinnerforarrivelunch = document.getElementById("spinnerforarrivelunch");

        function arriveLunch() {

            spinnerforarrivelunch.setAttribute('hidden', '');
            if (false) {
                alert("You already taken Lunch");
            } else {
                alert("Enjoy your Lunch!");
                location.reload();

            }
        }

        function disableafterlunch() {

            document.getElementById("arrive_lunch").disabled = true;
            document.getElementById("arrive_lunch").innerText = 'Lunch Taken';

        }
    </script>
@endpush
