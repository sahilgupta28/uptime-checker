<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestLog extends Model
{
    protected $table = 'test_logs';
    protected $fillable = [
        'website_id',
        'status',
        'test_at'
    ];
    protected $hidden = ['updated_at', 'created_at'];

    protected static $rules = [
        'website_id' => ['required', 'Numeric', 'exists:websites,id'],
        'status' => 'required',
        'test_at' => 'required  '
    ];

    protected static $messages = [
        'website_id' => 'Website Id is required',
        'status' => 'Status is required.',
        'test_at' => 'Test date time is required.'
    ];
}
