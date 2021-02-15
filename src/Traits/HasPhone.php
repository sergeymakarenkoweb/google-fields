<?php


namespace MakarenkoSergey\GoogleFields\Traits;


use Illuminate\Database\Eloquent\Model;

trait HasPhone
{
    public function setPhoneAttribute(string $value)
    {
        if ($this instanceof Model) {
            $this->setAttribute('phones', explode(',', str_replace(', ', ',', $value)));
        }
    }

    public function getPhoneAttribute(): ?string
    {
        if ($this instanceof Model) {
            if (!empty($this->getAttribute('phones'))) {
                return implode(',', $this->getAttribute('phones'));
            }
            return null;
        }
        return null;
    }
}