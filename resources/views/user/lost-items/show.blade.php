@extends('layout.admin')

@section('title', 'Lost Item Details')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-4">Lost Item Details</h1>

    @if(session('success'))
        <div class="bg-green-200 text-green-800 px-4 py-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded p-6 d-flex justify-content-evenly">
        <div>
            <div class="mb-4">
                <strong>Description:</strong>
                <p>{{ $itemLost->description }}</p>
            </div>

            <div class="mb-4">
                <strong>Date Lost:</strong>
                <p>{{ $itemLost->date_lost }}</p>
            </div>

            <div class="mb-4">
                <strong>Place Lost:</strong>
                <p>{{ $itemLost->place_lost ?? 'N/A' }}</p>
            </div>

            <div class="mb-4">
                <strong>Associated Item:</strong>
                <p>{{ $itemLost->item ? $itemLost->item->name : 'Not linked' }}</p>
            </div>

            <div class="mb-4">
                <strong>Status:</strong>
                <p>{{ $itemLost->taken ? 'Taken' : 'Not taken' }}</p>
            </div>
        </div>
        
        <div>
            <div class="mb-4">
                {{-- <strong>Image:</strong> --}}
                <img src="{{ preg_match('/^https:\/\/via\.placeholder\.com\/640x480\.png\/?/',$itemLost->image_url)==1 || !isset($itemLost->image_url)  ? asset('favicon.png') : asset('storage/' .$itemLost->image_url) }}" alt="Lost item image" class="h-auto w-50 rounded shadow">
            </div>
        <div>

        {{-- Claim Button --}}
        @if(!$itemLost->taken)
            <form action="{{ route('user.claims.store', $itemLost->id) }}" method="POST" class="mt-4">
                @csrf
                <button type="submit" 
                        class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
                    Claim Item
                </button>
            </form>
        @else
            <p class="text-red-500 font-semibold mt-4">This item has already been taken.</p>
        @endif

        <a href="{{ route('user.lost-items.index') }}" class="inline-block mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Back to Lost Items
        </a>
    </div>
</div>
@endsection