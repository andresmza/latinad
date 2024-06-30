<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Display extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'price_per_day',
        'resolution_height',
        'resolution_width',
        'type',
        'user_id',
    ];

    /**
     * Scope a query to only include displays with a specific name.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $name
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeName($query, $name)
    {
        if (!empty($name)) {
            $query->where('name', 'LIKE', "%{$name}%");
        }
        return $query;
    }

    /**
     * Scope a query to only include displays of a specific type.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string|null $type
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeType($query, $type)
    {
        if (!empty($type)) {
            $query->where('type', $type);
        }
        return $query;
    }

    /**
     * Get the user that owns the display.
     *
     * Defines a "belongsTo" relationship between Display and User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
