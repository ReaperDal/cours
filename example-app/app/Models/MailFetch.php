<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

namespace App\Models;


class MailFetch extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'mail_id'];
}
