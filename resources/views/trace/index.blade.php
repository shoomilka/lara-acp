@extends('app')

@section('content')
<div class="container">
	<h1>Бревет <a href="{{ url('/trace/create') }}" class="btn btn-primary btn-xs" title="Додати новий бревет"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Назва </th><th> Email </th><th> Початок </th><th> Завершення </th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            @foreach($traces as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->title }}</td>
					<td>{{ $item->email_id }}</td>
                    <td>{{ $item->start }}</td>
                    <td>{{ $item->finish }}</td>
                    <td>
                        <a href="{{ url('/trace/' . $item->id) }}" class="btn btn-success btn-xs" title="Переглянути деталі"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/trace/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Редагувати"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/trace', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Видалити" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Видалити',
                                    'onclick'=>'return confirm("Прив'язані КП також будуть стерті. Підтверджуєш видалення?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $traces->render() !!} </div>
    </div>
</div>
@endsection
