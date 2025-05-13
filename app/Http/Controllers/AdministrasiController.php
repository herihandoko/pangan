<?php
// app/Http/Controllers/AdministrasiController.php

namespace App\Http\Controllers;

use App\Administrasi;
use App\Http\Requests\StoreAdministrasiRequest;
use App\Http\Requests\UpdateAdministrasiRequest;

class AdministrasiController extends Controller
{
    public function index()
    {
        $administrasi = Administrasi::orderBy('created_at', 'desc')
            ->paginate(15);

        return view('administrasi.index', compact('administrasi'));
    }

    public function create()
    {
        return view('administrasi.create');
    }

    public function store(StoreAdministrasiRequest $request)
    {
        Administrasi::create($request->validated());

        return redirect()
            ->route('administrasi.index')
            ->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(Administrasi $administrasi)
    {
        return view('administrasi.show', compact('administrasi'));
    }

    public function edit(Administrasi $administrasi)
    {
        return view('administrasi.edit', compact('administrasi'));
    }

    public function update(UpdateAdministrasiRequest $request, Administrasi $administrasi)
    {
        $administrasi->update($request->validated());

        return redirect()
            ->route('administrasi.index')
            ->with('success', 'Data berhasil diupdate.');
    }

    public function destroy(Administrasi $administrasi)
    {
        $administrasi->delete();
        return back()->with('success', 'Data berhasil dihapus.');
    }
}
