<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\VendorCategory;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\Vendor;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles — only admin and user (vendors have no login)
        Role::firstOrCreate(['name' => 'admin']);
        Role::firstOrCreate(['name' => 'user']);

        // Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@b2bmarket.com'],
            [
                'name'      => 'Admin',
                'password'  => Hash::make('Admin@1234'),
                'is_active' => true,
            ]
        );
        $admin->assignRole('admin');

        // Demo user
        $user = User::firstOrCreate(
            ['email' => 'user@b2bmarket.com'],
            [
                'name'      => 'Demo User',
                'password'  => Hash::make('User@1234'),
                'is_active' => true,
            ]
        );
        $user->assignRole('user');

        // Vendor Categories
        $vendorCats = [
            ['name' => 'Manufacturing',      'icon' => '🏭'],
            ['name' => 'Agriculture',        'icon' => '🌿'],
            ['name' => 'Textiles & Apparel', 'icon' => '👕'],
            ['name' => 'Electronics',        'icon' => '💻'],
            ['name' => 'Food & Beverages',   'icon' => '🍽️'],
            ['name' => 'Chemicals',          'icon' => '⚗️'],
        ];

        foreach ($vendorCats as $i => $cat) {
            VendorCategory::firstOrCreate(
                ['slug' => Str::slug($cat['name'])],
                array_merge($cat, ['sort_order' => $i + 1, 'is_active' => true])
            );
        }

        // Product Categories with subcategories
        $productCats = [
            'Electronics & Technology' => ['Smartphones', 'Computers', 'Components', 'Accessories'],
            'Agricultural Products'    => ['Fresh Fruits', 'Vegetables', 'Grains', 'Spices'],
            'Textiles & Fabrics'       => ['Woven Fabrics', 'Garments', 'Home Textiles', 'Technical Textiles'],
            'Food & Beverages'         => ['Processed Foods', 'Beverages', 'Snacks', 'Dairy Products'],
            'Industrial Machinery'     => ['CNC Machines', 'Packaging Machines', 'Construction Equipment'],
            'Chemicals & Plastics'     => ['Industrial Chemicals', 'Plastics', 'Rubber Products'],
            'Construction Materials'   => ['Cement', 'Steel', 'Timber', 'Tiles'],
            'Health & Beauty'          => ['Personal Care', 'Cosmetics', 'Pharmaceuticals'],
        ];

        $sortOrder = 1;
        foreach ($productCats as $catName => $subcats) {
            $category = ProductCategory::firstOrCreate(
                ['slug' => Str::slug($catName)],
                ['name' => $catName, 'sort_order' => $sortOrder++, 'is_active' => true]
            );

            foreach ($subcats as $j => $sub) {
                ProductSubcategory::firstOrCreate(
                    ['slug' => Str::slug($sub)],
                    [
                        'product_category_id' => $category->id,
                        'name'                => $sub,
                        'sort_order'          => $j + 1,
                        'is_active'           => true,
                    ]
                );
            }
        }

        // Demo Vendor — admin-managed, no user account needed
        $vendorCat = VendorCategory::where('slug', 'agriculture')->first();

        $vendor = Vendor::firstOrCreate(
            ['slug' => 'ceylon-exports-ltd'],
            [
                'vendor_category_id' => $vendorCat->id,
                'company_name'       => 'Ceylon Exports Ltd.',
                'description'        => 'Premium Sri Lankan exports including spices, tea, and textiles.',
                'email'              => 'info@ceylonexports.com',
                'phone'              => '+94 11 234 5678',
                'address'            => '42 Galle Road',
                'city'               => 'Colombo',
                'country'            => 'Sri Lanka',
                'established_year'   => 1998,
                'status'             => 'approved',
                'is_featured'        => true,
            ]
        );

        // Demo Product
        $agriCat   = ProductCategory::where('slug', 'agricultural-products')->first();
        $spicesSub = ProductSubcategory::where('slug', 'spices')->first();

        Product::firstOrCreate(
            ['slug' => 'ceylon-cinnamon-sticks'],
            [
                'vendor_id'              => $vendor->id,
                'product_category_id'    => $agriCat->id,
                'product_subcategory_id' => $spicesSub->id,
                'name'                   => 'Ceylon Cinnamon Sticks',
                'short_description'      => 'Premium true cinnamon (Cinnamomum verum) sticks from Sri Lanka.',
                'description'            => 'Grade A Ceylon cinnamon, hand-rolled and sun-dried. Available in bulk quantities for international buyers.',
                'sku'                    => 'CIN-001',
                'price'                  => 12.50,
                'min_order_quantity'     => 50,
                'unit'                   => 'kg',
                'origin_country'         => 'Sri Lanka',
                'is_active'              => true,
                'is_featured'            => true,
            ]
        );
    }
}
