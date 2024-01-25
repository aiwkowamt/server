@extends('layouts.nav')
@section('content')
    <form method="GET" action="{{ route('categories.create') }}">
        <button class="btn btn-primary ">Добавить новую категорию</button>
    </form>

    <table class="table table-bordered text-center">
        <thead>
        <tr>
            <th scope="col" class="align-middle">id</th>
            <th scope="col" class="align-middle">name</th>
            <th scope="col" class="align-middle">actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($categories as $category)
            <tr>
                <td class="align-middle">{{ optional($category)->id }}</td>
                <td class="align-middle">{{ optional($category)->name }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
