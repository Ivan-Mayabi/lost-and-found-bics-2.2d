@extends('layout.managers')

@section('title', 'Edit Item')
@section('page-title', 'Edit Item')


@section('content')
<div class="card card-primary card-outline">
  <div class="card-header">
    <h4>Edit Item</h4>
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('lfm.items.update', $item->id) }}">
      @csrf
      @method('PUT')

      <div class="form-group mb-3">
        <label for="name">Item Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $item->name) }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="type">Item Type</label>
        <input type="text" name="type" class="form-control" value="{{ old('type', $item->type) }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="description">Description</label>
        <textarea name="description" class="form-control" required>{{ old('description', $item->description) }}</textarea>
      </div>

      <button type="submit" class="btn btn-primary">Update</button>
      <a href="{{ route('lfm.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection
