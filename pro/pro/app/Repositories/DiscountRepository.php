<?php

namespace App\Repositories;

use App\Models\Discount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;

class DiscountRepository implements DiscountRepositoryInterface
{
    public function createDiscount(array $data)
    {
        DB::beginTransaction();

        try {
            $discount = Discount::create($data);
            DB::commit();
            return $discount;
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error creating discount: ' . $e->getMessage());
            throw $e;
        }
    }

    public function deleteDiscount($id)
    {
        DB::beginTransaction();

        try {
            $discount = Discount::findOrFail($id);
            $discount->delete();
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            Log::error('Error deleting discount: ' . $e->getMessage());
            throw $e;
        }
    }
}
