<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreClaimRequest;
use App\Http\Requests\UpdateClaimRequest;
use App\Models\Claim;
use App\Models\ItemLost;
use App\Models\ItemClaimed;
use Illuminate\Support\Facades\Auth;
class ClaimController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::user()->isAdmin()){
            $claims=Claim::paginate(env('DEFAULT_PAGINATE_NUMBER',10));
        }
        else{
        $claims = Claim::where('user_id', Auth::id())
                        ->with('lostItem')
                        ->get();
        }

        return view('regular.claims.index', compact('claims'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($lostItemId)
    {
        $item = ItemLost::findOrFail($lostItemId);

        return view('regular.claims.create', compact('item'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreClaimRequest $request)
    {
        $request->validate([
            'lost_item_id' => 'required|exists:lost_items,id',
        ]);

        Claim::create([
            'user_id' => Auth::id(),
            'lost_item_id' => $request->lost_item_id,
            'verified' => false,
        ]);

        return redirect()->route('user.claims.index')
                         ->with('success', 'Claim submitted successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Claim $claim)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Claim $claim)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClaimRequest $request, Claim $claim)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Claim $claim)
    {
        //
    }

    public function history()
    {
        $claims = Claim::where('user_id', Auth::id())
         ->with('lostItem')
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('regular.claims.history', compact('claims'));
    }
}
