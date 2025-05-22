@php
    $errorsBag = session('errors') ? session('errors')->getBag('default') : null;
@endphp

<div class="form-group mb-3">
    <label for="kode_kab">Kabupaten/Kota</label>
    {!! Form::select(
        'kode_kab',
        $kabupaten,
        old('kode_kab'),
        ['class' => 'form-control'.($errors->has('kode_kab') ? ' is-invalid' : '')]
    ) !!}
    @error('kode_kab')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="nama_pangan">Nama Pangan</label>
    {!! Form::select('id_komoditas',$komoditas,old('id_komoditas'),['class' => 'form-control'.($errors->has('id_komoditas') ? ' is-invalid' : '')]) !!}
    @error('id_komoditas')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="hpp_het">Tanggal</label>
    {!! Form::date('waktu',old('waktu'),['class' => 'form-control'.($errors->has('waktu') ? ' is-invalid' : '')]) !!}
    @error('waktu')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="hpp_het">Harga</label>
    {!! Form::number('harga',old('harga'),['class' => 'form-control'.($errors->has('harga') ? ' is-invalid' : '')]) !!}
    @error('harga')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
