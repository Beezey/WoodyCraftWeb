<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Catégories de la maquette.
     */
    public const NAMES = [
        'Portables',
        'PC de bureau',
        'Gaming',
        'Mini PC',
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (self::NAMES as $name) {
            Category::firstOrCreate(['name' => $name]);
        }
    }
}
