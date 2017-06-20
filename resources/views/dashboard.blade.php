@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer'))

    <dashboard id="dashboard" columns="5" rows="3">
        <twitter :initial-tweets="{{ json_encode($initialTweets) }}" position="a1:a3"></twitter>

        <bugsnag-errors position="b1:c1"></bugsnag-errors>

        <tasks team-member="colegio" position="b2:c2"></tasks>
        <tasks team-member="personal" position="b3:c3"></tasks>

        <time-weather position="d1" dateformat="ddd DD/MM"></time-weather>
        <packagist position="d2"></packagist>
        <github position="d3"></github>
        <laravel-news position="e1:e3"></laravel-news>
      </dashboard>

@endsection
