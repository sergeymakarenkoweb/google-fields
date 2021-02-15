<?


namespace MakarenkoSergey\GoogleFields;


use Laravel\Nova\Fields\BelongsTo;

class CountryField extends BelongsTo
{
    use DependsField;

    protected $dependsAttribute = 'country';

    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'country-field';
}