<?php


namespace MakarenkoSergey\GoogleFields;


use Laravel\Nova\Fields\Field;

class LocationField extends Field
{
    use DependsField;

    protected $dependsAttribute = 'location';

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'location-field';

}