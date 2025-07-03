<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('projects')->insert([
            [
                'icon' => '<i class="fi fi-rs-user"></i>',
                'topic' => 'Simple User Profile',
                'description' => 'PHP, Laravel, Docker, HTML, CSS',
                'link' => '#',
            ],
            [
                'icon' => '<i class="fi fi-rs-handshake"></i>',
                'topic' => 'UX Website Project',
                'description' => 'Figma, Group Project, UX Design',
                'link' => '#',
            ],
            [
                'icon' => '<i class="fi fi-rs-download"></i>',
                'topic' => 'Systembolaget API',
                'description' => 'Python, API, Database, Hack',
                'link' => '#',
            ],
        ]);
    }
}
