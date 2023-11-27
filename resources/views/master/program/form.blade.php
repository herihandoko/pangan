<div class="form-group">
    {{ Form::label('code', 'Kode', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('code', isset($program->code) ? $program->code : old('code'), ['class' => $errors->has('code') ? 'form-control is-invalid' : 'form-control']) }}
        <span style="color:red !important;">{{ $errors->first('code') }}</span>
    </div>
</div>
<div class="form-group">
    {{ Form::label('name', 'Nama', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('name', isset($program->name) ? $program->name : old('name'), ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) }}
        <span style="color:red !important;">{{ $errors->first('name') }}</span>
    </div>
</div>
<div class="form-group has-error has-feedback">
    <div class="col-md-8 col-md-offset-3">
        <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
        <a href="{{ route('master.sub-unit.index') }}" class="btn btn-sm btn-default">Cancel</a>
    </div>
</div>
