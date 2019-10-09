@extends('layouts.app')

@section('content')

    <div class="text-center">
        <span>{{ $cityName }} температура {{ $weather }}°</span>
    </div>

    @include('passhunter.withUmbrella')

@endsection