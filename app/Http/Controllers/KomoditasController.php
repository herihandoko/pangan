<?php

namespace App\Http\Controllers;

use App\Komoditas;
use App\Http\Requests\StoreKomoditasRequest;
use App\Http\Requests\UpdateKomoditasRequest;

class KomoditasController extends Controller
{
    public function index()
    {
        $komoditas = Komoditas::orderBy('created_at', 'desc')
            ->paginate(10);
        return view('komoditas.index', compact('komoditas'));
    }

    public function create()
    {
        return view('komoditas.create');
    }

    public function store(StoreKomoditasRequest $request)
    {
        Komoditas::create($request->validated());

        return redirect()
            ->route('komoditas.index')
            ->with('success', 'Komoditas berhasil ditambahkan.');
    }

    public function show(Komoditas $komoditas)
    {
        
        return view('komoditas.show', compact('komoditas'));
    }

    public function edit(Komoditas $komoditas)
    {
        return view('komoditas.edit', compact('komoditas'));
    }

    public function update(UpdateKomoditasRequest $request, Komoditas $komoditas)
    {
        $komoditas->update($request->validated());

        return redirect()
            ->route('komoditas.index')
            ->with('success', 'Komoditas berhasil diupdate.');
    }

    public function destroy(Komoditas $komoditas)
    {
        $komoditas->delete();

        return back()->with('success', 'Komoditas berhasil dihapus.');
    }
}
