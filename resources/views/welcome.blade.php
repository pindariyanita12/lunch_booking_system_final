@extends('layout')

@section('content')
    <div class="jumbotron">
        <h1>PHP Graph</h1>
        <p class="lead">Using Microsoft Graph API to access a user's data </p>
        @if (isset($userName))
            <h4>Welcome {{ $userName }}!</h4>
        @else
            <a href="/signin" class="btn btn-primary btn-large">Click here to sign in</a>
        @endif
    </div>
@endsection
