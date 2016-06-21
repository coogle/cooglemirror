<link href="/packages/cooglemirror/weather/css/widget.css" rel="stylesheet"/>
<link href="/packages/cooglemirror/weather/css/weather-icons/css/weather-icons.css" rel="stylesheet"/>
<table style="width: 300px">
    <tr>
        <td colspan="2" class="align-left bright max-temp xlarge">{{ $weatherData['current']['temp'] }}</td>
        <td colspan="2" class="align-right bright weather-icon xlarge"><span class="wi {{ $weatherData['current']['icon'] }}"></span></td>
    </tr>
    @foreach($weatherData['hourly'] as $hourlyForecast)
    <tr style="opacity:  {{ $hourlyForecast['opacity'] }};">
        <td class="day">{{ $hourlyForecast['hour'] }}</td>
        <td class="weather-icon align-center"><span class="wi {{ $hourlyForecast['icon'] }}"></span></td>
        <td class="align-right min-temp">{{ $hourlyForecast['temp'] }}</td>
    </tr>
    @endforeach
</table>