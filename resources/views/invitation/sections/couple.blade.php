<section id="couple">
    <img src="{{ $config['assets']['wayang_left'] }}" alt="" class="wayang-l parallax-ornament"
        data-parallax-speed="-0.12" aria-hidden="true">
    <img src="{{ $config['assets']['wayang_right'] }}" alt="" class="wayang-r parallax-ornament"
        data-parallax-speed="0.1" aria-hidden="true">

    {{-- Bride --}}
    <div class="couple-person reveal-right delay-1">
        <div class="instagram">{{ $config['bride_instagram'] }}</div>
        <h2>{{ $config['bride_name'] }}</h2>
        <div class="role">{{ $config['bride_role'] }}</div>
        <div class="parent-info">
            {{ $config['bride_parents'] }}<br>
            <span style="font-size:0.75rem;opacity:0.65;">{{ $config['bride_hometown'] }}</span>
        </div>
    </div>

    <div class="divider-ampersand reveal-scale delay-2">&amp;</div>

    {{-- Groom --}}
    <div class="couple-person reveal-left delay-3">
        <div class="instagram">{{ $config['groom_instagram'] }}</div>
        <h2>{{ $config['groom_name'] }}</h2>
        <div class="role">{{ $config['groom_role'] }}</div>
        <div class="parent-info">
            {{ $config['groom_parents'] }}<br>
            <span style="font-size:0.75rem;opacity:0.65;">{{ $config['groom_hometown'] }}</span>
        </div>
    </div>
</section>