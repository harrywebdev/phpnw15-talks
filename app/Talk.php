<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Talk extends Model
{

    /**
     * {@inheritdoc}
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function speaker()
    {
        return $this->belongsTo('App\Speaker');
    }
}
