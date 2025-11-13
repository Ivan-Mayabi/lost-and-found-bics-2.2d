<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemClaimed;
use App\Models\ItemLost;
use Illuminate\Http\Request;

class LostAndFoundManagerController extends Controller
{
    //
    public function index() //dashboard
    {
        $items =  Item::paginate(env('PAGINATION_COUNT',10));
        $claims = ItemClaimed::all();
        $lostItems = ItemLost::paginate(env('PAGINATION_COUNT',10));
        $claims=ItemClaimed::with(['user','item_lost'])->paginate(10);
        return view('lostandfoundmanagers.index',compact('items','lostItems','claims'));
    }

    public function createItem() //show add item form
    {
        return view('lostandfoundmanagers.add_item');
    }

    public function storeItem(Request $request) //store item
    {
        $request->validate([
            'name'=>'required',
            'type'=>'required',
            'description'=>'required'
        ]);
        Item::create($request->only('name','type','description'));
        return redirect()->route('lfm.dashboard')->with('success','Item added successfully');
    }

    public function createLost() //show add lost form 
    {
        $items = Item::all();
        return view('lostandfoundmanagers.add_lost_item',compact('items'));
    }

    public function storeLost(Request $request) //store lost item
    {
        $request->validate([
            'item_id'=>'required|exists:items,id',
            'date_lost'=>'required|date',
            'place_lost'=>'required',
            'description'=>'nullable',
            'image_url'=>'nullable|url'
        ]);
        ItemLost::create($request->only(
            'item_id',
            'date_lost',
            'place_lost',
            'description',
            'image_url'
        ));
        return redirect()->route('lfm.dashboard')->with('success','Lost item reported successfully');
    }

    public function verifyClaims() //verify claims
    {
        $claims = ItemClaimed::where('verified',false)->paginate(env('PAGINATION_COUNT',10));
        return view('lostandfoundmanagers.verify_claims',compact('claims'));
    }

    public function approveClaim($id) //approve claim
    {
        $claim = ItemClaimed::findOrFail($id);
        $claim->delete();
        return redirect()->back()->with('success','Claim approved');
    }

    public function rejectClaim($id)
{
    // Find the claim
    $claim = ItemClaimed::findOrFail($id);

    // Optional: delete or update status
    // For example, if you have a 'status' column:
    // $claim->status = 'rejected';
    // $claim->save();

    // Or simply delete it:
    $claim->save();

    // Redirect back with a success message
    return redirect()->back()->with('success', 'Claim rejected .');
}

// ================== ITEM EDIT/DELETE ==================

// Show edit form for Item
public function editItem($id)
{
    $item = Item::findOrFail($id);
    return view('lostandfoundmanagers.edit_item', compact('item'));
}

// Update the Item
public function updateItem(Request $request, $id)
{
    $item = Item::findOrFail($id);

    $request->validate([
        'name' => 'required|string|max:255',
        'type' => 'required|string|max:255',
        'description' => 'required|string',
    ]);

    $item->update($request->only('name', 'type', 'description'));

    return redirect()->route('lfm.dashboard')->with('success', 'Item updated successfully!');
}

// Delete Item
public function deleteItem($id)
{
    $item = Item::findOrFail($id);
    $item->delete();

    return redirect()->route('lfm.dashboard')->with('success', 'Item deleted successfully!');
}



// ================== LOST ITEM EDIT/DELETE ==================

// Show edit form for Lost Item
public function editLostItem($id)
{
    $lostItem = ItemLost::findOrFail($id);
    $items = Item::all(); // to repopulate dropdown
    return view('lostandfoundmanagers.edit_lost_item', compact('lostItem', 'items'));
}

// Update Lost Item
public function updateLostItem(Request $request, $id)
{
    $lostItem = ItemLost::findOrFail($id);

    $request->validate([
        'item_id' => 'required|exists:items,id',
        'date_lost' => 'required|date',
        'place_lost' => 'required|string|max:255',
        'description' => 'nullable|string',
        'image_url' => 'nullable|url'
    ]);

    $lostItem->update($request->only('item_id', 'date_lost', 'place_lost', 'description', 'image_url'));

    return redirect()->route('lfm.dashboard')->with('success', 'Lost item updated successfully!');
}

// Delete Lost Item
public function deleteLostItem($id)
{
    $lostItem = ItemLost::findOrFail($id);
    $lostItem->delete();

    return redirect()->route('lfm.dashboard')->with('success', 'Lost item deleted successfully!');
}

    

}   

