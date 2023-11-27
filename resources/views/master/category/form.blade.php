<div class="form-group">
    {{ Form::label('name', 'Nama', ['class' => 'col-md-3 control-label']) }}
    <div class="col-md-9">
        {{ Form::text('name', isset($category->name) ? $category->name : old('name'), ['class' => $errors->has('name') ? 'form-control is-invalid' : 'form-control']) }}
        <span style="color:red !important;">{{ $errors->first('name') }}</span>
    </div>
</div>
<div class="form-group has-error has-feedback">
    <div class="col-md-8 col-md-offset-3">
        <button type="submit" class="btn btn-sm btn-primary m-r-5">Submit</button>
        <a href="{{ route('master.category.index') }}" class="btn btn-sm btn-default">Cancel</a>
    </div>
</div>
