@extends('app')

@section('content')
<div class="container">
	<h1>Checks <a href="{{ '/index.php/check/create' }}" class="btn btn-primary btn-xs" title="Додати новий"><span class="glyphicon glyphicon-plus" aria-hidden="true"/></a></h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Phone </th><th> Time </th><th> Target Title </th><th> Target </th>
                </tr>
            </thead>
            <tbody>
            
            <?php $i = 1 ?>
            @foreach($checks as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td>{{ $item->phone }}</td>
                    <td>{{ $item->time }}</td>
                    <td>{{ $item->target_title }}</td>
                    <td>
                        {!! Form::open([
                            'method'=>'PATCH',
                            'url' => ['/check', $item->id],
                            'style' => 'display:inline',
							'class' => 'form-inline'
                        ]) !!}
                            {!! Form::select('target_id', $targets, null, ['class' => 'form-control']) !!}
							{!! Form::submit('Підтвердити', ['class' => 'btn btn-primary form-control']) !!}
						{!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $checks->render() !!} </div>
    </div>
</div>
@endsection
