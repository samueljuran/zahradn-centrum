<?php

declare(strict_types=1);

namespace App\Models;

class UserModel extends BaseModel
{
    private string $table = 'users';

    
    public function authenticate(string $username, string $password): ?array
    {
        $stmt = $this->db->prepare(
            "SELECT * FROM {$this->table} WHERE username = :username LIMIT 1"
        );
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return null;
    }

    
    public function updatePassword(int $id, string $newPassword): bool
    {
        $hash = password_hash($newPassword, PASSWORD_BCRYPT, ['cost' => 12]);
        $stmt = $this->db->prepare(
            "UPDATE {$this->table} SET password = :password WHERE id = :id"
        );
        return $stmt->execute([':password' => $hash, ':id' => $id]);
    }
}
