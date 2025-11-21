@extends('layout.admin')

@section('title', 'Create Claim')

@section('content')
<div class="container mt-4">

    <h2>Claim Item</h2>

    <div class="card p-3 mt-3">
        <h4>{{ $item->name }}</h4>
        <p>{{ $item->description }}</p>

        <form action="{{ route('regular.claims.store') }}" method="POST">
            @csrf
            <input type="hidden" name="lost_item_id" value="{{ $item->id }}">

            <button type="submit" class="btn btn-primary">
                Confirm Claim
            </button>

            <a href="{{ route('regular.claims.index') }}" class="btn btn-secondary">
                Cancel
            </a>
        </form>
    </div>

</div>
@endsection

