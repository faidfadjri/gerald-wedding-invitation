<div class="left-panel">
    <div class="photo-grid">
        @foreach($config['photos'] as $i => $photo)
            <div class="photo-cell">
                <img src="{{ $photo }}" alt="Pre-wedding photo {{ $i + 1 }}"
                    style="object-position: {{ $config['photo_positions'][$i] ?? 'center center' }}">
            </div>
        @endforeach
    </div>
    <div class="left-overlay"></div>
    <div class="floating-dots">
        <span></span><span></span><span></span><span></span>
    </div>
    <div class="couple-name-left">
        {{ explode(' ', $config['groom_name'])[0] }} &amp;<br>
        {{ explode(' ', $config['bride_name'])[0] }}
    </div>
</div>