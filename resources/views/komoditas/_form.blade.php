@php
    $errorsBag = session('errors') ? session('errors')->getBag('default') : null;
@endphp

<div class="form-group mb-3">
    <label for="id_kmd">ID</label>
    <input type="text" name="id_kmd" id="id_kmd" value="{{ old('id_kmd', $komoditas->id_kmd ?? '') }}"
        class="form-control @error('id_kmd') is-invalid @enderror">
    @error('id_kmd')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="nama_pangan">Nama Pangan</label>
    <input type="text" name="nama_pangan" id="nama_pangan"
        value="{{ old('nama_pangan', $komoditas->nama_pangan ?? '') }}"
        class="form-control @error('nama_pangan') is-invalid @enderror">
    @error('nama_pangan')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="hpp_het">HPP/HET</label>
    <input type="text" name="hpp/het" id="hpp_het" value="{{ old('hpp/het', $komoditas->{'hpp/het'} ?? '') }}"
        class="form-control @error('hpp/het') is-invalid @enderror">
    @error('hpp/het')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="source">Source</label>
    <input type="text" name="source" id="source" value="{{ old('source', $komoditas->source ?? '') }}"
        class="form-control @error('source') is-invalid @enderror">
    @error('source')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
