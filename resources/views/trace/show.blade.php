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
                    <th>S.No</th><th> Назва </th><th> Координата </th><th> Початок </th><th> Завершення </th><th> Дії </th>
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
    <h1> Учасники </h1>
    {!! Form::open(['url' => '/register/'.$trace->id, 'class' => 'form-horizontal', 'style' => 'display:inline', 'files' => true]) !!}
            <div class="form-group {{ $errors->has('member_id') ? 'has-error' : ''}}">
                {!! Form::label('member_id', 'Учасник', ['class' => 'col-sm-2 control-label']) !!}
                <div class="col-sm-6">
                    {!! Form::select('member_id', $members, null, ['class' => 'form-control', 'style' => 'display:inline']) !!}
                    {!! $errors->first('member_id', '<p class="help-block">:message</p>') !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::submit('Додати', ['class' => 'btn btn-primary form-control', 'style' => 'display:inline']) !!}
                </div>
            </div>
    {!! Form::close() !!}
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Ім'я </th><th> Телефон </th><th> Місто </th><th> Рік народження </th><th> Велосипед </th><th> Нік </th><th> Дії </th>
                </tr>
            </thead>
            <tbody>
            
            <?php $i = 1 ?>
            @foreach($current_members as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->name }}</td>
					<td>{{ $item->phone }}</td>
                    <td>{{ $item->city }}</td>
                    <td>{{ $item->year }}</td>
                    <td>{{ $item->cycle }}</td>
                    <td>{{ $item->nick }}</td>
                    <td>
                        <a href="{{ '/index.php/member/' . $item->id }}" class="btn btn-success btn-xs" title="Переглянути деталі"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ '/index.php/member/' . $item->id . '/edit' }}" class="btn btn-primary btn-xs" title="Редагувати учасника"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/register/'.$trace->id.'/'.$item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-remove-sign" aria-hidden="true" title="Відписати учасника" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Відписати учасника',
                                    'onclick'=>'return confirm("Підтверджуєш зняття з реєстрації?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $current_members->render() !!} </div>
    </div>
</div>
@endsection
