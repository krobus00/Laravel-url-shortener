<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
    use Uuids;
    use HasFactory;

    protected $fillable = [
        'target', 'custom_key', 'user_id'
    ];

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
            ->format('d, M Y H:i');
    }
}
