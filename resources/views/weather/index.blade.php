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
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            @foreach ($forecastDays as $key => $day)
            <li class="nav-item" role="presentation">
                <a class="nav-link @if($key == 0) active @endif" id="pills-{{$day['date_epoch']}}-tab" data-toggle="pill" href="#pills-{{$day['date_epoch']}}" role="tab" aria-controls="pills-{{$day['date_epoch']}}" aria-selected="@if($key == 0) true @else false @endif">{{date('d M, Y', strtotime($day['date']))}}</a>
            </li>
            @endforeach
        </ul>
        <div class="tab-content" id="pills-tabContent">
            @foreach ($forecastDays as $_key => $forecastDay)
                <div class="tab-pane fade @if($_key == 0)show active @endif" id="pills-{{$forecastDay['date_epoch']}}" role="tabpanel" aria-labelledby="pills-{{$forecastDay['date_epoch']}}-tab">
                    <div class="card-group">
                        @foreach ($forecastDay['hour'] as $f_key => $forecast)
                            @if ((int)$f_key % 5 == 0)
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
            @endforeach
          </div>
    </div>
</div>
@endsection
