@extends('layouts.default')

@section('main')
<h2>Yo broadcast</h2>
<ul id="rdvs">
    @foreach ($rdvs as $rdv)
        <li>{{ $rdv->label }}</li>
    @endforeach
</ul>
@stop

@section('scripts')
<script>
    jQuery(document).ready(function ($) {
        /*
        Pusher.log = function(message) {
            if (window.console && window.console.log) {
                window.console.log(message);
            }
        };
        */
        var $rdvs = $('#rdvs');
        var pusher = new Pusher('{{ env("PUSHER_KEY") }}');

        var rdvChannel = pusher.subscribe('rdv');
        rdvChannel.bind('App\\Events\\RdvIsSaved', function (data) {
            $rdvs.append('<li>' + data.rdv.label + '</li>');
        });
    });
</script>
@stop
