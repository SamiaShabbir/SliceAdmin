<?php

namespace App\Models\Api;

use Illuminate\Database\Eloquent\Model;

class ApiGetDataLog extends Model
{
    protected $table = 'api_get_data_logs';
    protected $fillable = [
        'uri',
        'request',
        'request_time',
        'response',
        'response_time',
        'request_ip',
        'status_code',
        'store_id',
        'order_id',
        'job_queue',
    ];
}
