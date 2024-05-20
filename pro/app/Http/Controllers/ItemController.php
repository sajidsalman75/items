<?php

namespace App\Http\Controllers;

use App\Repositories\ItemRepositoryInterface;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    protected $itemRepository;

    public function __construct(ItemRepositoryInterface $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function index()
    {
        $items = $this->itemRepository->getAllItems();
        return response()->json($items);
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
        ]);

        $item = $this->itemRepository->createItem($validatedData);
        return response()->json($item, 201);
    }

    public function show($id)
    {
        $item = $this->itemRepository->getItemById($id);
        return response()->json($item);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'price' => 'sometimes|required|numeric',
            'quantity' => 'sometimes|required|integer',
        ]);

        $item = $this->itemRepository->updateItem($id, $validatedData);
        return response()->json($item);
    }

    public function destroy($id)
    {
        $this->itemRepository->deleteItem($id);
        return response()->json(null, 204);
    }
}
