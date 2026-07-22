<?php

namespace App\Controllers;

class RoleController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Role & Permission';

        $data['roles'] = $this->db->table('roles')->orderBy('name', 'ASC')->get()->getResult();

        foreach ($data['roles'] as $role) {
            $role->permission_count = $this->db->table('role_permissions')
                ->where('role_id', $role->id)
                ->countAllResults();
            $role->user_count = $this->db->table('user_roles')
                ->where('role_id', $role->id)
                ->countAllResults();
        }

        return view('admin/roles/index', $data);
    }

    public function permissions($roleId)
    {
        $data = $this->data;
        $data['title'] = 'Atur Permission';

        $data['role'] = $this->db->table('roles')->where('id', $roleId)->get()->getRow();
        if (!$data['role']) {
            return redirect()->to('/admin/roles')->with('error', 'Role tidak ditemukan.');
        }

        $data['permissions'] = $this->db->table('permissions')
            ->orderBy('group', 'ASC')
            ->orderBy('name', 'ASC')
            ->get()->getResult();

        $data['permission_groups'] = [];
        foreach ($data['permissions'] as $perm) {
            $group = $perm->group ?: 'Lainnya';
            $data['permission_groups'][$group][] = $perm;
        }

        $data['assigned_permissions'] = $this->db->table('role_permissions')
            ->where('role_id', $roleId)
            ->get()->getResult();

        $data['assigned_ids'] = array_column($data['assigned_permissions'], 'permission_id');

        return view('admin/roles/permissions', $data);
    }

    public function updatePermissions($roleId)
    {
        $role = $this->db->table('roles')->where('id', $roleId)->get()->getRow();
        if (!$role) {
            return redirect()->to('/admin/roles')->with('error', 'Role tidak ditemukan.');
        }

        $permissionIds = $this->request->getPost('permissions') ?? [];

        $this->db->table('role_permissions')->where('role_id', $roleId)->delete();

        foreach ($permissionIds as $permId) {
            $this->db->table('role_permissions')->insert([
                'role_id'       => $roleId,
                'permission_id' => $permId,
            ]);
        }

        $this->db->table('activity_logs')->insert([
            'user_id'     => session()->get('id'),
            'username'    => session()->get('username'),
            'module'      => 'Roles',
            'action'      => 'update_permissions',
            'description' => 'Memperbarui permission untuk role: ' . $role->name,
            'ip_address'  => $this->request->getIPAddress(),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);

        return redirect()->to('/admin/roles/permissions/' . $roleId)->with('success', 'Permission berhasil diperbarui.');
    }
}
