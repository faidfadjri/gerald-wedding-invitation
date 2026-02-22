<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- ── CONFIG: all images, names, dates, events, music ── --}}
    @php $config = include resource_path('views/invitation/config.php'); @endphp

    <title>The Wedding of {{ explode(' ', $config['groom_name'])[0] }} &amp;
        {{ explode(' ', $config['bride_name'])[0] }} — {{ $config['wedding_short_date'] }}
    </title>
    <meta name="description"
        content="Wedding invitation of {{ $config['groom_name'] }} & {{ $config['bride_name'] }}, {{ $config['wedding_date_display'] }}.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&family=Great+Vibes&family=Inter:wght@300;400;500&display=swap"
        rel="stylesheet">

    {{-- ── STYLES ── --}}
    @include('invitation.styles')
</head>

<body>

    {{-- Music toggle button (hidden if no music URL set) --}}
    @if($config['music_url'])
        <button class="music-btn" id="musicBtn" aria-label="Toggle background music">♪</button>
        <audio id="bgMusic" src="{{ $config['music_url'] }}" {{ $config['music_loop'] ? 'loop' : '' }}
            preload="none"></audio>
    @else
        <button class="music-btn" id="musicBtn" style="display:none" aria-label="Toggle background music">♪</button>
        <audio id="bgMusic" preload="none"></audio>
    @endif

    {{-- Floating side navigation --}}
    @include('invitation.side-nav')

    <div class="invitation-wrapper">

        {{-- ── LEFT PANEL: fixed photo grid ── --}}
        @include('invitation.left-panel')

        {{-- ── RIGHT PANEL: scrollable sections ── --}}
        <main class="right-panel" id="rightPanel">

            @include('invitation.sections.hero')
            @include('invitation.sections.quran')
            @include('invitation.sections.couple')
            @include('invitation.sections.savedate')
            @include('invitation.sections.events')
            @include('invitation.sections.livestream')
            @include('invitation.sections.gift')
            @include('invitation.sections.greetings')

            <footer>
                <img src="{{ $config['assets']['paper_sm_2'] }}" alt="" class="ornament-float"
                    style="width:70px;opacity:0.22;margin:0 auto 0.8rem;display:block;" aria-hidden="true">
                Made with ❤ for {{ explode(' ', $config['groom_name'])[0] }} &amp;
                {{ explode(' ', $config['bride_name'])[0] }}
                &nbsp;·&nbsp; {{ $config['wedding_short_date'] }}
            </footer>

        </main>
    </div>

    {{-- ── SCRIPTS: countdown, parallax, side nav, greetings AJAX ── --}}
    @include('invitation.scripts')

</body>

</html>