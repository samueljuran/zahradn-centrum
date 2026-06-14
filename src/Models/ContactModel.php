<?php

declare(strict_types=1);

namespace App\Models;

class ContactModel extends BaseModel
{
    private string $table = 'contact_messages';

    
    public function create(array $data): bool
    {
        $stmt = $this->db->prepare(
            "INSERT INTO {$this->table} (name, email, message)
             VALUES (:name, :email, :message)"
        );
        return $stmt->execute([
            ':name'    => $data['name'],
            ':email'   => $data['email'],
            ':message' => $data['message'],
        ]);
    }

    
    public function findAll(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table} ORDER BY created_at DESC"
        );
        return $stmt->fetchAll();
    }

    public function markAsRead(int $id): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET is_read = 1 WHERE id = :id"
        );
        return $stmt->execute([':id' => $id]);
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM {$this->table} WHERE id = :id"
        );
        return $stmt->execute([':id' => $id]);
    }

    public function countUnread(): int
    {
        $stmt = $this->db->query(
            "SELECT COUNT(*) FROM {$this->table} WHERE is_read = 0"
        );
        return (int) $stmt->fetchColumn();
    }
}
