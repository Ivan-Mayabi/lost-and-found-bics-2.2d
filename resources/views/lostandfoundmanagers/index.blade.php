@extends('layout.managers')

@section('title', 'Lost & Found Dashboard')

@section('content')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="row">
    <!-- Items Card -->
    <div class="col-md-6">
        <div class="card card-primary card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Items</div>
                <a href="{{ route('lfm.items.create') }}" class="btn btn-sm btn-primary float-end">
                    <i class="bi-icons bi-plus-circle"></i> Add Item
                </a>
            </div>
            <div class="card-body">
                @if($items->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
    @foreach($items as $item)
    <tr>
        <td>{{ $item->id }}</td>
        <td>{{ $item->name }}</td>
        <td>{{ $item->type }}</td>
        <td>
            <a href="{{ route('lfm.items.edit', $item->id) }}" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil-square"></i> Edit
            </a>

            <form action="{{ route('lfm.items.delete', $item->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this item?')">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
                    </table>
                    {{ $items->links('pagination::bootstrap-5') }}
                @else
                    <p>No items added yet.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- Lost Items Card -->
    <div class="col-md-6">
        <div class="card card-warning card-outline mb-4">
            <div class="card-header">
                <div class="card-title">Lost Items</div>
                <a href="{{ route('lfm.lost.create') }}" class="btn btn-sm btn-warning float-end">
                    <i class="bi-icons bi-plus-circle"></i> Add Lost Item
                </a>
            </div>
            <div class="card-body">
                @if($lostItems->count() > 0)
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Item Image</th>
                                <th>Item Name</th>
                                <th>Date Lost</th>
                                <th>Place Lost</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
    @foreach($lostItems as $lost)
    <tr>
        <td>{{ $lost->id }}</td>
        <td>
            <img src="{{ asset('storage/'.$lost->image_url)}}" alt="Lost Image" width="100vh">
        </td>
        <td>{{ $lost->item->name ?? 'N/A' }}</td>
        <td>{{ $lost->date_lost }}</td>
        <td>{{ $lost->place_lost }}</td>
        <td>
            <a href="{{ route('lfm.lostitems.edit', $lost->id) }}" class="btn btn-sm btn-warning">
                <i class="bi bi-pencil-square"></i> Edit
            </a>

            <form action="{{ route('lfm.lostitems.delete', $lost->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this lost item?')">
                    <i class="bi bi-trash"></i> Delete
                </button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>
                    </table>
                    {{ $lostItems->links('pagination::bootstrap-5') }}
                @else
                    <p>No lost items recorded yet.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Pending Claims Card -->
<div class="card card-success card-outline mb-4">
    <div class="card-header">
        <div class="card-title">Pending Claims</div>
        <a href="{{ route('lfm.claims.index') }}" class="btn btn-sm btn-success float-end">
            <i class="bi-icons bi-check-circle"></i> Verify Claims
        </a>
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
                    </tr>
                </thead>
                <tbody>
                    @foreach($claims as $claim)
                    <tr>
                        <td>{{ $claim->id }}</td>
                        <td>{{ $claim->item_lost->item->name ?? 'N/A' }}</td>
                        <td>{{ $claim->user->name ?? 'N/A' }}</td>
                        <td>{{ $claim->created_at->format('Y-m-d') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $claims->links('pagination::bootstrap-5') }}
        @else
            <p>No pending claims.</p>
        @endif
    </div>
</div>

@endsection
