<?php

return [
    /* ── COUPLE ──────────────────────────────────────────── */
    'bride_name' => 'Shinta Aulia, S.Pd',
    'bride_instagram' => '@shinta_doe',
    'bride_role' => 'Youngest Daughter of',
    'bride_parents' => 'Bapak Sanusi S.M & Ibu Jubaedah',
    'bride_hometown' => 'dari London Utara',

    'groom_name' => 'Gerald Akbar S.Kom',
    'groom_instagram' => '@john_doe',
    'groom_role' => 'First Son of',
    'groom_parents' => 'Bapak Akbar S.kom & Ibu Siti Maimunah',
    'groom_hometown' => 'dari Jakarta, Indonesia',

    /* ── DATE & VENUE ────────────────────────────────────── */
    'wedding_datetime' => '2026-02-28T10:00:00+07:00', // ISO 8601 for countdown
    'wedding_date_display' => 'Saturday, February 28th, 2026',
    'wedding_short_date' => '28 · 02 · 2026',

    'venue_name' => 'Plataran Menteng',
    'venue_address' => 'Jalan HOS. Cokroaminoto, RT.6/RW.4, Gondangdia,
                           Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta, Indonesia.',
    'venue_maps_url' => 'https://maps.app.goo.gl/kKkQottoPTUWyf6s5',
    'venue_maps_embed' => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.521260322283!2d106.82469731521655!3d-6.208763595493371!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zNsKwMTInMzEuNiJTIDEwNsKwNDknMzMuMiJF!5e0!3m2!1sen!2sid!4v1234567890',

    /* ── EVENTS ──────────────────────────────────────────── */
    'events' => [
        [
            'title' => 'Marriage Contract',
            'date' => 'Friday, April 28th, 2023',
            'time' => '09:00 WIB — finish',
            'location' => 'Masjid Al-Barkah, Jl. Veteran No.46, Rt.003/RW.004,
                           Marga Jaya, Kec. Bekasi Sel., Kota Bks, Jawa Barat 17141',
            'maps_url' => 'https://maps.app.goo.gl/kKkQottoPTUWyf6s5',
        ],
        [
            'title' => 'Wedding Reception',
            'date' => 'Saturday, February 28th, 2026',
            'time' => '10:00 WIB — 14:00 WIB',
            'location' => 'Plataran Menteng, Jalan HOS. Cokroaminoto, RT.6/RW.4,
                           Gondangdia, Kota Jakarta Pusat, DKI Jakarta',
            'maps_url' => 'https://maps.app.goo.gl/kKkQottoPTUWyf6s5',
        ],
    ],

    /* ── PHOTOS (left panel grid) ───────────────────────── */
    // Grid: cell 1 = top-left (tall), cell 2 = right (full height), cell 3 = bottom-left
    'photos' => [
        '/bridge/image-couple.jpeg',    // top-left
        '/bridge/image-couple-2.jpeg',  // right column (spans full height)
        '/bridge/image-woman.jpeg',     // bottom-left
    ],
    // CSS object-position per cell for ideal cropping
    'photo_positions' => [
        'center top',
        'center center',
        'center 40%',
    ],

    /* ── MUSIC ───────────────────────────────────────────── */
    'music_url' => '',    // e.g. '/assets/music/wedding-song.mp3'
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
            'holder' => 'Adek May',
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
