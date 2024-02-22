<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['surname', 'name', 'lastname', 'org_id', 'phone', 'job', 'crust_id'];

    public function exam()
    {
        return $this->hasMany(exam::class, 'worker_id', 'id');
    }

    public function org()
    {
        return $this->belongsTo(Org::class, 'org_id');
    }

    public function crust()
    {
        return $this->hasOne(Crust::class, 'id','crust_id');
    }


    public static function allWorkers()
    {
        return self::with('org')->with('crust')->get();
    }

    public static function newWorker($data)
    {
        $newStr = new self();
        $newStr->surname = $data['surname'];
        $newStr->name = $data['name'];
        $newStr->lastname = $data['lastname'];
        $newStr->org_id = $data['org_id'];
        $newStr->phone = $data['phone'];
        $newStr->job = $data['job'];
        $newStr->crust_id = $data['crust_id'];

        $newStr->save();

        return $newStr;
    }
}
