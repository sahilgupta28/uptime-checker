<?php

namespace App\Repositories\User;

interface UserInterface
{
    public function create(array $attributes);

    public function update(int $id, array $attributes);

    public function find(int $id);

    public function getWeeklyReport(int $id);

    public function all();

    public function list() : ?object;
}
