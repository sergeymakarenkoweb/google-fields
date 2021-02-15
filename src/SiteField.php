<?php


namespace MakarenkoSergey\GoogleFields;


use Laravel\Nova\Fields\Field;

class SiteField extends Field
{
    use DependsField;

    protected $dependsAttribute = 'website';

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'general-depend-field';
}