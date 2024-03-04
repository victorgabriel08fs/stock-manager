<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Churrasco', 'description' => 'Itens essenciais para um bom churrasco', 'icon' => 'assets/churrasco.png']);
        Category::create(['name' => 'Confeitaria', 'description' => 'Tudo o que você precisa para fazer um belo bolo', 'icon' => 'assets/biscoitos.png']);
        Category::create(['name' => 'Quintal', 'description' => 'Do varal à mangueira', 'icon' => 'assets/mangueira.png']);
        Category::create(['name' => 'Presente', 'description' => 'Presenteie alguém legal com algo legal']);
        Category::create(['name' => 'Ferramentas', 'description' => 'Ferramentas em geral']);
    }
}
