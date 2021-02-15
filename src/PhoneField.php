<?php


namespace MakarenkoSergey\GoogleFields;


use Laravel\Nova\Fields\Field;

class PhoneField extends Field
{
    use DependsField;

    protected $dependsAttribute = 'phone';

    public $component = 'general-depend-field';

}