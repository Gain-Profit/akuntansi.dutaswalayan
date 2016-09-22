<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PerusahaansTableSeeder::class);
        $this->call(KelasesTableSeeder::class);
        $this->call(KelasSubsTableSeeder::class);
    }
}
