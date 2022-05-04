<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Producto 1',
                'description' => 'desc',
                'price' => '100',
                'tax' => '8',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Producto 2',
                'description' => 'desc',
                'price' => '150',
                'tax' => '15',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Producto 3',
                'description' => 'desc',
                'price' => '243',
                'tax' => '12',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Producto 4',
                'description' => 'desc',
                'price' => '123',
                'tax' => '10',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Producto 5',
                'description' => 'desc',
                'price' => '454',
                'tax' => '5',
            ),
           
        ));

    }
}
