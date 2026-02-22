<script>
    (function () {
        'use strict';

        document.addEventListener('DOMContentLoaded', function () {
            console.log('Invitation scripts initialized');

            // ── OPEN INVITATION ────────────────────────────────────
            const cover = document.getElementById('invitationCover');
            const openBtn = document.getElementById('openInvitation');
            const body = document.body;
            const bgMusic = document.getElementById('bgMusic');
            const musicBtn = document.getElementById('musicBtn');

            if (openBtn && cover) {
                console.log('Cover and Open Button found');
                openBtn.addEventListener('click', function () {
                    console.log('Open Button clicked');
                    cover.classList.add('hide');
                    body.classList.remove('is-locked');

                    // Play music if it exists
                    if (bgMusic && bgMusic.src && bgMusic.src !== window.location.href) {
                        bgMusic.play().then(() => {
                            console.log('Music playing');
                            musicBtn?.classList.add('playing');
                        }).catch(e => {
                            console.log('Music autoplay failed (user interaction might be required but we are in the handler):', e);
                        });
                    }

                    // Trigger animations for the first section visible
                    setTimeout(() => {
                        window.dispatchEvent(new Event('scroll'));
                    }, 500);
                });
            } else {
                console.warn('Cover or Open Button NOT found', { openBtn, cover });
            }

            // ── COUNTDOWN ──────────────────────────────────────────
            const TARGET = new Date('{{ $config['wedding_datetime'] }}').getTime();
            function p(n) { return String(n).padStart(2, '0'); }
            function tickCountdown() {
                const diff = Math.max(0, TARGET - Date.now());
                const elD = document.getElementById('cd-days');
                const elH = document.getElementById('cd-hours');
                const elM = document.getElementById('cd-minutes');
                const elS = document.getElementById('cd-seconds');

                const d = Math.floor(diff / 86400000);
                const h = Math.floor((diff % 86400000) / 3600000);
                const m = Math.floor((diff % 3600000) / 60000);
                const s = Math.floor((diff % 60000) / 1000);

                const set = (el, val) => {
                    if (el && el.textContent !== val) {
                        el.style.animation = 'none';
                        el.offsetHeight;
                        el.style.animation = 'countFlip 0.3s ease';
                        el.textContent = val;
                    }
                };

                set(elD, p(d));
                set(elH, p(h));
                set(elM, p(m));
                set(elS, p(s));
            }
            setInterval(tickCountdown, 1000);
            tickCountdown();

            // ── MUSIC TOGGLE ───────────────────────────────────────
            if (musicBtn && bgMusic) {
                musicBtn.addEventListener('click', function () {
                    if (bgMusic.paused) {
                        bgMusic.play();
                        musicBtn.classList.add('playing');
                    } else {
                        bgMusic.pause();
                        musicBtn.classList.remove('playing');
                    }
                });
            }

            // ── PARALLAX ──────────────────────────────────────────
            const parallaxes = document.querySelectorAll('.parallax-ornament');
            const rightPanel = document.getElementById('rightPanel');

            function handleScroll() {
                const scrollY = rightPanel ? rightPanel.scrollTop : window.scrollY;
                parallaxes.forEach(el => {
                    const speed = parseFloat(el.dataset.parallaxSpeed || 0.1);
                    el.style.transform = `translateY(${scrollY * speed}px)`;
                });
            }

            if (rightPanel) {
                rightPanel.addEventListener('scroll', handleScroll, { passive: true });
            } else {
                window.addEventListener('scroll', handleScroll, { passive: true });
            }

            // ── REVEAL ON SCROLL ───────────────────────────────────
            const observerOptions = {
                threshold: 0.15,
                root: rightPanel || null
            };

            const revealObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.reveal, .reveal-left, .reveal-right, .reveal-scale, .wayang-l, .wayang-r').forEach(el => {
                revealObserver.observe(el);
            });

            // ── SIDE NAV SCROLL DETECTION ──────────────────────────
            const navLinks = document.querySelectorAll('.side-nav a');
            const sections = document.querySelectorAll('section[id]');

            function updateActiveNav() {
                let current = "";
                sections.forEach((section) => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.offsetHeight;
                    const scrollY = rightPanel ? rightPanel.scrollTop : window.scrollY;
                    if (scrollY >= sectionTop - 100) {
                        current = section.getAttribute("id");
                    }
                });

                navLinks.forEach((link) => {
                    link.classList.remove("active");
                    if (link.dataset.section === current) {
                        link.classList.add("active");
                    }
                });
            }

            if (rightPanel) {
                rightPanel.addEventListener('scroll', updateActiveNav, { passive: true });
            } else {
                window.addEventListener('scroll', updateActiveNav, { passive: true });
            }

            navLinks.forEach(link => {
                link.addEventListener('click', function (e) {
                    e.preventDefault();
                    const targetId = this.dataset.section;
                    const target = document.getElementById(targetId);
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

            const attClass = (a) => a === 'hadir' ? 'att-hadir' : (a === 'tidak_hadir' ? 'att-tidak' : 'att-tunggu');
            const attLabel = (a) => a === 'hadir' ? 'Hadir' : (a === 'tidak_hadir' ? 'Tidak Hadir' : 'Menunggu');
            const esc = (s) => s.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');

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
                            card.innerHTML = `<div class="g-header"><div class="g-avatar">${esc(g.name.charAt(0).toUpperCase())}</div><div class="g-name">${esc(g.name)}</div><span class="g-badge ${attClass(g.attendance)}">${attLabel(g.attendance)}</span></div><div class="g-message">${esc(g.message)}</div>`;
                            list.prepend(card);
                            document.getElementById('g-name').value = '';
                            document.getElementById('g-message').value = '';
                            document.getElementById('g-attendance').value = 'masih_menunggu';
                            formMsg.style.color = '#7de496';
                            formMsg.textContent = 'Ucapan berhasil dikirim! 💌';
                            setTimeout(() => { formMsg.textContent = ''; }, 3200);
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

        });
    })();
</script>