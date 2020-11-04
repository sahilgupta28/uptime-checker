<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Website extends Model
{
    use Notifiable;

    public function routeNotificationFor($driver)
    {
        return $this->slack_hook;
    }

    protected $table = 'websites';
    protected $fillable = [
        'title',
        'user_id',
        'domain',
        'description',
        'status',
        'test_at',
        'slack_hook',
        'is_active',
        'status_updated_at'
    ];
    protected $hidden = ['updated_at', 'created_at'];
    protected $dates = [
        'created_at',
        'updated_at',
        'test_at',
        'status_updated_at'
    ];

    protected static $rules = [
        'title' => ['max:30', 'required', 'string'],
        'user_id' => ['required', 'Numeric', 'exists:users,id'],
        'domain' => ['max:100', 'required', 'string'],
        'description' => 'required',
        'status' => 'required',
        'test_at' => 'required',
        'is_active' => 'boolean'
    ];

    protected static $messages = [
        'title' => 'Title is required.',
        'user_id' => 'User Id is required',
        'domain' => 'Domain is required.',
        'description' => 'description is required.',
        'status' => 'Status is required.',
        'test_at' => 'Test date time is required.'
    ];

    public function testLogs()
    {
        return $this->hasMany(\App\Models\TestLog::class, 'website_id', 'id')
            ->orderBy('id', config('constants.DEFAULT.SORT'));
    }
}
