@extends('layouts.user-app')
@section('container')
    @if (session()->has('alert'))
        <div class="alert alert-success alert-dismissible">
            {{ session()->get('alert') }}
            <button type="button" class="close" data-dismiss="alert">x</button>
        </div>
    @endif
    <h2 class="text-center" style="color: rgb(239, 83, 102);">
        {{ !$lunchAvailabiltyTomorrow ? ' ' : 'Tomorrow is off day..' }}</h2>
    <div class="container">
        <div class="request-button mb-3">
            @if (!$lunchAvailabiltyToday)
                @php($start = \Carbon\Carbon::createFromTimeString('12:00'))
                @php($end = \Carbon\Carbon::createFromTimeString('16:00'))
                @if ($isLunchTaken)
                    <a class="btn btn-primary disable" style="width: 70%;" role="link" aria-disabled="true">Lunch
                        taken..!!</a>
                @elseif(\Carbon\Carbon::now('Asia/Kolkata')->between($start, $end))
                    <a class="btn btn-primary" style="width: 70%;" href="{{ route('lunchTaken') }}">Sign for
                        lunch</a>
                @else
                    <a class="btn btn-primary disable" style="width: 70%;" role="link" aria-disabled="true"> Lunch entry is
                        not available</a>
                @endif
            @else
                <a class="btn btn-primary disable" style="width: 70%;" role="link" aria-disabled="true">Today lunch facility
                    is not available</a>
            @endif
        </div>
        <div class="text-center mt-4">
            <p class="lastrecords">People taking lunch last 10 minutes <br><span
                    id="value">{{ $record }}</span></p>
        </div>
    </div>

    <footer class="text-center mt-4" style="font-size:18px">
        <div class="text-center text-white" style="background-color: lightpink; font-style:bold;">
            <p>You can sign for lunch between 12:30 AM to 4:00 PM, From: Monday to Friday</p>
        </div>

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
        const obj = document.getElementById("value");
        function animateValue(obj, start, end, duration) {
            let startTimestamp = null;
            const step = (timestamp) => {
                if (!startTimestamp) startTimestamp = timestamp;
                const progress = Math.min((timestamp - startTimestamp) / duration, 1);
                obj.innerHTML = Math.floor(progress * (end - start) + start);
                if (progress < 1) {
                    window.requestAnimationFrame(step);
                }
            };
            window.requestAnimationFrame(step);
        }
        animateValue(obj, 0, {{$record}}, 5000);
    </script>
@endpush
