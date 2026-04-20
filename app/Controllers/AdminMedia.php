<?php

namespace App\Controllers;

class AdminMedia extends BaseController
{
    private string $uploadRoot;
    private string $editorDir;

    public function __construct()
    {
        $this->session = \Config\Services::session();
        $this->uploadRoot = rtrim(ROOTPATH . 'assets/upload', DIRECTORY_SEPARATOR);
        $this->editorDir = $this->uploadRoot . DIRECTORY_SEPARATOR . 'editor';
    }

    public function index()
    {
        if (session()->get('islogin') != true) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }

        if (! is_dir($this->editorDir)) {
            mkdir($this->editorDir, 0775, true);
        }

        $files = [];
        $iterator = new \RecursiveIteratorIterator(
            new \RecursiveDirectoryIterator($this->uploadRoot, \FilesystemIterator::SKIP_DOTS)
        );

        foreach ($iterator as $file) {
            if (! $file->isFile()) {
                continue;
            }

            $absolutePath = $file->getPathname();
            $relativePath = str_replace($this->uploadRoot . DIRECTORY_SEPARATOR, '', $absolutePath);
            $relativePath = str_replace('\\', '/', $relativePath);

            $files[] = [
                'name' => $file->getFilename(),
                'relative_path' => $relativePath,
                'delete_key' => rtrim(strtr(base64_encode($relativePath), '+/', '-_'), '='),
                'url' => base_url('assets/upload/' . $relativePath),
                'size' => $file->getSize(),
                'updated_at' => date('Y-m-d H:i:s', $file->getMTime()),
                'folder' => dirname($relativePath) === '.' ? 'root' : dirname($relativePath),
                'is_image' => in_array(strtolower($file->getExtension()), ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'], true),
            ];
        }

        usort($files, static fn(array $left, array $right): int => strcmp($right['updated_at'], $left['updated_at']));

        $data = [
            'title' => 'Media Manager',
            'mediaFiles' => $files,
            'mediaStats' => [
                'total_files' => count($files),
                'total_images' => count(array_filter($files, static fn(array $file): bool => $file['is_image'])),
                'total_size' => array_sum(array_column($files, 'size')),
            ],
        ];

        return view('administrator/media/index', $data);
    }

    public function upload()
    {
        if (session()->get('islogin') != true) {
            return $this->respondUpload(false, 'Unauthorized', 401);
        }

        if (! is_dir($this->editorDir)) {
            mkdir($this->editorDir, 0775, true);
        }

        $validationRule = [
            'file' => [
                'label' => 'Media file',
                'rules' => [
                    'uploaded[file]',
                    'is_image[file]',
                    'mime_in[file,image/jpg,image/jpeg,image/png,image/gif,image/webp,image/svg+xml]',
                    'max_size[file,5120]',
                ],
            ],
        ];

        if (! $this->validate($validationRule)) {
            return $this->respondUpload(false, implode(' ', $this->validator->getErrors()), 422);
        }

        $file = $this->request->getFile('file');
        $newName = 'bxsea_editor_' . $file->getRandomName();
        $file->move($this->editorDir, $newName, true);

        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => true,
                'message' => 'File berhasil diunggah.',
                'filename' => $newName,
                'url' => base_url('assets/upload/editor/' . $newName),
                'csrfHash' => csrf_hash(),
            ])->setStatusCode(200);
        }

        $this->session->setFlashdata('success', 'File berhasil diunggah ke media library.');
        return redirect()->to(base_url(getenv('bxsea.admin') . '/media'));
    }

    public function delete(string $encodedPath)
    {
        if (session()->get('islogin') != true) {
            return redirect()->to(base_url(getenv('bxsea.admin')));
        }

        $relativePath = base64_decode(strtr($encodedPath, '-_', '+/'), true);
        if ($relativePath === false) {
            $this->session->setFlashdata('error', 'File media tidak valid.');
            return redirect()->to(base_url(getenv('bxsea.admin') . '/media'));
        }

        $relativePath = str_replace(['..\\', '../'], '', $relativePath);
        $absolutePath = realpath($this->uploadRoot . DIRECTORY_SEPARATOR . str_replace('/', DIRECTORY_SEPARATOR, $relativePath));
        $basePath = realpath($this->uploadRoot);

        if ($absolutePath === false || $basePath === false || strpos($absolutePath, $basePath) !== 0 || ! is_file($absolutePath)) {
            $this->session->setFlashdata('error', 'File media tidak ditemukan.');
            return redirect()->to(base_url(getenv('bxsea.admin') . '/media'));
        }

        unlink($absolutePath);
        $this->session->setFlashdata('success', 'File media berhasil dihapus.');

        return redirect()->to(base_url(getenv('bxsea.admin') . '/media'));
    }

    private function respondUpload(bool $success, string $message, int $statusCode)
    {
        if ($this->request->isAJAX()) {
            return $this->response->setJSON([
                'success' => $success,
                'message' => $message,
                'csrfHash' => csrf_hash(),
            ])->setStatusCode($statusCode);
        }

        $this->session->setFlashdata($success ? 'success' : 'error', $message);
        return redirect()->to(base_url(getenv('bxsea.admin') . '/media'));
    }
}
