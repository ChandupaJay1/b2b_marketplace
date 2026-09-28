<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\ProductSubcategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductCategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            'Industrial & Other Products' => [
                'Paper & Packaging',
                'Coir & Coconut Products',
                'Animal Feed',
            ],
            'Grains & Oils' => [
                'Edible Oils',
                'Rice & Grains',
                'Flour Products',
            ],
            'Dehydrated & Processed Foods' => [
                'Dehydrated Vegetables & Spices',
                'Dehydrated Spices',
                'Dehydrated Herbal Products',
                'Dehydrated Mushrooms',
            ],
            'Food & Beverages' => [
                'Dairy Products',
                'Beverages & Juices',
            ],
            'Agriculture & Fresh Produce' => [
                'Fresh Fruits',
                'Fresh Mushrooms',
            ],
            'Snacks & Sweets' => [
                'Sweet Bites & Juices',
                'Sweets & Confectionery',
                'Savory Snacks',
                'Noodles & Pasta',
            ],
        ];

        $sortOrder = 1;
        foreach ($categories as $categoryName => $subcategories) {
            $category = ProductCategory::firstOrCreate(
                ['slug' => Str::slug($categoryName)],
                [
                    'name' => $categoryName,
                    'description' => "All items related to {$categoryName}",
                    'is_active' => true,
                    'sort_order' => $sortOrder++
                ]
            );

            $subSortOrder = 1;
            foreach ($subcategories as $subcategoryName) {
                ProductSubcategory::firstOrCreate(
                    [
                        'slug' => Str::slug($subcategoryName),
                        'product_category_id' => $category->id
                    ],
                    [
                        'name' => $subcategoryName,
                        'description' => "Various {$subcategoryName}",
                        'is_active' => true,
                        'sort_order' => $subSortOrder++
                    ]
                );
            }
        }
    }
}
