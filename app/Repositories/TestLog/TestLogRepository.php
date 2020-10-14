<?php

namespace App\Repositories\TestLog;

use App\Models\TestLog;

class TestLogRepository implements TestLogInterface
{
    private $model;

    public function __construct(TestLog $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function delete(int $website_id)
    {
        return $this->model->where('website_id', $website_id)->delete();
    }
}
