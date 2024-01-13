@extends('layouts.nav')
@section('content')
    <div class="container">
        <form method="POST" action="{{ route('roles.store') }}">
            @csrf

            <div class="form-group mb-3">
                <label for="first_name">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name') }}"
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
