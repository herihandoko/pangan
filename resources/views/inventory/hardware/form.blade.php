<h4>Detail Hardware</h4>
<p>
    Anda dapat memeriksa semua informasi perangkat keras Anda di bawah.<br>
    <span class="text-danger">* Silakan isi kolom yang wajib diisi.</span>
</p>
<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('type', 'Hardware Type', ['class' => 'control-label']) }} <span class="text-danger">*</span>
            {{ Form::select(
                'type',
                [
                    'server' => 'Server and Data Storage',
                    'network' => 'Network Device',
                    'safety' => 'Safety Device',
                    'enduser' => 'End User',
                    'printer' => 'Printer',
                ],
                isset($hardware->type) ? $hardware->type : old('type'),
                ['class' => $errors->has('type') ? 'form-control is-invalid' : 'form-control'],
            ) }}
            <span style="color:red !important;">{{ $errors->first('type') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('inventory_tag', 'Inventory Label', ['class' => 'control-label']) }} <span
                class="text-danger">*</span>
            {{ Form::text('inventory_tag', isset($hardware->inventory_tag) ? $hardware->inventory_tag : old('inventory_tag'), ['class' => $errors->has('inventory_tag') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('inventory_tag') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('barcode', 'Barcode', ['class' => 'control-label']) }}
            {{ Form::text('barcode', isset($hardware->barcode) ? $hardware->barcode : old('barcode'), ['class' => $errors->has('barcode') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('barcode') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('harga', 'Harga Beli', ['class' => 'control-label']) }} <span class="text-danger">*</span>
            <div class="row">
                <div class="col-md-4">
                    {{ Form::select(
                        'currency',
                        [
                            'IDR' => 'IDR',
                            'USD' => 'USD',
                            'SGD' => 'SGD',
                        ],
                        isset($hardware->currency) ? $hardware->currency : old('currency'),
                        ['class' => $errors->has('currency') ? 'form-control is-invalid' : 'form-control'],
                    ) }}
                </div>
                <div class="col-md-8">
                    {{ Form::number('harga', isset($hardware->harga) ? $hardware->harga : old('harga'), ['class' => $errors->has('harga') ? 'form-control is-invalid' : 'form-control']) }}
                </div>
            </div>
            <span style="color:red !important;">{{ $errors->first('harga') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('manufacturer', 'Manufacturer', ['class' => 'control-label']) }}
            {{ Form::text('manufacturer', isset($hardware->manufacturer) ? $hardware->manufacturer : old('manufacturer'), ['class' => $errors->has('manufacturer') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('manufacturer') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('brand', 'Brand', ['class' => 'control-label']) }}
            {{ Form::text('brand', isset($hardware->brand) ? $hardware->brand : old('brand'), ['class' => $errors->has('brand') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('brand') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('model', 'Model', ['class' => 'control-label']) }}
            {{ Form::text('model', isset($hardware->model) ? $hardware->model : old('model'), ['class' => $errors->has('model') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('model') }}</span>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            {{ Form::label('purchase_date', 'Tanggal Beli', ['class' => 'control-label']) }} <span
            class="text-danger">*</span>
            {{ Form::date('purchase_date', isset($hardware->purchase_date) ? $hardware->purchase_date : old('purchase_date'), ['class' => $errors->has('purchase_date') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('purchase_date') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('waranty_date', 'Berakhir Garansi', ['class' => 'control-label']) }}
            {{ Form::date('waranty_date', isset($hardware->waranty_date) ? $hardware->waranty_date : old('waranty_date'), ['class' => $errors->has('waranty_date') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('waranty_date') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('status', 'Status', ['class' => 'control-label']) }} <span class="text-danger">*</span>
            {{ Form::select(
                'status',
                [
                    'active' => 'Aktif',
                    'hilang' => 'Hilang',
                    'service' => 'Sedang di Service',
                    'simpan' => 'Dalam Penympanan',
                ],
                isset($hardware->status) ? $hardware->status : old('status'),
                ['class' => $errors->has('status') ? 'form-control is-invalid' : 'form-control'],
            ) }}
            <span style="color:red !important;">{{ $errors->first('status') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('opd_id', 'OPD', ['class' => 'control-label']) }} <span class="text-danger">*</span>
            {{ Form::select(
                'opd_id',
                $data['opds'],
                isset($hardware->opd_id) ? $hardware->opd_id : old('type_hosting'),
                [
                    'class' => $errors->has('opd_id') ? 'form-control is-invalid select2' : 'form-control select2',
                ],
            ) }}
            <span style="color:red !important;">{{ $errors->first('opd_id') }} </span>
        </div>
        <div class="form-group">
            {{ Form::label('serial_number', 'Serial Number', ['class' => 'control-label']) }} <span
            class="text-danger">*</span>
            {{ Form::text('serial_number', isset($hardware->serial_number) ? $hardware->serial_number : old('serial_number'), ['class' => $errors->has('serial_number') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('serial_number') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('tahun_anggaran', 'Tahun Anggaran', ['class' => 'control-label']) }} <span
                class="text-danger">*</span>
            {{ Form::number('tahun_anggaran', isset($hardware->tahun_anggaran) ? $hardware->tahun_anggaran : old('tahun_anggaran'), ['class' => $errors->has('tahun_anggaran') ? 'form-control is-invalid' : 'form-control']) }}
            <span style="color:red !important;">{{ $errors->first('tahun_anggaran') }}</span>
        </div>
        <div class="form-group">
            {{ Form::label('description', 'Keterangan', ['class' => 'control-label']) }}
            {{ Form::textarea(
                'description',
                isset($hardware->description) ? $hardware->description : old('description'),
                ['class' => $errors->has('status') ? 'form-control is-invalid' : 'form-control', 'rows' => 4],
            ) }}
            <span style="color:red !important;">{{ $errors->first('description') }}</span>
        </div>
    </div>
</div>
<hr>
<div class="form-group has-error has-feedback">
    <div class="col-md-12 text-right">
        <a href="{{ route('inventory.hardware.index') }}" class="btn btn-sm btn-default  m-r-5">Cancel</a>
        <button type="submit" class="btn btn-sm btn-primary">Simpan</button>
    </div>
</div>
