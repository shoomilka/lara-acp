@extends('app')

@section('content')
<div class="container">

    <h1>Редагувати скриньку</h1>
    <hr/>

    {!! Form::model($email, [
        'method' => 'PATCH',
        'url' => ['/email', $email->id],
        'class' => 'form-horizontal',
        'files' => true
    ]) !!}

            <div class="form-group {{ $errors->has('email') ? 'has-error' : ''}}">
                {!! Form::label('email', 'Адреса скриньки', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('pass') ? 'has-error' : ''}}">
                {!! Form::label('pass', 'Пароль', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('pass', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('pass', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('pop3') ? 'has-error' : ''}}">
                {!! Form::label('pop3', 'pop3', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('pop3', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('pop3', '<p class="help-block">:message</p>') !!}
                </div>
            </div>
            <div class="form-group {{ $errors->has('port') ? 'has-error' : ''}}">
                {!! Form::label('port', 'Порт', ['class' => 'col-sm-3 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('port', null, ['class' => 'form-control']) !!}
                    {!! $errors->first('port', '<p class="help-block">:message</p>') !!}
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