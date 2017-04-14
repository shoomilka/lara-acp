@extends('app')

@section('content')
<div class="container">
	<h1>Checks</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Phone </th><th> Time </th><th> Target Title </th>
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
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $checks->render() !!} </div>
    </div>
</div>
@endsection
