@extends('layout.admin')

@section('content')
<div class="container">
    <h1>Report a Lost Item</h1>

    <form action="{{ route('user.lost-items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="item_id">Item Name</label>
            <input type="text" name="item_name" id="item_name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="date_lost">Date Lost</label>
            <input type="date" name="date_lost" id="date_lost" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="place_lost">Place Lost</label>
            <input type="text" name="place_lost" id="place_lost" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" class="form-control" rows="3"></textarea>
        </div>

        <div class="form-group">
            <label for="image_url">Image (optional)</label>
            <input type="file" name="image_url" id="image_url" class="form-control">
        </div>

        <button type="submit" class="btn btn-success mt-2">Submit</button>
    </form>
</div>
@endsection
