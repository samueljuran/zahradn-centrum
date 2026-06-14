<?php

declare(strict_types=1);

namespace App\Models;

class ServiceModel extends BaseModel
{
    private string $table = 'services';

    

    
    public function findAll(): array
    {
        $stmt = $this->db->query(
            "SELECT * FROM {$this->table} ORDER BY category, name"
        );
        return $stmt->fetchAll();
    }

    
    public function findActive(): array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE is_active = 1 ORDER BY category, price"
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
            "INSERT INTO {$this->table} (name, description, price, category, is_active)
             VALUES (:name, :description, :price, :category, :is_active)"
        );
        return $stmt->execute([
            ':name'        => $data['name'],
            ':description' => $data['description'],
            ':price'       => $data['price'],
            ':category'    => $data['category'],
            ':is_active'   => $data['is_active'] ?? 1,
        ]);
    }

    

    
    public function update(int $id, array $data): bool
    {
        $stmt = $this->db->prepare(
            "UPDATE {$this->table}
             SET name = :name,
                 description = :description,
                 price = :price,
                 category = :category,
                 is_active = :is_active
             WHERE id = :id"
        );
        return $stmt->execute([
            ':name'        => $data['name'],
            ':description' => $data['description'],
            ':price'       => $data['price'],
            ':category'    => $data['category'],
            ':is_active'   => $data['is_active'] ?? 1,
            ':id'          => $id,
        ]);
    }

    

    
    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare(
            "DELETE FROM {$this->table} WHERE id = :id"
        );
        return $stmt->execute([':id' => $id]);
    }

    
    public function getCategories(): array
    {
        $stmt = $this->db->query(
            "SELECT DISTINCT category FROM {$this->table} ORDER BY category"
        );
        return $stmt->fetchAll(\PDO::FETCH_COLUMN);
    }
}
