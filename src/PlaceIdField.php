<?php


namespace MakarenkoSergey\GoogleFields;


use Laravel\Nova\Fields\Field;

class PlaceIdField extends Field
{
    use DependsField;

    protected $dependsAttribute = 'placeId';

    public $component = 'general-depend-field';
}