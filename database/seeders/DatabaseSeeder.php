<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
        ChatSeeder::class,
        ChatMessageSeeder::class,
        LogSeeder::class,
        ParameterSeeder::class,
        RolesTableSeeder::class,
        CategoriaTableSeeder::class,
        UsersTableSeeder::class,
        FormaPagosTableSeeder::class,
        ColoresTableSeeder::class,
        FamiliasTableSeeder::class,
        MonedasTableSeeder::class,
        PaisTableSeeder::class,
        ProvinciaTableSeeder::class,
        LocalidadTableSeeder::class,
        FletesTableSeeder::class,
        TiposTableSeeder::class,
        TipoPedidosTableSeeder::class,
        UnidadesTableSeeder::class,
        ProductosTableSeeder::class,
        CotizacionesTableSeeder::class,
        SubCotizacionesTableSeeder::class,

        ]);

    }
}
