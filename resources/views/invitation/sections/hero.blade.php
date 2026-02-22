<section id="hero">
    {{-- Parallax ornaments: move at 0.25x and 0.15x scroll speed --}}
    <img src="{{ $config['assets']['batik_top'] }}" alt="" class="batik-top parallax-ornament"
        data-parallax-speed="-0.2" aria-hidden="true">
    <img src="{{ $config['assets']['batik_bottom'] }}" alt="" class="batik-bottom parallax-ornament"
        data-parallax-speed="0.15" aria-hidden="true">

    <div class="hero-content">
        <div class="eyebrow">The Wedding Of</div>
        <h1>{{ explode(' ', $config['groom_name'])[0] }} &amp;<br>{{ explode(' ', $config['bride_name'])[0] }}</h1>
        <div class="date-display">{{ $config['wedding_short_date'] }}</div>
        <img src="{{ $config['assets']['leaf_1'] }}" alt="" class="leaf-hero parallax-ornament"
            data-parallax-speed="0.12" style="width:110px;opacity:0.45;margin:0 auto;" aria-hidden="true">
    </div>
    <div class="scroll-hint">
        <div class="scroll-arrow"></div>
        scroll down
    </div>
</section>