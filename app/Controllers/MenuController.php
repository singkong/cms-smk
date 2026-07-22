<?php

namespace App\Controllers;

use App\Models\MenuModel;

class MenuController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Menu Builder';
        $data['menus'] = model(MenuModel::class)->findAll();
        return view('admin/menus/index', $data);
    }

    public function items($menuId)
    {
        $data = $this->data;
        $data['title'] = 'Menu Items';
        $data['menu'] = model(MenuModel::class)->find($menuId);
        $data['items'] = $this->db->table('menu_items')->where('menu_id', $menuId)->orderBy('sort_order', 'ASC')->get()->getResult();
        return view('admin/menus/items', $data);
    }

    public function storeItem($menuId)
    {
        $this->db->table('menu_items')->insert([
            'menu_id' => $menuId,
            'parent_id' => $this->request->getPost('parent_id') ?: null,
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
            'icon' => $this->request->getPost('icon'),
            'target' => $this->request->getPost('target', '_self'),
            'sort_order' => $this->request->getPost('sort_order', 0),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->back()->with('success', 'Menu item ditambahkan.');
    }

    public function updateItem($itemId)
    {
        $this->db->table('menu_items')->where('id', $itemId)->update([
            'parent_id' => $this->request->getPost('parent_id') ?: null,
            'title' => $this->request->getPost('title'),
            'url' => $this->request->getPost('url'),
            'icon' => $this->request->getPost('icon'),
            'target' => $this->request->getPost('target', '_self'),
            'sort_order' => $this->request->getPost('sort_order', 0),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->back()->with('success', 'Menu item diperbarui.');
    }

    public function deleteItem($itemId)
    {
        $this->db->table('menu_items')->where('id', $itemId)->delete();
        return redirect()->back()->with('success', 'Menu item dihapus.');
    }
}
