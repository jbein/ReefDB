@extends('layout')

@section('content')
    <table class="table table-hover">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">time</th>
            <th scope="col">{{$stat}}</th>
        </tr>
        </thead>
        <tbody>
    @foreach($points as $key => $point)
        <tr>
            <td>{{$key + 1}}</td>
        @foreach ($point as $pkey => $pvalue)
            <td>{{$pvalue}}</td>
        @endforeach
        </tr>
    @endforeach
        </tbody>
    </table>
@endsection
