@extends('layout.admin')

@section('title', 'Temporary IDs')
@section('page-title', 'Temporary IDs')

@section('content')

<div class="mb-3 d-flex gap-2">
    <a href="{{ route('user.temporary-ids.create') }}" class="btn btn-primary text-black">
        Add New
    </a>

    {{-- Only show if the user has at least one record
    @if($idReplacements->count() > 0)
        <a href="{{ route('user.temporary-ids.show', $idReplacements->first()->id) }}"
           class="btn btn-info">
           More Details
        </a>
    @endif --}}
</div>


<table class="table table-bordered">
    <thead>
        <tr>
            <th>Temp ID</th>
            <th>Original ID</th>
            <th>Payment ID</th>
            <th>Status</th>
            <th>Created At</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        @forelse($idReplacements as $idReplacement)
        <tr>
            <td>{{ $idReplacement->id }}</td>
            <td>{{ $idReplacement->id_lost }}</td>
            <td>{{ $idReplacement->payment_id }}</td>

            <td>
                @if($idReplacement->approved)
                    <span class="badge bg-success">Approved</span>
                @else
                    <span class="badge bg-warning text-black">Pending</span>
                @endif
            </td>

            <td>{{ $idReplacement->created_at->format('d-m-Y H:i') }}</td>

            <td>
                <a href="{{ route('user.temporary-ids.show', $idReplacement) }}" class="btn btn-sm btn-info text-black">
                    More Details
                </a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6">No temporary ID requests yet.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
