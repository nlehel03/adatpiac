<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Dataset extends Model
{
    protected $table = 'datasets';
    const UPDATED_AT = null;

    protected $fillable = [
        'name',
        'price',
        'description',
        'num_rows',
        'num_cols',
        'attributes',
        'preview_img_path',
        'is_complete',
        'sellerid'
    ];
    protected $casts = [
        'is_complete' => 'boolean',
        'price' => 'integer',
        'num_rows' => 'integer',
        'num_cols' => 'integer',
        'attributes' => 'array',
        'created_at' => 'datetime',
    ];

    public function seller()
    {
        return $this ->belongsTo(User::class, 'sellerid');
    }

    public function getColumns()
    {
        return isset($this->attributes) && isset($this->attributes['attributes']) ? json_decode($this->attributes['attributes'], true) : [];
    }
}



