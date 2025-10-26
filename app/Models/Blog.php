<?php

class Blog
{
    private $db;

    public function __construct($database)
    {
        $this->db = $database;
    }

    public function getAll(): array
    {
        $stmt = $this->db->prepare("SELECT * FROM blogs ORDER BY created_at DESC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id): array|false
    {
        $stmt = $this->db->prepare("SELECT * FROM blogs WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($data)
    {
        $stmt = $this->db->prepare("INSERT INTO blogs (title, content, author, image_data, image_mime_type, image_filename) VALUES (?, ?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['title'],
            $data['content'],
            $data['author'],
            $data['image_data'] ?? null,
            $data['image_mime_type'] ?? null,
            $data['image_filename'] ?? null
        ]);
    }

    public function update($id, $data)
    {
        $stmt = $this->db->prepare("UPDATE blogs SET title = ?, content = ?, author = ?, image_data = ?, image_mime_type = ?, image_filename = ?, updated_at = CURRENT_TIMESTAMP WHERE id = ?");
        return $stmt->execute([
            $data['title'],
            $data['content'],
            $data['author'],
            $data['image_data'] ?? null,
            $data['image_mime_type'] ?? null,
            $data['image_filename'] ?? null,
            $id
        ]);
    }

    public function delete($id)
    {
        $stmt = $this->db->prepare("DELETE FROM blogs WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function validate($data)
    {
        $errors = [];

        if (empty($data['title'])) {
            $errors[] = 'Title is required';
        }

        if (empty($data['content'])) {
            $errors[] = 'Content is required';
        }

        if (empty($data['author'])) {
            $errors[] = 'Author is required';
        }

        return $errors;
    }

    public function uploadImage($file)
    {
        // ตรวจสอบว่าไฟล์ถูกอัพโหลดหรือไม่
        if (!isset($file['tmp_name']) || $file['error'] !== UPLOAD_ERR_OK) {
            return null;
        }

        $maxSize = 5 * 1024 * 1024; // 5MB
        if ($file['size'] > $maxSize) {
            return false;
        }

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $fileType = mime_content_type($file['tmp_name']);

        if (!in_array($fileType, $allowedTypes)) {
            return false;
        }

        // อ่านข้อมูลไฟล์เป็น binary
        $imageData = file_get_contents($file['tmp_name']);
        if ($imageData === false) {
            return false;
        }

        // สร้างชื่อไฟล์ใหม่
        $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
        $fileName = uniqid() . '_' . time() . '.' . $extension;

        return [
            'data' => $imageData,
            'mime_type' => $fileType,
            'filename' => $fileName
        ];
    }

    public function getImageById($id)
    {
        $stmt = $this->db->prepare("SELECT image_data, image_mime_type, image_filename FROM blogs WHERE id = ? AND image_data IS NOT NULL");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
