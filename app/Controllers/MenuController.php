<?php

namespace App\Controllers;

use App\Models\MenuModel;

class MenuController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Menu Builder';

        $menus = $this->db->table('menus')
            ->select('menus.*, COUNT(menu_items.id) as item_count')
            ->join('menu_items', 'menu_items.menu_id = menus.id', 'left')
            ->groupBy('menus.id')
            ->orderBy('menus.id', 'ASC')
            ->get()->getResult();

        $data['items'] = $menus;
        return view('admin/menus/index', $data);
    }

    public function items($menuId)
    {
        $data = $this->data;
        $data['title'] = 'Menu Items';
        $data['menu'] = model(MenuModel::class)->find($menuId);
        $data['items'] = $this->db->table('menu_items')
            ->where('menu_id', $menuId)
            ->orderBy('sort_order', 'ASC')
            ->get()->getResult();
        return view('admin/menus/items', $data);
    }

    public function store()
    {
        $this->db->table('menus')->insert([
            'name'       => $this->request->getPost('name'),
            'location'   => $this->request->getPost('location', 'header'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->back()->with('success', 'Menu berhasil ditambahkan.');
    }

    public function update($id)
    {
        $this->db->table('menus')->where('id', $id)->update([
            'name'       => $this->request->getPost('name'),
            'location'   => $this->request->getPost('location'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->back()->with('success', 'Menu berhasil diperbarui.');
    }

    public function delete($id)
    {
        $this->db->table('menu_items')->where('menu_id', $id)->delete();
        $this->db->table('menus')->where('id', $id)->delete();
        return redirect()->back()->with('success', 'Menu berhasil dihapus.');
    }

    public function storeItem($menuId)
    {
        $this->db->table('menu_items')->insert([
            'menu_id'    => $menuId,
            'parent_id'  => $this->request->getPost('parent_id') ?: null,
            'title'      => $this->request->getPost('title'),
            'url'        => $this->request->getPost('url'),
            'icon'       => $this->request->getPost('icon'),
            'target'     => $this->request->getPost('target', '_self'),
            'sort_order' => $this->request->getPost('sort_order', 0),
            'created_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->back()->with('success', 'Menu item ditambahkan.');
    }

    public function updateItem($itemId)
    {
        $this->db->table('menu_items')->where('id', $itemId)->update([
            'parent_id'  => $this->request->getPost('parent_id') ?: null,
            'title'      => $this->request->getPost('title'),
            'url'        => $this->request->getPost('url'),
            'icon'       => $this->request->getPost('icon'),
            'target'     => $this->request->getPost('target', '_self'),
            'sort_order' => $this->request->getPost('sort_order', 0),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        return redirect()->back()->with('success', 'Menu item diperbarui.');
    }

    public function deleteItem($itemId)
    {
        $this->db->table('menu_items')->where('id', $itemId)->delete();
        $this->db->table('menu_items')->where('parent_id', $itemId)->update(['parent_id' => null]);
        return redirect()->back()->with('success', 'Menu item dihapus.');
    }
}
