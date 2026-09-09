<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EcommerceSeeder extends Seeder
{
    /**
     * Real product photos live in database/seeders/assets/products, named
     * "<product-slug>.jpg" — copied onto the public disk for each product
     * exactly like a real vendor upload would be.
     */
    private string $photoDir;

    public function __construct()
    {
        $this->photoDir = database_path('seeders/assets/products');
    }

    public function run(): void
    {
        $vendor = User::firstOrCreate(
            ['email' => 'vendor@myecom.test'],
            ['name' => 'Amara Okafor', 'password' => bcrypt('password'), 'role' => 1, 'email_verified_at' => now()]
        );

        User::firstOrCreate(
            ['email' => 'admin@myecom.test'],
            ['name' => 'Site Admin', 'password' => bcrypt('password'), 'role' => 0, 'email_verified_at' => now()]
        );

        $store = Store::firstOrCreate(
            ['user_id' => $vendor->id],
            [
                'store_name' => 'Northgate & Co.',
                'slug' => 'northgate-and-co',
                'description' => 'Considered goods for everyday life. Electronics, fashion, and home, chosen for how they hold up.',
            ]
        );

        // [name, regularPrice, discountedPrice, description, brand]
        $catalog = [
            'Electronics' => [
                'Audio' => [
                    ['Wireless Over-Ear Headphones', 129.00, null, 'Cushioned over-ear headphones with a padded headband and deep bass response, built for daily listening.', null],
                    ['True Wireless Earbuds', 59.00, null, 'Compact true-wireless earbuds with a pocketable charging case and touch controls.', null],
                    ['Urbanista Wireless Headphones', 89.00, 69.00, 'Over-ear Bluetooth headphones in a metallic teal finish, tuned for all-day comfort.', 'Urbanista'],
                    ['AXESS 2.1-Channel Bluetooth Home Theater Speaker System', 79.00, null, 'A 2.1-channel Bluetooth speaker system with a powered subwoofer, USB/SD playback, and a full-function remote.', 'AXESS'],
                ],
                'TV & Home Theater' => [
                    ['Sharp 40" QLED HD Smart TV', 329.00, 279.00, 'A 40-inch QLED HD smart TV with built-in streaming apps and vivid color reproduction.', 'Sharp'],
                ],
                'Gaming' => [
                    ['Wireless Pro Game Controller', 74.00, null, 'A wireless game controller with textured grips, dual analog sticks, and a built-in speaker/mic jack.', 'PlayStation'],
                ],
                'Computers' => [
                    ['Ultrabook Laptop 13"', 899.00, 799.00, 'A slim, convertible ultrabook with an aluminum shell, built for work on the move.', 'HP'],
                    ['Wireless Rechargeable Mouse', 19.00, null, 'A slim, noiseless wireless mouse with an RGB glow strip and a rechargeable battery.', null],
                    ['Laptop Charger — 65W Replacement Power Adapter', 24.00, null, 'A 65W replacement power adapter with a compatible barrel cable, sized for compact ultrabooks.', 'HP'],
                ],
            ],
            'Fashion' => [
                'Footwear' => [
                    ["Air Jordan 1 Mid 'Banned'", 175.00, null, "A mid-top basketball sneaker in the classic black, red, and white 'Banned' colorway.", 'Jordan'],
                    ['Converse Chuck Taylor Low-Top Sneakers — Navy', 65.00, null, 'Classic canvas low-top sneakers with a rubber toe cap, in navy.', 'Converse'],
                    ['Converse Chuck Taylor Low-Top Sneakers — Maroon', 65.00, null, 'Classic canvas low-top sneakers with a rubber toe cap, in maroon.', 'Converse'],
                    ['Leather Combat Boots', 220.00, 189.00, 'Chunky-sole leather combat boots with lace-up styling and a durable rubber sole.', 'Dr. Martens'],
                ],
                'Tops' => [
                    ['Black Cotton Button-Up Shirt', 39.00, null, 'A relaxed-fit cotton shirt with a chest pocket, in solid black.', null],
                    ['Classic Denim Shirt — Dark Wash', 45.00, null, 'A long-sleeve denim shirt in a dark indigo wash with a chest pocket.', null],
                    ['Classic Denim Shirt — Light Wash', 45.00, 36.00, 'A long-sleeve denim shirt in a light blue wash with dual chest pockets.', null],
                    ['Oversized Checkered Flannel Shirt', 42.00, null, 'An oversized-fit flannel shirt in a black-and-white check, with a chest pocket.', null],
                ],
                'Accessories' => [
                    ['Classic Baseball Cap', 22.00, null, 'A structured six-panel cotton cap with an adjustable strap.', null],
                    ['Classic Leather Strap Watch', 89.00, null, 'An analog watch with a stainless case, Roman numeral dial, and a genuine leather strap.', null],
                    ['Retro Round Optical Frames', 34.00, null, 'Lightweight round frames in matte black, sized for a comfortable all-day fit.', null],
                ],
            ],
            'Home & Living' => [
                'Appliances' => [
                    ['Retro-Style Top-Freezer Refrigerator', 749.00, 649.00, 'A top-freezer refrigerator with a brushed steel finish and a digital temperature display.', 'Samsung'],
                ],
            ],
            'Pet Supplies' => [
                'Food' => [
                    ['NutriSource Adult Cat Food', 28.00, null, 'A grain-inclusive dry cat food formulated with real meat as the first ingredient.', 'NutriSource'],
                    ['Purina Friskies Seafood Sensations Dry Cat Food, 22lb', 24.00, 19.00, 'A 22lb bag of dry cat food with salmon, tuna, and shrimp flavors.', 'Purina'],
                ],
            ],
        ];

        foreach ($catalog as $categoryName => $subcategories) {
            $category = Category::firstOrCreate(['category_name' => $categoryName]);

            foreach ($subcategories as $subcategoryName => $products) {
                $subcategory = Subcategory::firstOrCreate([
                    'subcategory_name' => $subcategoryName,
                    'category_id' => $category->id,
                ]);

                foreach ($products as [$name, $regularPrice, $discountedPrice, $description, $brand]) {
                    $slug = Str::slug($name);

                    if (Product::where('slug', $slug)->exists()) {
                        continue;
                    }

                    $product = Product::create([
                        'product_name' => $name,
                        'description' => $description,
                        'sku' => strtoupper(Str::random(3)) . '-' . random_int(10000, 99999),
                        'brand' => $brand,
                        'user_id' => $vendor->id,
                        'category_id' => $category->id,
                        'subcategory_id' => $subcategory->id,
                        'store_id' => $store->id,
                        'regular_price' => $regularPrice,
                        'discounted_price' => $discountedPrice,
                        'tax_rate' => 0,
                        'stock_quantity' => random_int(8, 60),
                        'stock_status' => 'In Stock',
                        'slug' => $slug,
                        'visibility' => 1,
                        'status' => 'Published',
                    ]);

                    $path = $this->storeProductPhoto($slug);

                    ProductImage::create([
                        'product_id' => $product->id,
                        'img_path' => $path,
                        'is_primary' => true,
                    ]);
                }
            }
        }
    }

    /**
     * Copies the real product photo bundled at database/seeders/assets/products/{slug}.jpg
     * onto the public disk, exactly where a vendor upload would land.
     */
    private function storeProductPhoto(string $slug): string
    {
        $source = $this->photoDir . '/' . $slug . '.jpg';
        $target = 'product_images/' . $slug . '.jpg';

        Storage::disk('public')->put($target, file_get_contents($source));

        return $target;
    }
}
