@if ( ! empty($minutes))
    <span style="float: left; background-color: #aaa; color: #fff; font-size: 0.6em">{{ $minutes }}</span>
@endif
@foreach ($rdvs as $rdv)
    <h3 title="{{ ! empty($rdv->email) ? $rdv->email : $rdv->name }}">{{ $rdv->name }}</h3>
    @if ( ! empty($rdv->body))
        <pre>{{ nl2br($rdv->body) }}</pre>
    @endif
@endforeach
