<?php

namespace App\Models;

class MenuModel extends BaseModel
{
    protected $table            = 'menus';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['name', 'location'];
    protected $useSoftDeletes   = false;

    public function getWithItems($location = 'header')
    {
        $menu = $this->where('location', $location)->first();
        if (!$menu) return [];

        $items = $this->db->table('menu_items')
            ->where('menu_id', $menu->id)
            ->orderBy('sort_order', 'ASC')
            ->get()->getResult();

        return $this->buildTree($items);
    }

    protected function buildTree(array $items, $parentId = null): array
    {
        $tree = [];
        foreach ($items as $item) {
            if ($item->parent_id == $parentId) {
                $item->children = $this->buildTree($items, $item->id);
                $tree[] = $item;
            }
        }
        return $tree;
    }
}
