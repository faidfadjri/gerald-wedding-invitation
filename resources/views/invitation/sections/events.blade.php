<section id="events">
    @foreach($config['events'] as $i => $event)
        @if($i > 0)
            <div class="event-divider"></div>
        @endif
        <div class="event-card reveal delay-{{ $i + 1 }}">
            <h3>{{ $event['title'] }}</h3>
            <div class="ev-date">{{ $event['date'] }}</div>
            <div class="ev-time">⏰ {{ $event['time'] }}</div>
            <div class="ev-loc">📍 {{ $event['location'] }}</div>
            <div class="btn-center">
                <a href="{{ $event['maps_url'] }}" target="_blank" rel="noopener" class="btn-outline">see location</a>
            </div>
        </div>
    @endforeach
</section>