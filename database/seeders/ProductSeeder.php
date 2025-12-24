<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Marketplace\Product;
use App\Models\Marketplace\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // Living Room Products
            [
                'category_slug' => 'living-room',
                'name' => 'Luxury Velvet Sofa',
                'price' => 85000,
                'stock_quantity' => 10,
                'image' => 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400',
            ],
            [
                'category_slug' => 'living-room',
                'name' => 'Modern Coffee Table',
                'price' => 25000,
                'stock_quantity' => 15,
                'image' => 'https://images.unsplash.com/photo-1533090481720-856c6e3c1fdc?w=400',
            ],
            [
                'category_slug' => 'living-room',
                'name' => 'Accent Armchair',
                'price' => 45000,
                'stock_quantity' => 8,
                'image' => 'https://images.unsplash.com/photo-1506439773649-6e0eb8cfb237?w=400',
            ],
            [
                'category_slug' => 'living-room',
                'name' => 'TV Stand Cabinet',
                'price' => 35000,
                'stock_quantity' => 12,
                'image' => 'https://images.unsplash.com/photo-1588471980726-8346cb477a33?w=400',
            ],
            // Bedroom Products
            [
                'category_slug' => 'bedroom',
                'name' => 'King Size Bed Frame',
                'price' => 95000,
                'stock_quantity' => 5,
                'image' => 'https://images.unsplash.com/photo-1505693416388-ac5ce068fe85?w=400',
            ],
            [
                'category_slug' => 'bedroom',
                'name' => 'Wooden Wardrobe',
                'price' => 75000,
                'stock_quantity' => 7,
                'image' => 'https://images.unsplash.com/photo-1558997519-83ea9252edf8?w=400',
            ],
            [
                'category_slug' => 'bedroom',
                'name' => 'Bedside Table Set',
                'price' => 18000,
                'stock_quantity' => 20,
                'image' => 'https://images.unsplash.com/photo-1532372320572-cda25653a694?w=400',
            ],
            [
                'category_slug' => 'bedroom',
                'name' => 'Dressing Table',
                'price' => 42000,
                'stock_quantity' => 6,
                'image' => 'https://images.unsplash.com/photo-1595526114035-0d45ed16cfbf?w=400',
            ],
            // Dining Room Products
            [
                'category_slug' => 'dining-room',
                'name' => '6-Seater Dining Table',
                'price' => 65000,
                'stock_quantity' => 8,
                'image' => 'https://images.unsplash.com/photo-1617806118233-18e1de247200?w=400',
            ],
            [
                'category_slug' => 'dining-room',
                'name' => 'Dining Chair Set (4)',
                'price' => 32000,
                'stock_quantity' => 15,
                'image' => 'https://images.unsplash.com/photo-1551298370-9d3d53a4f776?w=400',
            ],
            [
                'category_slug' => 'dining-room',
                'name' => 'Buffet Cabinet',
                'price' => 55000,
                'stock_quantity' => 4,
                'image' => 'https://images.unsplash.com/photo-1594026112284-02bb6f3352fe?w=400',
            ],
            // Office Products
            [
                'category_slug' => 'office',
                'name' => 'Executive Office Desk',
                'price' => 48000,
                'stock_quantity' => 10,
                'image' => 'https://images.unsplash.com/photo-1518455027359-f3f8164ba6bd?w=400',
            ],
            [
                'category_slug' => 'office',
                'name' => 'Ergonomic Office Chair',
                'price' => 28000,
                'stock_quantity' => 25,
                'image' => 'https://images.unsplash.com/photo-1580480055273-228ff5388ef8?w=400',
            ],
            [
                'category_slug' => 'office',
                'name' => 'Bookshelf Unit',
                'price' => 22000,
                'stock_quantity' => 18,
                'image' => 'https://images.unsplash.com/photo-1594620302200-9a762244a156?w=400',
            ],
            // Outdoor Products
            [
                'category_slug' => 'outdoor',
                'name' => 'Patio Furniture Set',
                'price' => 78000,
                'stock_quantity' => 6,
                'image' => 'https://images.unsplash.com/photo-1600210492486-724fe5c67fb0?w=400',
            ],
            [
                'category_slug' => 'outdoor',
                'name' => 'Garden Swing Chair',
                'price' => 35000,
                'stock_quantity' => 9,
                'image' => 'https://images.unsplash.com/photo-1595435934249-5df7ed86e1c0?w=400',
            ],
        ];

        foreach ($products as $productData) {
            $category = Category::where('slug', $productData['category_slug'])->first();

            if ($category) {
                Product::create([
                    'category_id' => $category->id,
                    'name' => $productData['name'],
                    'slug' => Str::slug($productData['name']),
                    'price' => $productData['price'],
                    'stock_quantity' => $productData['stock_quantity'],
                    'is_active' => true,
                ]);
            }
        }
    }
}
