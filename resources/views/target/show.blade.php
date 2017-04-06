@extends('app')

@section('content')
<div class="container">

    <h1>КП #{{ $target->id }}
        <a href="{{ 'target/' . $target->id . '/edit' }}" class="btn btn-primary btn-xs" title="Редагувати КП"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['target', $target->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Видалити КП',
                    'onclick'=>'return confirm("Підтверджуєш видалення?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $target->id }}</td>
                </tr>
                <tr><th> Назва </th>
                    <td> {{ $target->title }} </td>
                    </tr><tr><th> Бревет </th>
                    <td> {{ $trace->title }} </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
