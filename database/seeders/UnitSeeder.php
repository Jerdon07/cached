<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    public function run(): void
    {
        $units = [
            ['name' => 'Piece', 'abbreviation' => 'PC'],
            ['name' => 'Box', 'abbreviation' => 'BX'],
            ['name' => 'Each', 'abbreviation' => 'EA'],
            ['name' => 'Pair', 'abbreviation' => 'PR'],
            ['name' => 'Set', 'abbreviation' => 'SET'],
            ['name' => 'Package', 'abbreviation' => 'PK'],
            ['name' => 'Carton', 'abbreviation' => 'CTN'],
            ['name' => 'Case', 'abbreviation' => 'CS'],
            ['name' => 'Dozen', 'abbreviation' => 'DZ'],
            ['name' => 'Bundle', 'abbreviation' => 'BDL'],
            ['name' => 'Roll', 'abbreviation' => 'RL'],
            ['name' => 'Bag', 'abbreviation' => 'BG'],
            ['name' => 'Pallet', 'abbreviation' => 'PLT'],
            ['name' => 'Skid', 'abbreviation' => 'SKD'],
            ['name' => 'Crate', 'abbreviation' => 'CRT'],
            ['name' => 'Container', 'abbreviation' => 'CTR'],
            ['name' => 'Kilogram', 'abbreviation' => 'KG'],
            ['name' => 'Pound', 'abbreviation' => 'LB'],
            ['name' => 'Litter', 'abbreviation' => 'L'],
            ['name' => 'Gallon', 'abbreviation' => 'GAL'],
            ['name' => 'Meter', 'abbreviation' => 'M'],
            ['name' => 'Foot', 'abbreviation' => 'FT'],
        ];

        foreach ($units as $unit) {
            Unit::firstOrCreate($unit);
        }
    }
}
