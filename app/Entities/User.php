<?php

// app/Entities/User.php
namespace App\Entities;

use CodeIgniter\Shield\Entities\User as ShieldUser;

class User extends ShieldUser
{
    protected $attributes = [
        'full_name' => null,
        'phone' => null,
        'address' => null,
    ];

    protected $datamap = [
        'full_name' => 'full_name',
        'phone' => 'phone',
        'address' => 'address',
    ];
}
