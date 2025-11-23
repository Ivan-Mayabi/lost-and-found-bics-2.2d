@extends('layout.admin')

@section('page-title', 'Temporary ID Details')

@section('content')
<div class="card">
    <div class="card-body">
        <p><strong>Temporary ID #{{ $idReplacement->id }}</strong><p>
        <p><strong>Original ID:</strong> {{ $idReplacement->id_lost }}</p>
        <p><strong>Payment ID:</strong> {{ $idReplacement->payment_id }}</p>
        <p><strong>Status:</strong>
            @if($idReplacement->approved==1)
                <span class="badge bg-success">Approved</span>
            @elseif($idReplacement->approved==0)
                <span class="badge bg-danger">Not Approved</span>
            @else
                <span class="badge bg-warning text-black">Pending</span>
            @endif
        </p>
        <p><strong>Created At:</strong> {{ $idReplacement->created_at->format('d-m-Y H:i') }}</p>
        <p><strong>Valid Up To and Including:</strong>
        @if($idReplacement->approved==1)
                <span class="badge bg-success">{{ date('d M Y', strtotime($idReplacement->created_at->modify('+7 days'))) }}</span>
        @endif
        </p>
        <a href="{{ route('user.temporary-ids.index') }}" class="btn btn-secondary">Back</a>
    </div>
</div>
@endsection
