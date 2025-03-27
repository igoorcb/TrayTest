<?php

namespace App\Services;

use App\Contracts\UserRepositoryInterface;
use App\Mail\ProfileCompletedMail;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Mail;

class UserService
{
    public function __construct(protected UserRepositoryInterface $userRepository) {}
    public function completeProfile(array $data): User
    {
        $user = $this->userRepository->findByEmail($data['email']);

        $user = $this->userRepository->update($user, [
            'name' => $data['name'],
            'cpf' => $data['cpf'],
            'birthdate' => $data['birthdate'],
        ]);

        Mail::to($user->email)->queue(new ProfileCompletedMail($user));

        return $user;
    }

    public function getFilteredUsers(array $filters)
    {
        return $this->userRepository->filter($filters);
    }
}
