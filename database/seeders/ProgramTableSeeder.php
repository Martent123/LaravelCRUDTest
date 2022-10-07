<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	// insert default value for programs
       	DB::table('programs')->insert([
            'program' => 'Computer Science',
        ]);

        DB::table('programs')->insert([
            'program' => 'Bachelor of Arts',
        ]);

        DB::table('programs')->insert([
            'program' => 'Commerce(Business)',
        ]);        
        DB::table('programs')->insert([
            'program' => 'Economics',
        ]);        
        DB::table('programs')->insert([
            'program' => 'Health Sciences',
        ]);        
        DB::table('programs')->insert([
            'program' => 'Information Technology',
        ]);        
        DB::table('programs')->insert([
            'program' => 'Journalism',
        ]);    }
}
