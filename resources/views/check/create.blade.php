@extends('app')

@section('content')
<div class="container">

    <h1>Додати новий чек</h1>
    <hr/>

    {!! Form::open(['url' => '/check', 'class' => 'form-horizontal', 'files' => true]) !!}

            <div class="form-group {{ $errors->has('phone') ? 'has-error' : ''}}">
                {!! Form::label('phone', 'Номер телефону', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('phone', null, ['class' => 'form-control', 'maxlength' => '10']) !!}
                    {!! $errors->first('phone', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('time') ? 'has-error' : ''}}">
                {!! Form::label('time', 'Час', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('time', null, ['class' => 'form-control', 'id' => 'datetimepicker2']) !!}
                    {!! $errors->first('time', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('target_id') ? 'has-error' : ''}}">
                {!! Form::label('target_id', 'КП', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('target_id', $targets, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('target_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Створити', ['class' => 'btn btn-primary form-control']) !!}
            </div>
        </div>
    {!! Form::close() !!}

    @if ($errors->any())
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

</div>
@endsection