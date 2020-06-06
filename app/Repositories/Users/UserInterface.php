<?php

namespace App\Repositories\User;

interface UserInterface
{
    public function create(array $attributes);

    public function find(int $id);
}
