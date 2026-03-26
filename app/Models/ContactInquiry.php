<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactInquiry extends Model
{
    use HasFactory;

    // The table name in your database
    protected $table = 'contact_inquiries';

    // Fields that can be filled via the request
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'message'
    ];
}
