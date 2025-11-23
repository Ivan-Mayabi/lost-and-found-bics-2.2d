@extends('layout.admin')

{{-- Page Title in Browser Tab --}}
@section('title', 'Payments')

{{-- Page Heading --}}
@section('page-title', 'Payments')

{{-- Breadcrumb --}}
@section('breadcrumb')
  <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">Home</a></li>
  <li class="breadcrumb-item active" aria-current="page">Payments</li>
@endsection

{{-- Main Content --}}
@section('content')
<div class="row">
  <div class="col-12">
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">All Payments</h3>
        <div class="card-tools">
        </div>
      </div>
      <!-- /.card-header -->
      
      <div class="card-body">
          <table class="table table-bordered table-striped">
            <thead>
              <tr>
                <th style="width: 10px">Payment ID</th>
                <th>Method</th>
                <th>Amount</th>
                <th>Payment Identifier</th>
                <th>Verified</th>
                <th>Created At</th>
                <th>Modified At</th>
                <th>Verify</th>
              </tr>
            </thead>
            <tbody>
              @foreach($payments as $payment)
              <tr>
                {{-- Can have {{ $loop->iteration }} --}}
                <td>{{$payment->id}}</td>
                <td> {{$payment->method}}</td>
                <td> {{$payment->amount}}</td>
                <td>{{$payment->payment_id_token}}</td>
                @if ($payment->verified == 1)
                    <td><span class="badge bg-success">Verified</td>
                @else
                    <td><span class="badge bg-danger text-black">Not yet Verified</td>
                @endif
                <td>{{ date("M d, Y", strtotime($payment->created_at))}}</td>
                <td>{{ date("M d, Y",strtotime($payment->updated_at))}}</td>
                <td>
                    @if($payment->verified == 0) 
                        <form action="{{ route('payments.approve', $payment->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success btn-sm">
                                <i class="bi-icons bi-check-circle"></i> Approve
                            </button>
                        </form>
                    @else
                        <form action="{{ route('payments.reject', $payment->id) }}" method="POST" style="display:inline-block;">
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
          
          
      </div>
      <!-- /.card-body -->
      <div>
        {{-- Pagination --}}
          <div class="mt-3">
                {{ $payments->links('pagination::bootstrap-5') }}
          </div>
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
  console.log('Payments index page loaded');
  
  // Example: Auto-hide alerts after 5 seconds
  setTimeout(function() {
    document.querySelectorAll('.alert').forEach(function(alert) {
      let bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    });
  }, 5000);
</script>
@endpush