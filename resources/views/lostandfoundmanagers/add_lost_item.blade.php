@extends('layout.managers')

@section('title', 'Add Lost Item')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Record Lost Item</div>
        </div>
        <form action="{{ route('lfm.lost.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="mb-3">
                    <label for="item_id" class="form-label">Select Item</label>
                    <select name="item_id" class="form-control" required>
                        <option value="">-- Select Item --</option>
                        @foreach($items as $item)
                            <option value="{{ $item->id }}" {{ old('item_id') == $item->id ? 'selected' : '' }}>
                                {{ $item->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                 <div class="mb-3">
                            <label for="type" class="form-label">Item type</label>
                            <input required type="text" name="type" class="form-control" value={{ old('type') }} >
                        </div>
                <div class="mb-3">
                    <label for="date_lost" class="form-label">Date Lost</label>
                    <input type="date" name="date_lost" class="form-control" value="{{ old('date_lost') }}" required>
                </div>
                <div class="mb-3">
                    <label for="" class="form-label">Place Lost</label>
                    <input type="text" name="place_lost" class="form-control" value="{{ old('place_lost') }}" required>
                </div>
                <div class="mb-3">
    <label for="description" class="form-label">Description (optional)</label>
    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
</div>

                <div class="mb-3">
                    <label for="image_url" class="form-label">Image URL (optional)</label>
                    <input type="file" name="image_url" class="form-control"{{ old('image_url') }}>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">
                    <i class="bi-icons bi-save"></i> Submit
                </button>
            </div>
        </form>
    </div>
@endsection
