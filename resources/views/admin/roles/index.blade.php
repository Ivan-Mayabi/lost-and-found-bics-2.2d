@extends('layout.admin')

{{-- Page Title in Browser Tab --}}
@section('title', 'Roles')

{{-- Page Heading --}}
@section('page-title', 'Roles')

{{-- Breadcrumb --}}
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Roles</li>
@endsection

{{-- Main Content --}}
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Roles</h3>
        <div class="card-tools">
          <a href=" {{ route('roles.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle"></i> Add New Role
          </a>
        </div>
      </div>
      <!-- /.card-header -->
      
      <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 10px">Role ID</th>
                <th>Type</th>
                <th>Created At</th>
                <th>Modified At</th>
                <th style="width: 200px">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach($roles as $role)
              <tr>
                {{-- Can have {{ $loop->iteration }} --}}
                <td>{{$role->id}}</td>
                <td> {{$role->type}}</td>
                <td>{{ date("M d, Y", strtotime($role->created_at))}}</td>
                <td>{{ date("M d, Y",strtotime($role->updated_at))}}</td>
                <td>
                  <div class="btn-group" role="group">
                        <a href="{{ route('roles.edit',$role->id)}}" 
                        class="btn btn-warning btn-sm" 
                        title="Edit">
                        <i class="bi bi-pencil rounded-0"></i>
                        </a>
                       
                        <form action="{{ route('roles.destroy',$role->id) }}" 
                                method="POST" 
                                class="d-inline"
                                onsubmit="return confirm('Are you sure you want to delete this role?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger rounded-0 btn-sm" title="Delete">
                            <i class="bi bi-trash"></i>
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