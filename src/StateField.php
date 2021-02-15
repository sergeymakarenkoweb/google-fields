<?php


namespace MakarenkoSergey\GoogleFields;


use Laravel\Nova\Fields\Field;

class StateField extends Field
{
    use DependsField;

    protected $dependsAttribute = 'state';

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'general-depend-field';
}