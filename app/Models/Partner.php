<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Partner extends Model
{
    protected $table = 'partners';

    protected $fillable = [
        'name',
        'enrolfee',
        'percentagefee',
        'partner_parent_id',
    ];

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function parent(): HasOne
    {
        return $this->hasOne(Partner::class, 'partner_parent_id', 'id');
    }

}
