<?php

namespace App\Repositories\User;

use App\Models\User;

class UserRepository implements UserInterface
{
    private $model;

    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }
}
