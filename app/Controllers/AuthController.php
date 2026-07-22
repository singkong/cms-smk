<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/dashboard');
        }

        $data = $this->data;
        $data['title'] = 'Login';

        return view('auth/login', $data);
    }

    public function attemptLogin()
    {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        $userModel = model(UserModel::class);
        $user = $userModel->where('username', $username)
            ->orWhere('email', $username)
            ->withDeleted()
            ->first();

        if ($user && password_verify($password, $user->password)) {
            if (!$user->is_active) {
                $this->logLogin($user, 'failed');
                return redirect()->back()->withInput()->with('error', 'Akun tidak aktif. Hubungi administrator.');
            }

            $userModel->update($user->id, ['last_login' => date('Y-m-d H:i:s')]);

            $roles = $this->db->table('user_roles')
                ->select('roles.slug')
                ->join('roles', 'roles.id = user_roles.role_id')
                ->where('user_roles.user_id', $user->id)
                ->get()->getResultArray();

            $roleSlugs = array_column($roles, 'slug');

            session()->set([
                'id'         => $user->id,
                'username'   => $user->username,
                'full_name'  => $user->full_name,
                'email'      => $user->email,
                'photo'      => $user->photo,
                'roles'      => $roleSlugs,
                'isLoggedIn' => true,
            ]);

            if ($remember) {
                $token = bin2hex(random_bytes(32));
                $userModel->update($user->id, ['remember_token' => $token]);
                setcookie('remember', $token, time() + 86400 * 30, '/', '', false, true);
            }

            $this->logLogin($user, 'success');

            $redirectUrl = session()->get('redirect_url') ?? '/dashboard';
            session()->remove('redirect_url');

            return redirect()->to($redirectUrl)->with('success', 'Selamat datang, ' . $user->full_name);
        }

        $this->logLogin($user ?? (object)['id' => null], 'failed');
        return redirect()->back()->withInput()->with('error', 'Username atau password salah.');
    }

    public function logout()
    {
        if (session()->get('isLoggedIn')) {
            $this->logActivity(session()->get('id'), 'Auth', 'Logout', 'User logged out');
        }

        session()->destroy();

        if (isset($_COOKIE['remember'])) {
            setcookie('remember', '', time() - 3600, '/');
        }

        return redirect()->to('/login')->with('success', 'Anda telah logout.');
    }

    protected function logLogin($user, string $status): void
    {
        $this->db->table('login_logs')->insert([
            'user_id'    => $user->id ?? null,
            'username'   => $user->username ?? $this->request->getPost('username'),
            'ip_address' => $this->request->getIPAddress(),
            'user_agent' => $this->request->getUserAgent()->getAgentString(),
            'status'     => $status,
            'created_at' => date('Y-m-d H:i:s'),
        ]);
    }

    protected function logActivity(int $userId, string $module, string $action, ?string $desc = null): void
    {
        $user = model(UserModel::class)->find($userId);
        $this->db->table('activity_logs')->insert([
            'user_id'     => $userId,
            'username'    => $user->username ?? 'unknown',
            'module'      => $module,
            'action'      => $action,
            'description' => $desc,
            'ip_address'  => $this->request->getIPAddress(),
            'created_at'  => date('Y-m-d H:i:s'),
        ]);
    }
}
