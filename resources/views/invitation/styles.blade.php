<style>
    *,
    *::before,
    *::after {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    :root {
        --brown-dark: #2C1A0E;
        --brown-mid: #5C3317;
        --brown-light: #8B5A2B;
        --cream: #F5E6C8;
        --cream-light: #FAF3E0;
        --gold: #C9A84C;
        --text-dark: #1a0a00;
        --text-mid: #5a3a1a;
        --white: #ffffff;
    }

    html {
        scroll-behavior: smooth;
    }

    body {
        font-family: 'Inter', sans-serif;
        background: var(--brown-dark);
        color: var(--cream);
        overflow-x: hidden;
        overflow-y: hidden;
    }

    /* ── LAYOUT ──────────────────────────────────────────── */
    .invitation-wrapper {
        display: flex;
        height: 100vh;
        position: relative;
        overflow: hidden;
    }

    /* LEFT PANEL */
    .left-panel {
        width: 55%;
        height: 100vh;
        overflow: hidden;
        flex-shrink: 0;
        position: relative;
    }

    .photo-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        grid-template-rows: 1fr 1fr;
        height: 100%;
        gap: 3px;
        background: #1a0d06;
    }

    .photo-grid .photo-cell {
        overflow: hidden;
        position: relative;
    }

    .photo-grid .photo-cell img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 8s ease;
        will-change: transform;
    }

    .photo-grid .photo-cell:hover img {
        transform: scale(1.06);
    }

    .photo-grid .photo-cell:nth-child(1) {
        grid-column: 1;
        grid-row: 1;
    }

    .photo-grid .photo-cell:nth-child(2) {
        grid-column: 2;
        grid-row: 1 / 3;
    }

    .photo-grid .photo-cell:nth-child(3) {
        grid-column: 1;
        grid-row: 2;
    }

    .left-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom, rgba(30, 10, 0, 0.15) 0%, rgba(30, 10, 0, 0.03) 50%, rgba(30, 10, 0, 0.6) 100%);
        pointer-events: none;
    }

    .couple-name-left {
        position: absolute;
        bottom: 2.5rem;
        left: 2rem;
        color: white;
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.6rem;
        font-weight: 300;
        line-height: 1.2;
        text-shadow: 0 2px 14px rgba(0, 0, 0, 0.8);
        animation: fadeInUp 1.2s ease 0.5s both;
    }

    /* FLOATING DOTS (left panel) */
    .floating-dots {
        position: absolute;
        inset: 0;
        pointer-events: none;
    }

    .floating-dots span {
        position: absolute;
        width: 5px;
        height: 5px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
    }

    .floating-dots span:nth-child(1) {
        top: 35%;
        left: 10%;
        animation: floatDot 7s ease-in-out 0s infinite;
    }

    .floating-dots span:nth-child(2) {
        top: 55%;
        left: 47%;
        animation: floatDot 5.5s ease-in-out 1.5s infinite;
    }

    .floating-dots span:nth-child(3) {
        top: 75%;
        left: 25%;
        animation: floatDot 8s ease-in-out 3s infinite;
    }

    .floating-dots span:nth-child(4) {
        top: 20%;
        left: 58%;
        animation: floatDot 6s ease-in-out 4.5s infinite;
    }

    /* MUSIC BTN */
    .music-btn {
        position: fixed;
        top: 1.2rem;
        right: calc(45% + 1rem);
        z-index: 1000;
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        color: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        transition: background 0.3s, border-color 0.3s, transform 0.2s;
        animation: fadeInDown 0.8s ease 0.3s both;
    }

    .music-btn:hover {
        background: rgba(255, 255, 255, 0.22);
        transform: scale(1.1);
    }

    .music-btn.playing {
        background: rgba(201, 168, 76, 0.35);
        border-color: var(--gold);
        animation: musicPulse 2s ease-in-out infinite;
    }

    /* SIDE NAV */
    .side-nav {
        position: fixed;
        left: calc(55% - 22px);
        top: 50%;
        transform: translateY(-50%);
        z-index: 999;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.4rem;
        background: rgba(20, 8, 0, 0.7);
        backdrop-filter: blur(14px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 30px;
        padding: 0.75rem 0.45rem;
        animation: fadeIn 1s ease 1s both;
    }

    .side-nav a {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.38);
        text-decoration: none;
        font-size: 1rem;
        transition: all 0.25s;
        position: relative;
    }

    .side-nav a:hover,
    .side-nav a.active {
        color: white;
        background: rgba(201, 168, 76, 0.35);
    }

    .side-nav a.active {
        box-shadow: 0 0 10px rgba(201, 168, 76, 0.35);
    }

    .side-nav a .nav-tooltip {
        position: absolute;
        left: calc(100% + 0.6rem);
        background: rgba(30, 10, 0, 0.95);
        color: var(--cream);
        padding: 0.2rem 0.65rem;
        border-radius: 20px;
        font-size: 0.68rem;
        font-family: 'Inter', sans-serif;
        white-space: nowrap;
        opacity: 0;
        pointer-events: none;
        transition: opacity 0.2s;
        border: 1px solid rgba(201, 168, 76, 0.2);
    }

    .side-nav a:hover .nav-tooltip {
        opacity: 1;
    }

    .nav-dot {
        width: 3px;
        height: 3px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.12);
    }

    /* RIGHT PANEL */
    .right-panel {
        width: 45%;
        height: 100vh;
        overflow-y: scroll;
        scroll-behavior: smooth;
    }

    .right-panel::-webkit-scrollbar {
        width: 4px;
    }

    .right-panel::-webkit-scrollbar-track {
        background: transparent;
    }

    .right-panel::-webkit-scrollbar-thumb {
        background: rgba(201, 168, 76, 0.25);
        border-radius: 2px;
    }

    /* ── KEYFRAMES ───────────────────────────────────────── */
    @keyframes floatDot {

        0%,
        100% {
            opacity: .25;
            transform: translateY(0)
        }

        50% {
            opacity: .8;
            transform: translateY(-10px)
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(28px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px)
        }

        to {
            opacity: 1;
            transform: translateY(0)
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0
        }

        to {
            opacity: 1
        }
    }

    @keyframes scaleIn {
        from {
            opacity: 0;
            transform: scale(0.88)
        }

        to {
            opacity: 1;
            transform: scale(1)
        }
    }

    @keyframes slideInLeft {
        from {
            opacity: 0;
            transform: translateX(-30px)
        }

        to {
            opacity: 1;
            transform: translateX(0)
        }
    }

    @keyframes slideInRight {
        from {
            opacity: 0;
            transform: translateX(30px)
        }

        to {
            opacity: 1;
            transform: translateX(0)
        }
    }

    @keyframes scrollPulse {

        0%,
        100% {
            opacity: .2
        }

        50% {
            opacity: .9
        }
    }

    @keyframes musicPulse {

        0%,
        100% {
            box-shadow: 0 0 0 0 rgba(201, 168, 76, 0.4)
        }

        50% {
            box-shadow: 0 0 0 8px rgba(201, 168, 76, 0)
        }
    }

    @keyframes ornamentFloat {

        0%,
        100% {
            transform: translateY(0) rotate(0deg)
        }

        33% {
            transform: translateY(-12px) rotate(2deg)
        }

        66% {
            transform: translateY(-6px) rotate(-1.5deg)
        }
    }

    @keyframes shimmer {

        0%,
        100% {
            opacity: 0.6
        }

        50% {
            opacity: 1
        }
    }

    @keyframes countFlip {
        0% {
            transform: translateY(-8px);
            opacity: 0
        }

        100% {
            transform: translateY(0);
            opacity: 1
        }
    }

    /* ── SCROLL-TRIGGERED REVEAL ─────────────────────────── */
    .reveal {
        opacity: 0;
        transform: translateY(32px);
        transition: opacity 0.75s cubic-bezier(.22, 1, .36, 1), transform 0.75s cubic-bezier(.22, 1, .36, 1);
    }

    .reveal.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .reveal-left {
        opacity: 0;
        transform: translateX(-32px);
        transition: opacity 0.7s cubic-bezier(.22, 1, .36, 1), transform 0.7s cubic-bezier(.22, 1, .36, 1);
    }

    .reveal-left.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .reveal-right {
        opacity: 0;
        transform: translateX(32px);
        transition: opacity 0.7s cubic-bezier(.22, 1, .36, 1), transform 0.7s cubic-bezier(.22, 1, .36, 1);
    }

    .reveal-right.visible {
        opacity: 1;
        transform: translateX(0);
    }

    .reveal-scale {
        opacity: 0;
        transform: scale(0.9);
        transition: opacity 0.7s cubic-bezier(.22, 1, .36, 1), transform 0.7s cubic-bezier(.22, 1, .36, 1);
    }

    .reveal-scale.visible {
        opacity: 1;
        transform: scale(1);
    }

    .delay-1 {
        transition-delay: 0.1s !important;
    }

    .delay-2 {
        transition-delay: 0.2s !important;
    }

    .delay-3 {
        transition-delay: 0.32s !important;
    }

    .delay-4 {
        transition-delay: 0.46s !important;
    }

    .delay-5 {
        transition-delay: 0.62s !important;
    }

    /* PARALLAX ORNAMENTS */
    .parallax-ornament {
        will-change: transform;
        transition: transform 0.05s linear;
    }

    .ornament-float {
        animation: ornamentFloat 7s ease-in-out infinite;
    }

    /* ── SECTIONS ────────────────────────────────────────── */
    section {
        position: relative;
    }

    /* HERO */
    #hero {
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        padding: 3rem 2.5rem;
        background: var(--brown-dark);
        overflow: hidden;
    }

    #hero .batik-top {
        position: absolute;
        top: 0;
        right: 0;
        width: 65%;
        opacity: 0;
        pointer-events: none;
        animation: slideInRight 1.4s cubic-bezier(.22, 1, .36, 1) 0.2s forwards;
    }

    #hero .batik-bottom {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 55%;
        opacity: 0;
        transform: rotate(180deg);
        pointer-events: none;
        animation: slideInLeft 1.4s cubic-bezier(.22, 1, .36, 1) 0.4s forwards;
    }

    #hero .hero-content {
        position: relative;
        z-index: 1;
    }

    #hero .eyebrow {
        font-size: 0.68rem;
        letter-spacing: 0.3em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 1rem;
        animation: fadeInDown 0.9s ease 0.6s both;
        animation: shimmer 3s ease-in-out 1s infinite, fadeInDown 0.9s ease 0.6s both;
    }

    #hero h1 {
        font-family: 'Cormorant Garamond', serif;
        font-size: clamp(3rem, 5.5vw, 4.8rem);
        font-weight: 300;
        color: var(--cream-light);
        line-height: 1.05;
        margin-bottom: 1.2rem;
        animation: fadeInUp 1s ease 0.8s both;
    }

    #hero .date-display {
        font-size: 0.72rem;
        letter-spacing: 0.4em;
        color: rgba(245, 230, 200, 0.65);
        margin-bottom: 2rem;
        animation: fadeInUp 1s ease 1s both;
    }

    #hero .leaf-hero {
        animation: fadeInUp 1s ease 1.2s both, ornamentFloat 8s ease-in-out 2s infinite;
    }

    .scroll-hint {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.4rem;
        color: rgba(245, 230, 200, 0.35);
        font-size: 0.62rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        position: absolute;
        bottom: 2rem;
        left: 50%;
        transform: translateX(-50%);
        animation: fadeIn 1s ease 2s both;
    }

    .scroll-arrow {
        width: 1px;
        height: 40px;
        background: linear-gradient(to bottom, transparent, rgba(245, 230, 200, 0.4));
        animation: scrollPulse 2s ease-in-out infinite;
    }

    /* QURAN */
    #quran {
        padding: 4rem 2.5rem;
        background: var(--cream-light);
        color: var(--text-dark);
        overflow: hidden;
        min-height: 60vh;
        display: flex;
        align-items: center;
    }

    #quran .bg-asset {
        position: absolute;
        right: -2rem;
        top: 0;
        height: 115%;
        opacity: 0.38;
        mix-blend-mode: multiply;
        pointer-events: none;
    }

    #quran .quran-inner {
        position: relative;
        z-index: 1;
        max-width: 360px;
    }

    #quran .arabic {
        font-family: 'Cormorant Garamond', serif;
        font-size: 0.95rem;
        color: var(--brown-mid);
        letter-spacing: 0.06em;
        margin-bottom: 1rem;
        font-style: italic;
    }

    #quran .quran-text {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.05rem;
        font-style: italic;
        line-height: 1.9;
        color: var(--text-dark);
        margin-bottom: 0.8rem;
    }

    #quran .quran-ref {
        font-size: 0.72rem;
        color: var(--brown-light);
        letter-spacing: 0.06em;
    }

    /* COUPLE */
    #couple {
        padding: 4rem 2.5rem;
        background: var(--cream);
        color: var(--text-dark);
        overflow: hidden;
    }

    #couple .wayang-l {
        position: absolute;
        left: 0;
        top: 50%;
        transform: translateY(-50%);
        height: 80%;
        opacity: 0;
        pointer-events: none;
        transition: opacity 1s ease;
    }

    #couple .wayang-l.visible {
        opacity: 0.12;
    }

    #couple .wayang-r {
        position: absolute;
        right: 0;
        bottom: 0;
        height: 60%;
        opacity: 0;
        pointer-events: none;
        transition: opacity 1s ease 0.3s;
    }

    #couple .wayang-r.visible {
        opacity: 0.1;
    }

    .couple-person {
        text-align: center;
        position: relative;
        z-index: 1;
        padding: 1.8rem 0;
    }

    .couple-person+.couple-person {
        border-top: 1px solid rgba(92, 51, 23, 0.15);
    }

    .couple-person .instagram {
        font-size: 0.7rem;
        color: var(--brown-light);
        letter-spacing: 0.12em;
        margin-bottom: 0.4rem;
    }

    .couple-person h2 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.9rem;
        font-weight: 600;
        color: var(--brown-dark);
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.3rem;
    }

    .couple-person .role {
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--brown-mid);
        margin-bottom: 0.5rem;
    }

    .couple-person .parent-info {
        font-size: 0.82rem;
        color: var(--text-mid);
        line-height: 1.7;
    }

    .divider-ampersand {
        text-align: center;
        font-family: 'Great Vibes', cursive;
        font-size: 3rem;
        color: var(--brown-light);
        padding: 0.3rem 0;
        position: relative;
        z-index: 1;
        animation: ornamentFloat 6s ease-in-out infinite;
    }

    /* SAVE THE DATE */
    #savedate {
        padding: 3.5rem 2.5rem;
        background: var(--brown-dark);
        overflow: hidden;
    }

    .paper-bg-ornament {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.06;
        pointer-events: none;
    }

    .paper-box {
        background: #ede0c4;
        border-radius: 4px;
        padding: 2.2rem;
        position: relative;
        box-shadow: 0 12px 60px rgba(0, 0, 0, 0.55);
        overflow: hidden;
    }

    .paper-box::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image: url('/assets/Javanese_Paperize__2_.png');
        background-size: cover;
        opacity: 0.1;
        pointer-events: none;
    }

    .paper-box .section-label {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.9rem;
        font-weight: 300;
        text-align: center;
        color: var(--text-dark);
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .countdown-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .cd-item {
        text-align: center;
    }

    .cd-item .num {
        font-family: 'Cormorant Garamond', serif;
        font-size: 2.4rem;
        font-weight: 600;
        color: var(--brown-dark);
        line-height: 1;
        display: inline-block;
        animation: countFlip 0.3s ease;
    }

    .cd-item .unit {
        font-size: 0.58rem;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        color: var(--brown-mid);
        margin-top: 0.2rem;
    }

    .event-date-txt {
        text-align: center;
        font-family: 'Cormorant Garamond', serif;
        font-size: 1rem;
        color: var(--text-mid);
        margin-bottom: 0.7rem;
        position: relative;
        z-index: 1;
    }

    .event-address {
        font-size: 0.77rem;
        text-align: center;
        color: var(--text-mid);
        line-height: 1.7;
        margin-bottom: 1.2rem;
        position: relative;
        z-index: 1;
    }

    .btn-center {
        text-align: center;
        position: relative;
        z-index: 1;
    }

    .btn-outline {
        display: inline-block;
        padding: 0.45rem 1.4rem;
        border: 1px solid currentColor;
        border-radius: 30px;
        font-size: 0.74rem;
        letter-spacing: 0.05em;
        text-decoration: none;
        transition: all 0.25s;
        cursor: pointer;
        background: transparent;
    }

    .paper-box .btn-outline {
        color: var(--brown-mid);
    }

    .paper-box .btn-outline:hover {
        background: var(--brown-mid);
        color: white;
        border-color: var(--brown-mid);
    }

    /* EVENTS */
    #events {
        padding: 3.5rem 2.5rem;
        background: var(--brown-dark);
    }

    .event-card h3 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.65rem;
        font-weight: 400;
        color: var(--cream-light);
        text-align: center;
        margin-bottom: 0.5rem;
    }

    .ev-date {
        font-size: 0.8rem;
        color: var(--gold);
        text-align: center;
        margin-bottom: 0.3rem;
    }

    .ev-time {
        font-size: 0.77rem;
        color: rgba(245, 230, 200, 0.65);
        text-align: center;
        margin-bottom: 0.5rem;
    }

    .ev-loc {
        font-size: 0.77rem;
        color: rgba(245, 230, 200, 0.55);
        text-align: center;
        line-height: 1.7;
        margin-bottom: 1rem;
    }

    .event-card .btn-outline {
        color: rgba(245, 230, 200, 0.7);
        border-color: rgba(245, 230, 200, 0.28);
    }

    .event-card .btn-outline:hover {
        background: rgba(255, 255, 255, 0.09);
        color: white;
    }

    .event-divider {
        height: 1px;
        background: linear-gradient(to right, transparent, rgba(201, 168, 76, 0.3), transparent);
        margin: 2rem 0;
    }

    /* LIVESTREAM */
    #livestream {
        padding: 3.5rem 2.5rem;
        background: var(--brown-dark);
        overflow: hidden;
        border-top: 1px solid rgba(201, 168, 76, 0.1);
    }

    #livestream .ls-bg {
        position: absolute;
        top: 0;
        right: -2rem;
        height: 110%;
        width: 70%;
        object-fit: cover;
        opacity: 0.2;
        pointer-events: none;
    }

    #livestream .ls-inner {
        position: relative;
        z-index: 1;
    }

    #livestream h3 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 300;
        color: var(--cream-light);
        margin-bottom: 0.7rem;
    }

    #livestream p {
        font-size: 0.79rem;
        color: rgba(245, 230, 200, 0.6);
        line-height: 1.75;
        margin-bottom: 1.2rem;
    }

    #livestream .btn-outline {
        color: var(--cream);
        border-color: rgba(245, 230, 200, 0.3);
    }

    #livestream .btn-outline:hover {
        background: rgba(255, 255, 255, 0.09);
    }

    /* GIFT */
    #gift {
        padding: 3rem 2.5rem;
        background: var(--brown-dark);
        border-top: 1px solid rgba(201, 168, 76, 0.1);
        text-align: center;
    }

    #gift h3 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 300;
        color: var(--cream-light);
        margin-bottom: 0.6rem;
    }

    #gift p {
        font-size: 0.79rem;
        color: var(--gold);
        line-height: 1.75;
        margin-bottom: 1.2rem;
    }

    #gift .btn-outline {
        color: var(--cream);
        border-color: rgba(245, 230, 200, 0.3);
    }

    #gift .btn-outline:hover {
        background: rgba(255, 255, 255, 0.09);
    }

    .bank-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 1.2rem;
        margin-top: 1.5rem;
    }

    .bank-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
        transition: transform 0.3s ease, background 0.3s ease;
    }

    .bank-card:hover {
        transform: translateY(-5px);
        background: rgba(255, 255, 255, 0.06);
    }

    .bank-name {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.4rem;
        color: var(--gold);
        margin-bottom: 0.3rem;
    }

    .bank-holder {
        font-size: 0.8rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: var(--cream-light);
        margin-bottom: 0.8rem;
    }

    .bank-number {
        font-family: 'Inter', sans-serif;
        font-size: 1.05rem;
        font-weight: 500;
        color: var(--white);
        margin-bottom: 1rem;
        letter-spacing: 0.05em;
    }

    .btn-copy {
        background: transparent;
        border: 1px solid rgba(201, 168, 76, 0.5);
        color: var(--gold);
        padding: 0.4rem 1.2rem;
        border-radius: 20px;
        font-size: 0.7rem;
        cursor: pointer;
        transition: all 0.2s ease;
        font-family: 'Inter', sans-serif;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .btn-copy:hover {
        background: var(--gold);
        color: var(--brown-dark);
        border-color: var(--gold);
    }

    /* GREETINGS */
    #greetings {
        padding: 3.5rem 2.5rem 5rem;
        background: #1e0d05;
    }

    #greetings h3 {
        font-family: 'Cormorant Garamond', serif;
        font-size: 1.8rem;
        font-weight: 300;
        color: var(--cream-light);
        text-align: center;
        margin-bottom: 0.3rem;
    }

    #greetings .subtitle {
        font-size: 0.74rem;
        color: rgba(245, 230, 200, 0.4);
        text-align: center;
        margin-bottom: 2rem;
    }

    .greeting-form {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 8px;
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    .form-group label {
        display: block;
        font-size: 0.7rem;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--gold);
        margin-bottom: 0.4rem;
    }

    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 4px;
        padding: 0.6rem 0.9rem;
        color: var(--cream);
        font-family: 'Inter', sans-serif;
        font-size: 0.82rem;
        outline: none;
        transition: border-color 0.2s, background 0.2s;
    }

    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        border-color: var(--gold);
        background: rgba(255, 255, 255, 0.08);
    }

    .form-group select option {
        background: #2c1a0e;
        color: var(--cream);
    }

    .form-group textarea {
        resize: vertical;
        min-height: 90px;
    }

    .btn-submit {
        width: 100%;
        padding: 0.75rem;
        background: var(--gold);
        color: var(--brown-dark);
        border: none;
        border-radius: 4px;
        font-family: 'Inter', sans-serif;
        font-size: 0.82rem;
        font-weight: 600;
        letter-spacing: 0.08em;
        cursor: pointer;
        transition: opacity 0.2s, transform 0.15s;
    }

    .btn-submit:hover {
        opacity: 0.88;
        transform: translateY(-1px);
    }

    .btn-submit:active {
        transform: translateY(0);
    }

    .greeting-list {
        display: flex;
        flex-direction: column;
        gap: 0.9rem;
    }

    .greeting-card {
        background: rgba(255, 255, 255, 0.04);
        border: 1px solid rgba(255, 255, 255, 0.07);
        border-radius: 6px;
        padding: 1rem 1.2rem;
        animation: fadeInUp 0.4s ease;
    }

    .g-header {
        display: flex;
        align-items: center;
        gap: 0.7rem;
        margin-bottom: 0.5rem;
    }

    .g-avatar {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        background: var(--brown-mid);
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Cormorant Garamond', serif;
        font-size: 1rem;
        color: var(--cream);
        flex-shrink: 0;
    }

    .g-name {
        font-size: 0.84rem;
        font-weight: 500;
        color: var(--cream-light);
    }

    .g-badge {
        font-size: 0.63rem;
        padding: 0.15rem 0.5rem;
        border-radius: 20px;
        margin-left: auto;
        flex-shrink: 0;
    }

    .att-hadir {
        background: rgba(60, 180, 80, 0.18);
        color: #7de496;
    }

    .att-tidak {
        background: rgba(220, 60, 60, 0.18);
        color: #e89090;
    }

    .att-tunggu {
        background: rgba(200, 160, 60, 0.18);
        color: #ddc980;
    }

    .g-message {
        font-size: 0.79rem;
        color: rgba(245, 230, 200, 0.58);
        line-height: 1.65;
    }

    /* FOOTER */
    footer {
        padding: 2rem 2.5rem;
        text-align: center;
        background: #120600;
        color: rgba(245, 230, 200, 0.22);
        font-size: 0.68rem;
        letter-spacing: 0.1em;
    }

    /* RESPONSIVE */
    @media (max-width: 820px) {
        body {
            overflow-y: auto;
        }

        .invitation-wrapper {
            flex-direction: column;
            height: auto;
            overflow: visible;
        }

        .left-panel {
            width: 100%;
            height: 75vw;
        }

        .right-panel {
            width: 100%;
            height: auto;
            overflow-y: visible;
        }

        .side-nav {
            left: auto;
            right: 0.8rem;
            top: auto;
            bottom: 2rem;
            transform: none;
            flex-direction: row;
            padding: 0.45rem 0.7rem;
            border-radius: 30px;
        }

        .music-btn {
            right: 1rem;
            top: 0.8rem;
        }

        .side-nav a .nav-tooltip {
            left: 50%;
            transform: translateX(-50%);
            bottom: calc(100% + 0.5rem);
            top: auto;
            right: auto;
        }

        #hero h1 {
            font-size: 2.6rem;
        }
    }
</style>