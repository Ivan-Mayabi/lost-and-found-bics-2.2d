@extends('layout.admin')

@section('title', 'Add User')

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
                    <div class="card-title">Add User</div>
                </div>
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input required type="name" name="name" class="form-control" value={{ old('name') }} >
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input required type="email" name="email" class="form-control" value={{ old('email') }}>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Role</label>
                            <select name="role" class="form-control">
                                <option value="">-- Please select User Role --</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" {{ (old('role') == $role->id) ? 'selected' : "" }}>{{$role->type}}</option>
                                @endforeach
                            </select>
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