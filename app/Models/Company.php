<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use phpDocumentor\Reflection\Types\Float_;
use Ramsey\Uuid\Type\Integer;

class Company extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'url',
        'email',
        'rating'
    ];

    /**
     * A collection of ratings for a company
     *
     * @return HasMany
     */
    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }





}
