<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MataKuliah;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Bikin Data Mata Kuliah
        $mkSO = MataKuliah::create(['nama_mk' => 'Sistem Operasi']);
        $mkJarkom = MataKuliah::create(['nama_mk' => 'Jaringan Komputer']);

        $mkPBO = MataKuliah::create(['nama_mk' => 'Pemrograman Berorientasi Objek']);
        $mkMatriks = MataKuliah::create(['nama_mk' => 'Aljabar Linier dan Matriks']);   



        // 2. Cari ID dosen yang barusan dibikin di UserSeeder
        $pakAnggi = User::where('username', 'Pak Anggi')->first();
        $BuLisda = User::where('username', 'Bu Lisda')->first();
        $pakRusdi = User::where('username', 'Pak Rusdi')->first();
        
        

        // 3. Hubungkan Dosen dengan Mata Kuliah di Tabel Pivot
        if ($pakAnggi) {
            DB::table('dosen_mata_kuliah')->insert([
                ['dosen_id' => $pakAnggi->id, 'mata_kuliah_id' => $mkSO->id, 'created_at' => now(), 'updated_at' => now()],
                ['dosen_id' => $pakAnggi->id, 'mata_kuliah_id' => $mkJarkom->id, 'created_at' => now(), 'updated_at' => now()],
            ]);

        }
        if ($BuLisda) {
            DB::table('dosen_mata_kuliah')->insert([
                ['dosen_id' => $BuLisda->id, 'mata_kuliah_id' => $mkPBO->id, 'created_at' => now(), 'updated_at' => now()],
                ['dosen_id' => $BuLisda->id, 'mata_kuliah_id' => $mkMatriks->id, 'created_at' => now(), 'updated_at' => now()],
            ]);

        }
        if ($pakRusdi) {
            DB::table('dosen_mata_kuliah')->insert([
                ['dosen_id' => $pakRusdi->id, 'mata_kuliah_id' => $mkPBO->id, 'created_at' => now(), 'updated_at' => now()],
                ['dosen_id' => $pakRusdi->id, 'mata_kuliah_id' => $mkMatriks->id, 'created_at' => now(), 'updated_at' => now()],
            ]);
        }

        
    }

}