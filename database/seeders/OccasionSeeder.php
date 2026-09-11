<?php

namespace Database\Seeders;

use App\Models\Occasion;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class OccasionSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $occasions = [
            ['name' => 'Corporate events', 'icon' => 'occasions/corporate-events.svg'],
            ['name' => 'Employee onboarding', 'icon' => 'occasions/employee-onboarding.svg'],
            ['name' => 'Festivals & Diwali gifts', 'icon' => 'occasions/festivals-diwali-gifts.svg'],
            ['name' => 'Client gifts', 'icon' => 'occasions/client-gifts.svg'],
            ['name' => 'Award ceremonies', 'icon' => 'occasions/award-ceremonies.svg'],
            ['name' => 'Trade shows', 'icon' => 'occasions/trade-shows.svg'],
        ];

        foreach ($occasions as $index => $occasion) {
            Occasion::updateOrCreate(
                ['slug' => Str::slug($occasion['name'])],
                [
                    'name' => $occasion['name'],
                    'icon' => $occasion['icon'],
                    'is_active' => true,
                    'sort_order' => $index,
                ]
            );
        }
    }
}
