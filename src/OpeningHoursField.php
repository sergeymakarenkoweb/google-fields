<?php


namespace MakarenkoSergey\GoogleFields;


use Laravel\Nova\Fields\Field;

class OpeningHoursField extends Field
{
    use DependsField;

    protected $dependsAttribute = 'openingHours';

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'opening-hours-field';

}