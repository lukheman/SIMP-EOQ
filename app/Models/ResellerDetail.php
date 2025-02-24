<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ResellerDetail extends Model
{
    protected $table = 'reseller_detail';
    protected $fillable = ['alamat'];

    public function user() {
        return $this->belongsTo(User::class, 'id_user');
    }
}
