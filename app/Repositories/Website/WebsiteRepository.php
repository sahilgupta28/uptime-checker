<?php

namespace App\Repositories\Website;

use App\Models\Website;
use Illuminate\Pipeline\Pipeline;

class WebsiteRepository implements WebsiteInterface
{
    private $model;

    public function __construct(Website $model)
    {
        $this->model = $model;
    }

    public function create(array $attributes)
    {
        return $this->model->create($attributes);
    }

    public function update(int $id, array $attributes)
    {
        return $this->model->whereId($id)->update($attributes);
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function list()
    {
        return app(Pipeline::class)
        ->send($this->model)
        ->through([
            \App\QueryFilters\Sort::class,
            \App\QueryFilters\Website\LoginUser::class
        ])
        ->thenReturn()
        ->paginate(config('constants.DEFAULT.PAGINATION'));
    }

    public function all()
    {
        return $this->model->all();
    }
}
