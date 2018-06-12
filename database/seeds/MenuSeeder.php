<?php

use Illuminate\Database\Seeder;

use App\Menu;
class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $main_menu = Menu::create([
            'text' => 'Main Menu',
            'label' => '',
            'url' => 'admin/home',
            'can' => 'main_menu',
        ]);
    }
}
