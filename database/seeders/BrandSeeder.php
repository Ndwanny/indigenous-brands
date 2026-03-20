<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BrandSeeder extends Seeder
{
    private function px(int $id, int $w = 800, int $h = 500): string
    {
        return "https://images.pexels.com/photos/{$id}/pexels-photo-{$id}.jpeg?auto=compress&cs=tinysrgb&w={$w}&h={$h}&fit=crop";
    }

    public function run(): void
    {
        $admin = User::where('email', 'admin@indigenousbrands.zm')->first();
        $cat   = fn($name) => Category::where('name', $name)->where('type', 'brand')->value('id');

        $brands = [
            [
                'name'          => 'Lusaka Threads',
                'tagline'       => 'Wear your culture, own your story',
                'category_id'   => $cat('Fashion'),
                'description'   => 'Lusaka Threads is a proudly Zambian fashion label blending traditional chitenge patterns with contemporary streetwear silhouettes. Founded in 2019 by designer Natasha Mwila, the brand has grown into one of Lusaka\'s most recognisable clothing lines, stocked in boutiques across the city and exported to customers in South Africa, Kenya, and the UK. Every piece is hand-cut and finished locally, supporting a team of over 20 Zambian tailors.',
                'location'      => 'Lusaka, Zambia',
                'logo'          => $this->px(12610340, 400, 400),   // African woman in traditional clothing
                'cover_image'   => $this->px(16863352, 1200, 500),  // Woman in traditional African clothing
                'email'         => 'hello@lusakathreads.zm',
                'phone'         => '+260 97 111 2233',
                'website_url'   => 'https://lusakathreads.zm',
                'instagram_url' => 'https://instagram.com/lusakathreads',
                'is_featured'   => true,
            ],
            [
                'name'          => 'Baobab Kitchen',
                'tagline'       => 'Rooted in Zambian flavour',
                'category_id'   => $cat('Food & Beverage'),
                'description'   => 'Baobab Kitchen is a Lusaka-based food brand celebrating the rich culinary heritage of Zambia. Their product range includes baobab powder, moringa blends, wild honey, and ready-to-cook Zambian spice kits. The brand sources all ingredients directly from small-scale farmers across the Copperbelt and Eastern provinces, ensuring fair pay and traceable supply chains.',
                'location'      => 'Lusaka, Zambia',
                'logo'          => $this->px(6190149, 400, 400),    // Woman carrying bowl of food
                'cover_image'   => $this->px(3771120, 1200, 500),   // Ethnic woman cooking in kitchen
                'email'         => 'orders@baobabkitchen.zm',
                'phone'         => '+260 96 222 4455',
                'website_url'   => 'https://baobabkitchen.zm',
                'instagram_url' => 'https://instagram.com/baobabkitchen',
                'is_featured'   => true,
            ],
            [
                'name'          => 'Copper Art Studio',
                'tagline'       => 'Crafted from the heart of the Copperbelt',
                'category_id'   => $cat('Art & Crafts'),
                'description'   => 'Copper Art Studio is a Ndola-based artisan collective that transforms raw copper and reclaimed materials into stunning sculptures, home décor, and wearable art. Inspired by Zambia\'s rich mining heritage, the studio employs 15 local craftspeople and runs free art programmes for youth in the Copperbelt region. Their pieces have been exhibited at galleries in Johannesburg and Nairobi.',
                'location'      => 'Ndola, Copperbelt',
                'logo'          => $this->px(29630131, 400, 400),   // Artisan crafting traditional African calabash
                'cover_image'   => $this->px(17931802, 1200, 500),  // Street market in African city
                'email'         => 'studio@copperartzm.com',
                'phone'         => '+260 95 333 6677',
                'website_url'   => 'https://copperartzm.com',
                'facebook_url'  => 'https://facebook.com/copperartstudio',
                'is_featured'   => false,
            ],
            [
                'name'          => 'Ngozi Beauty',
                'tagline'       => 'Natural beauty, African roots',
                'category_id'   => $cat('Beauty'),
                'description'   => 'Ngozi Beauty creates all-natural skincare and haircare products formulated specifically for African skin and hair textures. Founded by biochemist Dr. Chanda Phiri, every product is free from harmful chemicals and uses indigenous botanicals like shea, marula oil, and Zambian beeswax. The brand has a loyal following of over 50,000 customers across sub-Saharan Africa.',
                'location'      => 'Lusaka, Zambia',
                'logo'          => $this->px(11440539, 400, 400),   // Portrait of beautiful African woman
                'cover_image'   => $this->px(8689920, 1200, 500),   // Woman with beaded necklace
                'email'         => 'info@ngozibeauty.zm',
                'phone'         => '+260 97 444 8899',
                'website_url'   => 'https://ngozibeauty.zm',
                'instagram_url' => 'https://instagram.com/ngozibeauty',
                'twitter_url'   => 'https://twitter.com/ngozibeauty',
                'is_featured'   => true,
            ],
            [
                'name'          => 'ZedTech Solutions',
                'tagline'       => 'Building Africa\'s digital future',
                'category_id'   => $cat('Technology'),
                'description'   => 'ZedTech Solutions is a homegrown software company building fintech, agritech, and e-commerce tools tailored to the Zambian market. Their flagship product, ZedPay, processes over 2 million mobile transactions monthly and is used by more than 300 small businesses. The company also runs a coding bootcamp that has trained over 400 young Zambians in software development.',
                'location'      => 'Lusaka, Zambia',
                'logo'          => $this->px(5792871, 400, 400),    // Black entrepreneur with laptop
                'cover_image'   => $this->px(30678211, 1200, 500),  // Professional man working on laptop in Lagos
                'email'         => 'hello@zedtech.zm',
                'phone'         => '+260 96 555 0011',
                'website_url'   => 'https://zedtech.zm',
                'twitter_url'   => 'https://twitter.com/zedtechzm',
                'is_featured'   => true,
            ],
            [
                'name'          => 'Chitenge Collective',
                'tagline'       => 'African print, global style',
                'category_id'   => $cat('Fashion'),
                'description'   => 'Chitenge Collective is a fashion cooperative bringing together 12 independent Zambian designers under one brand umbrella. The collective produces limited-edition capsule collections using only locally-sourced chitenge fabric, and donates 10% of all profits to support women\'s tailoring cooperatives in rural Zambia. Their pieces have been featured in Vogue Africa and worn by international celebrities.',
                'location'      => 'Livingstone, Zambia',
                'logo'          => $this->px(33968170, 400, 400),   // Portrait of woman in traditional African attire
                'cover_image'   => $this->px(1625775, 1200, 500),   // Woman wearing red floral headdress
                'email'         => 'collective@chitengezmb.com',
                'phone'         => '+260 97 666 1122',
                'website_url'   => 'https://chitengezmb.com',
                'instagram_url' => 'https://instagram.com/chitengecollective',
                'is_featured'   => false,
            ],
            [
                'name'          => 'Victoria Jewels',
                'tagline'       => 'Inspired by the falls, crafted for life',
                'category_id'   => $cat('Jewelry'),
                'description'   => 'Victoria Jewels handcrafts fine jewellery using ethically sourced Zambian gemstones — including emeralds, amethyst, and malachite — set in sterling silver and recycled gold. Each piece tells a story tied to Zambia\'s natural landscape. Founded by goldsmith Mulenga Kapasa, the brand ships to collectors in 18 countries and has won three Pan-African Design Awards.',
                'location'      => 'Livingstone, Zambia',
                'logo'          => $this->px(2360530, 400, 400),    // Women wearing beaded necklace
                'cover_image'   => $this->px(28521274, 1200, 500),  // Colorful African handmade beaded bracelets
                'email'         => 'gems@victoriajewels.zm',
                'phone'         => '+260 95 777 3344',
                'website_url'   => 'https://victoriajewels.zm',
                'instagram_url' => 'https://instagram.com/victoriajewelszm',
                'is_featured'   => true,
            ],
            [
                'name'          => 'Savanna Brew Co',
                'tagline'       => 'Craft beer born from the wild',
                'category_id'   => $cat('Food & Beverage'),
                'description'   => 'Savanna Brew Co is Zambia\'s first independent craft brewery, producing small-batch ales, lagers, and stouts using local ingredients like baobab fruit, African honey, and sorghum. Based in Lusaka, the taproom has become a landmark for the city\'s creative and entrepreneurial community. The brewery also partners with local farmers to create a fully Zambian supply chain for their ingredients.',
                'location'      => 'Lusaka, Zambia',
                'logo'          => $this->px(4910234, 400, 400),    // Woman cooking in kitchen
                'cover_image'   => $this->px(6097885, 1200, 500),   // Black woman choosing food
                'email'         => 'tap@savannabrewco.zm',
                'phone'         => '+260 96 888 5566',
                'website_url'   => 'https://savannabrewco.zm',
                'facebook_url'  => 'https://facebook.com/savannabrewco',
                'instagram_url' => 'https://instagram.com/savannabrewco',
                'is_featured'   => false,
            ],
        ];

        foreach ($brands as $data) {
            Brand::updateOrCreate(
                ['slug' => Str::slug($data['name'])],
                array_merge($data, [
                    'user_id' => $admin->id,
                    'status'  => 'approved',
                ])
            );
        }
    }
}
