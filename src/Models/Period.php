<?php

namespace MakarenkoSergey\GoogleFields\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

abstract class Period extends Model
{
    protected $fillable = ['day', 'open_time', 'close_time'];

    public abstract function place(): BelongsTo;
}