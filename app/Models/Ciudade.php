<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudade extends Model
{
	use HasFactory;
	
    public $timestamps = true;

    protected $table = 'ciudades';

    protected $fillable = ['nombre','codigo_postal'];
	
}
