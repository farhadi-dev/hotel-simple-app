<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 */
class Hotel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'address',
        'image'
    ];
    public function rooms(){
        return $this->hasMany(Room::class);
    }
}
