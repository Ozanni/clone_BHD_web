<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Show extends Model
{
    protected $primaryKey = 'show_id';

    protected $fillable = ['movie_id', 'theaters_id', 'time', 'day'];

    public $timestamps = false;

    public function seats() {
        return $this->hasMany(Seat::class, 'show_id');
    }

    // Đăng ký các sự kiện Eloquent
    protected static function booted() {
        static::created(function ($show)
        {
            $seats = [];
            foreach (['A', 'B', 'C', 'D', 'E', 'F'] as $row) {
                for ($number = 1; $number <= 15; $number++) {
                    $seats[] = [
                        'seat_name' => "{$row}{$number}",
                        'show_id' => $show->show_id,
                    ];
                }
            }

            DB::table('seats')->insert($seats);
        });

        static::deleting(function ($show) {
            $show->seats()->delete();
        });

    }

}