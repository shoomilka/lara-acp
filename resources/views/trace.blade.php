@extends('app')

@section('content')
<div class="container">
	<h1>Результати</h1>
    <div class="table" style="overflow-x: scroll; white-space: pre;">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th colspan="6"> {{ $trace->title }} </th>
                    @foreach($targets as $item)
                        <th colspan="3"> {{ $item->title }} </th>
                    @endforeach
                    <th colspan="1" rowspan="3"> Відстав </th>
                    <th colspan="1" rowspan="3"> Рзультат </th>
                </tr>
                <tr>
                    <th colspan="4"> Дата старту: {{ $trace->start->format('d/m/Y') }} </th>
                    <th colspan="2"> Час: {{ $trace->start->format('h:i') }} </th>
                    <?php $i = 1 ?>
                    @foreach($targets as $item)
                        <th> КП {{ $i++ }} </th>
                        <th> Відстань </th>
                        <th> {{ $item->coordinate }} km </th>
                    @endforeach
                </tr>
                <tr>
                    <th rowspan="2">S.No</th>
                    <th rowspan="2"> Ім'я </th>
                    <th rowspan="2"> Рік народження </th>
                    <th rowspan="2"> Місто </th>
                    <th rowspan="2"> Байк </th>
                    <th rowspan="2"> Нік </th>
                    @foreach($targets as $item)
                        <th> Час </th>
                        <th> В дорозі </th>
                        <th> V середнє </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            
            <?php
                $i = 0;
                $prev = $trace->start;
                $last_co = 0;
                $flag = 0;
            ?>

            @foreach($members as $item)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->year }}</td>
                    <td>{{ $item->city }}</td>
                    <td>{{ $item->cycle }}</td>
                    <td>{{ $item->nick }}</td>
                    @foreach($targets as $target)
                        <?php
                            $check = $checks->where('target_id', $target->id)
                                            ->where('phone', $item->phone)
                                            ->where('checked', '1')
                                            ->sortBy('time')->first();
                        ?>
                        @if(isset($check->time))
                            <td>{{ $check->time->format('d/m h:i:s') }}</td>
                        <?php
                            $diff = $check->time->diffInMinutes($prev);
                        ?>
                            <td> {{ $diff }} хв.</td>
                            <td> {{ 60*($target->coordinate - $last_co)/$diff }} </td>
                        <?php
                            $flag++;
                            $prev = $check->time;
                            $last_co = $target->coordinate;
                        ?>
                        @else
                            <td> - </td>
                            <td> - </td>
                            <td> - </td>
                        @endif
                    @endforeach
                    <td> - </td>
                    <td> {{ ($flag != $targets->count()) ? 'DNF' : 'Congratulations!' }} </td>
                </tr>
                <?php $flag = 0; ?>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
