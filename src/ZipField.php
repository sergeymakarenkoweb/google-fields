<?php


namespace MakarenkoSergey\GoogleFields;


use Laravel\Nova\Fields\Field;

class ZipField extends Field
{
    use DependsField;

    protected $dependsAttribute = 'zip';

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'general-depend-field';

}