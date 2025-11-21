@extends('layout.admin')

@section('title', 'Claim History')

@section('content')
<div class="container mt-4">

    <h2>Claim History</h2>

    @if($claims->count() == 0)
        <p>No claim history available.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Item</th>
                    <th>Status</th>
                    <th>Claimed On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($claims as $claim)
                <tr>
                    <td>{{ $claim->lostItem->name }}</td>
                    <td>
                        @if($claim->verified)
                            <span class="badge bg-success">Verified</span>
                        @else
                            <span class="badge bg-warning">Pending</span>
                        @endif
                    </td>
                    <td>{{ $claim->created_at->format('d M Y - h:i A') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif

</div>
@endsection

