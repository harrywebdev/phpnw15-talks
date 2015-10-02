<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Speaker extends Model
{

    /**
     * {@inheritdoc}
     */
    protected $guarded = ['id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function talks()
    {
        return $this->hasMany('App\Talk');
    }
}
