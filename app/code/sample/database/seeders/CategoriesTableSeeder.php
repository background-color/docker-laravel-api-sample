<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        \App\Models\Category::create(['name' => '歩数']);
        \App\Models\Category::create(['name' => '体重']);
        \App\Models\Category::create(['name' => '睡眠時間']);
    }
}
