<?php

namespace App\Repositories\Website;

interface WebsiteInterface
{
    public function create(array $attributes);

    public function update(int $id, array $attributes);

    public function find(int $id);

    public function list();

    public function all();

    public function allFail();

    public function notify($id);

    public function getDailyReport($id);

    public function updateNotificationKey($id, $key, $started_at);
}
