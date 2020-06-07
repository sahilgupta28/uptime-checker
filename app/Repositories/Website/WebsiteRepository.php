<?php

namespace App\Repositories\Website;

use App\Models\Website;
use Illuminate\Pipeline\Pipeline;
use App\Notifications\TestFailNotification;

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
        ->get()
        ->map(function ($website) {
            $website->setRelation(
                'testLogs',
                $website->testLogs->take(10)
            );
            return $website;
        });
    }

    public function all()
    {
        return $this->model->all();
    }

    public function allFail()
    {
        return $this->model->where('status', false)->get();
    }

    public function notify($id)
    {
        return $this->model->whereId($id)->first()->notify(new TestFailNotification());
    }
}
