@extends('layout')

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Salt</th>
            <th scope="col">PH</th>
            <th scope="col">KH</th>
            <th scope="col">CA</th>
            <th scope="col">MG</th>
            <th scope="col">NO3</th>
            <th scope="col">PO4</th>
            <th scope="col">Temp</th>
            <th scope="col">Time</th>
        </tr>
        </thead>
        <tbody>
        @foreach($points as $key => $point)
            <tr>
                <th scope="row">{{$key + 1}}</th>
                <td class="table-secondary">{{$point['salt']}}</td>
                <td class="table-secondary">{{$point['ph']}}</td>
                <td class="table-info">{{$point['kh']}}</td>
                <td class="table-info">{{$point['ca']}}</td>
                <td class="table-info">{{$point['mg']}}</td>
                <td class="table-success">{{$point['no3']}}</td>
                <td class="table-success">{{$point['po4']}}</td>
                <td class="table-warning">{{$point['temp']}}</td>
                <td>{{$point['time']}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
