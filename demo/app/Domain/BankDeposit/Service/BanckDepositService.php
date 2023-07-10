<?php

namespace App\Domain\BankDeposit\Service;

use App\Models\BankAccount;
use App\Domain\UserRegister\Service\UserSevice;
use Exception;

class BanckDepositService
{
    private const DEP = 'DEP{{code}}';

    private const LIMIT_DEPOSIT = 10000;
    
    private UserSevice $userSevice;
    
    public function __construct()
    {
        $this->userSevice = resolve(UserSevice::class);
    }

    /** @param array $data */
    public function deposit(array $data): bool
    {
        $user = $this->userSevice->getUserById($data['user_id']);

        $bankCount = BankAccount::where(['user_id' => $user->getId()])->first();

        dd($bankCount);

        $this->limitDeposit($data['value']);
        
        $bankCount->value_by_count = $data['value'];
        $bankCount->save();

        return true;
    }

    private function generateCodeAuthorization(): string
    {
        return str_replace('{{code}}', str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT), self::DEP);
    }

    private function checkExistCount($bankCount)
    {
        if ($bankCount == null) {
            throw new Exception('Voce não possui uma conta, entre em contato com o suporte técnico.');
        }
    }

    private function limitDeposit(int $value)
    {
        if ($value > self::LIMIT_DEPOSIT) {
            throw new Exception('Você só pode depositar o valor máximo de R$ 1.000,00 por deposito.');
        }
    }
}
