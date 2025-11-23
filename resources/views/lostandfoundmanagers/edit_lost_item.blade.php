@extends('layout.managers')

@section('title', 'Edit Lost Item')

@section('content')
<div class="card card-primary card-outline">
  <div class="card-header">
    <h4>Edit Lost Item</h4>
  </div>
  <div class="card-body">
    <form method="POST" action="{{ route('lfm.lostitems.update', $lostItem->id) }}" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="form-group mb-3">
        <label for="item_id">Select Item</label>
        <select name="item_id" class="form-control" required>
          @foreach($items as $item)
            <option value="{{ $item->id }}" {{ $lostItem->item_id == $item->id ? 'selected' : '' }}>
              {{ $item->name }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="form-group mb-3">
        <label for="date_lost">Date Lost</label>
        <input type="datetime-local" name="date_lost" class="form-control" value="{{ old('date_lost', $lostItem->date_lost) }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="place_lost">Place Lost</label>
        <input type="text" name="place_lost" class="form-control" value="{{ old('place_lost', $lostItem->place_lost) }}" required>
      </div>

      <div class="form-group mb-3">
        <label for="description">Description</label>
        <textarea name="description" class="form-control">{{ old('description', $lostItem->description) }}</textarea>
      </div>

      <div class="form-group mb-3">
        <label for="image_url">Image URL</label>
        <input type="file" name="image_url" class="form-control" value="{{ old('image_url', $lostItem->image_url) }}">
      </div>

      <button type="submit" class="btn btn-primary">Update Lost Item</button>
      <a href="{{ route('lfm.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
  </div>
</div>
@endsection
