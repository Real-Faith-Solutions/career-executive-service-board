<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FailedAttempt extends Model
{
    use HasFactory;

    protected $table = 'failed_attempts'; // Specify the table name

    protected $fillable = [
        'email',
        'ip_address', 
        'attempts', 
        'suspension', 
    ];

    public static function addOrUpdateFailedAttempts($email, $ip_address)
    {
        $record = self::where('email', $email)
            ->where('ip_address', $ip_address)
            ->first();

        if ($record) {
            // Update attempts count
            $record->attempts += 1;

            // Update suspension based on attempts count
            if ($record->attempts >= 5) {
                if ($record->suspension === 0) {
                    $record->suspension = 5;
                    $record->attempts = 0;
                } elseif ($record->suspension === 5) {
                    $record->suspension = 30;
                    $record->attempts = 0;
                } elseif ($record->suspension === 30) {
                    $record->suspension = 1440;
                    $record->attempts = 0;
                }
            }

            $record->save();
        } else {
            // Create a new record
            self::create([
                'email' => $email,
                'ip_address' => $ip_address,
                'attempts' => 1,
                'suspension' => 0,
            ]);
        }
    }

}
