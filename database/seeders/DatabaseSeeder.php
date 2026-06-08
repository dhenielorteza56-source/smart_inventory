<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name'  => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create categories
        $categories = [
            ['name' => 'Electronics',    'description' => 'Electronic devices and accessories'],
            ['name' => 'Office Supplies', 'description' => 'Stationery and office materials'],
            ['name' => 'Furniture',       'description' => 'Office and home furniture'],
            ['name' => 'Clothing',        'description' => 'Apparel and garments'],
            ['name' => 'Food & Beverage', 'description' => 'Consumable food and drink products'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }

        // Create suppliers
        $suppliers = [
            [
                'name'    => 'TechSource PH',
                'email'   => 'orders@techsource.ph',
                'phone'   => '+63 2 8123 4567',
                'address' => '123 Ayala Ave, Makati City',
            ],
            [
                'name'    => 'Office Depot Manila',
                'email'   => 'supply@officedepot.ph',
                'phone'   => '+63 2 8987 6543',
                'address' => '456 EDSA, Mandaluyong City',
            ],
            [
                'name'    => 'Global Goods Inc.',
                'email'   => 'info@globalgoods.com',
                'phone'   => '+63 32 412 0000',
                'address' => '789 Cebu Business Park, Cebu City',
            ],
        ];

        foreach ($suppliers as $sup) {
            Supplier::create($sup);
        }

        // Create sample products
        $products = [
            [
                'name'        => 'Wireless Keyboard',
                'sku'         => 'ELEC-WKB-001',
                'description' => 'Compact wireless keyboard with USB receiver',
                'quantity'    => 45,
                'price'       => 899.00,
                'category_id' => 1,
                'supplier_id' => 1,
            ],
            [
                'name'        => 'USB-C Hub 7-in-1',
                'sku'         => 'ELEC-HUB-002',
                'description' => '7-port USB-C hub with HDMI and SD card reader',
                'quantity'    => 8,
                'price'       => 1299.00,
                'category_id' => 1,
                'supplier_id' => 1,
            ],
            [
                'name'        => 'Wireless Mouse',
                'sku'         => 'ELEC-WMS-003',
                'description' => 'Ergonomic wireless mouse, 1600 DPI',
                'quantity'    => 0,
                'price'       => 599.00,
                'category_id' => 1,
                'supplier_id' => 1,
            ],
            [
                'name'        => 'A4 Bond Paper (500 sheets)',
                'sku'         => 'OFFC-PPR-001',
                'description' => '80gsm A4 bond paper, 1 ream',
                'quantity'    => 200,
                'price'       => 225.00,
                'category_id' => 2,
                'supplier_id' => 2,
            ],
            [
                'name'        => 'Ballpen Box (Blue)',
                'sku'         => 'OFFC-PEN-002',
                'description' => 'Box of 12 blue ballpens',
                'quantity'    => 5,
                'price'       => 85.00,
                'category_id' => 2,
                'supplier_id' => 2,
            ],
            [
                'name'        => 'Stapler Heavy Duty',
                'sku'         => 'OFFC-STP-003',
                'description' => 'Heavy duty stapler, 50 sheet capacity',
                'quantity'    => 30,
                'price'       => 349.00,
                'category_id' => 2,
                'supplier_id' => 2,
            ],
            [
                'name'        => 'Office Chair Ergonomic',
                'sku'         => 'FURN-CHR-001',
                'description' => 'Adjustable ergonomic office chair with lumbar support',
                'quantity'    => 12,
                'price'       => 5500.00,
                'category_id' => 3,
                'supplier_id' => 3,
            ],
            [
                'name'        => 'Standing Desk 120cm',
                'sku'         => 'FURN-DSK-002',
                'description' => 'Height-adjustable standing desk, 120x60cm',
                'quantity'    => 3,
                'price'       => 12500.00,
                'category_id' => 3,
                'supplier_id' => 3,
            ],
        ];

        foreach ($products as $prod) {
            Product::create($prod);
        }
    }
}
