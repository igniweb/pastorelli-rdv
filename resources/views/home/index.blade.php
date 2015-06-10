@extends('layouts.default')

@section('main')
Yo broadcast
@stop

@section('scripts')
<script>
    jQuery(document).ready(function ($) {
        var pusher = new Pusher('{{ env("PUSHER_KEY") }}');

        var rdvChannel = pusher.subscribe('rdv');
        rdvChannel.bind('\\App\\Events\\RdvIsSaved', function (data) {
            console.log('RdvIsSaved');
            console.log(data);
        });
    });
</script>
@stop
