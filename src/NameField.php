<?php


namespace MakarenkoSergey\GoogleFields;


use Laravel\Nova\Fields\Field;

class NameField extends Field
{
    use DependsField;

    protected $dependsAttribute = 'name';

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'general-depend-field';
}