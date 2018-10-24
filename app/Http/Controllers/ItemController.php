<?php

namespace App\Http\Controllers;

use App\Http\Resources\ItemResource;
use App\Jobs\CatalogUpdating;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        return view('main');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     * @throws \Illuminate\Validation\ValidationException
     */
    public function search(Request $request)
    {
        $validated = $this->validate($request, [
            'q' => 'required|string|min:1'
        ]);

        $items = Item::query()
            ->where('title', 'like', '%' . $validated['q'] . '%')
            ->where('description', 'like', '%' . $validated['q'] . '%')
            ->paginate();

        return ItemResource::collection($items);
    }

    public function show($id)
    {
        $item = Item::findOrFail($id);

        return view('item', compact('item'));
    }

    public function updateCatalog()
    {
        $exist = \DB::table('jobs')->count();

        if (!$exist) {
            CatalogUpdating::dispatch();
        }

        return view('load', compact('exist'));
    }
}
