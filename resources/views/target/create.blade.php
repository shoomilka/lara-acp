@extends('app')

@section('content')
<div class="container">

    <h1>Додати КП</h1>
    <hr/>

    {!! Form::open(['url' => '/target', 'class' => 'form-horizontal', 'files' => true]) !!}

            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                {!! Form::label('title', 'Назва', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('trace_id') ? 'has-error' : ''}}">
                {!! Form::label('trace_id', 'ХЗ', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('trace_id', $traces, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('trace_id', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

            <div class="form-group {{ $errors->has('coordinate') ? 'has-error' : ''}}">
                {!! Form::label('coordinate', 'Кілометр', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::number('coordinate', 1, ['class' => 'form-control', 'step' => '0.01']) !!}
                    {!! $errors->first('coordinate', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

<!--start (time)-->
            <div class="form-group {{ $errors->has('start') ? 'has-error' : ''}}">
                {!! Form::label('start', 'Час початку', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('start', null, ['class' => 'form-control', 'id' => 'datetimepicker1']) !!}
                    {!! $errors->first('start', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
<!--finish (time)-->
            <div class="form-group {{ $errors->has('finish') ? 'has-error' : ''}}">
                {!! Form::label('finish', 'Час завершення', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('finish', null, ['class' => 'form-control', 'id' => 'datetimepicker2']) !!}
                    {!! $errors->first('finish', '<p class="help-block">:message</p>') !!}
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