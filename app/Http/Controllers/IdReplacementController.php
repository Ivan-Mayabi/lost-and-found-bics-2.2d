<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdReplacementRequest;
use App\Http\Requests\UpdateIdReplacementRequest;
use App\Models\IdReplacement;
use App\Models\Payment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IdReplacementController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     * API/JSON response (Ivan)
     */
    public function index()
    {
        $this->authorize('viewAny', IdReplacement::class);

        $query = IdReplacement::with(['user', 'payment']);

        // Regular users can only see their own requests
        if (Auth::user()->hasRole('student')) {
            $query->where('user_id', Auth::id());
        }

        return response()->json([
            'data' => $query->latest()->get()
        ]);
    }

    /**
     * Show all temporary IDs for a logged-in student (Blade view)
     */
    public function indexView()
    {
        $idReplacements = IdReplacement::where('user_id', Auth::id())->latest()->get();
        return view('user.temporary-ids.index', compact('idReplacements'));
    }

    /**
     * Show form to create a new request (Blade view)
     */
    public function create()
    {
        return view('user.temporary-ids.create');
    }

    /**
     * Store a newly created resource in storage.
     * Handles both API (Ivan) and Blade form submission
     */
    public function store(Request $request)
    {

        if($request->payment_id){
            $payment_token = Payment::find($request->payment_id);
            if($request->payment_token !== $payment_token->payment_id_token){
                return redirect()->route('user.temporary-ids.index')
                             ->with('error', 'Temporary ID request failed, wrong payment token.');
            }
        }
        if ($request instanceof StoreIdReplacementRequest) {
            // Ivan's API logic
            $this->authorize('create', IdReplacement::class);

            $payment = Payment::findOrFail($request->payment_id);

            if ($payment->user_id !== Auth::id()) {
                return response()->json([
                    'message' => 'Unauthorized payment'
                ], Response::HTTP_FORBIDDEN);
            }

            $idReplacement = IdReplacement::create([
                'user_id' => Auth::id(),
                'payment_id' => $payment->id,
                'id_lost' => $request->id_lost,
                'approved' => false,
            ]);

            return response()->json([
                'message' => 'ID replacement request submitted successfully',
                'data' => $idReplacement->load('user', 'payment')
            ], Response::HTTP_CREATED);
        } else {
            // Blade form submission logic (your current code)
            $request->validate([
                'id_lost' => 'required|string|max:50',
                'payment_id' => 'required|integer',
            ]);

            IdReplacement::create([
                'user_id' => Auth::id(),
                'id_lost' => $request->id_lost,
                'payment_id' => $request->payment_id,
                'approved' => false,
            ]);

            return redirect()->route('user.temporary-ids.index')
                             ->with('success', 'Temporary ID request submitted successfully.');
        }
    }

    /**
     * Display the specified resource (JSON/API)
     */
    public function show(IdReplacement $idReplacement)
    {
        $this->authorize('view', $idReplacement);

        // Blade view for regular users
        if (!Auth::user()->isAdmin()) {
            if ($idReplacement->user_id !== Auth::id()) {
                abort(403);
            }
            return view('user.temporary-ids.show', compact('idReplacement'));
        }

        // API response for admins
        return response()->json([
            'data' => $idReplacement->load(['user', 'payment'])
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateIdReplacementRequest $request, IdReplacement $idReplacement)
    {
        $this->authorize('update', $idReplacement);

        $updateData = $request->only(['id_lost']);

        if ($request->has('payment_id') && $idReplacement->isPending()) {
            $payment = Payment::findOrFail($request->payment_id);

            if ($payment->user_id === Auth::id()) {
                $updateData['payment_id'] = $payment->id;
            }
        }

        $idReplacement->update($updateData);

        return response()->json([
            'message' => 'ID replacement request updated successfully',
            'data' => $idReplacement->fresh(['user', 'payment'])
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(IdReplacement $idReplacement)
    {
        $this->authorize('delete', $idReplacement);

        $idReplacement->delete();

        return response()->json([
            'message' => 'ID replacement request deleted successfully'
        ]);
    }

    /**
     * Approve an ID replacement request
     */
    public function approve(IdReplacement $idReplacement): JsonResponse
    {
        $this->authorize('update', $idReplacement);

        if ($idReplacement->isApproved()) {
            return response()->json([
                'message' => 'ID replacement request is already approved'
            ], Response::HTTP_BAD_REQUEST);
        }

        $idReplacement->update([
            'approved' => true,
            'approved_by' => Auth::id(),
            'approved_at' => now(),
        ]);

        return response()->json([
            'message' => 'ID replacement request approved successfully',
            'data' => $idReplacement->load(['user', 'payment'])
        ]);
    }

    /**
     * Reject an ID replacement request
     */
    public function reject(IdReplacement $idReplacement): JsonResponse
    {
        $this->authorize('update', $idReplacement);

        if ($idReplacement->isApproved()) {
            return response()->json([
                'message' => 'Cannot reject an approved ID replacement request'
            ], Response::HTTP_BAD_REQUEST);
        }

        $idReplacement->update([
            'rejected_by' => Auth::id(),
            'rejected_at' => now(),
            'rejection_reason' => request('reason', 'No reason provided'),
        ]);

        return response()->json([
            'message' => 'ID replacement request rejected successfully',
            'data' => $idReplacement->load(['user', 'payment'])
        ]);
    }
}
