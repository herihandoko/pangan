@php
    $errorsBag = session('errors') ? session('errors')->getBag('default') : null;
@endphp

<div class="form-group mb-3">
    <label for="kd_adm">Kode Administrasi</label>
    <input type="text" name="kd_adm" id="kd_adm" value="{{ old('kd_adm', $administrasi->kd_adm ?? '') }}"
        class="form-control @error('kd_adm') is-invalid @enderror">
    @error('kd_adm')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="wilayah_adm">Wilayah Administrasi</label>
    <input type="text" name="wilayah_adm" id="wilayah_adm"
        value="{{ old('wilayah_adm', $administrasi->wilayah_adm ?? '') }}"
        class="form-control @error('wilayah_adm') is-invalid @enderror">
    @error('wilayah_adm')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="nm_adm">Nama Administrasi</label>
    <input type="text" name="nm_adm" id="nm_adm" value="{{ old('nm_adm', $administrasi->nm_adm ?? '') }}"
        class="form-control @error('nm_adm') is-invalid @enderror">
    @error('nm_adm')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="source">Source</label>
    <input type="text" name="source" id="source" value="{{ old('source', $administrasi->source ?? '') }}"
        class="form-control @error('source') is-invalid @enderror">
    @error('source')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
