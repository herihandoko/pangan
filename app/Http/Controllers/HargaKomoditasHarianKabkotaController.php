<?php

namespace App\Http\Controllers;

use App\Administrasi;
use App\Models\HargaKomoditasHarianKabkota;
use Illuminate\Http\Request;
use App\Http\Requests\StoreHargaKomoditasHarianKabkotaRequest;
use App\Http\Requests\UpdateHargaKomoditasHarianKabkotaRequest;
use App\Imports\HargaKomoditasHarianPivotImport;
use App\Komoditas;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class HargaKomoditasHarianKabkotaController extends Controller
{
    public function index(Request $request)
    {
        $q = HargaKomoditasHarianKabkota::with(['administrasi', 'komoditas']);
        // filter kode_kabupaten
        if ($request->filled('kode_kab')) {
            $q->where('kode_kab', $request->kode_kab);
        }

        // filter komoditas
        if ($request->filled('id_komoditas')) {
            $q->where('id_komoditas', $request->id_komoditas);
        }

        // filter tanggal (exact match)
        if ($request->filled('start_date') && $request->filled('end_date')) {
            $q->whereBetween('waktu', [
                $request->start_date,
                $request->end_date
            ]);
        }
        $data = $q->paginate(15)->appends($request->only(['kode_kab', 'id_komoditas', 'start_date', 'end_date']));
        $kabupaten  = Administrasi::pluck('nm_adm', 'kd_adm')->prepend('— Semua Kabupaten —', '');
        $komoditas  = Komoditas::pluck('nama_pangan', 'id_kmd')->prepend('— Semua Komoditas —', '');
        return view('harga_komoditas_harian.index', compact('data', 'kabupaten', 'komoditas', 'request'));
    }

    public function create()
    {
        $kabupaten  = Administrasi::pluck('wilayah_adm', 'kd_adm');
        $komoditas  = Komoditas::pluck('nama_pangan', 'id_kmd');
        return view('harga_komoditas_harian.create', compact('kabupaten', 'komoditas'));
    }

    public function store(StoreHargaKomoditasHarianKabkotaRequest $request)
    {
        HargaKomoditasHarianKabkota::create($request->validated());
        return redirect()->route('harga-komoditas-harian.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(HargaKomoditasHarianKabkota $hargaKomoditasHarian)
    {
        return view('harga_komoditas_harian.show', compact('hargaKomoditasHarian'));
    }

    public function edit(HargaKomoditasHarianKabkota $hargaKomoditasHarian)
    {
        $kabupaten = Administrasi::pluck('wilayah_adm', 'kd_adm');
        $komoditas = Komoditas::pluck('nm_komoditas', 'id_kmd');
        return view('harga_komoditas_harian.edit', compact('hargaKomoditasHarian', 'kabupaten', 'komoditas'));
    }

    public function update(UpdateHargaKomoditasHarianKabkotaRequest $request, HargaKomoditasHarianKabkota $hargaKomoditasHarian)
    {
        $hargaKomoditasHarian->update($request->validated());
        return redirect()->route('harga-komoditas-harian.index')
            ->with('success', 'Data berhasil diubah.');
    }

    public function destroy(HargaKomoditasHarianKabkota $hargaKomoditasHarian)
    {
        $hargaKomoditasHarian->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }

    public function upload()
    {
        return view('harga_komoditas_harian.upload');
    }

    public function import(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'waktu' => 'required|date',
            'file' => 'required|mimes:xlsx,xls|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = 'komoditas-' . auth()->user()->id . '-' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads', $filename, 'public');
            if ($path) {
                $waktu = $request->waktu; // Y-m-d
                Excel::import(
                    new HargaKomoditasHarianPivotImport($waktu),
                    storage_path('app/public') . '/' . $path
                );
            }
        }
        return back()->with('success', 'User Imported Successfully.');
    }
}
