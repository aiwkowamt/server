@extends('layouts.nav')

@section('content')
    <form method="POST" action="{{ route('declarations.update', $declaration) }}">
        @csrf
        @method('PUT')

        <div>
            <label for="status">Статус:</label>
            <select name="status" class="form-control">
                @foreach($status as $element)
                    <option value="{{ $element }}" {{ $element == $declaration->status ? 'selected' : '' }}>
                        {{ $element }}
                    </option>
                @endforeach
            </select>
        </div>

        <div>{{ optional($declaration)->id }}</div>
        <div>{{ optional($declaration)->user_id }}</div>
        <div>{{ optional($declaration)->description }}</div>

        <button type="submit" class="btn btn-primary mt-2">Update</button>
    </form>
@endsection
