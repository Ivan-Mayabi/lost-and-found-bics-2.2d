<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemClaimedRequest;
use App\Http\Requests\UpdateItemClaimedRequest;
use App\Models\ItemClaimed;
use App\Models\ItemLost;
use App\Models\User;

class ItemClaimedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $itemsClaimed = ItemClaimed::with(['user', 'itemLost.item'])->get();
        return view('lost-found.items-claimed.index', compact('itemsClaimed'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $itemsLost = ItemLost::where('taken', false)->get();
        $users = User::all();
        return view('lost-found.items-claimed.create', compact('itemsLost', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemClaimedRequest $request)
    {
        ItemClaimed::create([
            'user_id' => $request->user_id,
            'item_lost_id' => $request->item_lost_id,
            'verified' => false,
        ]);
        
        return redirect()->route('items-claimed.index')
            ->with('success', 'Item claim recorded successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(ItemClaimed $itemClaimed)
    {
        $itemClaimed->load(['user', 'itemLost.item']);
        return view('lost-found.items-claimed.show', compact('itemClaimed'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ItemClaimed $itemClaimed)
    {
        $itemsLost = ItemLost::where('taken', false)->get();
        $users = User::all();
        return view('lost-found.items-claimed.edit', compact('itemClaimed', 'itemsLost', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemClaimedRequest $request, ItemClaimed $itemClaimed)
    {
        $itemClaimed->update([
            'user_id' => $request->user_id,
            'item_lost_id' => $request->item_lost_id,
        ]);
        
        return redirect()->route('items-claimed.index')
            ->with('success', 'Item claim updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemClaimed $itemClaimed)
    {
        $itemClaimed->delete();
        return redirect()->route('items-claimed.index')
            ->with('success', 'Item claim deleted successfully');
    }
    
    /**
     * Verify item claim
     */
    public function verify(ItemClaimed $itemClaimed)
    {
        $itemClaimed->update(['verified' => true]);
        
        // Mark the lost item as taken
        $itemClaimed->itemLost->update([
            'taken' => true,
            'user_taken_id' => $itemClaimed->user_id,
        ]);
        
        return redirect()->route('items-claimed.index')
            ->with('success', 'Item claim verified successfully');
    }
}
