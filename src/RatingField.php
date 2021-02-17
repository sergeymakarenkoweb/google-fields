<?php


namespace MakarenkoSergey\GoogleFields;


use Laravel\Nova\Fields\Number;

class RatingField extends Number
{
    use DependsField;

    public function __construct($name, $attribute = null, $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);
        $this->step(0.1);
        $this->max(5);
        $this->min(1);
        $this->default(function () {
            return 1;
        });
    }

    protected $dependsAttribute = 'rating';

    public $component = 'general-depend-field';
}