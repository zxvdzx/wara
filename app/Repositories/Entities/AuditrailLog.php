<?php

namespace App\Repositories\Entities;

use Illuminate\Database\Eloquent\Model;

class AuditrailLog extends Model
{
    protected $table = 'auditrail_logs';

    /**
     * {@inheritDoc}
     */
    
    protected $fillable = [
        'email',
        'action', 
        'table_name', 
        'old_data', 
        'new_data',
    ];

    public static function saveData($email,$action,$table,$oldData=[],$newData=[])
    {
        $old = json_encode($oldData);
        $new = json_encode($newData);
        
        $audit = new AuditrailLog;
        $audit->email       = $email;
        $audit->action      = $action;
        $audit->table_name  = $table;
        $audit->old_data    = $old;
        $audit->new_data    = $new;
        $audit->save();
    }
}
