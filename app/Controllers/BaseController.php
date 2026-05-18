<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\CLIRequest;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController provides a convenient place for loading components
 * and performing functions that are needed by all your controllers.
 * Extend this class in any new controllers:
 *     class Home extends BaseController
 *
 * For security be sure to declare any new methods as protected or private.
 */
abstract class BaseController extends Controller
{
    protected $request;
    protected $helpers = [];
    protected $session;
    protected $Crud;
    protected $db;

    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }

    /**
     * Check if a file was actually uploaded (not an empty file field).
     * Fixes the bug where UploadedFile object != "" is always true.
     * Note: does NOT check hasMoved() so ternary still works after move.
     */
    protected function hasUploadedFile($file): bool
    {
        return $file !== null
            && $file instanceof \CodeIgniter\HTTP\Files\UploadedFile
            && $file->isValid()
            && $file->getError() !== UPLOAD_ERR_NO_FILE;
    }

    /**
     * Delete a file from the upload directory using absolute path.
     */
    protected function deleteUploadFile(string $relativePath): void
    {
        $abs = ROOTPATH . ltrim($relativePath, '/');
        if (is_file($abs)) {
            @unlink($abs);
        }
    }
}