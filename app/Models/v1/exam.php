<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class exam extends Model
{
    use HasFactory;

    protected $fillable = ['worker_id', 'group_id', 'pass'];

    public function group()
    {
        return $this->belongsTo(Groups::class, 'group_id', 'id');
    }

    public function workers()
    {
        return $this->belongsTo(Workers::class, 'worker_id', 'id');
    }

    public static function allExams()
    {
        return self::get();
    }

    public static function newExam($data)
    {
        $newStr = new self();
        $newStr->worker_id = $data['worker_id'];
        $newStr->group_id = $data['group_id'];
        $newStr->pass = false;
        $accessCode = str_pad(strval(random_int(0, 999999)), 6, '0', STR_PAD_LEFT);
        $newStr->access_code = $accessCode;

        $newStr->save();

        return $newStr;
    }
}
