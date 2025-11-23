@extends('layout.managers')

@section('title', 'Make ID Replacement Approvals')
@section('page-title', 'Make ID Replacement Approvals')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card card-primary card-outline mb-4">
        <div class="card-header">
            <div class="card-title">Approved</div>
        </div>
        <div class="card-body">
            @if($replacements->count() > 0)
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Replacement ID</th>
                            <th>Payment ID</th>
                            <th>User ID</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Approved</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($replacements as $replacement)
                        <tr>
                            <td>{{ $replacement->id }}</td>
                            <td>{{ $replacement->payment_id ?? 'N/A' }}</td>
                            <td>{{ $replacement->user->name }}</td>
                            @if($replacement->approved == 1)
                                <td><span class="badge bg-success">{{ $replacement->approved }} Approved</span></td>
                            @elseif($replacement->approved == 0)
                                <td><span class="badge bg-danger">Not Approved</span></td>
                            @else
                                <td><span class="badge bg-warning text-black">Pending</span></td>
                            @endif
                            <td>{{ $replacement->created_at->format('Y-m-d') }}</td>
                            <td>
                                @if($replacement->approved==0 && auth()->user()->isAdmin())
                                    <form action="{{ route('id-replacements.approve', $replacement->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="bi-icons bi-check-circle"></i> Approve
                                        </button>
                                    </form>
                                @elseif($replacement->approved==1 && auth()->user()->isAdmin())
                                    <form action="{{ route('id-replacements.reject',$replacement->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi-icons bi-x-circle"></i> Reject
                                        </button>
                                    </form>
                                @elseif($replacement->approved==2)
                                    <form action="{{ route('id-replacements.approve', $replacement->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm">
                                            <i class="bi-icons bi-check-circle"></i> Approve
                                        </button>
                                    </form>

                                    <form action="{{ route('id-replacements.reject',$replacement->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi-icons bi-x-circle"></i> Reject
                                        </button>
                                    </form>

                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>All approved replacements have been processed.</p>
            @endif
        </div>
    </div>
@endsection
