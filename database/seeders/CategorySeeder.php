<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $brandCategories = [
            'Fashion', 'Food & Beverage', 'Art & Crafts',
            'Technology', 'Beauty', 'Jewelry',
        ];

        $blogCategories = [
            'Entrepreneurship', 'Zambian Culture', 'Innovation',
            'Sustainability', 'Fashion', 'Success Stories',
        ];

        $eventCategories = [
            'Bootcamp', 'Workshop', 'Networking', 'Showcase', 'Coffee Date',
        ];

        foreach ($brandCategories as $name) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name), 'type' => 'brand'],
                ['name' => $name]
            );
        }

        foreach ($blogCategories as $name) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name) . '-blog', 'type' => 'blog'],
                ['name' => $name]
            );
        }

        foreach ($eventCategories as $name) {
            Category::firstOrCreate(
                ['slug' => Str::slug($name) . '-event', 'type' => 'event'],
                ['name' => $name]
            );
        }
    }
}
