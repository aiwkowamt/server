@extends('layouts.nav')
@section('content')
    <form method="GET" action="{{ route('roles.create') }}">
        <button class="btn btn-primary">Добавить новую роль</button>
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
        @foreach($roles as $role)
            <tr>
                <td class="align-middle">{{ $role->id }}</td>
                <td class="align-middle">{{ $role->name }}</td>
                <td class="align-middle">
                    <div class="d-flex justify-content-center">
                        <form method="GET" action="{{ route('roles.edit', $role->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Изменить</button>
                        </form>
                        <form method="POST" action="{{ route('roles.destroy', $role->id) }}">
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
