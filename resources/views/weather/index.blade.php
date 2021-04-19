@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h1>Weather</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="city">
                <p>City: <b>{{$location['name']}}</b></p>
                <p>Region: <b>{{$location['region']}}</b></p>
                <p>Country: <b>{{$location['country']}}</b></p>
                <p>Time: <span class="badge badge-primary" style="font-size: 120%; color: #fff;">{{date('d M, Y', strtotime($location['localtime']))}}</span></p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="card-group">
        @foreach ($forecastDay['hour'] as $key => $forecast)
            @if ((int)$key % 5 == 0)
                <div class="card" style="width: 18rem;">
                    <img src="{{str_replace('64x64', '128x128', $forecast['condition']['icon'])}}" class="card-img-top" alt="...">
                    <h3 class="badge badge-primary" style="border-radius: 0px; color: #fff; font-size: 90%; padding: 0.5em 0.4em;">
                        {{$forecast['condition']['text']}}
                    </h3>
                    <div class="card-body">
                    <h5 class="card-title"><b>Time:</b> {{date('H:00', strtotime($forecast['time']))}}</h5>
                    <p class="card-text">
                        <p><b>Temperature t&#8451;:</b> {{$forecast['temp_c']}}&#8451;</p>
                        <p><b>Feels like t&#8451;:</b> {{$forecast['feelslike_c']}}&#8451;</p>
                        <p><b>Wind speed:</b> {{$forecast['wind_kph']}} kph</p>
                        <p><b>Wind dir:</b> {{$forecast['wind_dir']}}</p>
                        <p><b>Rain chance:</b> {{$forecast['chance_of_rain']}}%</p>
                        <p><b>Snow chance:</b> {{$forecast['chance_of_snow']}}%</p>
                    </p>
                    </div>
                </div>
            @endif
        @endforeach
        </div>
    </div>
</div>
@endsection
