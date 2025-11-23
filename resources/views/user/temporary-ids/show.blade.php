@extends('layout.admin')

@section('page-title', 'Temporary ID Details')

@section('content')
<div class="card">
    <div class="card-body">
        <h5 class="card-title">Temporary ID #{{ $idReplacement->id }}</h5>
        <br>
        <p><strong>Original ID:</strong> {{ $idReplacement->id_lost }}</p>
        <p><strong>Payment ID:</strong> {{ $idReplacement->payment_id }}</p>
        <p><strong>Status:</strong>
            @if($idReplacement->approved)
                <span class="badge bg-success">Approved</span>
            @else
                <span class="badge bg-warning">Pending</span>
            @endif
        </p>
        <p><strong>Created At:</strong> {{ $idReplacement->created_at->format('d-m-Y H:i') }}</p>
        <a href="{{ route('user.temporary-ids.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
