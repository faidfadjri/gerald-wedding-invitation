<script>
    (function () {
        'use strict';

        // ── COUNTDOWN ──────────────────────────────────────────
        const TARGET = new Date('{{ $config['wedding_datetime'] }}').getTime();
        function p(n) { return String(n).padStart(2, '0'); }
        function tickCountdown() {
            const diff = Math.max(0, TARGET - Date.now());
            const elD = document.getElementById('cd-days');
            const elH = document.getElementById('cd-hours');
            const elM = document.getElementById('cd-minutes');
            const elS = document.getElementById('cd-seconds');
            function set(el, val) {
                if (el && el.textContent !== val) {
                    el.style.animation = 'none';
                    el.offsetHeight; // reflow
                    el.style.animation = 'countFlip 0.3s ease';
                    el.textContent = val;
                }
            }
            if (elD) set(elD, p(Math.floor(diff / 86400000)));
            if (elH) set(elH, p(Math.floor((diff % 86400000) / 3600000)));
            if (elM) set(elM, p(Math.floor((diff % 3600000) / 60000)));
            if (elS) set(elS, p(Math.floor((diff % 60000) / 1000)));
        }
        tickCountdown();
        setInterval(tickCountdown, 1000);

        // ── MUSIC ──────────────────────────────────────────────
        const musicBtn = document.getElementById('musicBtn');
        const bgMusic = document.getElementById('bgMusic');
        if (musicBtn && bgMusic && bgMusic.src) {
            musicBtn.addEventListener('click', function () {
                if (bgMusic.paused) {
                    bgMusic.play().catch(() => { });
                    musicBtn.textContent = '♬';
                    musicBtn.classList.add('playing');
                } else {
                    bgMusic.pause();
                    musicBtn.textContent = '♪';
                    musicBtn.classList.remove('playing');
                }
            });
        } else if (musicBtn) {
            musicBtn.style.display = 'none'; // hide if no music configured
        }

        // ── INTERSECTION OBSERVER (scroll reveal) ──────────────
        const revealClasses = ['.reveal', '.reveal-left', '.reveal-right', '.reveal-scale'];
        const allReveal = document.querySelectorAll(revealClasses.join(','));
        const rightPanel = document.getElementById('rightPanel');

        const observer = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('visible');
                    // Also reveal wayang when couple section is visible
                    if (entry.target.id === 'couple') {
                        const wl = entry.target.querySelector('.wayang-l');
                        const wr = entry.target.querySelector('.wayang-r');
                        if (wl) wl.classList.add('visible');
                        if (wr) wr.classList.add('visible');
                    }
                    observer.unobserve(entry.target);
                }
            });
        }, {
            root: rightPanel || null,
            rootMargin: '0px 0px -60px 0px',
            threshold: 0.08
        });

        allReveal.forEach(function (el) { observer.observe(el); });

        // Observe sections for wayang
        const coupleSection = document.getElementById('couple');
        if (coupleSection) observer.observe(coupleSection);

        // ── PARALLAX (ornaments scroll at different rates) ─────
        const parallaxItems = document.querySelectorAll('.parallax-ornament');

        function applyParallax() {
            const scrollY = rightPanel ? rightPanel.scrollTop : window.scrollY;
            parallaxItems.forEach(function (el) {
                const speed = parseFloat(el.dataset.parallaxSpeed || '0.3');
                const base = parseFloat(el.dataset.parallaxBase || '0');
                const offset = (scrollY - base) * speed;
                el.style.transform = 'translateY(' + offset + 'px)';
            });
        }

        // Set initial base position relative to the element's initial scroll context
        function initParallax() {
            parallaxItems.forEach(function (el) {
                const scrollY = rightPanel ? rightPanel.scrollTop : window.scrollY;
                el.dataset.parallaxBase = String(scrollY);
            });
        }

        if (rightPanel) {
            rightPanel.addEventListener('scroll', applyParallax, { passive: true });
        }
        window.addEventListener('scroll', applyParallax, { passive: true });
        setTimeout(initParallax, 100);

        // ── SIDE NAV (active highlight on scroll) ──────────────
        const sections = ['hero', 'quran', 'couple', 'savedate', 'events', 'livestream', 'gift', 'greetings'];
        const navLinks = document.querySelectorAll('.side-nav a[data-section]');

        function setActive(id) {
            navLinks.forEach(function (link) {
                link.classList.toggle('active', link.dataset.section === id);
            });
        }

        function updateActiveSection() {
            let current = sections[0];
            const panelRect = rightPanel ? rightPanel.getBoundingClientRect() : { top: 0 };
            sections.forEach(function (id) {
                const el = document.getElementById(id);
                if (!el) return;
                const relTop = el.getBoundingClientRect().top - panelRect.top;
                if (relTop <= 120) current = id;
            });
            setActive(current);
        }

        if (rightPanel) {
            rightPanel.addEventListener('scroll', updateActiveSection, { passive: true });
        }
        window.addEventListener('scroll', updateActiveSection, { passive: true });
        setTimeout(updateActiveSection, 200);

        // Smooth-scroll nav links
        navLinks.forEach(function (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.getElementById(link.dataset.section);
                if (!target) return;
                if (rightPanel && getComputedStyle(rightPanel).overflowY !== 'visible') {
                    rightPanel.scrollTo({ top: target.offsetTop, behavior: 'smooth' });
                } else {
                    target.scrollIntoView({ behavior: 'smooth' });
                }
            });
        });

        // ── GREETING FORM (AJAX) ───────────────────────────────
        const submitBtn = document.getElementById('submitGreeting');
        const formMsg = document.getElementById('formMsg');
        const list = document.getElementById('greetingList');
        const csrfMeta = document.querySelector('meta[name="csrf-token"]');
        const csrf = csrfMeta ? csrfMeta.content : '';

        function attClass(a) { return a === 'hadir' ? 'att-hadir' : (a === 'tidak_hadir' ? 'att-tidak' : 'att-tunggu'); }
        function attLabel(a) { return a === 'hadir' ? 'Hadir' : (a === 'tidak_hadir' ? 'Tidak Hadir' : 'Menunggu'); }
        function esc(s) { return s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;'); }

        if (submitBtn) {
            submitBtn.addEventListener('click', async function () {
                const name = document.getElementById('g-name').value.trim();
                const attendance = document.getElementById('g-attendance').value;
                const message = document.getElementById('g-message').value.trim();
                if (!name || !message) {
                    formMsg.style.color = '#e89090';
                    formMsg.textContent = 'Nama dan ucapan wajib diisi.';
                    return;
                }
                submitBtn.disabled = true;
                submitBtn.textContent = 'Mengirim...';
                formMsg.textContent = '';
                try {
                    const res = await fetch('/greetings', { method: 'POST', headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrf, 'Accept': 'application/json' }, body: JSON.stringify({ name, attendance, message }) });
                    const data = await res.json();
                    if (data.success) {
                        const g = data.greeting;
                        document.getElementById('emptyState')?.remove();
                        const card = document.createElement('div');
                        card.className = 'greeting-card';
                        card.innerHTML = '<div class="g-header"><div class="g-avatar">' + esc(g.name.charAt(0).toUpperCase()) + '</div><div class="g-name">' + esc(g.name) + '</div><span class="g-badge ' + attClass(g.attendance) + '">' + attLabel(g.attendance) + '</span></div><div class="g-message">' + esc(g.message) + '</div>';
                        list.prepend(card);
                        document.getElementById('g-name').value = '';
                        document.getElementById('g-message').value = '';
                        document.getElementById('g-attendance').value = 'masih_menunggu';
                        formMsg.style.color = '#7de496';
                        formMsg.textContent = 'Ucapan berhasil dikirim! 💌';
                        setTimeout(function () { formMsg.textContent = ''; }, 3200);
                    } else {
                        formMsg.style.color = '#e89090';
                        formMsg.textContent = 'Terjadi kesalahan. Coba lagi.';
                    }
                } catch (_) {
                    formMsg.style.color = '#e89090';
                    formMsg.textContent = 'Koneksi gagal. Coba lagi.';
                }
                submitBtn.disabled = false;
                submitBtn.textContent = 'Kirim Ucapan ✨';
            });
        }

        // ── COPY TO CLIPBOARD ──────────────────────────────────
        document.querySelectorAll('.btn-copy').forEach(btn => {
            btn.addEventListener('click', function () {
                const num = this.dataset.number;
                if (!num) return;
                navigator.clipboard.writeText(num).then(() => {
                    const originalText = this.textContent;
                    this.textContent = 'Copied! ✅';
                    this.classList.add('active');
                    setTimeout(() => {
                        this.textContent = originalText;
                        this.classList.remove('active');
                    }, 2000);
                });
            });
        });

    })();
</script>