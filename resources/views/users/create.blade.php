@extends('layouts.nav')
@section('content')
    <div class="container">
        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <div class="form-group mb-3">
                <label for="email">Email</label>
                <input
                    type="text"
                    id="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-control @error('email') is-invalid @enderror""
                >
                @error('email')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="address">Address</label>
                <input
                    type="text"
                    id="address"
                    name="address"
                    value="{{ old('address') }}"
                    class="form-control @error('address') is-invalid @enderror"
                >
                @error('address')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="first_name">First Name</label>
                <input
                    type="text"
                    id="first_name"
                    name="first_name"
                    value="{{ old('first_name') }}"
                    class="form-control @error('first_name') is-invalid @enderror"
                >
                @error('first_name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="second_name">Second Name</label>
                <input
                    type="text"
                    id="second_name"
                    name="second_name"
                    value="{{ old('second_name') }}"
                    class="form-control @error('second_name') is-invalid @enderror"
                >
                @error('second_name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="password">Password</label>
                <input
                    type="text"
                    id="password"
                    name="password"
                    value="{{ old('password') }}"
                    class="form-control @error('password') is-invalid @enderror"
                >
                @error('password')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="phone">Phone</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone') }}"
                    class="form-control @error('phone') is-invalid @enderror"
                >
                @error('phone')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="role_id">Role</label>
                <select id="role_id" name="role_id" class="form-control @error('role_id') is-invalid @enderror">
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Готово</button>
        </form>
    </div>
@endsection
