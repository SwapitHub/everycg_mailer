<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class SmtpConfig extends Model
{
    use HasFactory;
    protected $table = 'smtp_config';

    protected $fillable = [
        'mail_mailer',
        'mail_host',
        'mail_port',
        'mail_username',
        'mail_password',
        'mail_encryption',
        'mail_from_address',
        'mail_from_name',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];
}
