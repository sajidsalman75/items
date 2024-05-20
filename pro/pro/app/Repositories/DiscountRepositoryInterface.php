<?php

namespace App\Repositories;

interface DiscountRepositoryInterface
{
    public function createDiscount(array $data);
    public function deleteDiscount($id);
}
