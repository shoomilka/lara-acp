@extends('app')

@section('content')
<div class="container">

    <h1>Учасник #{{ $member->id }}
        <a href="{{ 'member/' . $member->id . '/edit' }}" class="btn btn-primary btn-xs" title="Редагувати учасника"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
        {!! Form::open([
            'method'=>'DELETE',
            'url' => ['member', $member->id],
            'style' => 'display:inline'
        ]) !!}
            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true"/>', array(
                    'type' => 'submit',
                    'class' => 'btn btn-danger btn-xs',
                    'title' => 'Видалити учасника',
                    'onclick'=>'return confirm("Підтверджуєш видалення?")'
            ))!!}
        {!! Form::close() !!}
    </h1>
    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <tbody>
                <tr>
                    <th>ID</th><td>{{ $member->id }}</td>
                </tr>
                <tr><th> Ім'я </th>
                    <td> {{ $member->name }} </td>
                    </tr><tr><th> Телефон </th>
                    <td> {{ $member->phone }} </td>
                    </tr><tr><th> Місто </th>
                    <td> {{ $member->city }} </td>
                    </tr><tr><th> Рік народження </th>
                    <td> {{ $member->year }} </td>
                    </tr><tr><th> Велосипед </th>
                    <td> {{ $member->cycle }} </td>
                    </tr><tr><th> Нік </th>
                    <td> {{ $member->nick }} </td>
                </tr>
            </tbody>
        </table>
    </div>

</div>
@endsection
