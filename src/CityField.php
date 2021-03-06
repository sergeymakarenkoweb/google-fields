<?php


namespace MakarenkoSergey\GoogleFields;



use Laravel\Nova\Fields\Field;

class CityField extends Field
{
    use DependsField;

    protected $dependsAttribute = 'city';
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'general-depend-field';
}