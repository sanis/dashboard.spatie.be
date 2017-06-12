@extends('layouts/master')

@section('content')

    @javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer'))

    <div class="dashboard" id="dashboard">
        <twitter :initial-tweets="{{ json_encode($initialTweets) }}" grid="a1:a3"></twitter>

        <bugsnag-errors grid="b1:c1"></bugsnag-errors>

        <tasks team-member="colegio" grid="b2:c2"></tasks>
        <tasks team-member="personal" grid="b3:c3"></tasks>

        <time-weather grid="d1" dateformat="ddd DD/MM"></time-weather>
        <packagist grid="d2"></packagist>
        <github grid="d3"></github>
        <laravel-news grid="e1:e3"></laravel-news>

        <internet-connection></internet-connection>
    </div>
@endsection
