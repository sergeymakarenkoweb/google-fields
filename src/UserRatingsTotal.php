<?php


namespace MakarenkoSergey\GoogleFields;


use Laravel\Nova\Fields\Number;

class UserRatingsTotal extends Number
{
    use DependsField;

    protected $dependsAttribute = 'totalReviews';

    public $component = 'general-depend-field';
}