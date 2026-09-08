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
    /** One warm tint per category, used only for the generated placeholder photos. */
    private array $categoryTints = [
        'Electronics' => ['#DDE3E8', '#B7C2CC', '#3F4A54'],
        'Fashion' => ['#EFDFE0', '#D9B8BC', '#5A3A3E'],
        'Home & Living' => ['#E1E7DA', '#BFCDB2', '#3E4A34'],
        'Beauty' => ['#F3E3D9', '#E3BFAA', '#6B4430'],
        'Sports & Outdoors' => ['#E7E2D3', '#C9BE9E', '#4B4530'],
    ];

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
                'description' => 'Considered goods for everyday life — electronics, fashion, and home, chosen for how they hold up.',
            ]
        );

        $catalog = [
            'Electronics' => [
                'Audio' => [
                    ['Aurora Wireless Over-Ear Headphones', 189.00, 149.00, 'Closed-back over-ear headphones tuned for a warm, detailed sound with 40 hours of battery life.', 'Northline Audio'],
                    ['Pulse True Wireless Earbuds', 79.00, null, 'Compact true-wireless earbuds with active noise cancellation and a pocketable charging case.', 'Northline Audio'],
                ],
                'Wearables' => [
                    ['Meridian Smartwatch Series 4', 249.00, 209.00, 'Aluminum-cased smartwatch with continuous heart-rate tracking and a week-long battery.', 'Kestrel Tech'],
                    ['Orbit Fitness Tracker Band', 59.00, null, 'Lightweight fitness band that tracks steps, sleep, and heart rate with a seven-day charge.', 'Kestrel Tech'],
                ],
            ],
            'Fashion' => [
                'Outerwear' => [
                    ['Cascade Wool Overcoat', 329.00, null, 'A double-breasted wool overcoat cut for a clean, structured silhouette in colder months.', 'Fieldstone'],
                    ['Harbor Quilted Field Jacket', 189.00, 149.00, 'Quilted field jacket in water-resistant cotton, lined for the first cold snap.', 'Fieldstone'],
                ],
                'Footwear' => [
                    ['Ridgeline Leather Chelsea Boots', 219.00, null, 'Full-grain leather Chelsea boots with a stacked heel and elastic side panels.', 'Harrow Supply Co.'],
                    ['Drift Canvas Low-Top Sneakers', 89.00, null, 'Minimal canvas low-tops with a cushioned insole, built for daily wear.', 'Amble & Co.'],
                ],
            ],
            'Home & Living' => [
                'Lighting' => [
                    ['Solace Ceramic Table Lamp', 99.00, null, 'Hand-finished ceramic base with a linen shade, casting a soft, warm glow.', 'Amberlight'],
                    ['Halo Arc Floor Lamp', 179.00, 139.00, 'An arched floor lamp in brushed brass, positioned to light a reading chair just right.', 'Amberlight'],
                ],
                'Decor' => [
                    ['Linen Weave Throw Pillow Set', 59.00, null, 'A set of two linen-blend throw pillows in a subtle basket weave.', 'Linen & Loom'],
                    ['Amber Glass Vase Trio', 69.00, null, 'Three hand-blown amber glass vases in graduated sizes.', 'Linen & Loom'],
                ],
            ],
            'Beauty' => [
                'Skincare' => [
                    ['Renew Vitamin C Serum', 48.00, null, 'A brightening serum with 15% vitamin C and ferulic acid, for daily morning use.', 'Verdant Botanics'],
                    ['Velvet Clay Cleansing Balm', 34.00, 27.00, 'A balm-to-oil cleanser that lifts makeup and sunscreen without stripping the skin.', 'Verdant Botanics'],
                ],
                'Fragrance' => [
                    ['Ember & Oak Eau de Parfum', 95.00, null, 'A warm, woody fragrance built around smoked oak, amber, and cedar.', 'Meridian House'],
                ],
            ],
            'Sports & Outdoors' => [
                'Fitness' => [
                    ['Summit Insulated Water Bottle', 32.00, null, 'Double-wall insulated bottle that keeps drinks cold for 24 hours.', 'Trailforge'],
                ],
                'Camping' => [
                    ['Trailhead 30L Daypack', 129.00, 99.00, 'A 30L daypack with a padded hip belt and a dedicated hydration sleeve.', 'Trailforge'],
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

                    $path = $this->makePlaceholderImage($name, $categoryName, $this->categoryTints[$categoryName]);

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
     * Generates a simple, on-brand SVG "product photo" placeholder — no
     * external image service or network dependency — and stores it on the
     * public disk exactly like a real upload would be.
     */
    private function makePlaceholderImage(string $productName, string $categoryName, array $tint): string
    {
        [$light, $mid, $ink] = $tint;
        $lines = $this->wrapLines($productName, 16);
        $lineHeight = 34;
        $startY = 320 - (count($lines) - 1) * ($lineHeight / 2);

        $tspans = '';
        foreach ($lines as $i => $line) {
            $y = $startY + $i * $lineHeight;
            $tspans .= sprintf(
                '<text x="320" y="%d" text-anchor="middle" font-family="Georgia, \'Times New Roman\', serif" font-size="27" font-weight="600" fill="%s">%s</text>',
                $y,
                $ink,
                htmlspecialchars($line, ENT_QUOTES)
            );
        }

        $svg = <<<SVG
<svg viewBox="0 0 640 640" xmlns="http://www.w3.org/2000/svg">
  <defs>
    <linearGradient id="bg" x1="0" y1="0" x2="1" y2="1">
      <stop offset="0%" stop-color="{$light}" />
      <stop offset="100%" stop-color="{$mid}" />
    </linearGradient>
  </defs>
  <rect width="640" height="640" fill="url(#bg)" />
  <rect x="28" y="28" width="584" height="584" fill="none" stroke="{$ink}" stroke-opacity="0.35" stroke-width="1" />
  <text x="320" y="250" text-anchor="middle" font-family="Georgia, serif" font-style="italic" font-size="15" letter-spacing="2" fill="{$ink}" opacity="0.7">{$categoryName}</text>
  {$tspans}
</svg>
SVG;

        $filename = 'product_images/' . Str::slug($productName) . '.svg';
        Storage::disk('public')->put($filename, $svg);

        return $filename;
    }

    /** Naive word-wrap for SVG text, which has no native wrapping. */
    private function wrapLines(string $text, int $maxCharsPerLine): array
    {
        $words = explode(' ', $text);
        $lines = [];
        $current = '';

        foreach ($words as $word) {
            $candidate = trim($current . ' ' . $word);
            if (strlen($candidate) > $maxCharsPerLine && $current !== '') {
                $lines[] = $current;
                $current = $word;
            } else {
                $current = $candidate;
            }
        }
        if ($current !== '') {
            $lines[] = $current;
        }

        return $lines;
    }
}
