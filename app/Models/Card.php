<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Card extends Model
{
    use HasFactory;
    use Sluggable;

    protected $fillable = ['title', 'description', 'manufacturer_id', 'group_id', 'price', 'wight', 'thumbnail'];

    public function manufacturer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function group(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getImage() {
        if(!$this->thumbnail) {
            return asset("No_image.png");
        }
        return asset($this->thumbnail);
    }

}
