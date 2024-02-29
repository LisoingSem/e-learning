<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesTableSeeder::class);
        $this->call(SystemsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ProgressStatusesTableSeeder::class);
        $this->call(StatusesTableSeeder::class);
        $this->call(ReligionsTableSeeder::class);
        $this->call(LanguagesTableSeeder::class);
        $this->call(CountriesTableSeeder::class);
        $this->call(SystemFeaturesTableSeeder::class);
        $this->call(FeatureLinksTableSeeder::class);
        $this->call(SystemModulesTableSeeder::class);
    }
}
