@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">partner_name</th>
            <th scope="col">cost</th>
            <th scope="col">product names</th>
            <th scope="col">status</th>
        </tr>
        </thead>
        <tbody>

        @foreach($orders as $order)
            <tr>
                <th><a href="{{ $order->editLink }}">{{ $order->id }}</a></th>
                <td>{{ $order->partner_name }}</td>
                <td>{{ $order->cost }}</td>
                <td>{{ $order->name_order_composition }}

                </td>
                <td>{{ $order->status }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
