@extends('layout.admin')

@section('title','Make Payment')
@section('page-title', 'Make Payment for Temporary ID')

@section('content')
{{-- displaying token once --}}
@if (isset($token) || isset($id))
    <div class="alert alert-warning alert-dismissible">
        <button type="button" class="btn-close" data-bs-dismiss="alert"
            aria-label="Close">
        </button>
        <h5><i class="bi bi-key"></i> Your Payment Details</h5>
        <p class="mb-2"><strong>Save these Details</strong></p>
        <div class="input-group">
            <label class="form-control-sm" for="newToken">Payment Token</label>
            <input type="text" class="form-control-sm w-50 text-black bg-white" value="{{ $token }}"
                id="newToken" readonly>
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button" onclick="copyToken()">
                    <i class="bi bi-clipboard"></i> Copy
                </button>
            </div>
        </div>
        <div class="input-group">
            <label class="form-control-sm" for="newId">Payment ID</label>
            <input type="text" class="form-control-sm text-black bg-white" value="{{ $id }}"
                id="newId" readonly>
        </div>
    </div>
@endif

<form action="{{ route('payments.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="phone_number" class="form-label">Phone Number</label>
        <input type="text" class="form-control" id="phone_number" name="phone_number" required>
    </div>
    <div class="mb-3">
        <label for="payment_id" class="form-label">Amount</label>
        <input type="text" class="form-control" id="payment_id" name="payment_id" placeholder="Enter numbers only" required>
    </div>
    <button type="submit" class="btn btn-success">Add</button>
    <a href="{{ route('user.temporary-ids.index') }}" class="btn btn-secondary">Back</a>
</form>
@endsection

@push('scripts')
    <script type="text/javascript">
        // copy token to clipboard
        function copyToken() {
            const tokenInput = document.getElementById('newToken');
            tokenInput.select();
            tokenInput.setSelectionRange(0, 99999);
            document.execCommand('copy');
            // Show temporary feedback
            const button = event.target;
            const originalText = button.innerHTML;
            button.innerHTML = '<i class="fas fa-check"></i> Copied!';
            button.classList.remove('btn-outline-secondary');
            button.classList.add('btn-success');
            setTimeout(() => {
                button.innerHTML = originalText;
                button.classList.remove('btn-success');
                button.classList.add('btn-outline-secondary');
            }, 2000);
        }
       
    </script>
@endpush
