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
                <label for="image_path">Новое изображение</label>
                <input type="file" id="image_path" name="image_path" class="form-control-file @error('image_path') is-invalid @enderror">
                @error('image_path')
                <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <img src="http://localhost:8080/storage/{{ $restaurant->image_path }}" style="width: 95px; height: 80px;" alt="Restaurant Image">

            <button type="submit" class="btn btn-primary">Готово</button>
        </form>
    </div>
@endsection
