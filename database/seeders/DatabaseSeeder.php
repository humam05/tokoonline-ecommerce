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
            ['name' => 'Laptop Gaming', 'description' => 'Laptop dengan spesifikasi tinggi untuk gaming dan pekerjaan berat. Dilengkapi prosesor terbaru dan GPU dedicated.', 'price' => 15000000, 'stock' => 10, 'category_id' => 1, 'image' => 'https://images.unsplash.com/photo-1603302576837-37561b5e8e0a?w=400&h=300&fit=crop'],
            ['name' => 'Smartphone Android', 'description' => 'Smartphone dengan layar AMOLED dan kamera 108MP. Baterai tahan lama dengan fast charging.', 'price' => 5000000, 'stock' => 25, 'category_id' => 1, 'image' => 'https://images.unsplash.com/photo-1598327105666-5b89351aff97?w=400&h=300&fit=crop'],
            ['name' => 'Headphone Bluetooth', 'description' => 'Headphone nirkabel dengan noise cancellation aktif. Nyaman dipakai seharian.', 'price' => 750000, 'stock' => 50, 'category_id' => 3, 'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=400&h=300&fit=crop'],
            ['name' => 'Mouse Wireless', 'description' => 'Mouse ergonomis dengan baterai tahan lama hingga 6 bulan. Sensor presisi tinggi.', 'price' => 250000, 'stock' => 100, 'category_id' => 2, 'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=400&h=300&fit=crop'],
            ['name' => 'Keyboard Mechanical', 'description' => 'Keyboard mechanical RGB dengan switch blue. Backlight customizable.', 'price' => 450000, 'stock' => 75, 'category_id' => 5, 'image' => 'https://images.unsplash.com/photo-1587829741301-dc798b83add3?w=400&h=300&fit=crop'],
            ['name' => 'Monitor 27 Inch', 'description' => 'Monitor IPS 4K UHD dengan refresh rate 144Hz. Cocok untuk gaming dan desain.', 'price' => 4500000, 'stock' => 15, 'category_id' => 1, 'image' => 'https://images.unsplash.com/photo-1527443225154-c4b0a440c12d?w=400&h=300&fit=crop'],
            ['name' => 'Tablet Android', 'description' => 'Tablet untuk produktivitas dan hiburan. Layar 11 inch dengan stylus support.', 'price' => 3500000, 'stock' => 20, 'category_id' => 1, 'image' => 'https://images.unsplash.com/photo-1561154464-82e9adf32764?w=400&h=300&fit=crop'],
            ['name' => 'Smartwatch', 'description' => 'Jam tangan pintar dengan fitur kesehatan lengkap. GPS, heart rate, dan sleep tracking.', 'price' => 1500000, 'stock' => 30, 'category_id' => 2, 'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=400&h=300&fit=crop'],
            ['name' => 'Kamera Mirrorless', 'description' => 'Kamera mirrorless dengan sensor full-frame 24MP. Mendukung video 4K 60fps.', 'price' => 12000000, 'stock' => 5, 'category_id' => 1, 'image' => 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=400&h=300&fit=crop'],
            ['name' => 'Speaker Portable', 'description' => 'Speaker Bluetooth portabel dengan bass kuat. IPX7 water resistant.', 'price' => 500000, 'stock' => 40, 'category_id' => 3, 'image' => 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=400&h=300&fit=crop'],
            ['name' => 'USB Flash Drive 64GB', 'description' => 'USB 3.0 dengan kecepatan baca hingga 150MB/s. Desain ringkas.', 'price' => 150000, 'stock' => 200, 'category_id' => 4, 'image' => 'https://images.unsplash.com/photo-1600269452121-4f2416e55c28?w=400&h=300&fit=crop'],
            ['name' => 'External SSD 1TB', 'description' => 'SSD eksternal portabel dengan kecepatan baca 1050MB/s. USB-C.', 'price' => 1800000, 'stock' => 25, 'category_id' => 4, 'image' => 'https://images.unsplash.com/photo-1600269452121-4f2416e55c28?w=400&h=300&fit=crop'],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
