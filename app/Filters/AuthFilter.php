<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('isLoggedIn')) {
            session()->set('redirect_url', current_url());
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (!empty($arguments)) {
            $permission = $arguments[0];
            $userModel = model(UserModel::class);
            if (!$userModel->hasPermission(session()->get('id'), $permission)) {
                return redirect()->to('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
            }
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
