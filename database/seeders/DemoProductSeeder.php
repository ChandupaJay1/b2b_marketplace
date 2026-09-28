<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use App\Models\Vendor;
use Illuminate\Support\Str;

class DemoProductSeeder extends Seeder
{
    public function run(): void
    {
        // Fetch Categories & Subcategories
        $dehydratedCat = ProductCategory::where('slug', 'dehydrated-processed-foods')->first();
        $spiceSub = ProductSubcategory::where('product_category_id', $dehydratedCat->id ?? 0)
                                      ->where('slug', 'dehydrated-spices')->first();
                                      
        $foodCat = ProductCategory::where('slug', 'food-beverages')->first();
        $dairySub = ProductSubcategory::where('product_category_id', $foodCat->id ?? 0)
                                      ->where('slug', 'dairy-products')->first();
                                      
        $industrialCat = ProductCategory::where('slug', 'industrial-other-products')->first();
        $paperSub = ProductSubcategory::where('product_category_id', $industrialCat->id ?? 0)
                                      ->where('slug', 'paper-packaging')->first();

        // Fallback to random vendor if no matching vendor is found
        $defaultVendor = Vendor::first();

        // 5 Spices
        $spices = [
            ['name' => 'Premium Ceylon Cinnamon Sticks', 'price' => 15.50, 'unit' => 'kg', 'min_order_quantity' => 10],
            ['name' => 'Organic Black Pepper (Whole)', 'price' => 8.75, 'unit' => 'kg', 'min_order_quantity' => 20],
            ['name' => 'Roasted Curry Powder', 'price' => 6.20, 'unit' => 'kg', 'min_order_quantity' => 50],
            ['name' => 'Dried Turmeric Powder', 'price' => 5.40, 'unit' => 'kg', 'min_order_quantity' => 15],
            ['name' => 'Cardamom Pods (Green)', 'price' => 25.00, 'unit' => 'kg', 'min_order_quantity' => 5],
        ];

        foreach ($spices as $spice) {
            $vendor = Vendor::where('vendor_category_id', $dehydratedCat->id ?? 0)->inRandomOrder()->first() ?? $defaultVendor;
            if (!$vendor || !$dehydratedCat) continue;
            
            Product::create([
                'vendor_id' => $vendor->id,
                'product_category_id' => $dehydratedCat->id,
                'product_subcategory_id' => $spiceSub->id ?? null,
                'name' => $spice['name'],
                'slug' => Str::slug($spice['name'] . '-' . uniqid()),
                'sku' => strtoupper(Str::random(6)),
                'price' => $spice['price'],
                'unit' => $spice['unit'],
                'min_order_quantity' => $spice['min_order_quantity'],
                'short_description' => 'High quality ' . $spice['name'] . ' from Sri Lanka.',
                'description' => 'Premium grade ' . $spice['name'] . ' perfect for international buyers. Sourced directly from local farms.',
                'origin_country' => 'Sri Lanka',
                'is_active' => true,
                'is_featured' => true,
            ]);
        }

        // 3 Dairy Products
        $dairies = [
            ['name' => 'Fresh Buffalo Curd (Set)', 'price' => 2.50, 'unit' => 'liter', 'min_order_quantity' => 100],
            ['name' => 'Full Cream Milk Powder', 'price' => 4.20, 'unit' => 'kg', 'min_order_quantity' => 200],
            ['name' => 'Pure Ghee (Clarified Butter)', 'price' => 9.80, 'unit' => 'liter', 'min_order_quantity' => 50],
        ];

        foreach ($dairies as $dairy) {
            $vendor = Vendor::where('vendor_category_id', $foodCat->id ?? 0)->inRandomOrder()->first() ?? $defaultVendor;
            if (!$vendor || !$foodCat) continue;

            Product::create([
                'vendor_id' => $vendor->id,
                'product_category_id' => $foodCat->id,
                'product_subcategory_id' => $dairySub->id ?? null,
                'name' => $dairy['name'],
                'slug' => Str::slug($dairy['name'] . '-' . uniqid()),
                'sku' => strtoupper(Str::random(6)),
                'price' => $dairy['price'],
                'unit' => $dairy['unit'],
                'min_order_quantity' => $dairy['min_order_quantity'],
                'short_description' => 'High quality ' . $dairy['name'] . ' processed under hygienic conditions.',
                'description' => 'Nutritious and delicious ' . $dairy['name'] . ' suitable for large scale consumption and retail packing.',
                'origin_country' => 'Sri Lanka',
                'is_active' => true,
                'is_featured' => false,
            ]);
        }

        // 2 Paper & Packaging
        $papers = [
            ['name' => 'Eco-friendly Kraft Paper Bags', 'price' => 0.15, 'unit' => 'piece', 'min_order_quantity' => 10000],
            ['name' => 'Corrugated Packaging Boxes', 'price' => 0.45, 'unit' => 'piece', 'min_order_quantity' => 5000],
        ];

        foreach ($papers as $paper) {
            $vendor = Vendor::where('vendor_category_id', $industrialCat->id ?? 0)->inRandomOrder()->first() ?? $defaultVendor;
            if (!$vendor || !$industrialCat) continue;

            Product::create([
                'vendor_id' => $vendor->id,
                'product_category_id' => $industrialCat->id,
                'product_subcategory_id' => $paperSub->id ?? null,
                'name' => $paper['name'],
                'slug' => Str::slug($paper['name'] . '-' . uniqid()),
                'sku' => strtoupper(Str::random(6)),
                'price' => $paper['price'],
                'unit' => $paper['unit'],
                'min_order_quantity' => $paper['min_order_quantity'],
                'short_description' => 'Durable ' . $paper['name'] . ' for various industrial needs.',
                'description' => 'High strength ' . $paper['name'] . ' made from recycled materials. Customizable sizes available upon request.',
                'origin_country' => 'Sri Lanka',
                'is_active' => true,
                'is_featured' => true,
            ]);
        }
    }
}
