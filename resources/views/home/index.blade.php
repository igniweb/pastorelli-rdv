@extends('layouts.default')

@section('main')
<h2>Yo broadcast</h2>
<ul id="rdvs">
    @foreach ($rdvs as $rdv)
        <li>{{ $rdv->label }}</li>
    @endforeach
</ul>
<pre><?php //var_dump($agenda->rdvs); ?></pre>
@stop

@section('scripts')
<script>
    jQuery(document).ready(function ($) {
        App.pusher.setup('{{ env("PUSHER_KEY") }}');
        App.pusher.subscribe('rdv', 'App\\Events\\RdvIsSaved', function (data) {
            $('#rdvs').append('<li>' + data.rdv.label + '</li>');
        });
    });
</script>
@stop
