<?php


namespace MakarenkoSergey\GoogleFields\Traits;


use Illuminate\Database\Eloquent\Model;

trait HasLocation
{
    public $longitudeColumn = 'longitude';
    public $latitudeColumn = 'latitude';

    public function getLocationAttribute(): array
    {
        if ($this instanceof Model){
            return [
                'longitude' => $this->getAttribute($this->longitudeColumn),
                'latitude' => $this->getAttribute($this->latitudeColumn),
            ];
        }
        return [];
    }

    public function setLocationAttribute(string $value)
    {
        $location = json_decode($value, true);
        if ($this instanceof Model) {
            $this->setAttribute($this->longitudeColumn, $location['longitude']);
            $this->setAttribute($this->latitudeColumn, $location['latitude']);
        }
   }
}