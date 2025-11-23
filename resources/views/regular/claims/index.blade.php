@extends('layout.admin') 

{{-- Page Title in Browser Tab --}}
@section('title', 'Claims')

{{-- Page Heading --}}
@section('page-title', 'Claims')

@section('content')
<div class="container mt-4">

    @if(auth()->user()->isAdmin())
        <h2 class="mb-3">All Claims</h2>
    @else
        <h2 class="mb-3">My Claims</h2>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($claims)<1)
        <p>You haven't claimed any items yet.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Item Name</th>
                    <th>Description</th>
                    @if(auth()->user()->isAdmin())
                        <th>Claimant</th>
                    @endif
                    <th>Status</th>
                    <th>Taken</th>
                    <th>Date Claimed</th>
                </tr>
            </thead>
            <tbody>
                @foreach($claims as $claim)
                <tr>
                    <td>{{ $claim->lostItem->item->name }}</td>
                    <td>{{ $claim->lostItem->description }}</td>
                    @if(auth()->user()->isAdmin())
                        <td>{{ $claim->user->name }}</td>
                    @endif
                    <td>
                        @if($claim->verified==1)
                            <span class="badge bg-success">Verified</span>
                        @elseif($claim->verified==0)
                            <span class="badge bg-danger">Not Verified</span>
                        @else
                            <span class="badge bg-warning text-black">Pending</span>
                        @endif
                    </td>
                    @if($claim->lostItem->taken == 0)
                        <td><span class="badge bg-warning text-black">Not yet Taken</span></td>
                    @else
                        <td><span class="badge bg-success">{{ date('d M Y', strtotime($claim->lostItem->date_taken))}}</span></td>
                    @endif
                    <td>{{ $claim->created_at->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @if(auth()->user()->isAdmin())
            {{$claims->links('pagination::bootstrap-5')}}
        @endif
    @endif

</div>
@endsection

