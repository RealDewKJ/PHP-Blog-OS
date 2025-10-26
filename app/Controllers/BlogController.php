<?php

require_once __DIR__ . '/../Models/Database.php';
require_once __DIR__ . '/../Models/Blog.php';

class BlogController
{
    private $blogModel;

    public function __construct()
    {
        $database = new Database();
        $db = $database->getConnection();
        $this->blogModel = new Blog($db);
    }

    public function index()
    {
        $blogs = $this->blogModel->getAll();
        include __DIR__ . '/../Views/blog/index.php';
    }

    public function show($id)
    {
        $blog = $this->blogModel->getById($id);
        if (!$blog) {
            header('Location: /php-project/');
            exit;
        }
        include __DIR__ . '/../Views/blog/show.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'content' => $_POST['content'] ?? '',
                'author' => $_POST['author'] ?? ''
            ];

            $errors = $this->blogModel->validate($data);

            // จัดการอัพโหลดรูปภาพ
            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $imageResult = $this->blogModel->uploadImage($_FILES['image']);
                if ($imageResult === false) {
                    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                        $errors[] = 'Image file is too large. Maximum size is 5MB.';
                    } else {
                        $errors[] = 'Invalid image file type. Only JPEG, PNG, GIF, and WebP are allowed.';
                    }
                } elseif ($imageResult !== null) {
                    $data['image_data'] = $imageResult['data'];
                    $data['image_mime_type'] = $imageResult['mime_type'];
                    $data['image_filename'] = $imageResult['filename'];
                }
            }

            if (empty($errors)) {
                if ($this->blogModel->create($data)) {
                    $data['success'] = true;
                    $data['success_message'] = 'Blog post created successfully!';
                } else {
                    $errors[] = 'Failed to create blog post';
                }
            }
        } else {
            $data = ['title' => '', 'content' => '', 'author' => '', 'image_data' => null, 'image_mime_type' => null, 'image_filename' => null];
            $errors = [];
        }

        include __DIR__ . '/../Views/blog/form.php';
    }

    public function edit($id)
    {
        $blog = $this->blogModel->getById($id);
        if (!$blog) {
            header('Location: /php-project/');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'title' => $_POST['title'] ?? '',
                'content' => $_POST['content'] ?? '',
                'author' => $_POST['author'] ?? '',
                'image_data' => $blog['image_data'], // เก็บรูปเดิมไว้ก่อน
                'image_mime_type' => $blog['image_mime_type'],
                'image_filename' => $blog['image_filename']
            ];

            $errors = $this->blogModel->validate($data);

            // จัดการอัพโหลดรูปภาพใหม่
            if (isset($_FILES['image']) && $_FILES['image']['error'] !== UPLOAD_ERR_NO_FILE) {
                $imageResult = $this->blogModel->uploadImage($_FILES['image']);
                if ($imageResult === false) {
                    if ($_FILES['image']['size'] > 5 * 1024 * 1024) {
                        $errors[] = 'Image file is too large. Maximum size is 5MB.';
                    } else {
                        $errors[] = 'Invalid image file type. Only JPEG, PNG, GIF, and WebP are allowed.';
                    }
                } elseif ($imageResult !== null) {
                    $data['image_data'] = $imageResult['data'];
                    $data['image_mime_type'] = $imageResult['mime_type'];
                    $data['image_filename'] = $imageResult['filename'];
                }
            }

            if (empty($errors)) {
                if ($this->blogModel->update($id, $data)) {
                    $data['success'] = true;
                    $data['success_message'] = 'Blog post updated successfully!';
                } else {
                    $errors[] = 'Failed to update blog post';
                }
            }
        } else {
            $data = $blog;
            $errors = [];
        }

        include __DIR__ . '/../Views/blog/form.php';
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->blogModel->delete($id);
        }
        header('Location: /php-project/');
        exit;
    }

    public function showImage($id)
    {
        $imageData = $this->blogModel->getImageById($id);

        if (!$imageData) {
            http_response_code(404);
            exit('Image not found');
        }

        header('Content-Type: ' . $imageData['image_mime_type']);
        header('Content-Disposition: inline; filename="' . $imageData['image_filename'] . '"');
        header('Cache-Control: public, max-age=31536000'); // Cache for 1 year

        echo $imageData['image_data'];
        exit;
    }
}
