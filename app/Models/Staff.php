<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Model
{
    use Notifiable;

    protected $primaryKey = "id";
    protected $table = "staff";
    protected $fillable = ['document_no', 
                            'sampler',
                            'testing_parameter',
                            'recieved_date',
                            'sample_count',
                            'test_start_date',
                            'test_end_date',
                            'sample_no',
                            'parameter_and_values',
                            'specification',
                            'note',
                            'ttd_staff',
                            'ttd_operator',
                            'ttd_supervisor'
];
}
