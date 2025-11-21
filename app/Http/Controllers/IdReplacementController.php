<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\IdReplacement;

class IdReplacementController extends Controller
{
    // List all temporary ID requests for the logged-in student
    public function index()
    {
        $idReplacements = IdReplacement::where('user_id', auth()->id())->latest()->get();
        return view('user.temporary-ids.index', compact('idReplacements'));
    }

    // Show form to create a new request
    public function create()
    {
        return view('user.temporary-ids.create');
    }

    // Store a new request
    public function store(Request $request)
    {
        $request->validate([
            'id_lost' => 'required|string|max:50',
            'payment_id' => 'required|string|max:100',
        ]);

        IdReplacement::create([
            'user_id' => auth()->id(),
            'id_lost' => $request->id_lost,
            'payment_id' => $request->payment_id,
            'approved' => false, // default pending
        ]);

        return redirect()->route('user.temporary-ids.index')
                         ->with('success', 'Temporary ID request submitted successfully.');
    }

    // Show more details
    public function show(IdReplacement $idReplacement)
    {
        // Ensure the user owns this request
        if ($idReplacement->user_id !== auth()->id()) {
            abort(403);
        }

        return view('user.temporary-ids.show', compact('idReplacement'));
    }
}
