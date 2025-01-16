<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Author extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'authors';

    protected $fillable = ['name','bio','date_of_barth','nationality'];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
