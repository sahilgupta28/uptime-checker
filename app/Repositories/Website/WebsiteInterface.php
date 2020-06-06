<?php

namespace App\Repositories\Website;

interface WebsiteInterface
{
    public function create(array $attributes);

    public function update(int $id, array $attributes);

    public function find(int $id);

    public function list();

    public function all();
}
