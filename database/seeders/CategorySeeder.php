<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'Action and adventure', 'Art/architecture', 'Alternate history', 'Autobiography',
            'Anthology','Biography','Chick lit','Business/economics','Children\'s','Crafts/hobbies',
            'Classic','Cookbook','Comic book','Diary','Coming-of-age','Dictionary','Crime','Encyclopedia',
            'Drama','Guide','Fairy tale','Health/fitness','Fantasy','History','Graphic novel',
            'Home and garden','Historical fiction','Humor','Horror','Journal','Mystery','Math',
            'Paranormal romance','Memoir','Picture book','Philosophy','Poetry','Prayer',
            'Political thriller','Religion, spirituality, and new age','Romance','Textbook',
            'Satire','True crime','Science fiction','Review','Short story','Science','Suspense',
            'Self help','Thriller','Sports and leisure','Western','Travel','Young adult','True crime'
        ];

        foreach ($categories as $cat) {
            DB::table('categories')->insert([
                'category' => $cat,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
