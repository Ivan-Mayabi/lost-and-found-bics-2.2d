@extends('layout.managers')

@section('title', 'Verify Claims')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Pending Claims</div>
        </div>
        <div class="card-body">
            @if($claims->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Claim ID</th>
                            <th>Item</th>
                            <th>Claimant</th>
                            <th>Date Claimed</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($claims as $claim)
                        <tr>
                            <td>{{ $claim->id }}</td>
                            <td>{{ $claim->item->name ?? 'N/A' }}</td>
                            <td>{{ $claim->user->name ?? 'N/A' }}</td>
                            <td>{{ $claim->created_at->format('Y-m-d') }}</td>
                            <td>
                                <form action="{{ route('lfm.claims.approve', $claim->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm">
                                        <i class="bi-icons bi-check-circle"></i> Approve
                                    </button>
                                </form>

                                <form action="{{ route('lfm.claims.reject', $claim->id) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi-icons bi-x-circle"></i> Reject
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No pending claims at the moment.</p>
            @endif
        </div>
    </div>
@endsection
