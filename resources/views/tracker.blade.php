@extends('layout')

@section('content')
    <table>
        <thead>
        <tr class="table-head">
            <th class="wide">Name</th>
            <th>Total</th>
            <th>{{ $period }}</th>
        </tr>
        </thead>
        <tbody>
        @foreach($items as $item)
            <tr>
                <td>{{$item->item->name}}</td>
                <td>{{$item->total_items}}</td>
                <td>{{$item->today_items}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
