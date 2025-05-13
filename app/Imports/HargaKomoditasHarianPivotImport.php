<?php
// app/Imports/HargaKomoditasHarianPivotImport.php

namespace App\Imports;

use App\Administrasi;
use App\Komoditas;
use App\Models\HargaKomoditasHarianKabkota;
use App\Models\MasterAdministrasi;
use App\Models\MasterKomoditas;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class HargaKomoditasHarianPivotImport implements ToCollection, WithHeadingRow
{
    protected $waktu;
    protected $kabMap;
    protected $komMap;

    public function __construct(string $waktu)
    {
        $this->waktu = $waktu;
        // mapping nama->kode
        $this->kabMap = Administrasi::pluck('kd_adm', 'nm_adm')->toArray();
        // mapping nama komoditas->id
        $this->komMap = Komoditas::pluck('id_kmd', 'nama_pangan')->toArray();
    }

    /**
     * @param Collection $rows
     */
    public function collection(Collection $rows)
    {
        // baris pertama biasanya unit, jadi skip jika perlu
        foreach ($rows as $row) {
            $kabName = trim($row['kota/kabupaten'] ?? '');
            if (! isset($this->kabMap[$kabName])) {
                continue; // kabupaten tidak dikenal
            }
            $kodeKab = $this->kabMap[$kabName];

            // untuk setiap kolom header kecuali 'no' & 'kota/kabupaten'
            foreach ($row->keys() as $col) {
                if (in_array($col, ['no', 'kota/kabupaten'])) {
                    continue;
                }
                $hargaRaw = $row[$col];
                // skip kosong atau tanda '-'
                if (empty($hargaRaw) || trim($hargaRaw) === '-') {
                    continue;
                }
                // ambil id komoditas
                if (! isset($this->komMap[$col])) {
                    continue; // kolom tidak dikenali sebagai komoditas
                }
                $idKmd = $this->komMap[$col];
                // bersihkan angka (hapus 'Rp', '.', spasi)
                $harga = (int) preg_replace('/[^\d]/', '', $hargaRaw);

                HargaKomoditasHarianKabkota::create([
                    'kode_kab'     => $kodeKab,
                    'waktu'        => $this->waktu,
                    'id_komoditas' => $idKmd,
                    'harga'        => $harga,
                    'source'       => 'Excel Import',
                ]);
            }
        }
    }
}
