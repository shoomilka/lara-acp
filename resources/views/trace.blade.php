@extends('app')

@section('content')
<div class="container">
	<h1>Результати</h1>
    <div class="table" style="overflow-x: scroll; white-space: pre;">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th colspan="6"> {{ $trace->title }} </th>
                    <?php $i = 1; ?>
                    @foreach($targets as $item)
                        <?php $i % 2 ? $color = 'info' : $color = ''; ?>
                        <th colspan="3" class="{{ $color }}"> {{ $item->title }} </th>
                        <?php $i++; ?>
                    @endforeach
                    <th colspan="1" rowspan="4"> Результат </th>
                </tr>
                <tr>
                    <th colspan="4"> Дата старту: {{ $trace->start->format('d/m/Y') }} </th>
                    <th colspan="2"> Час: {{ $trace->start->format('H:i') }} </th>
                    <?php $i = 1 ?>
                    @foreach($targets as $item)
                        <?php $i % 2 ? $color = 'info' : $color = ''; ?>
                        @if($i == $targets->count())
                            <th class="{{ $color }}"> Фініш </th>
                        @else
                            <th class="{{ $color }}"> КП {{ $i++ }} </th>
                        @endif
                        <th class="{{ $color }}"> Відстань </th>
                        <th class="{{ $color }}"> {{ $item->coordinate }} км </th>
                    @endforeach
                </tr>
                <tr>
                    <th rowspan="2">S.No</th>
                    <th rowspan="2"> Ім'я </th>
                    <th rowspan="2"> p.н. </th>
                    <th rowspan="2"> Місто </th>
                    <th rowspan="2"> Байк </th>
                    <th rowspan="2"> Нік </th>
                    <?php $i = 1; ?>
                    @foreach($targets as $item)
                        <?php $i % 2 ? $color = 'info' : $color = ''; ?>
                        <th class="{{ $color }}"> Час </th>
                        <th class="{{ $color }}"> В дорозі </th>
                        <th class="{{ $color }}"> V середнє </th>
                        <?php $i++; ?>
                    @endforeach
                </tr>
                <tr>
                    <?php $i = 1; ?>
                    @foreach($targets as $item)
                        <?php $i % 2 ? $color = 'info' : $color = ''; ?>
                        <th colspan="2" class="{{ $color }}"> </th>
                        <th class="{{ $color }}"> км/год </th>
                        <?php $i++; ?>
                    @endforeach
                </tr>
            </thead>
            <tbody>
            
            <?php
                $i = 0;  
            ?>
            @foreach($members as $item)
                <tr>
                    <td>{{ ++$i }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->year }}</td>
                    <td>{{ $item->city }}</td>
                    <td>{{ $item->cycle }}</td>
                    <td>{{ $item->nick }}</td>
                    <?php $j = 1;
                    $prev = $trace->start;
                    $last_co = 0;
                    $flag = 0;
                    ?>
                    @foreach($targets as $target)
                        <?php
                            ($j % 2) ? $color = 'info' : $color = 'success';
                            $check = $checks->where('target_id', $target->id)
                                            ->where('phone', $item->phone)
                                            ->where('checked', '1')
                                            ->sortBy('time')->first();
                        ?>
                        @if(isset($check->time))
                            <td class="{{ $color }}">{{ $check->time->format('d/m H:i') }}</td>
                        <?php
                            $diff = $check->time->diffInMinutes($prev);
                        ?>
                            <td class="{{ $color }}"> {{ str_pad(floor($diff / 60), 2, "0", STR_PAD_LEFT) }}:{{ str_pad(($diff % 60), 2, "0", STR_PAD_LEFT) }} </td>
                            <td class="{{ $color }}"> {{ round(60*($target->coordinate - $last_co)/$diff, 1) }} </td>
                        <?php
                            $flag++;
                            $prev = $check->time;
                            $last_co = $target->coordinate;
                        ?>
                        @else
                            <td class="danger"> - </td>
                            <td class="danger"> - </td>
                            <td class="danger"> - </td>
                        @endif
                        <?php
                            $j++;
                        ?>
                    @endforeach
                    <?php
                        $res = '';
                        if(isset($check->time)){
                            $diff = $check->time->diffInMinutes($trace->start);
                            $res = str_pad(floor($diff / 60), 2, "0", STR_PAD_LEFT) .':'. str_pad(($diff % 60), 2, "0", STR_PAD_LEFT);
                        }
                        $empty_res = $are_results ? 'DNF' : '';
                        $empty_color = $are_results ? 'danger' : '';
                    ?>
                    <td class={{
                        ($flag != $targets->count()) ? (isset($check->time)) ? 'warning' : $empty_color : 'success'
                    }}> {{
                        ($flag != $targets->count()) ? (isset($check->time)) ? $res : $empty_res : $res
                    }} </td>
                </tr>
                <?php $flag = 0; ?>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
