<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'product_code' => 'SKUSKILNP',
                'product_name' => 'So klin Pewangi',
                'price' => '15000',
                'currency' => 'IDR',
                'discount' => '10',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS',
            ],
            [
                'product_code' => 'SKUSKILNP1',
                'product_name' => 'So klin Liquid',
                'price' => '18000',
                'currency' => 'IDR',
                'discount' => '10',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS',
            ],
            [
                'product_code' => 'SKUSKILNP2',
                'product_name' => 'Giv Biru',
                'price' => '11000',
                'currency' => 'IDR',
                'discount' => '10',
                'dimension' => '13 cm x 10 cm',
                'unit' => 'PCS',
            ],
        ];

        foreach ($data as $item) {
            Product::firstOrCreate($item);
        }
    }
}
