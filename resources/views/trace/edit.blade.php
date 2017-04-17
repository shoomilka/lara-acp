@extends('app')

@section('content')
<div class="container">

    <h1>Редагувати бревет</h1>
    <hr/>

    {!! Form::model($trace, [
        'method' => 'PATCH',
        'url' => ['/trace', $trace->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                {!! Form::label('title', 'Назва', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

<!--email-->
            <div class="form-group {{ $errors->has('email_id') ? 'has-error' : ''}}">
                {!! Form::label('email_id', 'Email', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('email_id', $emails, null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email_id', '<p class="help-block">:message</p>') !!}
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

            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                {!! Form::label('description', 'Опис', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                </div>
            </div>

        <div class="form-group">
            <div class="col-sm-offset-3 col-sm-3">
                {!! Form::submit('Оновити', ['class' => 'btn btn-primary form-control']) !!}
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