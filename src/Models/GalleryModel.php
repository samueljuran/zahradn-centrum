<?php

declare(strict_types=1);

namespace App\Models;

class GalleryModel extends BaseModel
{
    private string $table = 'gallery_images';

    
    public function findAll(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table} ORDER BY sort_order, id"
        );
        return $stmt->fetchAll();
    }

    
    public function findActive(): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE is_active = 1 ORDER BY sort_order, id"
        );
        $stmt->execute();
        return $stmt->fetchAll();
    }

    
    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE id = :id LIMIT 1"
        );
        $stmt->execute([':id' => $id]);
        $result = $stmt->fetch();
        return $result ?: null;
    }

    
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (title, filename, description, sort_order, is_active)
             VALUES (:title, :filename, :description, :sort_order, :is_active)"
        );
        return $stmt->execute([
            ':title'       => $data['title'],
            ':filename'    => $data['filename'],
            ':description' => $data['description'] ?? '',
            ':sort_order'  => $data['sort_order'] ?? 0,
            ':is_active'   => $data['is_active'] ?? 1,
        ]);
    }

    
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE {$this->table}
             SET title = :title,
                 description = :description,
                 sort_order = :sort_order,
                 is_active = :is_active
             WHERE id = :id"
        );
        return $stmt->execute([
            ':title'       => $data['title'],
            ':description' => $data['description'] ?? '',
            ':sort_order'  => $data['sort_order'] ?? 0,
            ':is_active'   => $data['is_active'] ?? 1,
            ':id'          => $id,
        ]);
    }

    public function delete(int $id): bool
    {
        
        $image = $this->findById($id);
        if ($image === null) {
            return false;
        }

        $stmt = $this->db->prepare(
            "DELETE FROM {$this->table} WHERE id = :id"
        );
        return $stmt->execute([':id' => $id]);
    }
}
