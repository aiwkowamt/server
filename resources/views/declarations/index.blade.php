@extends('layouts.nav')
@section('content')
    <table class="table table-bordered text-center">
        <thead>
        <tr>
            <th scope="col" class="align-middle">id</th>
            <th scope="col" class="align-middle">user_id</th>
            <th scope="col" class="align-middle">description</th>
            <th scope="col" class="align-middle">status</th>
            <th scope="col" class="align-middle">actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($declarations as $declaration)
            <tr>
                <td class="align-middle">{{ optional($declaration)->id }}</td>
                <td class="align-middle">{{ optional($declaration)->user_id }}</td>
                <td class="align-middle">{{ optional($declaration)->description }}</td>
                <td class="align-middle">{{ optional($declaration)->status }}</td>
                <td class="align-middle">
                    <div class="d-flex justify-content-center">
                        <form method="GET" action="{{ route('declarations.edit', $declaration) }}">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Рассмотреть</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
