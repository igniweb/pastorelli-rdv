@extends('layouts.default')

@section('main')
<h2>Yo broadcast!</h2>
<ul id="rdvs">
    @foreach ($rdvs as $rdv)
        <?php $rdvArray = $rdv->toArray(); unset($rdvArray['guest']); ?><li title="{!! print_r($rdvArray, true) . PHP_EOL . print_r($rdv->guest->toArray(), true) !!}">{{ $rdv->body }}</li>
    @endforeach
</ul>
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
