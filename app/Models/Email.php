<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Group;
use App\Models\EmailOpen;



class Email extends Model
{
    use HasFactory;
    // protected $fillable = ['group', 'from_email', 'to_email', 'cc_email','subject','body','is_draft','status'];
    protected $guarded = [];


    public function groups()
    {
        return $this->belongsToMany(Group::class);
    }

    public function opens()
    {
        return $this->hasMany(EmailOpen::class);
    }
}
