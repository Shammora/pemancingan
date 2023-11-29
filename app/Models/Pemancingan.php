<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemancingan extends Model
{
    use HasFactory;
    protected $table = 'pemancingan';

    public function Pemilik()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function Jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'pemancingan_id', 'id');
    }
}
