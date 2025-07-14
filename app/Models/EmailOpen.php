<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Email;
use App\Models\Contact;

class EmailOpen extends Model
{
    use HasFactory;
    protected $fillable = ['email_id', 'contact_id', 'opened_at'];

    protected $casts = [
        'opened_at' => 'datetime',
    ];

    public function email()
    {
        return $this->belongsTo(Email::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }
}
