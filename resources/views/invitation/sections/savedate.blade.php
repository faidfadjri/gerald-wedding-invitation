<section id="savedate">
    <img src="{{ $config['assets']['paper_torn_1'] }}" alt="" class="paper-bg-ornament parallax-ornament"
        data-parallax-speed="0.08" aria-hidden="true">

    <div class="paper-box reveal-scale">
        <div class="section-label">Save the Date</div>
        <div class="countdown-grid">
            <div class="cd-item">
                <div class="num" id="cd-days">00</div>
                <div class="unit">Days</div>
            </div>
            <div class="cd-item">
                <div class="num" id="cd-hours">00</div>
                <div class="unit">Hours</div>
            </div>
            <div class="cd-item">
                <div class="num" id="cd-minutes">00</div>
                <div class="unit">Minutes</div>
            </div>
            <div class="cd-item">
                <div class="num" id="cd-seconds">00</div>
                <div class="unit">Seconds</div>
            </div>
        </div>
        <div class="event-date-txt">{{ $config['wedding_date_display'] }}</div>
        <div class="event-address">{{ $config['venue_address'] }}</div>
        <div class="btn-center">
            <a href="{{ $config['venue_maps_url'] }}" target="_blank" rel="noopener" class="btn-outline">📍 see
                location</a>
        </div>
    </div>
</section>