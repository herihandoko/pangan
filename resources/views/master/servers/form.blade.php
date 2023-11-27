<div class="form-group">
    <label for="type" class="col-md-3 control-label">Type <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::select(
            'type',
            [
                'on_prem' => 'On-prem',
                'cloud' => 'Cloud',
            ],
            isset($server->type) ? $server->type : old('type'),
            ['class' => $errors->has('type') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('type') }}</span>
    </div>
</div>
<div class="form-group">
    <label for="id_hardware" class="col-md-3 control-label">Hardware</label>
    <div class="col-md-9">
        {{ Form::select(
            'id_hardware',
            $data['hardware'],
            isset($servers->id_hardware) ? $servers->id_hardware : old('id_hardware'),
            ['class' => $errors->has('id_hardware') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('id_hardware') }}</span>
    </div>
</div>
<div class="form-group">
    <label for="ip" class="col-md-3 control-label">IP Address <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::text('ip', isset($servers->ip) ? $servers->ip : old('ip'), ['class' => $errors->has('ip') ? 'form-control is-invalid' : 'form-control', 'placeholder' => '127.0.0.1']) }}
        <span style="color:red !important;">{{ $errors->first('ip') }}</span>
    </div>
</div>
<div class="form-group">
    {{ Form::label('hdd', 'Hardisc', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('hdd', isset($servers->hdd) ? $servers->hdd : old('hdd'), ['class' => $errors->has('hdd') ? 'form-control is-invalid' : 'form-control', 'placeholder' => '512GB']) }}
        <span style="color:red !important;">{{ $errors->first('hdd') }}</span>
    </div>
</div>
<div class="form-group">
    {{ Form::label('ram', 'RAM', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('ram', isset($servers->ram) ? $servers->ram : old('ram'), ['class' => $errors->has('ram') ? 'form-control is-invalid' : 'form-control', 'placeholder' => '8x32GB']) }}
        <span style="color:red !important;">{{ $errors->first('ram') }}</span>
    </div>
</div>
<div class="form-group">
    {{ Form::label('cpu', 'CPU', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('cpu', isset($servers->cpu) ? $servers->cpu : old('cpu'), ['class' => $errors->has('cpu') ? 'form-control is-invalid' : 'form-control', 'placeholder' => 'Core i7 Intel, Quard Core']) }}
        <span style="color:red !important;">{{ $errors->first('cpu') }}</span>
    </div>
</div>
<div class="form-group">
    <label for="status" class="col-md-3 control-label">Status <span class="text-danger">*</span></label>
    <div class="col-md-9">
        {{ Form::select(
            'status',
            [
                'active' => 'Active',
                'inactive' => 'Inactive',
            ],
            isset($server->status) ? $server->status : old('status'),
            ['class' => $errors->has('status') ? 'form-control is-invalid' : 'form-control'],
        ) }}
        <span style="color:red !important;">{{ $errors->first('status') }}</span>
    </div>
</div>
<div class="form-group has-error has-feedback">
    <div class="col-md-8 col-md-offset-3">
        <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
        <a href="{{ route('master.servers.index') }}" class="btn btn-sm btn-default">Cancel</a>
    </div>
</div>
