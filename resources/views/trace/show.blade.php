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
    <h1> Приєднані КП <a href="/index.php/target/create" class="btn btn-primary btn-xs" title="Додати нове КП"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Назва </th><th> Координата </th><th> Початок </th><th> Завершення </th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            @foreach($targets as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->coordinate }}</td>
                    <td>{{ $item->start }}</td>
                    <td>{{ $item->finish }}</td>
                    <td>
                        <a href="{{ '/index.php/target/' . $item->id }}" class="btn btn-success btn-xs" title="Переглянути деталі"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ '/index.php/target/' . $item->id . '/edit' }}" class="btn btn-primary btn-xs" title="Редагувати КП"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/target', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Видалити КП" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Видалити КП',
                                    'onclick'=>'return confirm("Підтверджуєш видалення?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $targets->render() !!} </div>
    </div>
</div>
@endsection
