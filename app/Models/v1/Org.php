<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Org extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = ['name_kk', 'name_ru', 'email'];

    public function workers()
    {
        return $this->belongsTo(Workers::class, 'worker_id', 'id');
    }

}
