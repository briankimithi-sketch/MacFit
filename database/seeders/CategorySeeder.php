<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create([
            'name' => 'Admin',
            'description' => 'Administrator']);

 
        Category::create([
            'name' => 'Trainer',
            'description' => 'This is a trainer']);

 
        Category::create([
            'name' => 'User',
            'description' => 'This is a normal user']);

 
        Category::create([
            'name' => 'Staff',
            'description' => 'This is a staff member'

        ]);

    }

    }

