<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Groups extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['user_id', 'worker_id', 'group_id', 'start', 'end', 'subject', 'chin_id', 'commission', 'pass'];

    public function exam()
    {
        return $this->hasMany(exam::class, 'group_id', 'id');
    }

    public static function allGroups()
    {
        return self::get();
    }

    public static function newGroup($data)
    {
        $newStr = new self();
        $newStr->user_id = $data['user_id'];
        $newStr->start = $data['start'];
        $newStr->end = $data['end'];
        $newStr->subject = $data['subject'];
        $newStr->chin = $data['chin'];
        $newStr->commission = $data['commission'];
        $newStr->quantity = $data['quantity'];
        $newStr->passed_on = $data['passed_on'];

        $newStr->save();

        return $newStr;
    }
}
