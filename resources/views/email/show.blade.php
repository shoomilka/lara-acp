@extends('app')

@section('content')
<div class="container">

    <h1>Email #{{ $email->id }}
        <a href="{{ url('email/' . $email->id . '/edit') }}" class="btn btn-primary btn-xs" title="Редагувати Email"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['email', $email->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Видалити Email',
                    'onclick'=>'return confirm("Підтверджуєш видалення?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $email->id }}</td>
                </tr>
                <tr><th> Email </th>
                    <td> {{ $email->email }} </td>
                    </tr><tr><th> Пароль </th>
                    <td> {{ $email->pass }} </td>
                    </tr><tr><th> pop3 </th>
                    <td> {{ $email->pop3 }} </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
