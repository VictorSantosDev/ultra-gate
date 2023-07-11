<?php

namespace App\Domain\BankDeposit\Service;

use Exception;
use App\Models\BankAccount;
use App\Domain\UserRegister\Service\UserSevice;
use App\Domain\UserRegister\Entity\Interface\UserContract;
use App\Models\DepositAuthorizationCode;

class BanckDepositService
{
    private const DEP = 'DEP{{code}}';

    private const LIMIT_DEPOSIT = 10000;

    private const PROCESSED_STATE = 1;
    
    private UserSevice $userSevice;
    
    public function __construct()
    {
        $this->userSevice = resolve(UserSevice::class);
    }

    /** @param array $data */
    public function deposit(array $data): bool
    {
        $user = $this->userSevice->getUserById($data['userId']);

        $this->saveCodeByDeposit($user);
        $this->saveDeposit($user, $data['value']);
        $this->depositSuccess($user);

        return true;
    }

    private function saveCodeByDeposit(UserContract $user): void
    {
        try{
            DepositAuthorizationCode::create([
                'user_id' => $user->getId(),
                'code' => $this->generateCodeAuthorization(),
                'status' => 0
            ]);
        }catch(Exception){
            throw new Exception('Houve um erro ao gerar o código de transferência.');
        }
    }

    private function depositSuccess(UserContract $user): void
    {
        $codeDeposit = DepositAuthorizationCode::where('user_id', $user->getId())->first();
        $codeDeposit->status = self::PROCESSED_STATE;
        $codeDeposit->save();
    }

    private function saveDeposit(UserContract $user, int $value): bool
    {
        $bankCount = BankAccount::where(['user_id' => $user->getId()])->first();
        $this->checkExistCount($bankCount);

        $this->limitDeposit($value);

        $bankCount->value_by_count += $value;
        $bankCount->save();

        return true;
    }

    private function generateCodeAuthorization(): string
    {
        return str_replace('{{code}}', str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT), self::DEP);
    }

    private function checkExistCount($bankCount): void
    {
        if ($bankCount == null) {
            throw new Exception('Voce não possui uma conta, entre em contato com o suporte técnico.');
        }
    }

    private function limitDeposit(int $value): void
    {
        if ($value > self::LIMIT_DEPOSIT) {
            throw new Exception('Você só pode depositar o valor máximo de R$ 1.000,00 por deposito.');
        }
    }
}
