@extends('layout.admin')

@section('title', 'Add Role')

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
                    <div class="card-title">Add Role</div>
                </div>
                <form action="{{ route('roles.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <input required type="name" name="type" class="form-control" value={{ old('type') }} >
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