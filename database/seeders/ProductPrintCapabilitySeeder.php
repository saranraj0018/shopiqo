<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductPrintCapabilitySeeder extends Seeder
{
    /**
     * Assigns sample print capability values to products that don't have any yet.
     * Values must match the checkbox options in the admin product form and the
     * shop page's Print Capability filter (Laser, Screen Print, UV Print, Embroidery).
     */
    public function run(): void
    {
        $samplePrintCapabilities = [
            'Laser',
            'Screen Print',
            'UV Print',
            'Embroidery',
            'Laser,Screen Print',
            'UV Print,Embroidery',
            'Laser,UV Print',
            'Screen Print,Embroidery',
        ];

        Product::whereNull('print_capability')
            ->orWhere('print_capability', '')
            ->get()
            ->each(function (Product $product, $index) use ($samplePrintCapabilities) {
                $product->update([
                    'print_capability' => $samplePrintCapabilities[$index % count($samplePrintCapabilities)],
                ]);
            });
    }
}
