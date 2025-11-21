<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreIdReplacementRequest;
use App\Http\Requests\UpdateIdReplacementRequest;
use App\Models\IdReplacement;
use App\Models\Payment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class IdReplacementController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Store a newly created resource in storage.
     */
    public function store(StoreIdReplacementRequest $request)
    {
        $this->authorize('create', IdReplacement::class);

        // Verify payment
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
    }

    /**
     * Display the specified resource.
     */
    public function show(IdReplacement $idReplacement)
    {
        $this->authorize('view', $idReplacement);

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

        // Only allow updating certain fields if not an admin/approver
        $updateData = $request->only(['id_lost']);

        // Only update payment if it's the same user and request is pending
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

        // TODO: Trigger ID card generation or other post-approval actions

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
