@extends('layout.admin')
@section('title','Lost Items')

@section('content')
<div class="container mx-auto py-6">
    @section('page-title','Lost Items')

    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('user.lost-items.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">
        Report a Lost Item
    </a>

    {{-- Search Form --}}
    <div class="mb-4">
        <form action="{{ route('user.lost-items.index') }}" method="GET" class="flex gap-2">
            <input 
                type="text" 
                name="search" 
                value="{{ request('search') }}" 
                placeholder="Search by description, item, or location" 
                class="border form-control w-50 d-inline rounded px-3 py-2 w-full"
            />
            <button type="submit" class="bg-blue-500 btn btn-success text-white px-4 py-2 rounded hover:bg-blue-600">
                <img width="20vw" src="https://img.icons8.com/ios-glyphs/30/search--v1.png" alt="Search V1"/>
                Search
            </button>
        </form>
    </div>

    @if($lostItems->isEmpty())
        <p class="text-gray-600">No lost items reported yet.</p>
    @else
        <table class="min-w-full bg-white border rounded">
            <thead>
                <tr>
                    <th class="border px-4 py-2">Image</th>
                    <th class="border px-4 py-2">Description</th>
                    <th class="border px-4 py-2">Date Lost</th>
                    <th class="border px-4 py-2">Place Lost</th>
                    <th class="border px-4 py-2">Item</th>
                    <th class="border px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($lostItems as $item)
                    <tr>
                        <td class="border px-4 py-2"><img class=".img-fluid" width="100vw" src="{{ is_null($item->image_url)||preg_match("/^https:\/\/via\.placeholder\.com\/640x480?/",$item->image_url) ? asset('favicon.png') : asset('storage/'.$item->image_url)}}" ></td>
                        <td class="border px-4 py-2">{{ $item->description }}</td>
                        <td class="border px-4 py-2">{{ $item->date_lost }}</td>
                        <td class="border px-4 py-2">{{ $item->place_lost }}</td>
                        <td class="border px-4 py-2">{{ $item->item ? $item->item->name : 'N/A' }}</td>
                        <td class="border px-4 py-2">
                            <a href="{{ route('user.lost-items.show', $item->id) }}" class="text-blue-500 hover:underline">
                                View
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection