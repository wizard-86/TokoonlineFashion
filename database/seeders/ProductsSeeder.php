<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'id' => 1, 'category_id' => 1, 'name' => 'Phantom Sneakers Red', 'price' => 549000,
                'image' => 'sepatu/shoes1.png', 'description' => 'Sneakers premium dengan desain berani perpaduan warna merah dan hitam gelap. Cocok untuk pergerakan urban yang dinamis dan memberikan kenyamanan maksimal sepanjang hari.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 2, 'category_id' => 1, 'name' => 'Street Ranger Gold', 'price' => 999000,
                'image' => 'sepatu/shoes2.png', 'description' => 'Edisi eksklusif Street Ranger dengan aksen emas yang mewah. Dibuat dengan material pilihan untuk menunjang penampilan streetwear premium kamu.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 3, 'category_id' => 1, 'name' => 'Cyber Black', 'price' => 599000,
                'image' => 'sepatu/shoes3.png', 'description' => 'Terinspirasi dari konsep utilitarian masa depan, Cyber Black menawarkan siluet kokoh serba hitam dengan daya tahan tinggi di segala medan kota.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 4, 'category_id' => 1, 'name' => 'Neo Vulcanized White', 'price' => 425000,
                'image' => 'sepatu/shoes4.png', 'description' => 'Sepatu vulkanisir klasik bernuansa putih bersih. Sangat fleksibel dipadukan dengan outfit apa saja, memberikan kesan bersih dan minimalis.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 5, 'category_id' => 2, 'name' => 'Urban Vibe Bloom', 'price' => 265000,
                'image' => 'parfum/perfume1.png', 'description' => 'Aroma segar floral yang dipadukan dengan sedikit sentuhan citrus, memancarkan energi positif dan kesegaran alami sepanjang hari.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 6, 'category_id' => 2, 'name' => 'Urban Vibe Clarity', 'price' => 295000,
                'image' => 'parfum/perfume2.png', 'description' => 'Wewangian clean dan elegan dengan notes ozonic dan white musk. Memberikan impresi profesional, rapi, dan menenang kan.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 7, 'category_id' => 2, 'name' => 'Urban Vibe Noir', 'price' => 195000,
                'image' => 'parfum/perfume3.png', 'description' => 'Aroma misterius dan intens dari perpaduan amber, wood, dan rempah-rempah hangat. Sangat cocok untuk penggunaan malam hari atau acara formal.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 8, 'category_id' => 2, 'name' => 'Urban Vibe Edge', 'price' => 280000,
                'image' => 'parfum/perfume4.png', 'description' => 'Aroma maskulin yang berkarakter kuat dengan sentuhan leather and bergamot. Menegaskan sisi berani dan penuh percaya diri.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 9, 'category_id' => 3, 'name' => 'Gothic Yellow Oversized', 'price' => 189000,
                'image' => 'kaos/t-shirt1.png', 'description' => 'Kaos oversized berbahan katun berat dengan grafis tipografi gothic berwarna kuning menyala. Nyaman dan trendy.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 10, 'category_id' => 3, 'name' => 'Vintage Red', 'price' => 199000,
                'image' => 'kaos/t-shirt2.png', 'description' => 'Kaos bernuansa pudar (washed) merah klasik dengan sentuhan artwork retro yang memberikan vibes lawas yang otentik.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 11, 'category_id' => 3, 'name' => 'Acid Wash Black', 'price' => 185000,
                'image' => 'kaos/t-shirt3.png', 'description' => 'Efek acid wash pudar abu-abu gelap kehitaman yang estetik. Tekstur kainnya sangat lembut dan memberikan karakter streetwear yang kuat.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 12, 'category_id' => 3, 'name' => 'Minimalist Core White', 'price' => 175000,
                'image' => 'kaos/t-shirt4.png', 'description' => 'Kaos putih polos esensial dengan logo kecil Urban Vibe bordir di bagian dada. Pilihan tepat untuk gaya casual harian.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 13, 'category_id' => 4, 'name' => 'Heavyweight Boxy Hoodie', 'price' => 379000,
                'image' => 'hodie/hoodies1.png', 'description' => 'Hoodie berpotongan kotak (boxy) terbuat dari bahan fleece katun tebal yang menjaga kehangatan sekaligus mempertahankan siluet keren saat dipakai.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 14, 'category_id' => 4, 'name' => 'Raw Edge Cropped Sage', 'price' => 365000,
                'image' => 'hodie/hoodies2.png', 'description' => 'Hoodie bersiluet cropped dengan detail potongan raw edge di bagian bawah. Berwarna hijau sage yang sedang tren.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 15, 'category_id' => 4, 'name' => 'Street Graffiti Pullover', 'price' => 395000,
                'image' => 'hodie/hoodies3.png', 'description' => 'Pullover hoodie yang dipenuhi dengan coretan grafis mural jalanan yang ekspresif di bagian lengan dan punggung.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 16, 'category_id' => 4, 'name' => 'Cyber Glitch Full Zipper', 'price' => 410000,
                'image' => 'hodie/hoodies4.png', 'description' => 'Hoodie ritsleting penuh dengan cetakan efek glitch digital yang futuristik. Praktis, nyaman, dan berkarakter.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 17, 'category_id' => 5, 'name' => 'Retro Blue Aesthetic', 'price' => 55000,
                'image' => 'kaoskaki/sock1.png', 'description' => 'Kaos kaki kru rajut tebal dengan aksen garis biru klasik bergaya olahraga tahun 80-an.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 18, 'category_id' => 5, 'name' => 'Retro Light Green Aesthetic', 'price' => 55000,
                'image' => 'kaoskaki/sock2.png', 'description' => 'Sentuhan warna hijau pastel lembut yang memberikan detail warna estetik pada pergelangan kaki kamu.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 19, 'category_id' => 5, 'name' => 'Retro Stripe Aesthetic', 'price' => 45000,
                'image' => 'kaoskaki/sock3.png', 'description' => 'Kaos kaki basic bergaris melingkar yang kasual, sangat pas dikombinasikan dengan celana pendek dan sneakers vulkanisir.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 20, 'category_id' => 5, 'name' => 'Cyber Neon Reflective', 'price' => 59000,
                'image' => 'kaoskaki/sock4.png', 'description' => 'Dilengkapi dengan benang reflektif neon yang dapat memantulkan cahaya saat terpapar lampu di kegelapan malam.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 21, 'category_id' => 6, 'name' => 'Vintage Denim Rebel Jacket', 'price' => 449000,
                'image' => 'jaket/jacket1.png', 'description' => 'Jaket denim tebal dengan efek robekan (distressed) ringan dan pudar warna indigo wash untuk penampilan rebel yang stylish.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 22, 'category_id' => 6, 'name' => 'Technical Waterproof Bomber', 'price' => 415000,
                'image' => 'jaket/jacket2.png', 'description' => 'Jaket bomber fungsional tahan air dan angin. Dilengkapi saku taktis ekstra untuk menyimpan gadget aman dari hujan.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 23, 'category_id' => 6, 'name' => 'Classic Leather Varsity', 'price' => 575000,
                'image' => 'jaket/jacket3.png', 'description' => 'Perpaduan bahan wol premium pada badan dan kulit sintetis berkualitas pada lengan. Menghidupkan kembali gaya kampus klasik Amerika.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 24, 'category_id' => 6, 'name' => 'Minimalist Coach Jacket', 'price' => 349000,
                'image' => 'jaket/jacket4.png', 'description' => 'Jaket berkerah ringan dengan kancing tekan depan dan tali pengencang bawah. Simpel, bersih, mudah dibawa ke mana saja.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 25, 'category_id' => 7, 'name' => 'Urban Cream Distro Cap', 'price' => 125000,
                'image' => 'topi/hat1.png', 'description' => 'Topi baseball berwarna krem netral dengan setelan besi gesper di belakang. Melindungi dari terik matahari dengan santai.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 26, 'category_id' => 7, 'name' => 'Street Reversible Bucket Hat', 'price' => 135000,
                'image' => 'topi/hat2.png', 'description' => 'Topi bucket dua sisi yang unik; satu sisi bermotif grafis ramai, sisi lainnya berwarna hitam polos. Dua gaya dalam satu produk.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 27, 'category_id' => 7, 'name' => 'Premium Knit Beanie Black', 'price' => 99000,
                'image' => 'topi/hat3.png', 'description' => 'Topi kupluk rajut elastis berwarna hitam pekat. Memberikan kenyamanan hangat sekaligus melengkapi gaya streetwear musim dingin.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 28, 'category_id' => 7, 'name' => 'Industrial Typography Snapback', 'price' => 145000,
                'image' => 'topi/hat4.png', 'description' => 'Snapback berlidah datar dengan bordir tipografi industrial yang tebal di bagian depan, memberikan penegasan gaya yang maskulin.',
                'created_at' => '2026-06-11 09:30:56', 'updated_at' => '2026-06-11 09:30:56'
            ],
            [
                'id' => 29, 'category_id' => 8, 'name' => 'Urban Vibe Metro Tote Bag', 'price' => 189000,
                'image' => 'tas/bag1.png', 'description' => 'Tote bag minimalis berwarna hitam dengan kompartemen utama luas dan saku depan beritsleting, cocok untuk aktivitas harian, kerja, maupun kuliah.',
                'created_at' => '2026-06-11 09:44:38', 'updated_at' => '2026-06-11 09:44:38'
            ],
            [
                'id' => 30, 'category_id' => 8, 'name' => 'Urban Vibe Arctic Backpack', 'price' => 249000,
                'image' => 'tas/bag2.png', 'description' => 'Backpack modern berwarna putih dengan desain clean dan kompartemen multifungsi, dilengkapi kantong depan besar serta ruang penyimpanan yang nyaman untuk kebutuhan sehari-hari.',
                'created_at' => '2026-06-11 09:44:38', 'updated_at' => '2026-06-11 09:44:38'
            ],
            [
                'id' => 31, 'category_id' => 8, 'name' => 'Urban Vibe Blush Sling Bag', 'price' => 159000,
                'image' => 'tas/bag3.png', 'description' => 'Tas selempang berwarna pink pastel dengan desain elegan dan ringan, dilengkapi beberapa kantong penyimpanan yang praktis untuk menunjang gaya kasual maupun semi-formal.',
                'created_at' => '2026-06-11 09:44:38', 'updated_at' => '2026-06-11 09:44:38'
            ],
            [
                'id' => 32, 'category_id' => 8, 'name' => 'Urban Vibe Explorer Trek Backpack', 'price' => 329000,
                'image' => 'tas/bag4.png', 'description' => 'Backpack outdoor berwarna cokelat dengan kapasitas besar, dilengkapi tali pengikat eksternal dan banyak kompartemen untuk mendukung kegiatan hiking, traveling, dan petualangan.',
                'created_at' => '2026-06-11 09:44:38', 'updated_at' => '2026-06-11 09:44:38'
            ],
            [
                'id' => 33, 'category_id' => 9, 'name' => 'Urban Vibe Eclipse Auto-Lock Belt', 'price' => 189000,
                'image' => 'sabuk/belt1.png', 'description' => 'Sabuk pria premium dengan sistem auto-lock modern dan buckle metal hitam elegan. Cocok untuk gaya formal maupun kasual dengan tampilan minimalis yang eksklusif.',
                'created_at' => '2026-06-11 09:51:28', 'updated_at' => '2026-06-11 09:51:28'
            ],
            [
                'id' => 34, 'category_id' => 9, 'name' => 'Urban Vibe Heritage Leather Belt', 'price' => 169000,
                'image' => 'sabuk/belt2.png', 'description' => 'Sabuk kulit klasik berwarna coklat dengan buckle metal vintage yang kokoh. Memberikan sentuhan maskulin dan timeless untuk berbagai outfit sehari-hari.',
                'created_at' => '2026-06-11 09:51:28', 'updated_at' => '2026-06-11 09:51:28'
            ],
            [
                'id' => 35, 'category_id' => 9, 'name' => 'Urban Vibe Ivory Signature Belt', 'price' => 179000,
                'image' => 'sabuk/belt3.png', 'description' => 'Sabuk fashion warna ivory dengan desain clean dan detail emboss eksklusif. Pilihan sempurna untuk tampilan modern yang rapi dan berkelas.',
                'created_at' => '2026-06-11 09:51:28', 'updated_at' => '2026-06-11 09:51:28'
            ],
            [
                'id' => 36, 'category_id' => 9, 'name' => 'Urban Vibe Blush Rose Belt', 'price' => 165000,
                'image' => 'sabuk/belt4.png', 'description' => 'Sabuk wanita berwarna pink pastel dengan buckle rose gold elegan. Dirancang untuk melengkapi gaya feminin yang stylish dan anggun.',
                'created_at' => '2026-06-11 09:51:28', 'updated_at' => '2026-06-11 09:51:28'
            ],
            [
                'id' => 37, 'category_id' => 10, 'name' => 'Aurelia Square Neck Puff Dress', 'price' => 425000,
                'image' => 'gaun/dress1.png', 'description' => 'Gaun hitam elegan dengan kerah kotak yang tegas dan lengan puff klasik. Diperindah dengan aksen drapery lipat miring di pinggang yang jatuh anggun, memberikan siluet ramping yang memikat.',
                'created_at' => '2026-06-11 09:56:30', 'updated_at' => '2026-06-11 09:56:30'
            ],
            [
                'id' => 38, 'category_id' => 10, 'name' => 'Seraphina Olive Satin Slip Dress', 'price' => 395000,
                'image' => 'gaun/dress2.png', 'description' => 'Gaun satin premium bernuansa olive green dengan potongan cowl neck yang sensual. Detail tali spageti berpadu dengan aksen drapery asimetris di bagian rok, memancarkan kemewahan yang minimalis.',
                'created_at' => '2026-06-11 09:56:30', 'updated_at' => '2026-06-11 09:56:30'
            ],
            [
                'id' => 39, 'category_id' => 10, 'name' => 'Valerie Crimson Cowl Neck Dress', 'price' => 415000,
                'image' => 'gaun/dress3.png', 'description' => 'Gaun pesta berwarna merah marun pekat dengan kerah model draping lembut dan aksen ring emas mewah pada bagian bahu. Potongan ruffles mengalir di satu sisi rok menciptakan kesan glamor dan dramatis.',
                'created_at' => '2026-06-11 09:56:30', 'updated_at' => '2026-06-11 09:56:30'
            ],
            [
                'id' => 40, 'category_id' => 10, 'name' => 'Evangeline Ivory Pleated Dress', 'price' => 445000,
                'image' => 'gaun/dress4.png', 'description' => 'Gaun bernuansa ivory white yang anggun dengan detail plisket diagonal di bagian dada dan lengan puff yang menawan. Dilengkapi siluet ban pinggang yang mempertegas lekuk tubuh serta potongan rok berlayer.',
                'created_at' => '2026-06-11 09:56:30', 'updated_at' => '2026-06-11 09:56:30'
            ],
            [
                'id' => 41, 'category_id' => 11, 'name' => 'Urban Vibe Midnight Stripe Shirt', 'price' => 185000,
                'image' => 'kemeja/shirt1.png', 'description' => 'Kemeja lengan panjang berwarna hitam pekat dengan motif garis vertikal putih yang presisi. Memberikan kesan kasual yang tajam, modern, dan siluet tubuh yang tampak lebih jenjang.',
                'created_at' => '2026-06-11 09:59:38', 'updated_at' => '2026-06-11 09:59:38'
            ],
            [
                'id' => 42, 'category_id' => 11, 'name' => 'Urban Vibe Espresso Cuban Shirt', 'price' => 195000,
                'image' => 'kemeja/shirt2.png', 'description' => 'Kemeja lengan panjang dengan kerah model Cuban berpotongan santai berwarna cokelat espresso. Dilengkapi motif pinstripe putih dan detail saku minimalis untuk tampilan semi-formal yang tenang.',
                'created_at' => '2026-06-11 09:59:38', 'updated_at' => '2026-06-11 09:59:38'
            ],
            [
                'id' => 43, 'category_id' => 11, 'name' => 'Urban Vibe Ivory Linen Stripe Shirt', 'price' => 185000,
                'image' => 'kemeja/shirt3.png', 'description' => 'Kemeja bergaya kasual dengan warna dasar putih gading (ivory) dan motif garis hitam yang kontras. Desain kerah terbuka memberikan kenyamanan maksimal untuk aktivitas santai sepanjang hari.',
                'created_at' => '2026-06-11 09:59:38', 'updated_at' => '2026-06-11 09:59:38'
            ],
            [
                'id' => 44, 'category_id' => 11, 'name' => 'Urban Vibe Crimson Regal Stripe Shirt', 'price' => 195000,
                'image' => 'kemeja/shirt4.png', 'description' => 'Kemeja lengan panjang berwarna merah marun (crimson) yang berani, dipadukan dengan garis vertikal putih. Sempurna untuk mengekspresikan gaya retro-modern yang penuh percaya diri.',
                'created_at' => '2026-06-11 09:59:38', 'updated_at' => '2026-06-11 09:59:38'
            ]
        ]); //
    }
}
