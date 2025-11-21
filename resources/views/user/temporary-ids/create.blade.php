@extends('layout.admin')

@section('page-title', 'Add Temporary ID Request')

@section('content')
<form action="{{ route('user.temporary-ids.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="id_lost" class="form-label">Original ID Number</label>
        <input type="text" class="form-control" id="id_lost" name="id_lost" required>
    </div>
    <div class="mb-3">
        <label for="payment_id" class="form-label">Payment ID</label>
        <input type="text" class="form-control" id="payment_id" name="payment_id" required>
    </div>
    <button type="submit" class="btn btn-success">Add</button>
    <a href="{{ route('user.temporary-ids.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection
