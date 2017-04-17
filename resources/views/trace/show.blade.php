@extends('app')

@section('content')
<div class="container">

    <h1>Бревет #{{ $trace->id }}
        <a href="{{ 'trace/' . $trace->id . '/edit' }}" class="btn btn-primary btn-xs" title="Редагувати бревет"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['trace', $trace->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Видалити бревет',
                    'onclick'=>'return confirm("Прив\'язані КП також будуть стерті. Підтверджуєш видалення?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $trace->id }}</td>
                </tr>
                <tr><th> Назва </th>
                    <td> {{ $trace->title }} </td>
                    </tr><tr><th> Email </th>
                    <td> {{ $email->email }} </td>
                    </tr><tr><th> Час початку </th>
                    <td> {{ $trace->start }} </td>
                    </tr><tr><th> Час закінчення </th>
                    <td> {{ $trace->finish }} </td>
                    </tr><tr><th> Опис </th>
                    <td> {{ $trace->description }} </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
