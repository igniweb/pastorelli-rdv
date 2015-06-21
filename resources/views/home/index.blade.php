@extends('layouts.default')

@section('main')
<h2>{{ $agenda->user->first_name . ' ' . $agenda->user->last_name . ' - ' . date(trans('rdv.format.date_php'), strtotime($day)) }}</h2>
<table class="ui table day">
    <tbody>
        @for ($hour = 6 ; $hour <= 21 ; $hour++)
            <tr>
                <td class="hour" rowspan="{{ floor(60 / $options['current_day_interval']) }}">{{ sprintf("%02d", $hour) }}</td>
                <td>@include('home.rdv._day', ['rdvs' => $agenda->rdvs($day, $hour . ':00'), 'minutes' => '00'])</td>
            </tr>
            @for ($minutes = $options['current_day_interval'] ; $minutes < 60 ; $minutes += $options['current_day_interval'])
                <tr class="day-interval clear">
                    <td>@include('home.rdv._day', ['rdvs' => $agenda->rdvs($day, sprintf("%02d", $hour) . ':' . $minutes), 'minutes' => $minutes])</td>
                </tr>
            @endfor
        @endfor
    </tbody>
</table>
<!-- <pre><?php print_r($options); ?></pre> -->
@stop

@section('scripts')
<script>
    jQuery(document).ready(function ($) {
        App.pusher.setup('{{ env("PUSHER_KEY") }}');
        App.pusher.subscribe('rdv', 'App\\Events\\RdvIsSaved', function (data) {
            $('#rdvs').append('<li>' + data.rdv.body + '</li>');
        });
    });
</script>
@stop
