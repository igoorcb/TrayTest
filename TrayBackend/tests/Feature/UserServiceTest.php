<?php

namespace Tests\Unit;

use App\Contracts\UserRepositoryInterface;
use App\Mail\ProfileCompletedMail;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
    public function test_complete_profile_updates_user_and_sends_email()
    {
        $mockUser = new User([
            'email' => 'igor@test.com',
            'name' => 'Igor Original',
            'cpf' => '00000000000',
            'birthdate' => '2000-01-10',
        ]);

        $data = [
            'email' => 'igor@test.com',
            'name' => 'Igor Novo',
            'cpf' => '54224675222',
            'birthdate' => '2000-10-10',
        ];

        $userRepo = $this->createMock(UserRepositoryInterface::class);

        $userRepo->expects($this->once())
            ->method('findByEmail')
            ->with($data['email'])
            ->willReturn($mockUser);

        $userRepo->expects($this->once())
            ->method('update')
            ->with($mockUser, [
                'name' => $data['name'],
                'cpf' => $data['cpf'],
                'birthdate' => $data['birthdate'],
            ])
            ->willReturn($mockUser);

        Mail::fake();

        $service = new UserService($userRepo);
        $returnedUser = $service->completeProfile($data);

        $this->assertEquals($mockUser, $returnedUser);

        Mail::assertQueued(ProfileCompletedMail::class, function ($mail) use ($mockUser) {
            return $mail->user->email === $mockUser->email;
        });
    }
}
