<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $compositions = [
        [
            'step' => 'Komposisi 01',
            'title' => 'Fresh Mango',
            'detail' => 'Menggunakan buah mangga asli yang memberikan rasa manis dan sedikit asam alami serta aroma buah yang segar.',
            'badge' => '100% Buah Asli',
            'color' => '#FB6C00',
            'bg' => 'bg-[#FFDD9C]/35',
        ],
        [
            'step' => 'Komposisi 02',
            'title' => 'Creamy Milk',
            'detail' => 'Menggunakan susu UHT berkualitas yang menghasilkan rasa gurih, lembut, dan creamy pada setiap tegukan.',
            'badge' => 'Gurih & Lembut',
            'color' => '#569118',
            'bg' => 'bg-white',
        ],
        [
            'step' => 'Komposisi 03',
            'title' => 'Jelly & Chia Seed',
            'detail' => 'Tambahan jelly memberikan sensasi kenyal, sedangkan chia seed memberikan tekstur unik dan tambahan serat.',
            'badge' => 'Kaya Serat',
            'color' => '#F9B637',
            'bg' => 'bg-[#F9B637]/20',
        ],
    ];

    $products = [
        [
            'id' => 'mjm-single',
            'code' => '01',
            'name' => 'Mango Jelly Milk',
            'size' => 'Ukuran 250 ml per botol',
            'price' => 15000,
            'normal_price' => null,
            'tag' => 'Single Bottle',
            'desc' => 'Minuman creamy dessert dengan mangga asli, susu UHT, jelly, dan chia seed. Cocok dinikmati saat dingin.',
            'highlight' => 'Ramah di kantong mahasiswa',
            'is_promo' => false,
        ],
        [
            'id' => 'mjm-bundling',
            'code' => '02',
            'name' => 'Promo Bundling (2 Botol)',
            'size' => '2 Botol × 250 ml',
            'price' => 25000,
            'normal_price' => 30000,
            'tag' => 'Hemat Rp5.000',
            'desc' => '2 Botol Mango Jelly Milk cuman Rp25.000. Lebih hemat untuk dinikmati bersama teman.',
            'highlight' => 'Paket paling favorit untuk berdua',
            'is_promo' => true,
        ],
    ];

    $processes = [
        [
            'no' => '01',
            'title' => 'Pemilihan Mangga',
            'desc' => 'Memilih buah mangga segar dan berkualitas, kemudian mencuci serta memotong buah sebelum diolah.',
        ],
        [
            'no' => '02',
            'title' => 'Pembuatan Jelly',
            'desc' => 'Merebus bubuk jelly sesuai takaran hingga matang, kemudian mencetak dan memotongnya menjadi bagian kecil.',
        ],
        [
            'no' => '03',
            'title' => 'Persiapan Bahan',
            'desc' => 'Merendam chia seed hingga mengembang serta mencampurkan susu UHT dan gula sesuai takaran.',
        ],
        [
            'no' => '04',
            'title' => 'Pengemasan Produk',
            'desc' => 'Memasukkan mangga, jelly, chia seed, dan susu ke dalam botol secara berlapis, kemudian menyimpannya di dalam chiller sebelum dijual.',
        ],
    ];

    $advantages = [
        [
            'title' => 'Real Mango',
            'desc' => 'Menggunakan buah mangga asli, bukan sekadar perisa mangga.',
            'accent' => 'border-l-4 border-l-[#FB6C00]',
        ],
        [
            'title' => 'Creamy Taste',
            'desc' => 'Perpaduan susu UHT yang lembut dan gurih.',
            'accent' => 'border-l-4 border-l-[#F9B637]',
        ],
        [
            'title' => 'Unique Texture',
            'desc' => 'Jelly kenyal dan chia seed yang memberikan sensasi berbeda.',
            'accent' => 'border-l-4 border-l-[#569118]',
        ],
        [
            'title' => 'Fresh & Cold',
            'desc' => 'Diproduksi setiap hari dan disimpan dalam chiller.',
            'accent' => 'border-l-4 border-l-[#569118]',
        ],
        [
            'title' => 'Affordable Price',
            'desc' => 'Harga Rp15.000 yang ramah untuk mahasiswa.',
            'accent' => 'border-l-4 border-l-[#FB6C00]',
        ],
        [
            'title' => 'Aesthetic Packaging',
            'desc' => 'Dikemas dalam botol transparan yang praktis dan menarik.',
            'accent' => 'border-l-4 border-l-[#F9B637]',
        ],
    ];

    return view('welcome', compact('compositions', 'products', 'processes', 'advantages'));
});
