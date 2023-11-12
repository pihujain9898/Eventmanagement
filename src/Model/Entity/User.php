<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher;

class User extends Entity
{
    protected array $_accessible = [
        'fname' => true,
        'lname' => true,
        'email' => true,
        'password' => true,
        'user_role' => true,
        'is_verified' => true,
        'created_at' => true,
        'updated_at' => true,
    ];

    protected array $_hidden = [
        'password',
    ];

    // protected function _setPassword(string $password)
    // {
    //     $hasher = new DefaultPasswordHasher();
    //     return $hasher->hash($password);
    // }
}
