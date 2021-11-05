<?php

namespace App\Http\Controllers;

use App\Model\Wishlist;
use Auth;
use Illuminate\Http\Request;

class WishlistController extends Controller
{

    public function index()
    {
        $user_id = Auth::guard('web')->user()->id;
        $wishlists = Wishlist::latest()->where('user_id', $user_id)->paginate(10);
        return response()->json([
            'wishlists' => $wishlists
        ], 200);
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $wishlist = new Wishlist;
        $wishlist = $wishlist->create($request->all());
        return response()->json($wishlist);
    }

    public function show(Wishlist $wishlist)
    {
        //
    }

    public function edit(Wishlist $wishlist)
    {
        //
    }

    public function update(Request $request, Wishlist $wishlist)
    {
        //
    }

    public function destroy(Wishlist $wishlist)
    {
        // dd($wishlist);
        $wishlist->delete();
        return $this->index();
    }
}
