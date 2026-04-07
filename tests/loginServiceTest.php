<?php

namespace App\tests;

use App\repository\accountRepository;
use App\repository\customerRepository;
use App\service\loginService;
use App\entity\account;
use PHPUnit\Framework\TestCase;

class loginServiceTest extends TestCase
{

    public function testLoginWrongPassword()
    {
        $fakeUser = new account(
            'jean@test.com',
            password_hash('secret123', PASSWORD_ARGON2ID),
            '0600000000'
        );

        $accountRepoMock = $this->createMock(accountRepository::class);
        $customerRepoMock = $this->createMock(customerRepository::class);

        $accountRepoMock->method('findByMail')
            ->willReturn($fakeUser); // <--- Ici, on simule le retour de ton repo

        $service = new loginService($accountRepoMock, $customerRepoMock);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Wrong mdp');


        $service->login(['mail' => 'jean@test.com', 'password' => 'mauvaisMDP']);
    }

    public function testLoginWrongMail()
    {

        $fakeUser = new account(
            'jean@test.com',
            password_hash('secret123', PASSWORD_ARGON2ID),
            '0600000000'
        );

        $accountRepoMock = $this->createMock(accountRepository::class);
        $customerRepoMock = $this->createMock(customerRepository::class);

        $accountRepoMock->method('findByMail')
            ->willReturn(null);

        $service = new loginService($accountRepoMock, $customerRepoMock);

        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage('Identifiant ou Mot de passe');

        $service->login(['mail' => 'jean@test.com', 'password' => 'mauvaisMDP']);
    }
}
