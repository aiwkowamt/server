@extends('layouts.nav')
@section('content')
    <div class="container">
        <form method="POST" action="{{ route('restaurants.update', $restaurant->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="name">Name</label>
                <input
                    type="text"
                    id="name"
                    name="name"
                    value="{{ old('name', $restaurant->name) }}"
                    class="form-control @error('name') is-invalid @enderror"
                >
                @error('name')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="phone">Phone</label>
                <input
                    type="text"
                    id="phone"
                    name="phone"
                    value="{{ old('phone', $restaurant->phone) }}"
                    class="form-control @error('phone') is-invalid @enderror"
                >
                @error('phone')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="image">Новое изображение</label>
                <input type="file" id="image" name="image" class="form-control-file @error('image') is-invalid @enderror">
                @error('image')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary" onclick="return confirm('Вы уверены?')">Готово</button>
        </form>
    </div>
@endsection
