
@extends('layout.managers')

@section('title', 'Add Item')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </div>
    @endif

    <div class="card card-primary card-outline mb-4">
                <div class="card-header">
                    <div class="card-title">Add Item</div>
                </div>
                <form action="{{ route('lfm.items.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Item name</label>
                            <input required type="text" name="name" class="form-control" value={{ old('name') }} >
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Item type</label>
                            <input required type="text" name="type" class="form-control" value={{ old('type') }} >
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Item description</label>
                            <textarea required name="description" class="form-control">{{ old('description') }}</textarea>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi-icons bi-save"></i> Submit
                        </button>
                    </div>
                </form>
            </div>
    </form>

@endsection