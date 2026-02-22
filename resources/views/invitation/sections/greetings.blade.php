<section id="greetings">
    <h3 class="reveal">Ucapan &amp; Doa</h3>
    <div class="subtitle reveal delay-1">Kirimkan ucapan dan doa terbaik kamu</div>

    <div class="greeting-form reveal delay-2">
        <div class="form-group">
            <label for="g-name">Nama</label>
            <input type="text" id="g-name" placeholder="Nama kamu" maxlength="100" autocomplete="name">
        </div>
        <div class="form-group">
            <label for="g-attendance">Kehadiran</label>
            <select id="g-attendance">
                <option value="masih_menunggu">Masih Menunggu</option>
                <option value="hadir">Hadir 🎉</option>
                <option value="tidak_hadir">Tidak Hadir 😢</option>
            </select>
        </div>
        <div class="form-group">
            <label for="g-message">Ucapan &amp; Doa</label>
            <textarea id="g-message" placeholder="Tuliskan ucapan dan doa kamu di sini..." maxlength="500"></textarea>
        </div>
        <button class="btn-submit" id="submitGreeting">Kirim Ucapan ✨</button>
        <div id="formMsg" style="margin-top:0.7rem;font-size:0.75rem;text-align:center;min-height:1.2em;"></div>
    </div>

    <div class="greeting-list" id="greetingList">
        @forelse($greetings as $g)
            <div class="greeting-card">
                <div class="g-header">
                    <div class="g-avatar">{{ strtoupper(mb_substr($g->name, 0, 1)) }}</div>
                    <div class="g-name">{{ $g->name }}</div>
                    <span
                        class="g-badge {{ $g->attendance === 'hadir' ? 'att-hadir' : ($g->attendance === 'tidak_hadir' ? 'att-tidak' : 'att-tunggu') }}">
                        {{ $g->attendance === 'hadir' ? 'Hadir' : ($g->attendance === 'tidak_hadir' ? 'Tidak Hadir' : 'Menunggu') }}
                    </span>
                </div>
                <div class="g-message">{{ $g->message }}</div>
            </div>
        @empty
            <div style="text-align:center;color:rgba(245,230,200,0.28);font-size:0.8rem;padding:1.5rem 0;" id="emptyState">
                Jadilah yang pertama memberikan ucapan 💌
            </div>
        @endforelse
    </div>
</section>