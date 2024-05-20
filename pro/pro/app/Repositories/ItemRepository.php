<?php

namespace App\Repositories;

use App\Models\Item;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class ItemRepository implements ItemRepositoryInterface
{
    public function getAllItems()
    {
        return Item::with('discounts')->get();
    }

    public function getItemById($id)
    {
        return Item::with('discounts')->findOrFail($id);
    }

    public function createItem(array $data)
    {
        DB::beginTransaction();

        try {
            $item = Item::create($data);
            DB::commit();
            return $item;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating item: ' . $e->getMessage());
            throw $e;
        }
    }

    public function updateItem($id, array $data)
    {
        DB::beginTransaction();

        try {
            $item = Item::findOrFail($id);
            $item->update($data);
            DB::commit();
            return $item;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error updating item: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteItem($id)
    {
        DB::beginTransaction();

        try {
            $item = Item::findOrFail($id);
            $item->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting item: ' . $e->getMessage());
            throw $e;
        }
    }
}
