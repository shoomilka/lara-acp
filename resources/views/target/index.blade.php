@extends('app')

@section('content')
<div class="container">
	<h1>КП <a href="/index.php/target/create" class="btn btn-primary btn-xs" title="Додати нове КП"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Назва </th><th> Кілометр </th><th> Початок </th><th> Завершення </th><th> Дії </th>
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