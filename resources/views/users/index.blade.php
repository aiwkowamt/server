@extends('layouts.nav')
@section('content')
    <form method="GET" action="{{ route('users.create') }}">
        <button class="btn btn-primary ">Добавить нового пользователя</button>
    </form>

    <table class="table table-bordered text-center">
        <thead>
        <tr>
            <th scope="col" class="align-middle">id</th>
            <th scope="col" class="align-middle">email</th>
            <th scope="col" class="align-middle">address</th>
            <th scope="col" class="align-middle">first_name</th>
            <th scope="col" class="align-middle">second_name</th>
            <th scope="col" class="align-middle">phone</th>
            <th scope="col" class="align-middle">role</th>
            <th scope="col" class="align-middle">actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($users as $user)
            <tr>
                <td class="align-middle">{{ optional($user)->id }}</td>
                <td class="align-middle">{{ optional($user)->email }}</td>
                <td class="align-middle">{{ optional($user)->address }}</td>
                <td class="align-middle">{{ optional($user)->first_name }}</td>
                <td class="align-middle">{{ optional($user)->second_name }}</td>
                <td class="align-middle">{{ optional($user)->phone }}</td>
                <td class="align-middle">{{ optional($user->role)->name }}</td>
                <td class="align-middle">
                    <div class="d-flex justify-content-center">
                        <form method="GET" action="{{ route('users.edit', $user->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-warning btn-sm">Изменить</button>
                        </form>
                        <form method="POST" action="{{ route('users.destroy', $user->id) }}">
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
