<?php

use Illuminate\Database\Seeder;

use App\Product;
use App\Category;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $makanan = Category::create(['title' => 'Makanan']);

        $makanan->childs()->saveMany([
            new Category(['title' => 'Khas Jogja']),
            new Category(['title' => 'Khas Boyolali']),
            new Category(['title' => 'Khas Salatiga']),
            new Category(['title' => 'Khas Surakarta'])
        ]);

        $minuman = Category::create(['title' => 'Minuman']);
        $minuman->childs()->saveMany([
            new Category(['title' => 'Minuman Khas Jogja']),
            new Category(['title' => 'Minuman Khas Boyolali']),
            new Category(['title' => 'Minuman Khas Surakarta'])
        ]);

        $khas_jogja = Category::where('title', 'Khas Jogja')->first();
        $khas_boyolali = Category::where('title', 'Khas Boyolali')->first();

        $bakpia_pathok_25 = Product::create([
            'name' => 'Bakpia Pathok 25',
            'model' => 'Makanan Khas',
            'photo' => 'bakpia_pathok_25.jpg',
            'weight' => 2 * 1000,
            'price' => 145000]);
        $bakpia_pathok_81 = Product::create([
            'name' => 'Bakpia Pathok 81',
            'model' => 'Makanan Khas',
            'weight' => 1 * 1000,
            'photo' => '154253664809666_5f6039f4-07a0-4022-9982-bf336586a157.jpeg',
            'price' => 30000]);
        $gudeg_yu_djum_besek = Product::create([
            'name' => 'Gudeg yu Djum Besek',
            'model' => 'Makanan Khas',
            'weight' => 1 * 1000,
            'photo' => 'Gudeg-Yu-Djum-Paket-Besek.jpg',
            'price' => 130000]);
        $gudeg_yu_djum_kendil = Product::create([
            'name' => 'Gudeg yu Djum Kendil',
            'model' => 'Makanan Khas',
            'weight' => 2 * 1000,
            'photo' => 'Gudeg-Yu-Djum-Paket-Kendil.jpg',
            'price' => 290000]);
        $coklat_monggo_punakawan = Product::create([
            'name' => 'Coklat Monggo Punakawan',
            'model' => 'Makanan Khas',
            'weight' => 1 * 1000,
            'photo' => 'Souvenier-Box-Punokawan_a-min.png',
            'price' => 90000]);
        $marning =   Product::create([
            'name' => 'Marning Jagung Istimewa Rasa Pedas Manis',
            'model' => 'Makanan Khas',
            'weight' => 1 * 1000,
            'photo' => 'kripik-singkong-marning-jagung-madura-65d62fd3ff84896fd0c833ddabec7fdd.jpg',
            'price' => 12000]);
        $dodol_susu = Product::create([
            'name' => 'Dodol Susu Super Serba Susu Lembang',
            'model' => 'Makanan Khas',
            'weight' => 1 * 1000,
            'photo' => 'e751ec7dfbe6d5311b8498f73b9ec454-33dfda68329158811b3f336ad6796f01.jpg',
            'price' => 15000]);
        $yangko_jogja = Product::create([
            'name' => 'Yangko',
            'model' => 'Makanan Khas',
            'weight' => 1 * 1000,
            'photo' => 'Info-Jogja-Seputar-Panganan-Tradisional-Yang-Mendunia-800x480.jpg',
            'price' => 29000]);
        
        $khas_jogja->products()->saveMany([$bakpia_pathok_25, $bakpia_pathok_81, $gudeg_yu_djum_besek, $gudeg_yu_djum_kendil, $coklat_monggo_punakawan, $yangko_jogja]);   
        $khas_boyolali->products()->saveMany([$marning, $dodol_susu]);

        $minuman_khas_jogja = Category::where('title', 'Minuman Khas Jogja')->first();

        $kopi_jos = Product::create([
            'name' => 'Kopi Jos Rempah',
            'model' => 'Minuman Khas',
            'photo' => '0_481247f3-50f9-4de2-b242-b5616d78effc_734_672.jpg',
            'weight' => 1 * 1000,
            'price' => 120000]);
        $wedang_uwuh = Product::create([
            'name' => 'Wedang Uwuh',
            'model' => 'Minuman Khas',
            'photo' => '38322698_33218068-b004-4392-9d07-d2d138df9f8a_1080_809.png',
            'weight' => 1 * 1000,
            'price' => 3000]);

        $minuman_khas_jogja->products()->saveMany([$kopi_jos, $wedang_uwuh]);
        
        // copy image sample to public directory
        $from = database_path() . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR;
        $to = public_path() . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR;
        File::copy($from . 'bakpia_pathok_25.jpg', $to . 'bakpia_pathok_25.jpg');
        File::copy($from . '154253664809666_5f6039f4-07a0-4022-9982-bf336586a157.jpeg', $to . '154253664809666_5f6039f4-07a0-4022-9982-bf336586a157.jpeg');
        File::copy($from . 'Gudeg-Yu-Djum-Paket-Besek.jpg', $to . 'Gudeg-Yu-Djum-Paket-Besek.jpg');
        File::copy($from . 'Gudeg-Yu-Djum-Paket-Kendil.jpg', $to . 'Gudeg-Yu-Djum-Paket-Kendil.jpg');
        File::copy($from . 'Souvenier-Box-Punokawan_a-min.png', $to . 'Souvenier-Box-Punokawan_a-min.png');
        File::copy($from . 'kripik-singkong-marning-jagung-madura-65d62fd3ff84896fd0c833ddabec7fdd.jpg', $to . 'kripik-singkong-marning-jagung-madura-65d62fd3ff84896fd0c833ddabec7fdd.jpg');
        File::copy($from . 'e751ec7dfbe6d5311b8498f73b9ec454-33dfda68329158811b3f336ad6796f01.jpg', $to . 'e751ec7dfbe6d5311b8498f73b9ec454-33dfda68329158811b3f336ad6796f01.jpg');
        File::copy($from . 'Info-Jogja-Seputar-Panganan-Tradisional-Yang-Mendunia-800x480.jpg', $to . 'Info-Jogja-Seputar-Panganan-Tradisional-Yang-Mendunia-800x480.jpg');
        File::copy($from . '0_481247f3-50f9-4de2-b242-b5616d78effc_734_672.jpg', $to . '0_481247f3-50f9-4de2-b242-b5616d78effc_734_672.jpg');
        File::copy($from . '38322698_33218068-b004-4392-9d07-d2d138df9f8a_1080_809.png', $to . '38322698_33218068-b004-4392-9d07-d2d138df9f8a_1080_809.png');
    }
}
