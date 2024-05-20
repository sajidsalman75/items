<?php

namespace App\Repositories;

interface ItemRepositoryInterface
{
    public function getAllItems();
    public function getItemById($id);
    public function createItem(array $data);
    public function updateItem($id, array $data);
    public function deleteItem($id);
}
