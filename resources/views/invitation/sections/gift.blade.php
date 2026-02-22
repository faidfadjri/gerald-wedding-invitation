<section id="gift">
    <h3 class="reveal">Send your gift</h3>
    <p class="reveal delay-1">Tanpa mengurangi rasa hormat, bagi anda yang ingin memberikan tanda kasih untuk kami,
        dapat melalui:</p>

    <div class="bank-grid reveal delay-2">
        @foreach($config['bank_accounts'] as $acc)
            <div class="bank-card">
                <div class="bank-name">{{ $acc['bank'] }}</div>
                <div class="bank-holder">{{ $acc['holder'] }}</div>
                <div class="bank-number">{{ $acc['number'] }}</div>
                <button class="btn-copy" data-number="{{ $acc['number'] }}">Salin Nomor Rekening</button>
            </div>
        @endforeach
    </div>
</section>