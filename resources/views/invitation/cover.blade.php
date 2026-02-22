<div id="invitationCover" class="cover-overlay">
    <div class="cover-bg" style="background-image: url('{{ $config['photos'][1] }}')"></div>
    <div class="cover-content">
        <div class="cover-eyebrow">THE WEDDING OF</div>
        <h1 class="cover-title">
            {{ explode(' ', $config['groom_name'])[0] }} &amp; {{ explode(' ', $config['bride_name'])[0] }}
        </h1>

        <div class="cover-guest">
            <p>Kepada Bapak/Ibu/Saudara/i:</p>
            <h2 id="guestName">{{ request()->query('to', 'Tamu Undangan') }}</h2>
            <p>Kami mengundang Anda untuk hadir di acara pernikahan kami.</p>
        </div>

        <button id="openInvitation" class="btn-open">
            <span class="icon">✉</span> Buka Undangan
        </button>
    </div>

    <div class="cover-ornament top-right">
        <img src="{{ $config['assets']['batik_top'] }}" alt="">
    </div>
    <div class="cover-ornament bottom-left">
        <img src="{{ $config['assets']['batik_bottom'] }}" alt="">
    </div>
</div>