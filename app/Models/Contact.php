<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;
use App\Models\EmailOpen;

class Contact extends Model
{
    use HasFactory;
    protected $fillable = ['group_id', 'name', 'email'];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function emailOpens()
    {
        return $this->hasMany(EmailOpen::class);
    }
}
