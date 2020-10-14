<?php

namespace App\Repositories\TestLog;

interface TestLogInterface
{
    public function create(array $attributes);

    public function delete(int $website_id);
}
