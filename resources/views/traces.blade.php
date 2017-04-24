@extends('app')

@section('content')
<div class="container">
	<h1>Бревет</h1>
    <div class="table">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>S.No</th><th> Назва </th><th> Початок </th><th> Завершення </th>
                </tr>
            </thead>
            <tbody>
            <?php $i = 1 ?>
            @foreach($traces as $item)
                <tr>
                    <td>{{ $i++ }}</td>
                    <td><a href="/index.php/results/{{ $item->id }}">{{ $item->title }}</a></td>
                    <td>{{ $item->start }}</td>
                    <td>{{ $item->finish }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <div class="pagination-wrapper"> {!! $traces->render() !!} </div>
    </div>
</div>
@endsection
