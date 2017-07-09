@extends('layouts/master')

@section('content')

@javascript(compact('pusherKey', 'pusherCluster', 'usingNodeServer'))

        <dashboard id="dashboard" columns="5" rows="3">
            <sentry-errors position="b1:d1"></sentry-errors>

            <time-weather position="e1" date-format="YY/DD/MM ddd"></time-weather>

            <internet-connection></internet-connection>
        </dashboard>

@endsection
