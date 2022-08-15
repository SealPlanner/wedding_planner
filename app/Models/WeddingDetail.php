<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeddingDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'detail_id';
    protected $fillable = ['wedding_id','health_beauty','flower_decor','invitation','attire','music','ceremony','jewelry','photo_video','catering','transportation','venue','souvenir'];
    public $timestamps = false;

}
