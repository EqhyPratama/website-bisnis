<?php
// Data produk & lapisan (sama seperti di routes/web.php)
$products = [
    [
        'id' => 'mjm-250',
        'code' => '01',
        'name' => 'Signature Mango Jelly Milk',
        'size' => '250ml Cold-Pressed Bottle',
        'price' => 22000,
        'tag' => 'Best Seller',
        'desc' => 'Perpaduan susu segar pasteurisasi, potongan konjac jelly mangga kenyal, dan puree mangga Harumanis kental di bagian dasar.',
        'calories' => '210 kcal',
        'ratio' => '45% Milk • 30% Puree • 25% Jelly',
        'bg_accent' => 'bg-[#FFDD9C]/35',
    ],
    [
        'id' => 'mjm-500',
        'code' => '02',
        'name' => 'Double Texture Reserve',
        'size' => '500ml Medium Bottle',
        'price' => 39000,
        'tag' => 'Extra Jelly',
        'desc' => 'Porsi ganda potongan dadu mangga segar dan homemade mango jelly dengan takaran susu creamy yang lebih seimbang.',
        'calories' => '380 kcal',
        'ratio' => '40% Milk • 30% Puree • 30% Jelly',
        'bg_accent' => 'bg-[#F9B637]/20',
    ],
    [
        'id' => 'mjm-1000',
        'code' => '03',
        'name' => 'House Carafe Pack',
        'size' => '1000ml Family Bottle',
        'price' => 72000,
        'tag' => 'Sharing Size',
        'desc' => 'Kemasan literan untuk 4–5 gelas saji. Dikemas rapat untuk menjaga suhu dingin dan tekstur jelly tetap padat di kulkas.',
        'calories' => '740 kcal',
        'ratio' => '45% Milk • 30% Puree • 25% Jelly',
        'bg_accent' => 'bg-[#569118]/10',
    ],
];

$layers = [
    [
        'step' => 'Layer 01 — Top',
        'title' => 'Pasteurized Fresh Milk',
        'detail' => 'Susu sapi segar tanpa tambahan krimer bubuk buatan. Memberikan tekstur ringan yang tidak meninggalkan rasa enek di tenggorokan.',
        'color' => '#FFFFFF',
        'border' => '#569118',
    ],
    [
        'step' => 'Layer 02 — Middle',
        'title' => 'Artisanal Konjac Mango Jelly',
        'detail' => 'Dibuat setiap pagi dengan ekstrak mangga asli dan serat konjac, menghasilkan potongan kenyal yang mudah disedot.',
        'color' => '#F9B637',
        'border' => '#F9B637',
    ],
    [
        'step' => 'Layer 03 — Base',
        'title' => 'Chunky Harumanis Puree',
        'detail' => 'Daging mangga Harumanis matang pohon yang dihaluskan kasar bersama potongan dadu buah asli untuk rasa manis-asam alami.',
        'color' => '#FB6C00',
        'border' => '#FB6C00',
    ],
];

// Baca file Blade utama dari folder resources/views/welcome.blade.php
$blade = file_get_contents(__DIR__ . '/resources/views/welcome.blade.php');

// Ganti direktif @vite dengan Tailwind CDN otomatis agar CSS langsung aktif
$tailwindCdn = '<script src="https://cdn.tailwindcss.com"></script>
<script>
    tailwind.config = {
        theme: {
            extend: {
                fontFamily: {
                    sans: ["Plus Jakarta Sans", "sans-serif"],
                    display: ["Fraunces", "serif"],
                }
            }
        }
    }
</script>';

$blade = preg_replace('/@vite\(.*?\)/', $tailwindCdn, $blade);
$blade = preg_replace('/@foreach\s*\((.*?)\)/', '<?php foreach($1): ?>', $blade);
$blade = str_replace('@endforeach', '<?php endforeach; ?>', $blade);
$blade = preg_replace('/\{\{\s*(.*?)\s*\}\}/', '<?= htmlspecialchars((string)($1), ENT_QUOTES, "UTF-8") ?>', $blade);

eval('?>' . $blade);
