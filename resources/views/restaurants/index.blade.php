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
            <th scope="col" class="align-middle">actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($restaurants as $restaurant)
            <tr>
                <td class="align-middle">{{ $restaurant->name }}</td>
                <td class="align-middle">{{ $restaurant->address }}</td>
                <td class="align-middle">{{ $restaurant->phone }}</td>
                <td class="align-middle">
                    @if($restaurant->image_path)
                        <img src="http://localhost:8080/storage/{{ $restaurant->image_path }}" style="width: 95px; height: 80px;" alt="Restaurant Image">
                    @endif
                </td>
                <td class="align-middle">{{ $restaurant->user_id }}</td>
                <td class="align-middle">{{ $restaurant->created_at }}</td>
                <td class="align-middle">{{ $restaurant->updated_at }}</td>
                <td class="align-middle">
                    <div class="d-flex justify-content-center">
                        <form method="GET" action="{{ route('restaurants.edit', $restaurant->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Изменить</button>
                        </form>
                        <form method="POST" action="{{ route('restaurants.destroy', $restaurant->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
