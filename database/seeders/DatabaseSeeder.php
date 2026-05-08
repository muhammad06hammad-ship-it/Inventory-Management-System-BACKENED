<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@inventory.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create Staff User
        User::create([
            'name' => 'Staff User',
            'email' => 'staff@inventory.com',
            'password' => Hash::make('staff123'),
            'role' => 'staff',
        ]);

        // Create Categories
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic devices and components'],
            ['name' => 'Furniture', 'description' => 'Office and household furniture'],
            ['name' => 'Stationery', 'description' => 'Office stationery and supplies'],
            ['name' => 'Hardware', 'description' => 'Hardware tools and materials'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }

        // Create Suppliers
        $suppliers = [
            [
                'name' => 'Tech Supplies Inc.',
                'contact_person' => 'John Doe',
                'email' => 'contact@techsupplies.com',
                'phone' => '555-0001',
                'address' => '123 Tech Street, Silicon Valley',
                'status' => 'active',
            ],
            [
                'name' => 'Office Solutions Ltd.',
                'contact_person' => 'Jane Smith',
                'email' => 'info@officesolutions.com',
                'phone' => '555-0002',
                'address' => '456 Business Ave, New York',
                'status' => 'active',
            ],
            [
                'name' => 'Hardware Depot',
                'contact_person' => 'Bob Johnson',
                'email' => 'sales@hardwaredepot.com',
                'phone' => '555-0003',
                'address' => '789 Industrial Way, Chicago',
                'status' => 'active',
            ],
        ];

        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }

        // Create Products
        $products = [
            [
                'sku' => 'PROD-001',
                'name' => 'Laptop Computer',
                'category_id' => 1,
                'unit' => 'pcs',
                'minimum_stock' => 5,
                'quantity_on_hand' => 12,
                'status' => 'active',
                'description' => 'Professional laptop with 16GB RAM',
            ],
            [
                'sku' => 'PROD-002',
                'name' => 'Desktop Monitor',
                'category_id' => 1,
                'unit' => 'pcs',
                'minimum_stock' => 10,
                'quantity_on_hand' => 8,
                'status' => 'active',
                'description' => '27-inch 4K display monitor',
            ],
            [
                'sku' => 'PROD-003',
                'name' => 'Office Chair',
                'category_id' => 2,
                'unit' => 'pcs',
                'minimum_stock' => 3,
                'quantity_on_hand' => 6,
                'status' => 'active',
                'description' => 'Ergonomic office chair with wheels',
            ],
            [
                'sku' => 'PROD-004',
                'name' => 'Desk Lamp',
                'category_id' => 2,
                'unit' => 'pcs',
                'minimum_stock' => 8,
                'quantity_on_hand' => 15,
                'status' => 'active',
                'description' => 'LED desk lamp with adjustable brightness',
            ],
            [
                'sku' => 'PROD-005',
                'name' => 'Printer Paper (Ream)',
                'category_id' => 3,
                'unit' => 'box',
                'minimum_stock' => 20,
                'quantity_on_hand' => 45,
                'status' => 'active',
                'description' => 'A4 printing paper, 500 sheets per ream',
            ],
            [
                'sku' => 'PROD-006',
                'name' => 'Ballpoint Pens (Box)',
                'category_id' => 3,
                'unit' => 'box',
                'minimum_stock' => 10,
                'quantity_on_hand' => 25,
                'status' => 'active',
                'description' => 'Box of 50 ballpoint pens',
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

