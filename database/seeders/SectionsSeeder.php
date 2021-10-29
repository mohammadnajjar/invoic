<?php

namespace Database\Seeders;

use App\Models\Section;
use Illuminate\Database\Seeder;

class SectionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Section::create([
            "section_name" => 'البنك الاهلي',
            "description" => 'البنك الاهلي',
            "created_by" => 'admin',
        ]);
        Section::create([
            "section_name" => 'البنك الاسلامي',
            "description" => 'البنك الاسلامي',
            "created_by" => 'admin',
        ]);
        Section::create([
            "section_name" => 'البنك العربي',
            "description" => 'البنك العربي',
            "created_by" => 'admin',
        ]);
        Section::create([
            "section_name" => 'بنك الرياض',
            "description" => 'بنك الرياض',
            "created_by" => 'admin',
        ]);
        Section::create([
            "section_name" => 'البنك المهجر',
            "description" => 'البنك المهجر',
            "created_by" => 'admin',
        ]);

    }
}
