@extends('app')

@section('content')
<div class="container">
	<h1>Учасник <a href="{{ url('/member/create') }}" class="btn btn-primary btn-xs" title="Додати нового учасника"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Ім'я </th><th> Телефон </th>
                </tr>
            </thead>
            <tbody>
            
            <?php $i = 1 ?>
            @foreach($members as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->name }}</td>
					<td>{{ $item->phone }}</td>
                    <td>
                        <a href="{{ url('/member/' . $item->id) }}" class="btn btn-success btn-xs" title="Переглянути деталі"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/member/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Редагувати учасника"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
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