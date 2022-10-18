<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // insert default value for students
       Student::create([
		    'last_name' => 'LastName 1',
		    'first_name' => 'FirstName 1',
		    'email' => 'test1@gmail.com',
		    'phone' => '1233211234',
		    'program_id' => 1,
		]);

        // insert default value for students
       Student::create([
		    'last_name' => 'LastName 2',
		    'first_name' => 'FirstName 2',
		    'email' => 'test2@gmail.com',
		    'phone' => '123-321-1234',
		    'program_id' => 2,
		]);

        // insert default value for students
       Student::create([
		    'last_name' => 'LastName 3',
		    'first_name' => 'FirstName 3',
		    'email' => 'test3@gmail.com',
		    'phone' => '+1(123)123-1234',
		    'program_id' => 3,
		]);

        // insert default value for students
       Student::create([
		    'last_name' => 'LastName 4',
		    'first_name' => 'FirstName 4',
		    'email' => 'test4@gmail.com',
		    'phone' => '1233211234',
		    'program_id' => 4,
		]);
    }
}
