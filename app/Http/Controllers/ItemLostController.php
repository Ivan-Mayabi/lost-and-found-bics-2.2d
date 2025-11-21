<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemLostRequest;
use App\Http\Requests\UpdateItemLostRequest;
use App\Models\ItemLost;
use Illuminate\Http\Request;

class ItemLostController extends Controller
{
    /**
     * Display a listing of the lost items.
     */
    public function index(Request $request)
    {
        $query = ItemLost::query()->with('item');

        // Apply search filters if present
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('description', 'LIKE', "%$search%")
                  ->orWhere('place_lost', 'LIKE', "%$search%")
                  ->orWhereHas('item', function ($q) use ($search) {
                      $q->where('name', 'LIKE', "%$search%");
                  });
        }

        $lostItems = $query->orderBy('date_lost', 'desc')->get();

        return view('user.lost-items.index', compact('lostItems'));
    }

    /**
     * Show the form for creating a new lost item.
     */
    public function create()
    {
        return view('user.lost-items.create');
    }

    /**
     * Store a newly created lost item in storage.
     */
    public function store(StoreItemLostRequest $request)
    {
        $data = $request->validated();

        // Handle image upload if exists
        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('lost-items', 'public');
            $data['image_url'] = $path;
        }

        // Ensure defaults for optional fields
        $data['taken'] = false;
        $data['item_id'] = $data['item_id'] ?? null;

        ItemLost::create($data);

        return redirect()->route('user.lost-items.index')
                         ->with('success', 'Lost item reported successfully.');
    }

    /**
     * Display a single lost item.
     */
    public function show(ItemLost $itemLost)
    {
        return view('user.lost-items.show', compact('itemLost'));
    }

    /**
     * Show the form for editing the specified lost item.
     */
    public function edit(ItemLost $itemLost)
    {
        return view('user.lost-items.edit', compact('itemLost'));
    }

    /**
     * Update the specified lost item in storage.
     */
    public function update(UpdateItemLostRequest $request, ItemLost $itemLost)
    {
        $data = $request->validated();

        // Handle image upload if exists
        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('lost-items', 'public');
            $data['image_url'] = $path;
        }

        $itemLost->update($data);

        return redirect()->route('user.lost-items.index')
                         ->with('success', 'Lost item updated successfully.');
    }

    /**
     * Remove the specified lost item from storage.
     */
    public function destroy(ItemLost $itemLost)
    {
        $itemLost->delete();

        return redirect()->route('user.lost-items.index')
                         ->with('success', 'Lost item deleted successfully.');
    }

    /**
     * Mark a lost item as claimed by a user.
     */
    public function claim(ItemLost $itemLost)
    {
        if ($itemLost->taken) {
            return redirect()->back()->with('error', 'This item has already been claimed.');
        }

        $itemLost->taken = true;
        $itemLost->save();

        return redirect()->back()->with('success', 'You have successfully claimed this item.');
    }
}
