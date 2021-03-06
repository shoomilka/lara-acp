@extends('app')

@section('content')
<div class="container">
	<h1>Учасник <a href="/index.php/member/create" class="btn btn-primary btn-xs" title="Додати нового учасника"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Ім'я </th><th> Телефон </th><th> Місто </th><th> Рік народження </th><th> Велосипед </th><th> Нік </th><th> Дії </th>
                </tr>
            </thead>
            <tbody>
            
            <?php $i = 1 ?>
            @foreach($members as $item)
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
                            'url' => ['/member', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Видалити учасника" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Видалити учасника',
                                    'onclick'=>'return confirm("Підтверджуєш видалення?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $members->render() !!} </div>
    </div>
</div>
@endsection