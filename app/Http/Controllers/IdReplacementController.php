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

    public function index()
    {
        $this->authorize('viewAny', IdReplacement::class);

        $query = IdReplacement::with(['user', 'payment']);

        if (Auth::user()->hasRole('student')) {
            $query->where('user_id', Auth::id());
        }

        return response()->json([
            'data' => $query->latest()->get()
        ]);
    }

    public function indexView()
    {
        if (Auth::user()->isAdmin()) {
            $idReplacements = IdReplacement::paginate(env('DEFAULT_PAGINATE_NUMBER', 10));
        } else {
            $idReplacements = IdReplacement::where('user_id', Auth::id())->latest()->get();
        }

        return view('user.temporary-ids.index', compact('idReplacements'));
    }

    public function create()
    {
        return view('user.temporary-ids.create');
    }

    public function store(Request $request)
    {
        if ($request->payment_id) {
            $payment_token = Payment::find($request->payment_id);
            if ($request->payment_token !== $payment_token->payment_id_token) {
                return redirect()->route('user.temporary-ids.index')
                                ->with('error', 'Temporary ID request failed, wrong payment token.');
            }
        }

        if ($request instanceof StoreIdReplacementRequest) {
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
                'approved' => 2, // pending by default
            ]);

            return response()->json([
                'message' => 'ID replacement request submitted successfully',
                'data' => $idReplacement->load('user', 'payment')
            ], Response::HTTP_CREATED);

        } else {

            $request->validate([
                'id_lost' => 'required|string|max:50',
                'payment_id' => 'required|integer',
            ]);

            IdReplacement::create([
                'user_id' => Auth::id(),
                'id_lost' => $request->id_lost,
                'payment_id' => $request->payment_id,
                'approved' => 2, // pending by default
            ]);

            return redirect()->route('user.temporary-ids.index')
                             ->with('success', 'Temporary ID request submitted successfully.');
        }
    }

    public function show(IdReplacement $idReplacement)
    {
        $this->authorize('view', $idReplacement);

        if (!Auth::user()->isAdmin()) {
            if ($idReplacement->user_id !== Auth::id()) {
                abort(403);
            }
            return view('user.temporary-ids.show', compact('idReplacement'));
        }

        return response()->json([
            'data' => $idReplacement->load(['user', 'payment'])
        ]);
    }

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

    public function destroy(IdReplacement $idReplacement)
    {
        $this->authorize('delete', $idReplacement);

        $idReplacement->delete();

        return response()->json([
            'message' => 'ID replacement request deleted successfully'
        ]);
    }

    public function approve(Request $request, IdReplacement $idReplacement): JsonResponse|\Illuminate\Http\RedirectResponse
{
    $this->authorize('update', $idReplacement);

    // Load the payment relation
    $idReplacement->load('payment');

    // Check if payment exists and is verified (verified = 1)
    if (!$idReplacement->payment || $idReplacement->payment->verified !== 1) {
        $msg = 'Cannot approve this request because payment has not been verified.';
        if ($request->wantsJson()) {
            return response()->json(['message' => $msg], Response::HTTP_BAD_REQUEST);
        }
        return redirect()->back()->with('error', $msg);
    }

    // Check if already approved
    if ($idReplacement->approved === 1) {
        $msg = 'This request is already approved.';
        if ($request->wantsJson()) {
            return response()->json(['message' => $msg], Response::HTTP_BAD_REQUEST);
        }
        return redirect()->back()->with('error', $msg);
    }

    // Approve the request
    $idReplacement->update([
        'approved' => 1, // pending = 2, approved = 1
    ]);

    $msg = 'ID replacement request approved successfully.';
    if ($request->wantsJson()) {
        return response()->json([
            'message' => $msg,
            'data' => $idReplacement->load(['user', 'payment'])
        ]);
    }

    return redirect()->back()->with('success', $msg);
}


    public function reject(Request $request, IdReplacement $idReplacement): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $this->authorize('update', $idReplacement);

        if ($idReplacement->isApproved()) {
            if ($request->wantsJson()) {
                return response()->json([
                    'message' => 'Cannot reject an approved ID replacement request'
                ], Response::HTTP_BAD_REQUEST);
            }
            return redirect()->back()->with('error', 'You cannot reject an already approved request.');
        }

        $idReplacement->update([
            'approved' => 0, // rejected
        ]);

        if ($request->wantsJson()) {
            return response()->json([
                'message' => 'ID replacement request rejected successfully',
                'data' => $idReplacement->load(['user', 'payment'])
            ]);
        }

        return redirect()->back()->with('success', 'ID replacement request rejected successfully.');
    }
}
