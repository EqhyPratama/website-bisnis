<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>mango.moooo — Milk, Mango & Jelly</title>

    <!-- Google Fonts: Plus Jakarta Sans & Fraunces -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,600;0,9..144,700;1,9..144,500&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        [x-cloak] { display: none !important; }
    </style>
</head>
<body
    x-data="mangoStore()"
    :class="{ 'overflow-hidden': menuOpen || cartOpen }"
    class="bg-white text-stone-900 font-sans antialiased selection:bg-[#F9B637] selection:text-stone-950"
>

    <!-- 1. TOP TICKER BAR -->
    <div class="bg-[#569118] text-white text-[11px] sm:text-xs font-semibold tracking-wider border-b border-stone-900/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 py-2.5 flex items-center justify-between gap-4">
            <div class="flex items-center gap-2">
                <span class="inline-block w-2 h-2 rounded-full bg-[#FFDD9C] animate-pulse"></span>
                <span>FRESH EVERY DAY • REAL MANGO • CREAMY MILK • JELLY & CHIA SEED</span>
            </div>
            <span class="hidden md:inline text-[#FFDD9C]">Makassar, Sulawesi Selatan</span>
        </div>
    </div>

    <!-- HEADER DENGAN INTERACTIVE BURGER MENU -->
    <header class="sticky top-0 z-50 bg-white/95 backdrop-blur-md border-b border-stone-900/10">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 h-20 flex items-center justify-between">

            <!-- Brand Identity + Logo Landscape -->
            <a href="#" class="flex items-center gap-3.5 group">
                <div class="h-12 px-2.5 rounded-2xl bg-white border border-stone-900/15 overflow-hidden flex items-center justify-center shrink-0 shadow-2xs">
                    <img
                        src="logo.png?v=2"
                        alt="mango.moooo Logo"
                        class="h-10 w-auto object-contain"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                    >
                    <span style="display:none;" class="font-display text-lg font-bold text-[#FB6C00] px-1">m.m</span>
                </div>
                <div>
                    <span class="block font-display text-xl sm:text-2xl font-bold tracking-tight leading-none text-stone-900">
                        mango<span class="text-[#FB6C00]">.moooo</span>
                    </span>
                    <span class="block text-[11px] uppercase tracking-widest text-[#569118] font-bold mt-1">
                        Milk, Mango & Jelly
                    </span>
                </div>
            </a>

            <!-- Quick Desktop Pill -->
            <div class="hidden lg:flex items-center gap-3 px-4 py-1.5 rounded-full bg-[#FFDD9C]/40 border border-[#F9B637]/60 text-xs font-semibold text-stone-800">
                <span class="text-[#569118]">● Bahan Berkualitas</span>
                <span class="text-stone-300">|</span>
                <span class="text-[#FB6C00]">● Dingin Menyegarkan</span>
                <span class="text-stone-300">|</span>
                <span class="text-stone-900">● Enak & Creamy</span>
            </div>

            <!-- Right Controls: Tombol Keranjang & Interactive Burger Menu -->
            <div class="flex items-center gap-2.5 sm:gap-3">
                <button
                    @click="cartOpen = true; menuOpen = false"
                    class="relative inline-flex items-center gap-2.5 px-4 py-2.5 rounded-full bg-[#FFDD9C]/60 hover:bg-[#F9B637] text-stone-900 text-xs font-bold uppercase tracking-wider transition-colors cursor-pointer"
                >
                    <span>Pesanan</span>
                    <span
                        x-text="cartCount()"
                        class="w-5 h-5 rounded-full bg-[#FB6C00] text-white text-[11px] flex items-center justify-center font-bold"
                    >0</span>
                </button>

                <!-- Tombol Interactive Burger Menu -->
                <button
                    @click="menuOpen = !menuOpen; cartOpen = false"
                    :aria-expanded="menuOpen"
                    aria-label="Toggle Navigation Menu"
                    class="group relative inline-flex items-center gap-3 pl-4 pr-3.5 py-2.5 rounded-full border border-stone-900/15 hover:border-stone-900 bg-white text-stone-900 transition-all duration-300 cursor-pointer"
                >
                    <span
                        x-text="menuOpen ? 'Tutup' : 'Menu'"
                        class="text-xs font-bold uppercase tracking-wider"
                    >Menu</span>

                    <div class="w-5 h-4 relative flex flex-col justify-between items-end">
                        <span
                            :class="menuOpen ? 'rotate-45 translate-y-[7px] w-5 bg-[#FB6C00]' : 'w-5 bg-stone-900 group-hover:bg-[#569118]'"
                            class="h-[2px] rounded-full transition-all duration-300 origin-center"
                        ></span>
                        <span
                            :class="menuOpen ? 'opacity-0 translate-x-2' : 'w-3.5 bg-stone-900 group-hover:w-5 group-hover:bg-[#FB6C00]'"
                            class="h-[2px] rounded-full transition-all duration-300"
                        ></span>
                        <span
                            :class="menuOpen ? '-rotate-45 -translate-y-[7px] w-5 bg-[#FB6C00]' : 'w-4 bg-stone-900 group-hover:w-5 group-hover:bg-[#569118]'"
                            class="h-[2px] rounded-full transition-all duration-300 origin-center"
                        ></span>
                    </div>
                </button>
            </div>
        </div>
    </header>

    <!-- SLIDE-OVER BURGER MENU DRAWER -->
    <div
        x-show="menuOpen"
        x-cloak
        class="fixed inset-0 z-40 flex justify-end"
    >
        <div
            x-show="menuOpen"
            x-transition.opacity
            @click="menuOpen = false"
            class="fixed inset-0 bg-stone-950/40 backdrop-blur-xs"
        ></div>

        <div
            x-show="menuOpen"
            x-transition:enter="transition transform ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition transform ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="relative w-full max-w-xl bg-white h-full pt-24 pb-10 px-6 sm:px-12 flex flex-col justify-between overflow-y-auto border-l border-stone-900/10 shadow-2xl"
        >
            <div>
                <p class="text-[11px] font-bold uppercase tracking-[0.2em] text-[#569118] mb-5">Navigasi mango.moooo</p>

                <nav class="divide-y divide-stone-900/10 border-y border-stone-900/10">
                    <a @click="menuOpen = false" href="#komposisi" class="group py-4 flex items-baseline justify-between hover:pl-3 transition-all duration-200">
                        <div class="flex items-baseline gap-4">
                            <span class="text-xs font-mono font-bold text-[#FB6C00]">01</span>
                            <span class="font-display text-2xl text-stone-900 group-hover:text-[#FB6C00] transition-colors">Komposisi Produk</span>
                        </div>
                        <span class="text-xs uppercase tracking-wider text-stone-400 group-hover:text-stone-900">3 Bahan Utama →</span>
                    </a>

                    <a @click="menuOpen = false" href="#katalog" class="group py-4 flex items-baseline justify-between hover:pl-3 transition-all duration-200">
                        <div class="flex items-baseline gap-4">
                            <span class="text-xs font-mono font-bold text-[#FB6C00]">02</span>
                            <span class="font-display text-2xl text-stone-900 group-hover:text-[#FB6C00] transition-colors">Katalog & Promo Bundling</span>
                        </div>
                        <span class="text-xs uppercase tracking-wider text-stone-400 group-hover:text-stone-900">Rp15.000 / Rp25.000 →</span>
                    </a>

                    <a @click="menuOpen = false" href="#produksi" class="group py-4 flex items-baseline justify-between hover:pl-3 transition-all duration-200">
                        <div class="flex items-baseline gap-4">
                            <span class="text-xs font-mono font-bold text-[#FB6C00]">03</span>
                            <span class="font-display text-2xl text-stone-900 group-hover:text-[#FB6C00] transition-colors">Proses Produksi</span>
                        </div>
                        <span class="text-xs uppercase tracking-wider text-stone-400 group-hover:text-stone-900">4 Tahap Higienis →</span>
                    </a>

                    <a @click="menuOpen = false" href="#keunggulan" class="group py-4 flex items-baseline justify-between hover:pl-3 transition-all duration-200">
                        <div class="flex items-baseline gap-4">
                            <span class="text-xs font-mono font-bold text-[#FB6C00]">04</span>
                            <span class="font-display text-2xl text-stone-900 group-hover:text-[#FB6C00] transition-colors">Keunggulan Produk</span>
                        </div>
                        <span class="text-xs uppercase tracking-wider text-stone-400 group-hover:text-stone-900">Why Choose Us →</span>
                    </a>

                    <a @click="menuOpen = false" href="#kontak" class="group py-4 flex items-baseline justify-between hover:pl-3 transition-all duration-200">
                        <div class="flex items-baseline gap-4">
                            <span class="text-xs font-mono font-bold text-[#FB6C00]">05</span>
                            <span class="font-display text-2xl text-stone-900 group-hover:text-[#FB6C00] transition-colors">Pemesanan & Kontak</span>
                        </div>
                        <span class="text-xs uppercase tracking-wider text-stone-400 group-hover:text-stone-900">@mango.moooo →</span>
                    </a>
                </nav>
            </div>

            <!-- Card Info di dalam Burger Menu -->
            <div class="mt-8 rounded-2xl bg-[#FFDD9C]/50 border border-[#F9B637] p-6">
                <div class="flex items-center justify-between mb-2">
                    <span class="px-2.5 py-1 rounded-full bg-[#569118] text-white text-[10px] font-bold uppercase tracking-wider">Promo Mahasiswa</span>
                    <span class="text-xs font-bold text-[#FB6C00]">2 Botol Rp25.000</span>
                </div>
                <p class="text-xs text-stone-700 leading-relaxed mb-4">
                    Nikmati kesegaran Mango Jelly Milk dari <strong>mango.moooo</strong> di tengah cuaca panas Kota Makassar.
                </p>
                <button
                    @click="menuOpen = false; cartOpen = true"
                    class="w-full py-3 px-4 rounded-xl bg-[#FB6C00] hover:bg-stone-900 text-white text-xs font-bold uppercase tracking-wider transition-colors cursor-pointer"
                >
                    Lihat Ringkasan Pesanan
                </button>
            </div>
        </div>
    </div>

    <main>
        <!-- HERO SECTION -->
        <section class="max-w-7xl mx-auto px-4 sm:px-8 pt-8 pb-20">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-stretch">

                <!-- Kolom Kiri (7 Kolom): Teks Utama Hero -->
                <div class="lg:col-span-7 rounded-3xl border border-stone-900/10 bg-white p-8 sm:p-12 flex flex-col justify-between">
                    <div>
                        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-[#FFDD9C]/70 border border-[#F9B637] text-stone-900 text-xs font-bold mb-6">
                            <span class="w-2 h-2 rounded-full bg-[#569118]"></span>
                            <span>MANGO.MOOOO • MILK, MANGO & JELLY</span>
                        </div>

                        <h1 class="font-display text-4xl sm:text-5xl lg:text-[54px] font-bold tracking-tight text-stone-950 leading-[1.1]">
                            Segarnya Mangga Asli, <span class="italic font-semibold text-[#FB6C00]">Creamy-nya Susu</span> dalam Setiap Tegukan!
                        </h1>

                        <p class="mt-6 text-base text-stone-600 leading-relaxed">
                            Nikmati perpaduan buah mangga asli, susu creamy, jelly kenyal, dan chia seed dalam satu botol. <strong class="text-stone-900 font-semibold">Mango Jelly Milk</strong> dari <strong class="text-[#FB6C00] font-semibold">mango.moooo</strong> hadir sebagai minuman dessert yang menyegarkan, lezat, dan cocok menemani aktivitasmu setiap hari.
                        </p>
                        <p class="mt-3 text-sm text-stone-600 leading-relaxed bg-[#FFDD9C]/35 border-l-4 border-[#569118] p-3.5 rounded-r-xl">
                            Dibuat dari bahan berkualitas dan disajikan dalam kondisi dingin untuk memberikan kesegaran maksimal, terutama di tengah cuaca panas Kota Makassar.
                        </p>
                    </div>

                    <!-- CTA & Harga Cepat -->
                    <div class="mt-8 pt-8 border-t border-stone-900/10 flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                        <div class="flex flex-wrap items-center gap-3">
                            <a
                                href="#katalog"
                                class="inline-flex items-center justify-center px-7 py-4 rounded-2xl bg-[#FB6C00] hover:bg-stone-900 text-white text-sm font-bold transition-colors"
                            >
                                Pesan Sekarang — Rp15.000
                            </a>
                            <a
                                href="#komposisi"
                                class="inline-flex items-center justify-center px-6 py-4 rounded-2xl bg-[#FFDD9C]/50 hover:bg-[#FFDD9C] text-stone-900 text-sm font-bold transition-colors"
                            >
                                Lihat Komposisi
                            </a>
                        </div>

                        <div class="flex items-center gap-5">
                            <div>
                                <span class="block font-display text-2xl font-bold text-[#569118]">250 ml</span>
                                <span class="text-xs text-stone-500">Kemasan Botol</span>
                            </div>
                            <div class="h-8 w-px bg-stone-900/10"></div>
                            <div>
                                <span class="block font-display text-2xl font-bold text-[#FB6C00]">Rp25rb</span>
                                <span class="text-xs text-stone-500">Bundling 2 Botol</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Kolom Kanan (5 Kolom): Showcase Logo & Visualisasi Botol -->
                <div class="lg:col-span-5 rounded-3xl bg-[#FFDD9C]/50 border border-[#F9B637] p-7 sm:p-8 flex flex-col justify-between">

                    <div class="flex items-center justify-between">
                        <span class="text-xs font-mono uppercase tracking-widest text-stone-700 font-bold">MANGO.MOOOO // 250ML</span>
                        <span class="px-3 py-1 rounded-full bg-[#569118] text-white text-xs font-bold">Dingin Menyegarkan</span>
                    </div>

                    <!-- Gambar Logo / Produk Utama (Proporsional Landscape) -->
                    <div class="my-6 flex flex-col items-center">
                        <div class="w-full aspect-4/3 rounded-3xl bg-white p-5 border-2 border-[#FB6C00]/30 shadow-sm flex items-center justify-center overflow-hidden">
                            <img
                                src="logo.png?v=2"
                                alt="mango.moooo — Milk, Mango & Jelly"
                                class="w-full h-full object-contain"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                            >
                            <!-- Fallback Visual jika logo.png belum ditaruh di folder public -->
                            <div style="display:none;" class="w-full h-full rounded-2xl bg-gradient-to-b from-[#FFDD9C] via-[#F9B637] to-[#FB6C00] flex-col items-center justify-center text-center p-4">
                                <span class="font-display text-3xl font-bold text-white drop-shadow">mango.moooo</span>
                                <span class="text-xs font-bold text-stone-900 mt-2 bg-white/90 px-3.5 py-1 rounded-full">Milk, Mango & Jelly • 250ml</span>
                            </div>
                        </div>

                        <!-- 3 Badge Keunggulan -->
                        <div class="mt-5 grid grid-cols-3 gap-2 w-full">
                            <div class="bg-white/90 border border-stone-900/10 rounded-xl p-2.5 text-center">
                                <span class="block text-[11px] font-bold text-[#569118]">Bahan</span>
                                <span class="block text-[10px] text-stone-600">Berkualitas</span>
                            </div>
                            <div class="bg-white/90 border border-stone-900/10 rounded-xl p-2.5 text-center">
                                <span class="block text-[11px] font-bold text-[#FB6C00]">Dingin</span>
                                <span class="block text-[10px] text-stone-600">Menyegarkan</span>
                            </div>
                            <div class="bg-white/90 border border-stone-900/10 rounded-xl p-2.5 text-center">
                                <span class="block text-[11px] font-bold text-stone-900">Enak &</span>
                                <span class="block text-[10px] text-stone-600">Creamy</span>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Add di Hero -->
                    <div class="bg-white rounded-2xl p-4 border border-stone-900/10 flex items-center justify-between gap-3">
                        <div>
                            <p class="text-xs font-bold text-stone-900">Promo Bundling 2 Botol</p>
                            <p class="text-[11px] text-[#569118] font-semibold">Cuman Rp25.000 (Hemat Rp5.000)</p>
                        </div>
                        <button
                            @click="addToCart({ id: 'mjm-bundling', name: 'Promo Bundling (2 Botol Mango Jelly Milk)', price: 25000 })"
                            class="px-4 py-2.5 rounded-xl bg-[#FB6C00] hover:bg-stone-900 text-white text-xs font-bold transition-colors shrink-0 cursor-pointer"
                        >
                            + Ambil Promo
                        </button>
                    </div>
                </div>

            </div>
        </section>

        <!-- BAGIAN 2: KOMPOSISI PRODUK -->
        <section id="komposisi" class="py-20 border-t border-stone-900/10 bg-[#FFDD9C]/25">
            <div class="max-w-7xl mx-auto px-4 sm:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end mb-12">
                    <div class="lg:col-span-6">
                        <span class="text-xs font-mono uppercase tracking-widest text-[#569118] font-bold">01 // KOMPOSISI PRODUK</span>
                        <h2 class="font-display text-3xl sm:text-4xl font-bold text-stone-950 mt-2">
                            Tiga Perpaduan Rasa, Satu Kesegaran Istimewa.
                        </h2>
                    </div>
                    <div class="lg:col-span-6">
                        <p class="text-sm sm:text-base text-stone-600 leading-relaxed">
                            Mango Jelly Milk diracik dengan perpaduan bahan pilihan yang menghasilkan cita rasa manis, creamy, dan tekstur yang menyenangkan. Setiap bahan memberikan karakter tersendiri untuk menciptakan minuman yang nikmat dan menyegarkan.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($compositions as $item)
                    <div class="rounded-3xl {{ $item['bg'] }} border border-stone-900/10 p-8 flex flex-col justify-between hover:border-stone-900/40 transition-all">
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <span class="text-xs font-mono uppercase tracking-wider text-stone-500 font-semibold">{{ $item['step'] }}</span>
                                <span
                                    class="px-3 py-1 rounded-full text-white text-[11px] font-bold"
                                    style="background-color: {{ $item['color'] }}"
                                >
                                    {{ $item['badge'] }}
                                </span>
                            </div>
                            <h3 class="font-display text-2xl font-bold text-stone-900 mb-3">{{ $item['title'] }}</h3>
                            <p class="text-sm text-stone-600 leading-relaxed">{{ $item['detail'] }}</p>
                        </div>
                        <div class="mt-8 pt-4 border-t border-stone-900/10 flex items-center justify-between text-xs font-bold text-[#569118]">
                            <span>mango.moooo Standard</span>
                            <span>✓ Pilihan Terbaik</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- BAGIAN 3: KATALOG & PROMO BUNDLING -->
        <section id="katalog" class="py-20 border-t border-stone-900/10 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-8">
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6">
                    <div>
                        <span class="text-xs font-mono uppercase tracking-widest text-[#FB6C00] font-bold">02 // KATALOG HARGA</span>
                        <h2 class="font-display text-3xl sm:text-4xl font-bold text-stone-950 mt-2">
                            Pilih Paket Kesegaranmu.
                        </h2>
                    </div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#569118]/10 text-[#569118] text-xs font-bold">
                        <span>Disajikan dingin langsung dari chiller • Ukuran 250 ml</span>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    @foreach($products as $product)
                    <div class="rounded-3xl border-2 {{ $product['is_promo'] ? 'border-[#FB6C00] bg-[#FFDD9C]/35' : 'border-stone-900/10 bg-white' }} p-8 sm:p-10 flex flex-col justify-between relative">
                        <div>
                            <div class="flex items-center justify-between gap-2 mb-6">
                                <span class="text-xs font-mono font-bold text-stone-500">PAKET {{ $product['code'] }}</span>
                                <span class="px-3.5 py-1 rounded-full {{ $product['is_promo'] ? 'bg-[#FB6C00] text-white' : 'bg-[#569118] text-white' }} text-xs font-bold">
                                    {{ $product['tag'] }}
                                </span>
                            </div>

                            <h3 class="font-display text-3xl font-bold text-stone-950">{{ $product['name'] }}</h3>
                            <p class="text-xs font-bold uppercase tracking-wider text-[#569118] mt-1.5">{{ $product['size'] }}</p>

                            <p class="mt-4 text-sm sm:text-base text-stone-600 leading-relaxed">
                                {{ $product['desc'] }}
                            </p>

                            <div class="mt-6 inline-flex items-center gap-2 px-3.5 py-1.5 rounded-xl bg-white border border-stone-900/10 text-xs font-semibold text-stone-700">
                                <span class="text-[#FB6C00]">★</span>
                                <span>{{ $product['highlight'] }}</span>
                            </div>
                        </div>

                        <div class="mt-8 pt-6 border-t border-stone-900/10 flex flex-wrap items-center justify-between gap-4">
                            <div>
                                <span class="block text-xs text-stone-500">Harga</span>
                                <div class="flex items-baseline gap-2.5">
                                    <span class="font-display text-3xl sm:text-4xl font-bold text-stone-950">
                                        Rp{{ number_format($product['price'], 0, ',', '.') }}
                                    </span>
                                    @if($product['normal_price'])
                                    <span class="text-sm text-stone-400 line-through font-semibold">
                                        Rp{{ number_format($product['normal_price'], 0, ',', '.') }}
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <button
                                @click="addToCart({ id: '{{ $product['id'] }}', name: '{{ $product['name'] }}', price: {{ $product['price'] }} })"
                                class="px-6 py-4 rounded-2xl {{ $product['is_promo'] ? 'bg-[#FB6C00] hover:bg-stone-900' : 'bg-[#569118] hover:bg-stone-900' }} text-white text-xs font-bold uppercase tracking-wider transition-colors cursor-pointer"
                            >
                                + Tambah ke Pesanan
                            </button>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- BAGIAN 4: PROSES PRODUKSI (PRODUCTION PROCESS) -->
        <section id="produksi" class="py-20 border-t border-stone-900/10 bg-stone-950 text-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-end mb-14">
                    <div class="lg:col-span-6">
                        <span class="text-xs font-mono uppercase tracking-widest text-[#F9B637] font-bold">03 // PRODUCTION PROCESS</span>
                        <h2 class="font-display text-3xl sm:text-4xl font-bold text-white mt-2 leading-tight">
                            Dibuat dengan Bahan Pilihan, Diproses dengan Sepenuh Hati.
                        </h2>
                    </div>
                    <div class="lg:col-span-6">
                        <p class="text-sm sm:text-base text-stone-300 leading-relaxed">
                            Kami mengutamakan kualitas bahan dan kebersihan dalam setiap proses pembuatan Mango Jelly Milk. Produksi dilakukan secara fresh setiap hari untuk menjaga kualitas rasa dan kesegaran produk sebelum sampai ke tangan pelanggan.
                        </p>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($processes as $proc)
                    <div class="rounded-3xl bg-white/5 border border-white/10 p-7 flex flex-col justify-between hover:border-[#F9B637]/60 transition-colors">
                        <div>
                            <div class="flex items-center justify-between mb-6">
                                <span class="px-3 py-1 rounded-lg bg-[#FB6C00] text-white text-xs font-mono font-bold">
                                    TAHAP {{ $proc['no'] }}
                                </span>
                                <span class="w-2.5 h-2.5 rounded-full bg-[#569118]"></span>
                            </div>
                            <h3 class="font-display text-xl font-bold text-[#FFDD9C] mb-3">
                                {{ $proc['title'] }}
                            </h3>
                            <p class="text-xs sm:text-sm text-stone-300 leading-relaxed">
                                {{ $proc['desc'] }}
                            </p>
                        </div>
                        <div class="mt-6 pt-4 border-t border-white/10 text-[11px] font-mono text-[#F9B637]">
                            HIGIENIS & FRESH DAILY
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- BAGIAN 5: KEUNGGULAN PRODUK (WHY CHOOSE US?) -->
        <section id="keunggulan" class="py-20 border-t border-stone-900/10 bg-[#FFDD9C]/20">
            <div class="max-w-7xl mx-auto px-4 sm:px-8">
                <div class="max-w-2xl mb-12">
                    <span class="text-xs font-mono uppercase tracking-widest text-[#569118] font-bold">04 // WHY CHOOSE US?</span>
                    <h2 class="font-display text-3xl sm:text-4xl font-bold text-stone-950 mt-2">
                        Kenapa Harus Mango Jelly Milk?
                    </h2>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($advantages as $adv)
                    <div class="rounded-2xl bg-white border border-stone-900/10 {{ $adv['accent'] }} p-6 shadow-2xs hover:shadow-md transition-shadow">
                        <h3 class="font-display text-xl font-bold text-stone-900">
                            {{ $adv['title'] }}
                        </h3>
                        <p class="mt-2 text-sm text-stone-600 leading-relaxed">
                            {{ $adv['desc'] }}
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <!-- BAGIAN 6: PEMESANAN (ORDER & CONTACT) -->
        <section id="kontak" class="py-20 border-t border-stone-900/10 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-8">
                <div class="rounded-3xl bg-[#FFDD9C]/50 border-2 border-[#F9B637] p-8 sm:p-12">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">

                        <div class="lg:col-span-7">
                            <span class="inline-block px-3 py-1 rounded-full bg-[#569118] text-white text-xs font-bold uppercase tracking-wider mb-4">
                                Order & Contact
                            </span>
                            <h2 class="font-display text-3xl sm:text-4xl font-bold text-stone-950">
                                Yuk, Nikmati Kesegaran Mango Jelly Milk!
                            </h2>
                            <p class="mt-4 text-sm sm:text-base text-stone-700 leading-relaxed">
                                Jangan lewatkan kesegaran Mango Jelly Milk dari <strong>mango.moooo</strong>! Nikmati perpaduan mangga asli, susu creamy, jelly, dan chia seed yang cocok menemani aktivitasmu. Pesan sekarang dan rasakan kesegarannya bersama teman maupun keluarga.
                            </p>

                            <div class="mt-8 flex flex-wrap gap-3">
                                <button
                                    @click="cartOpen = true"
                                    class="px-7 py-4 rounded-2xl bg-[#FB6C00] hover:bg-stone-900 text-white text-xs font-bold uppercase tracking-wider transition-colors cursor-pointer"
                                >
                                    Pesan Lewat Keranjang Web
                                </button>
                                <a
                                    href="https://instagram.com/mango.moooo"
                                    target="_blank"
                                    class="px-7 py-4 rounded-2xl bg-white hover:bg-stone-900 hover:text-white text-stone-900 border border-stone-900/15 text-xs font-bold uppercase tracking-wider transition-colors"
                                >
                                    DM Instagram @mango.moooo
                                </a>
                            </div>
                        </div>

                        <!-- Kartu Informasi Kontak -->
                        <div class="lg:col-span-5 bg-white rounded-2xl border border-stone-900/10 p-6 sm:p-8 space-y-5">
                            <h3 class="font-display text-xl font-bold text-stone-900 border-b border-stone-100 pb-3">
                                Informasi Usaha
                            </h3>

                            <div>
                                <span class="block text-[11px] font-bold uppercase tracking-wider text-stone-400">Nama Usaha</span>
                                <span class="text-base font-bold text-stone-900">mango.moooo</span>
                            </div>

                            <div>
                                <span class="block text-[11px] font-bold uppercase tracking-wider text-stone-400">Lokasi</span>
                                <span class="text-base font-bold text-[#569118]">Makassar, Sulawesi Selatan</span>
                            </div>

                            <div>
                                <span class="block text-[11px] font-bold uppercase tracking-wider text-stone-400">Instagram Resmi</span>
                                <a href="https://instagram.com/mango.moooo" target="_blank" class="text-base font-bold text-[#FB6C00] hover:underline">
                                    @mango.moooo
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- FOOTER -->
    <footer class="bg-stone-950 text-white border-t border-stone-800 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-8 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6">
            <div>
                <span class="font-display text-xl font-bold text-[#FFDD9C]">mango.moooo</span>
                <p class="text-xs text-stone-400 mt-1">Milk, Mango & Jelly • Makassar, Sulawesi Selatan • Instagram: @mango.moooo</p>
            </div>
            <div class="flex flex-wrap gap-6 text-xs text-stone-400">
                <a href="#komposisi" class="hover:text-[#F9B637]">Komposisi</a>
                <a href="#katalog" class="hover:text-[#F9B637]">Katalog</a>
                <a href="#produksi" class="hover:text-[#F9B637]">Proses Produksi</a>
                <a href="#keunggulan" class="hover:text-[#F9B637]">Keunggulan</a>
                <a href="#kontak" class="hover:text-[#F9B637]">Pemesanan</a>
            </div>
        </div>
    </footer>

    <!-- SLIDE-OVER CART DRAWER -->
    <div
        x-show="cartOpen"
        x-cloak
        class="fixed inset-0 z-50 flex justify-end"
    >
        <div
            x-show="cartOpen"
            x-transition.opacity
            @click="cartOpen = false"
            class="fixed inset-0 bg-stone-950/40 backdrop-blur-xs"
        ></div>

        <div
            x-show="cartOpen"
            x-transition:enter="transition transform ease-out duration-300"
            x-transition:enter-start="translate-x-full"
            x-transition:enter-end="translate-x-0"
            x-transition:leave="transition transform ease-in duration-200"
            x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full"
            class="relative w-full max-w-md bg-white h-full p-6 sm:p-8 flex flex-col justify-between border-l border-stone-900/10 shadow-2xl"
        >
            <div>
                <div class="flex items-center justify-between pb-5 border-b border-stone-900/10">
                    <div>
                        <h3 class="font-display text-2xl font-bold text-stone-900">Keranjang mango.moooo</h3>
                        <p class="text-xs text-stone-500">Makassar, Sulawesi Selatan</p>
                    </div>
                    <button
                        @click="cartOpen = false"
                        class="px-3 py-1.5 rounded-lg border border-stone-200 text-xs font-bold hover:bg-stone-100 cursor-pointer"
                    >
                        Tutup ✕
                    </button>
                </div>

                <div class="mt-6 space-y-4 max-h-[55vh] overflow-y-auto pr-1">
                    <template x-if="cart.length === 0">
                        <div class="py-12 text-center rounded-2xl bg-[#FFDD9C]/25 border border-dashed border-[#F9B637]">
                            <p class="text-sm font-bold text-stone-700">Keranjang masih kosong</p>
                            <p class="text-xs text-stone-500 mt-1">Pilih Mango Jelly Milk Rp15.000 atau Bundling Rp25.000.</p>
                        </div>
                    </template>

                    <template x-for="(item, index) in cart" :key="item.id">
                        <div class="p-4 rounded-2xl border border-stone-900/10 bg-stone-50 flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-bold text-stone-900" x-text="item.name"></p>
                                <p class="text-xs text-[#FB6C00] font-bold mt-0.5" x-text="formatRupiah(item.price * item.qty)"></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <button @click="decreaseQty(index)" class="w-7 h-7 rounded-lg bg-white border border-stone-300 text-xs font-bold cursor-pointer">-</button>
                                <span class="text-xs font-bold w-5 text-center" x-text="item.qty"></span>
                                <button @click="increaseQty(index)" class="w-7 h-7 rounded-lg bg-white border border-stone-300 text-xs font-bold cursor-pointer">+</button>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="pt-5 border-t border-stone-900/10">
                <div class="flex items-center justify-between mb-4">
                    <span class="text-xs uppercase tracking-wider text-stone-500 font-bold">Total Pembayaran</span>
                    <span class="font-display text-2xl font-bold text-stone-900" x-text="formatRupiah(cartTotal())"></span>
                </div>
                <button
                    @click="checkoutWhatsApp()"
                    :disabled="cart.length === 0"
                    :class="cart.length === 0 ? 'opacity-40 cursor-not-allowed bg-stone-400' : 'bg-[#569118] hover:bg-stone-900 cursor-pointer'"
                    class="w-full py-4 rounded-2xl text-white text-xs font-bold uppercase tracking-wider transition-colors"
                >
                    Pesan Sekarang via WhatsApp →
                </button>
            </div>
        </div>
    </div>

    <!-- ALPINE.JS STORE -->
    <script>
        function mangoStore() {
            return {
                menuOpen: false,
                cartOpen: false,
                cart: [
                    { id: 'mjm-single', name: 'Mango Jelly Milk (250 ml)', price: 15000, qty: 1 }
                ],
                addToCart(product) {
                    const existing = this.cart.find(item => item.id === product.id);
                    if (existing) {
                        existing.qty++;
                    } else {
                        this.cart.push({ ...product, qty: 1 });
                    }
                    this.cartOpen = true;
                },
                increaseQty(index) {
                    this.cart[index].qty++;
                },
                decreaseQty(index) {
                    if (this.cart[index].qty > 1) {
                        this.cart[index].qty--;
                    } else {
                        this.cart.splice(index, 1);
                    }
                },
                cartCount() {
                    return this.cart.reduce((sum, item) => sum + item.qty, 0);
                },
                cartTotal() {
                    return this.cart.reduce((sum, item) => sum + (item.price * item.qty), 0);
                },
                formatRupiah(number) {
                    return 'Rp' + number.toLocaleString('id-ID');
                },
                checkoutWhatsApp() {
                    if (this.cart.length === 0) return;
                    let lines = ['Halo mango.moooo Makassar! Saya ingin memesan:'];
                    this.cart.forEach(item => {
                        lines.push(`- ${item.qty}x ${item.name} (${this.formatRupiah(item.price * item.qty)})`);
                    });
                    lines.push(`\nTotal: ${this.formatRupiah(this.cartTotal())}`);

                    const url = `https://wa.me/6281234567890?text=${encodeURIComponent(lines.join('\n'))}`;
                    window.open(url, '_blank');
                }
            }
        }
    </script>
</body>
</html>
