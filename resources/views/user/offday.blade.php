@extends('layouts.user-app')
@section('container')
        <div class="row full-calendar">
            <div id='calendar'></div>
        </div>
@endsection()
@push('scripts')
<script>
    const spinner = document.getElementById("spinner");
    $(document).ready(function() {
        var calendar = new FullCalendar.Calendar(document.getElementById('calendar'), {

        initialView: 'dayGridMonth',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
        },
        events: {!! ($offDays) !!},
        eventColor: ' #7d7f7c',
        }).render();
    });
</script>
@endpush
