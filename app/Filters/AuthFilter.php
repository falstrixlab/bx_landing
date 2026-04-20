<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

/**
 * AuthFilter - Middleware untuk proteksi halaman admin
 * Menggantikan pengecekan session manual di setiap controller
 */
class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (! session()->get('islogin')) {
            session()->setFlashdata('nologin', 'Silakan login terlebih dahulu.');
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // nothing needed after
    }
}
