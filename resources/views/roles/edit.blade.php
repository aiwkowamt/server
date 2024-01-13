@extends('layouts.nav')
@section('content')
    <div class="container">
        <form method="POST" action="{{ route('roles.update', $role->id) }}">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="first_name">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $role->name) }}"
                    class="form-control @error('name') is-invalid @enderror"
                >
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Готово</button>
        </form>
    </div>
@endsection
