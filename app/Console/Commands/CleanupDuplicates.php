<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Penilaian;
use Illuminate\Support\Facades\DB;

class CleanupDuplicates extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'penilaian:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Membersihkan data penilaian duplikat';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Membersihkan data penilaian duplikat...');
        
        // Hapus duplikat berdasarkan kandidat_id dan kriteria_id
        $duplicates = DB::table('penilaians')
            ->select('kandidat_id', 'kriteria_id', DB::raw('COUNT(*) as count'))
            ->groupBy('kandidat_id', 'kriteria_id')
            ->having('count', '>', 1)
            ->get();

        $deletedCount = 0;
        foreach ($duplicates as $duplicate) {
            // Ambil semua penilaian untuk kandidat dan kriteria ini
            $penilaians = Penilaian::where('kandidat_id', $duplicate->kandidat_id)
                ->where('kriteria_id', $duplicate->kriteria_id)
                ->orderBy('created_at', 'desc')
                ->get();

            // Hapus semua kecuali yang terbaru
            if ($penilaians->count() > 1) {
                $keep = $penilaians->first();
                $toDelete = $penilaians->skip(1);
                
                foreach ($toDelete as $penilaian) {
                    $penilaian->delete();
                    $deletedCount++;
                }
            }
        }

        $this->info("Berhasil menghapus {$deletedCount} data duplikat.");
        $this->info("Total penilaian sekarang: " . Penilaian::count());
        
        return 0;
    }
}
