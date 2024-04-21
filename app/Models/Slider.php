<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Slider extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $table ='slider';

    protected $fillable = ['image','title','subtitle','description'];
}
