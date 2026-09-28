<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Categories extracted directly from Information of enterprises for Website.xlsx
        $rawCategories = [
            'Paper products',
            'Vergin coconut oil products',
            'Dehydrated foods (herbal, spices)',
            'Traditional rice',
            'Rice flour products',
            'Coconut husk chips',
            'Dehydrated foods (spices)',
            'Dairy products',
            'Banana fruits',
            'Fruits juice',
            'Coconut shell charcoal',
            'King coconut fruits',
            'Fruits juice, Sweet bites',
            'Sesame sweet bites',
            'Food oil (Sesame, Butter tree, Neem, Mustard)',
            'Dehydrated foods (herbal paroducts)',
            'Cassava chips, Spicy bites',
            'Sweet bites (Ash pumpkin)',
            'Mushroom production Dehydrated foods',
            'Mushroom production',
            'Milk toffee',
            'Passion fruits production',
            'Animal (chicken) feed',
            'Noodles, Pasta, Bites',
            'King coconut fruits, Papaya',
            'Mushroom production/ Banana chips',
            'Fruit drink',
            'Sesami sweets'
        ];

        $sortOrder = 1;

        foreach ($rawCategories as $categoryName) {
            $slug = Str::slug($categoryName);
            
            $category = ProductCategory::firstOrCreate(
                ['slug' => $slug],
                [
                    'name' => $categoryName,
                    'description' => "Products related to {$categoryName}",
                    'is_active' => true,
                    'sort_order' => $sortOrder++
                ]
            );

            // Create a default subcategory for each since the Excel sheet doesn't specify subcategories
            ProductSubcategory::firstOrCreate(
                [
                    'slug' => $slug . '-general',
                    'product_category_id' => $category->id
                ],
                [
                    'name' => 'General ' . $categoryName,
                    'description' => "General {$categoryName}",
                    'is_active' => true,
                    'sort_order' => 1
                ]
            );
        }
    }
}
