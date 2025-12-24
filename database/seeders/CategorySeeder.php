<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marketplace\Category;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Living Room',
                'slug' => 'living-room',
                'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400',
                'is_active' => true,
            ],
            [
                'name' => 'Bedroom',
                'slug' => 'bedroom',
                'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=400',
                'is_active' => true,
            ],
            [
                'name' => 'Dining Room',
                'slug' => 'dining-room',
                'image' => 'https://images.unsplash.com/photo-1617806118233-18e1de247200?w=400',
                'is_active' => true,
            ],
            [
                'name' => 'Office',
                'slug' => 'office',
                'image' => 'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?w=400',
                'is_active' => true,
            ],
            [
                'name' => 'Outdoor',
                'slug' => 'outdoor',
                'image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=400',
                'is_active' => true,
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
