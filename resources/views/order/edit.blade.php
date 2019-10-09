@extends('layouts.app')

@section('content')
    <form method="POST" action="{{ route('orders.update', $order) }}">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-group">
            <label for="client_email">Client Email</label>
            <input required name="client_email" value="{{ old('client_email', $order->client_email) }}" type="email"
                   class="form-control" id="client_email" placeholder="Enter email">
        </div>

        <div class="form-group">
            <label for="partner_id">select partner</label>
            <select required name="partner_id" class="form-control" id="partner_id">
                @foreach($partners as $partner)
                    <option
                            {{ old('partner_id', $order->partner_id) == $partner->id ? 'selected' : '' }}
                            value="{{$partner->id}}">{{ $partner->name }}</option>
                @endforeach
            </select>
        </div>

        @foreach($order->orderProducts as $orderProductItem)
            <div class="form-row">
                <div class="col">
                    <input value="{{ $orderProductItem->product->name }} ({{ $orderProductItem->product->price }}) - {{ $orderProductItem->quantity }}" disabled type="text" class="form-control">
                </div>
            </div>
        @endforeach

        <div class="form-group">
            <label for="status">select status</label>
            <select required name="status" class="form-control" id="status">
                @foreach($statuses as $key => $status)
                    <option
                            {{ old('status', $order->status) == $key ? 'selected' : '' }}
                            value="{{ $key }}">{{ $status }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="cost">Стоимость заказа</label>
            <input disabled value="{{ $order->orderProducts->sum('cost') }}" type="text" class="form-control" id="cost">
        </div>

        <button type="submit" class="btn btn-primary">Save</button>
    </form>
@endsection
