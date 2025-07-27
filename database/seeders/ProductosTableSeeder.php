<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductosTableSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('productos')->insert([
            [
                'id' => 3,
                'codigo' => 2200,
                'nombre' => 'TA-30 "INNOVA X-TREME"',
                'um_id' => 1,
                'detalle' => 'Cap. 30.000 L (24-25 Tn.) - Ruedas 23-1x30...',
                'img' => '/storage/img/F6NsIj1ntjqe5cqNahrtr5YcdpNZksvtDxvKrVQY.png',
                'img_1' => '/storage/img/4WDbdCiYqd23IT4XfBtcIdVz1O6LU76yTt2j0mZ1.jpg',
                'img_2' => '/storage/img/NMeSKJMQlYnWfu2Us2x1LeM9Y3W7LakxNXw65zkL.jpg',
                'img_3' => '/storage/img/y65iKR8MdmvAz9mNzWBiK3tHeZDHmJs9hgmxQgHD.jpg',
                'links' => 'https://comofrasrl.com.ar/tolvas-autodescargables/',
                'volumen_carga_m3' => null,
                'potencia_requerida_hp' => null,
                'toma_potencia_tom' => null,
                'tiempo_descarga_aprx_min' => null,
                'balanza' => null,
                'camaras' => null,
                'altura_maxima_mm' => null,
                'altura_carga_mm' => null,
                'longitud_total_mm' => null,
                'peso_vacio_kg' => null,
                'de_serie' => null,
                'opcional' => null,
                'colores' => null,
                'familia_id' => 1,
                'activo' => 1,
                'tipo_id' => 1,
                'user_id' => 5,
                'created_at' => '2025-05-11 21:16:49',
                'updated_at' => '2025-07-04 02:10:10'
            ],
            [
                'id' => 7,
                'codigo' => 199,
                'nombre' => 'DIFERENCIA DE LLANTAS 20x30x5/8" (23-1x30) POR 21x32x5/8" (24-5x32)',
                'um_id' => 1,
                'detalle' => '',
                'img' => '/storage/img/Fi8mrbG0q5IWFCLHHtURTPcE2S4o1HiKW6WkQOdq.png',
                'img_1' => null,
                'img_2' => null,
                'img_3' => null,
                'links' => null,
                'volumen_carga_m3' => null,
                'potencia_requerida_hp' => null,
                'toma_potencia_tom' => null,
                'tiempo_descarga_aprx_min' => null,
                'balanza' => null,
                'camaras' => null,
                'altura_maxima_mm' => null,
                'altura_carga_mm' => null,
                'longitud_total_mm' => null,
                'peso_vacio_kg' => null,
                'de_serie' => null,
                'opcional' => null,
                'colores' => null,
                'familia_id' => 4,
                'activo' => 1,
                'tipo_id' => 23,
                'user_id' => 5,
                'created_at' => '2025-05-17 22:24:14',
                'updated_at' => '2025-05-30 12:28:55'
            ],
            [
                'id' => 8,
                'codigo' => 19904073,
                'nombre' => 'Neumatico 23:1x30 - BKT - 16 T. - P/ACOP. TA-17,5 - TA-26 Y TA-30',
                'um_id' => 1,
                'detalle' => '',
                'img' => '/storage/img/XiSfMlOPrWO0iKsWuS9SaKus8U94qUoEpHOmIVk0.png',
                'img_1' => null,
                'img_2' => null,
                'img_3' => null,
                'links' => null,
                'volumen_carga_m3' => null,
                'potencia_requerida_hp' => null,
                'toma_potencia_tom' => null,
                'tiempo_descarga_aprx_min' => null,
                'balanza' => null,
                'camaras' => null,
                'altura_maxima_mm' => null,
                'altura_carga_mm' => null,
                'longitud_total_mm' => null,
                'peso_vacio_kg' => null,
                'de_serie' => null,
                'opcional' => null,
                'colores' => null,
                'familia_id' => 5,
                'activo' => 1,
                'tipo_id' => 14,
                'user_id' => 5,
                'created_at' => '2025-05-17 22:26:42',
                'updated_at' => '2025-05-29 20:57:49'
            ]
        ]);
    }
}
