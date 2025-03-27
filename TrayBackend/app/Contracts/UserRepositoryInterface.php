<?php

namespace App\Contracts;

use App\Models\User;

interface UserRepositoryInterface
{
    public function findByEmail(string $email): ?User;

    public function update(User $user, array $data): User;

    public function filter(array $filters, int $perPage = 10);
}
