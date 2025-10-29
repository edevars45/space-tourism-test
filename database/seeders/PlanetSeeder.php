<?php
 
namespace Database\Seeders;
 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Planet;
 
class PlanetSeeder extends Seeder
{
   public function run(): void {
    Planet::firstOrCreate(
      ['slug'=>'lune'],
      ['name'=>'Lune','description'=>'…','distance_km'=>384000,'duration_days'=>3]
    );
  }
}