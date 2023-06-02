<div class="box box-info padding-1">
    <div class="box-body">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('name') }}
                    {{ Form::text('name', $student->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'User Id']) }}
                    {!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {{ Form::label('nim') }}
                    {{ Form::text('nim', $student->nim, ['class' => 'form-control' . ($errors->has('nim') ? ' is-invalid' : ''), 'placeholder' => 'Nim']) }}
                    {!! $errors->first('nim', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Kelas</label>
                    <select class="form-control" name="class_id" required>
                        <option value="{{ $student->class_id }}" selected>{{ $student->classRoom->name }}
                        </option>
                        @foreach ($classRooms as $value => $key)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::label('address') }}
                    {{ Form::textarea('address', $student->address, ['class' => 'form-control' . ($errors->has('address') ? ' is-invalid' : ''), 'placeholder' => 'Address']) }}
                    {!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
                </div>
            </div>
        </div>
    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>
