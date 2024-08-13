@extends('template::layouts.app')
@section('main')

<h1 class="mb-4">Edit Category</h1>

<form action="{{route('categories.update', $category->id)}}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="name" class="form-label">Name:</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $category->name) }}">
        @error('name')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="is_publish" class="form-label">Published</label>
        <select id="is_publish" name="is_publish" class="form-select">
            <option value="1" {{ old('is_publish', $category->is_publish) == '1' ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('is_publish', $category->is_publish) == '0' ? 'selected' : '' }}>No</option>
        </select>
        @error('is_publish')
        <div class="text-danger">{{ $message }}</div>
        @enderror
    </div>
    

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
</form>

@endsection