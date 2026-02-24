<?php

return [
    /* ── COUPLE ──────────────────────────────────────────── */
    'bride_name' => 'Siti Maysaroh',
    'bride_instagram' => '@siti_maysaroh',
    'bride_role' => 'Putri',
    'bride_parents' => 'Bapak gimun & Ibu Semi',
    'bride_hometown' => 'Lubuk Rumbai sumatra selatan',

    'groom_name' => 'Geraldo Bima Sabian',
    'groom_instagram' => '@geraldo',
    'groom_role' => 'Putra',
    'groom_parents' => 'Bapak broto Hadibowo & Ibu Anita Setiawati',
    'groom_hometown' => 'Banjarnegara jawa tengah',

    /* ── DATE & VENUE ────────────────────────────────────── */
    'wedding_datetime' => '2026-04-10T09:00:00+07:00', // ISO 8601 for countdown
    'wedding_date_display' => 'Jumat, 10 April 2026',
    'wedding_short_date' => '10 · 04 · 2026',

    'venue_name' => 'Plataran Menteng',
    'venue_address' => 'Jl. Desa Muara Kati Baru 1, Kec. Tiang Pumpung Kepungut (TPK),Kab. Musi Rawas, Sumatera Selatan',
    'venue_maps_url' => 'https://maps.app.goo.gl/kKkQottoPTUWyf6s5',
    'venue_maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.82469731521655!3d-6.208763595493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMzEuNiJTIDEwNsKwNDknMzMuMiJF!5e0!3m2!1sen!2sid!4v1234567890',

    /* ── EVENTS ──────────────────────────────────────────── */
    'events' => [
        [
            'title' => 'Akad & Resepsi',
            'date' => 'Jumat, 10 April 2026',
            'time' => 'Akad: 09:00 WIB — Selesai',
            'location' => 'Jl.Desa Muara Kati Baru 1, Kec. Tiang Pumpung Kepungut (TPK), Kab. Musi Rawas, Sumatera Selatan',
            'maps_url' => 'https://maps.app.goo.gl/kKkQottoPTUWyf6s5',
        ],
    ],

    /* ── PHOTOS (left panel grid) ───────────────────────── */
    // Grid: cell 1 = top-left, cell 2 = top-right, cell 3 = bottom-left, cell 4 = bottom-right
    'photos' => [
        '/bridge/image-couple.jpeg',    // top-left
        '/bridge/image-couple-2.jpeg',  // top-right
        '/bridge/image-man.jpeg',  // bottom-right (reused)
        '/bridge/image-woman.jpeg',     // bottom-left
    ],
    // CSS object-position per cell for ideal cropping
    'photo_positions' => [
        'center top',
        'center center',
        'center 40%',
        'center center',
    ],

    /* ── MUSIC ───────────────────────────────────────────── */
    'music_url' => '/assets/music.mp3',    // e.g. '/assets/music/wedding-song.mp3'
    'music_loop' => true,

    /* ── STREAMING ───────────────────────────────────────── */
    'streaming_url' => '#',
    'streaming_note' => 'Please join the live streaming. Live streaming link will be activated on the day of the event.',

    /* ── GIFT / BANK ACCOUNTS ────────────────────────────── */
    'bank_accounts' => [
        [
            'holder' => 'Geraldo Bima Sabian',
            'bank' => 'Bank Mandiri',
            'number' => '1650002946771',
        ],
        [
            'holder' => 'Maysaroh',
            'bank' => 'BNI',
            'number' => '1351670398',
        ],
    ],

    /* ── ORNAMENT ASSETS ─────────────────────────────────── */
    'assets' => [
        'batik_top' => '/assets/batik-paperize.png',
        'batik_bottom' => '/assets/batik.png',
        'leaf_1' => '/assets/leaf-ornament-2.png',
        'leaf_2' => '/assets/leaf-ornament-3.png',
        'sakura' => '/assets/sakura tree.png',
        'wayang_left' => '/assets/wayang-left.png',
        'wayang_right' => '/assets/wayang-right.png',
        'dreamy' => '/assets/assets_dreamy_javanese.png',
        'layout_ornament' => '/assets/Layout_design_Lunare___38___1_.png',
        'tree' => '/assets/tree.png',
        'tree_ornament' => '/assets/tree ornament.png',
        'paper_sm_1' => '/assets/Javanese_Paperize__2_.png',
        'paper_sm_2' => '/assets/Javanese_Paperize__3_.png',
        'paper_torn_1' => '/assets/Javanese_Paperize__5_.png',
        'paper_torn_2' => '/assets/Javanese_Paperize__6_.png',
    ],
];
