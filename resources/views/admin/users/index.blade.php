@extends('layout.admin')

{{-- Page Title in Browser Tab --}}
@section('title', 'Users')

{{-- Page Heading --}}
@section('page-title', 'Users')

{{-- Breadcrumb --}}
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Users</li>
@endsection

{{-- Main Content --}}
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Users</h3>
        <div class="card-tools">
          <a href=" {{ route('users.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add New User
          </a>
        </div>
      </div>
      <!-- /.card-header -->
      
      <div class="card-body">
          <table class="table table-bordered table-striped" style="border-collapse:collapse">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
                <th>Created At</th>
                <th style="width: 200px">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($users as $user)
              <tr>
                {{-- Can have {{ $loop->iteration }} --}}
                <td>{{$loop->iteration}}</td>
                <td> {{$user->name}}</td>
                <td>
                    {{$user->email}}
                        @if (!is_null($user->email_verified_at))
                        <span class="badge bg-success">
                            <i class="bi bi-check-circle" title="Email Verified at: {{ $user->email_verified_at }}"></i>
                        </span>
                        @else
                        <span class="badge bg-danger">
                            <i class="bi bi-x-circle" title="Email not verified"></i>
                        </span>
                        @endif
                </td>
                <td>{{$user->role->type}}</td>
                @if($user->active==1)
                  <td class="bg-success">Active</td>
                @else
                  <td class="bg-danger">Inactive</td>
                @endif
                </td>
                <td>{{ date("M d, Y", strtotime($user->created_at))}}</td>
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ route('users.edit',$user->id)}}" 
                       class="btn btn-warning btn-sm rounded-start" 
                       title="Edit">
                      <i class="bi bi-pencil"></i>
                    </a>
                    <form action="{{ route('users.reset-password',$user->id) }}" 
                            method="POST" 
                            class="d-inline"
                            onsubmit="return confirm('Are you sure you want to reset this password?');">
                        @csrf
                      <button type="submit" class="btn btn-success rounded-0 btn-sm" title="Reset Password">
                        <i class="bi bi-key"></i>
                      </button>
                    </form>
                    <form action="{{ route('users.destroy',$user->id) }}" 
                          method="POST" 
                          class="d-inline"
                          onsubmit="return confirm('Are you sure you want to delete this user?');">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger rounded-0 btn-sm" title="Delete">
                        <i class="bi bi-trash"></i>
                      </button>
                    </form>
                    <form action="{{ route('users.deactivate',$user->id) }}" method=POST onsubmit="return confirm('Do you want to deactivate this user?')" class="d-inline">
                      @csrf
                      <button type="submit" title="Deactivate User" class="btn btn-info rounded-end btn-sm">
                          <i class="bi bi-ban"></i>
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
          
          
      </div>
      <!-- /.card-body -->
      <div>
        {{-- Pagination --}}
          {{-- <div class="mt-3">
                {{ $users->links('pagination::bootstrap-5') }}
          </div> --}}
      </div>
    </div>
    <!-- /.card -->
  </div>
</div>
@endsection

{{-- Page-specific Scripts --}}
@push('scripts')
<script>
  // Add any page-specific JavaScript here
  console.log('Roles index page loaded');
  
  // Example: Auto-hide alerts after 5 seconds
  setTimeout(function() {
    document.querySelectorAll('.alert').forEach(function(alert) {
      let bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    });
  }, 5000);
</script>
@endpush