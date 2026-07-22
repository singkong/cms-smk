<?php

namespace App\Controllers;

use App\Models\UserModel;

class UserController extends BaseController
{
    public function index()
    {
        $data = $this->data;
        $data['title'] = 'Manajemen Pengguna';

        $data['users'] = $this->db->table('users')
            ->select('users.*')
            ->where('users.deleted_at', null)
            ->orderBy('users.id', 'DESC')
            ->get()->getResult();

        foreach ($data['users'] as $user) {
            $user->role_list = $this->db->table('user_roles')
                ->select('roles.name, roles.slug')
                ->join('roles', 'roles.id = user_roles.role_id')
                ->where('user_roles.user_id', $user->id)
                ->get()->getResult();
        }

        $data['roles'] = $this->db->table('roles')->orderBy('name', 'ASC')->get()->getResult();

        return view('admin/users/index', $data);
    }

    public function store()
    {
        $model = model(UserModel::class);

        $password = $this->request->getPost('password');
        if (empty($password)) {
            $password = 'password123';
        }

        $photo = $this->request->getFile('photo');
        $photoName = null;
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $photoName = $photo->getRandomName();
            $photo->move(FCPATH . 'uploads/avatars', $photoName);
        }

        $userData = [
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'password'  => $password,
            'full_name' => $this->request->getPost('full_name'),
            'photo'     => $photoName,
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        if (!$model->insert($userData)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        $userId = $model->getInsertID();

        $roleIds = $this->request->getPost('roles') ?? [];
        foreach ($roleIds as $roleId) {
            $this->db->table('user_roles')->insert([
                'user_id' => $userId,
                'role_id' => $roleId,
            ]);
        }

        $this->logActivity('Users', 'create', 'Membuat pengguna baru: ' . $this->request->getPost('username'));

        return redirect()->to('/admin/users')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function update($id)
    {
        $model = model(UserModel::class);

        $userData = [
            'username'  => $this->request->getPost('username'),
            'email'     => $this->request->getPost('email'),
            'full_name' => $this->request->getPost('full_name'),
            'is_active' => $this->request->getPost('is_active') ? 1 : 0,
        ];

        $password = $this->request->getPost('password');
        if (!empty($password)) {
            $userData['password'] = $password;
        }

        $photo = $this->request->getFile('photo');
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $oldUser = $model->find($id);
            if ($oldUser && $oldUser->photo && file_exists(FCPATH . 'uploads/avatars/' . $oldUser->photo)) {
                unlink(FCPATH . 'uploads/avatars/' . $oldUser->photo);
            }
            $photoName = $photo->getRandomName();
            $photo->move(FCPATH . 'uploads/avatars', $photoName);
            $userData['photo'] = $photoName;
        }

        if (!$model->update($id, $userData)) {
            return redirect()->back()->withInput()->with('errors', $model->errors());
        }

        $this->db->table('user_roles')->where('user_id', $id)->delete();
        $roleIds = $this->request->getPost('roles') ?? [];
        foreach ($roleIds as $roleId) {
            $this->db->table('user_roles')->insert([
                'user_id' => $id,
                'role_id' => $roleId,
            ]);
        }

        $this->logActivity('Users', 'update', 'Memperbarui pengguna: ' . $this->request->getPost('username'));

        return redirect()->to('/admin/users')->with('success', 'Pengguna berhasil diperbarui.');
    }

    public function delete($id)
    {
        if ($id == session()->get('id')) {
            return redirect()->to('/admin/users')->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user = model(UserModel::class)->find($id);
        if ($user) {
            model(UserModel::class)->delete($id);
            $this->logActivity('Users', 'delete', 'Menghapus pengguna: ' . $user->username);
        }

        return redirect()->to('/admin/users')->with('success', 'Pengguna berhasil dihapus.');
    }

    private function logActivity(string $module, string $action, string $description): void
    {
        $this->db->table('activity_logs')->insert([
            'user_id'     => session()->get('id'),
            'username'    => session()->get('username'),
            'module'      => $module,
            'action'      => $action,
            'description' => $description,
            'ip_address'  => $this->request->getIPAddress(),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);
    }
}
