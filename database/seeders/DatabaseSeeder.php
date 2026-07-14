<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@tokoonline.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);

        $categories = [
            ['name' => 'Elektronik', 'description' => 'Produk elektronik seperti laptop, smartphone, dan tablet.'],
            ['name' => 'Aksesoris', 'description' => 'Aksesoris pendukung perangkat elektronik.'],
            ['name' => 'Audio', 'description' => 'Headphone, speaker, dan perangkat audio lainnya.'],
            ['name' => 'Penyimpanan', 'description' => 'Flash drive, SSD, dan media penyimpanan.'],
            ['name' => 'Perangkat Gaming', 'description' => 'Perangkat untuk kebutuhan gaming.'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        $products = [
            ['name' => 'Laptop Gaming', 'description' => 'Laptop dengan spesifikasi tinggi untuk gaming dan pekerjaan berat. Dilengkapi prosesor terbaru dan GPU dedicated.', 'price' => 15000000, 'stock' => 10, 'category_id' => 1],
            ['name' => 'Smartphone Android', 'description' => 'Smartphone dengan layar AMOLED dan kamera 108MP. Baterai tahan lama dengan fast charging.', 'price' => 5000000, 'stock' => 25, 'category_id' => 1],
            ['name' => 'Headphone Bluetooth', 'description' => 'Headphone nirkabel dengan noise cancellation aktif. Nyaman dipakai seharian.', 'price' => 750000, 'stock' => 50, 'category_id' => 3],
            ['name' => 'Mouse Wireless', 'description' => 'Mouse ergonomis dengan baterai tahan lama hingga 6 bulan. Sensor presisi tinggi.', 'price' => 250000, 'stock' => 100, 'category_id' => 2],
            ['name' => 'Keyboard Mechanical', 'description' => 'Keyboard mechanical RGB dengan switch blue. Backlight customizable.', 'price' => 450000, 'stock' => 75, 'category_id' => 5],
            ['name' => 'Monitor 27 Inch', 'description' => 'Monitor IPS 4K UHD dengan refresh rate 144Hz. Cocok untuk gaming dan desain.', 'price' => 4500000, 'stock' => 15, 'category_id' => 1],
            ['name' => 'Tablet Android', 'description' => 'Tablet untuk produktivitas dan hiburan. Layar 11 inch dengan stylus support.', 'price' => 3500000, 'stock' => 20, 'category_id' => 1],
            ['name' => 'Smartwatch', 'description' => 'Jam tangan pintar dengan fitur kesehatan lengkap. GPS, heart rate, dan sleep tracking.', 'price' => 1500000, 'stock' => 30, 'category_id' => 2],
            ['name' => 'Kamera Mirrorless', 'description' => 'Kamera mirrorless dengan sensor full-frame 24MP. Mendukung video 4K 60fps.', 'price' => 12000000, 'stock' => 5, 'category_id' => 1],
            ['name' => 'Speaker Portable', 'description' => 'Speaker Bluetooth portabel dengan bass kuat. IPX7 water resistant.', 'price' => 500000, 'stock' => 40, 'category_id' => 3],
            ['name' => 'USB Flash Drive 64GB', 'description' => 'USB 3.0 dengan kecepatan baca hingga 150MB/s. Desain ringkas.', 'price' => 150000, 'stock' => 200, 'category_id' => 4],
            ['name' => 'External SSD 1TB', 'description' => 'SSD eksternal portabel dengan kecepatan baca 1050MB/s. USB-C.', 'price' => 1800000, 'stock' => 25, 'category_id' => 4],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
