<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        'table',
        'datetime'
    ];

    public static function isFileChanged($table, $file)
    {
        $log = static::where('table', $table)->first();

        if ($log->datetime != date("Y-m-d H:i:s", filemtime($file)))
        {
            $log->datetime = date("Y-m-d H:i:s", filemtime($file));
            $saved = $log->save();
            return true;
        }
        else {
            return false;
        }
    }
}
