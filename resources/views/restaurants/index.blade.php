@extends('layouts.nav')
@section('content')
    <table class="table table-bordered text-center">
        <thead>
        <tr>
            <th scope="col" class="align-middle">name</th>
            <th scope="col" class="align-middle">address</th>
            <th scope="col" class="align-middle">phone</th>
            <th scope="col" class="align-middle">image</th>
            <th scope="col" class="align-middle">user_id</th>
            <th scope="col" class="align-middle">created_at</th>
            <th scope="col" class="align-middle">updated_at</th>
        </tr>
        </thead>
        <tbody>
        @foreach($restaurants as $restaurant)
            <tr>
                <td class="align-middle">{{ $restaurant->name }}</td>
                <td class="align-middle">{{ $restaurant->address }}</td>
                <td class="align-middle">{{ $restaurant->phone }}</td>
                <td class="align-middle">{{ $restaurant->image }}</td>
                <td class="align-middle">{{ $restaurant->user_id }}</td>
                <td class="align-middle">{{ $restaurant->created_at }}</td>
                <td class="align-middle">{{ $restaurant->updated_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
