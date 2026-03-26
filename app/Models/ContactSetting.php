<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    use HasFactory;

    // The table name in your database
    protected $table = 'contact_settings';

    // Fields that can be updated from the Admin panel
    protected $fillable = [
        'phone',
        'email',
        'address',
        'office_timing',
        'google_map_link'
    ];

    /**
     * Helper to get the single settings row.
     * Since there is usually only one set of contact details.
     */
    public static function getSettings()
    {
        return self::first();
    }
}
