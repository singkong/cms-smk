<?php

namespace App\Models;

class UserModel extends BaseModel
{
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $allowedFields    = ['username', 'email', 'password', 'full_name', 'photo', 'is_active', 'remember_token', 'last_login'];
    protected $beforeInsert     = ['hashPassword'];
    protected $beforeUpdate     = ['hashPassword'];

    protected $validationRules = [
        'username'  => 'required|min_length[3]|max_length[100]|is_unique[users.username,id,{id}]',
        'email'     => 'required|valid_email|max_length[100]|is_unique[users.email,id,{id}]',
        'full_name' => 'required|min_length[3]|max_length[255]',
    ];

    protected function hashPassword(array $data): array
    {
        if (isset($data['data']['password']) && !empty($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        } else {
            unset($data['data']['password']);
        }
        return $data;
    }

    public function getUserWithRoles($id)
    {
        $user = $this->find($id);
        if (!$user) return null;

        $roles = $this->db->table('user_roles')
            ->select('roles.*')
            ->join('roles', 'roles.id = user_roles.role_id')
            ->where('user_roles.user_id', $id)
            ->get()->getResult();

        $user->roles = $roles;
        return $user;
    }

    public function getUserPermissions($userId): array
    {
        return $this->db->table('role_permissions')
            ->select('permissions.slug')
            ->join('permissions', 'permissions.id = role_permissions.permission_id')
            ->join('user_roles', 'user_roles.role_id = role_permissions.role_id')
            ->where('user_roles.user_id', $userId)
            ->get()->getResultArray();
    }

    public function hasPermission($userId, $slug): bool
    {
        $result = $this->db->table('role_permissions')
            ->join('permissions', 'permissions.id = role_permissions.permission_id')
            ->join('user_roles', 'user_roles.role_id = role_permissions.role_id')
            ->where('user_roles.user_id', $userId)
            ->where('permissions.slug', $slug)
            ->countAllResults();

        return $result > 0;
    }
}
