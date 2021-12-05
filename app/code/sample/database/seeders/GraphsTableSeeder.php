<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GraphsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('graphs')->truncate();
        //\App\Models\Graph::create(['category_id' => 1, 'val' => 5000, 'date' => '2021-12-01']);
        $datas = [
          ['category_id' => 1, 'val' => 5000, 'date' => '2021-12-01'],
          ['category_id' => 1, 'val' => 6000, 'date' => '2021-12-02'],
          ['category_id' => 1, 'val' => 5000, 'date' => '2021-12-03'],
          ['category_id' => 1, 'val' => 5500, 'date' => '2021-12-04'],
          ['category_id' => 1, 'val' => 5500, 'date' => '2021-12-05'],
          ['category_id' => 1, 'val' => 7000, 'date' => '2021-12-06'],
          ['category_id' => 2, 'val' => 50, 'date' => '2021-12-01'],
          ['category_id' => 2, 'val' => 51, 'date' => '2021-12-02'],
          ['category_id' => 2, 'val' => 50, 'date' => '2021-12-03'],
          ['category_id' => 2, 'val' => 50, 'date' => '2021-12-04'],
          ['category_id' => 2, 'val' => 51, 'date' => '2021-12-05'],
          ['category_id' => 2, 'val' => 49, 'date' => '2021-12-06'],
          ['category_id' => 3, 'val' => 5, 'date' => '2021-12-01'],
          ['category_id' => 3, 'val' => 5, 'date' => '2021-12-02'],
          ['category_id' => 3, 'val' => 5, 'date' => '2021-12-03'],
          ['category_id' => 3, 'val' => 6, 'date' => '2021-12-04'],
          ['category_id' => 3, 'val' => 5, 'date' => '2021-12-05'],
          ['category_id' => 3, 'val' => 4, 'date' => '2021-12-06']
        ];
        foreach($datas as $data) {
          \App\Models\Graph::create($data);
        }
    }
}
