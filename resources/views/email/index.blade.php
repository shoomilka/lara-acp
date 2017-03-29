@extends('app')

@section('content')
<div class="container">
	<h1>Emails <a href="{{ url('/email/create') }}" class="btn btn-primary btn-xs" title="Додати нову пошту"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Email </th><th> pop3 </th>
                </tr>
            </thead>
            <tbody>
            
            <?php $i = 1 ?>
            @foreach($emails as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->email }}</td>
                    <td>{{ $item->pop3 }}</td>
                    <td>
                        <a href="{{ url('/email/' . $item->id) }}" class="btn btn-success btn-xs" title="Переглянути деталі"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"/></a>
                        <a href="{{ url('/email/' . $item->id . '/edit') }}" class="btn btn-primary btn-xs" title="Редагувати пошту"><span class="glyphicon glyphicon-pencil" aria-hidden="true"/></a>
                        {!! Form::open([
                            'method'=>'DELETE',
                            'url' => ['/email', $item->id],
                            'style' => 'display:inline'
                        ]) !!}
                            {!! Form::button('<span class="glyphicon glyphicon-trash" aria-hidden="true" title="Видалити пошту" />', array(
                                    'type' => 'submit',
                                    'class' => 'btn btn-danger btn-xs',
                                    'title' => 'Delete Email',
                                    'onclick'=>'return confirm("Confirm delete?")'
                            )) !!}
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $emails->render() !!} </div>
    </div>
</div>
@endsection