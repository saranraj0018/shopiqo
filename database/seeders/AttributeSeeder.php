<?php

namespace Database\Seeders;

use App\Models\AttributeType;
use App\Models\VariantAttribute;
use Illuminate\Database\Seeder;

class AttributeSeeder extends Seeder
{
    /**
     * Run the database seeds.
    */
    public function run(): void
    {
        $attributes = [
            [
                'id' => 1,
                'name' => 'color',
                'created_by' => 1
            ],
            [
                'id' => 2,
                'name' => 'size',
                'created_by' => 1
            ]
        ];

        foreach ($attributes as $attribute) {
            $exists = AttributeType::where('name', $attribute['name'])->exists();
            if (!$exists) {
                $att =new AttributeType();
                $att->name = $attribute['name'];
                $att->save();
            }
        }
    }
}
