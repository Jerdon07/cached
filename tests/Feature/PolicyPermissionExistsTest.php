<?php

use App\Models\Permission;
use Database\Seeders\PermissionSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Symfony\Component\Finder\Finder;
uses(RefreshDatabase::class);

it('every permission checked in a policy is seeded', function () {
    
    /** @var \Illuminate\Foundation\Testing\TestCase $this */
    $this->seed(PermissionSeeder::class);

    $seeded = Permission::pluck('name')->all();

    $referenced = collect(Finder::create()->files()->in(app_path('Policies'))->name('*.php'))
        ->flatMap(function ($file) {
            preg_match_all("/hasPermissionTo\(\s*'([^']+)'\s*\)/", $file->getContents(), $matches);
            return $matches[1];
        })
        ->unique()
        ->values();

    expect($referenced)->not->toBeEmpty();

    $missing = $referenced->diff($seeded);

    expect($missing->all())
        ->toBe([], "Policies reference permissions not in PermissionSeeder: {$missing->implode(', ')}");
});