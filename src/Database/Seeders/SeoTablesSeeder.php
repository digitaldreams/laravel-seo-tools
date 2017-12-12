<?php

namespace SEO\Database\Seeders;

use Illuminate\Database\Seeder;

class SeoTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MetaTagsTableSeeder::class);
        $this->call(LinkTagsTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
    }
}
