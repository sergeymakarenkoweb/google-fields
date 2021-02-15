<?php

namespace MakarenkoSergey\GoogleFields;

use App\Models\Country;
use Laravel\Nova\Fields\Field;

class AddressField extends Field
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'address-field';

    public function jsonSerialize()
    {
        $countries = Country::all()->map(function (Country $country) {
            return strtolower($country->getAttribute('code'));
        });
        return array_merge([
            'availableCountries' => $countries,
        ], parent::jsonSerialize());
    }
}
