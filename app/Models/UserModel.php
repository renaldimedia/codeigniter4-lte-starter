<?php

declare(strict_types=1);

namespace App\Models;

use CodeIgniter\Shield\Models\UserModel as ShieldUserModel;

class UserModel extends ShieldUserModel
{
    protected $returnType = \App\Entities\User::class;

    protected function initialize(): void
    {
        parent::initialize();

        $this->allowedFields = [
            ...$this->allowedFields,
            'full_name',
            'phone',
            'address'
            // 'first_name',
        ];
    }
}
