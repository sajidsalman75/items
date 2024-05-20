<?php

namespace App\Http\Controllers;

use App\Repositories\DiscountRepositoryInterface;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    protected $discountRepository;

    public function __construct(DiscountRepositoryInterface $discountRepository)
    {
        $this->discountRepository = $discountRepository;
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'price' => 'required|integer',
            'item_id' => 'required|exists:items,id',
        ]);

        $discount = $this->discountRepository->createDiscount($validatedData);
        return response()->json($discount, 201);
    }

    public function destroy($id)
    {
        $this->discountRepository->deleteDiscount($id);
        return response()->json(null, 204);
    }
}
