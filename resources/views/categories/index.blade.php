@extends('template::layouts.app')
@section('main')
<h1 class="mb-4">Categories</h1>

<form method="GET" action="{{ route('categories.index') }}" class="mb-4">
    <div class="input-group">
        <input type="text" name="search" value="{{ old('search', $search) }}" placeholder="Search categories"
            class="form-control">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Published</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($categories as $category)
        <tr>
            <td>{{ $category->id }}</td>
            <td>{{ $category->name }}</td>
            <td>{{ $category->is_publish ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center">
    {{ $categories->withQueryString()->links('pagination::bootstrap-4') }}
</div>

<a href="{{ route('categories.create') }}" class="btn btn-success mt-4">Create New Category</a>
@endsection