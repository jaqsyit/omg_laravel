<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crust extends Model
{
    use HasFactory;

    public function worker()
    {
        return $this->hasOne(Workers::class, 'crust_id','id');
    }

    public static function newCrust($data)
    {
        $newStr = new self();
        $newStr->user_id = $data['user_id'];

        $newStr->save();

        return $newStr;
    }
}
