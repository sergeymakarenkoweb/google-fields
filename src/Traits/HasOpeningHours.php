<?php


namespace MakarenkoSergey\GoogleFields\Traits;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use MakarenkoSergey\GoogleFields\Models\Period;
use RuntimeException;

/**
 * @property Collection<Period> hours
 * @property Collection<Period> newPeriods
 * @property Collection<Period> deprecatedPeriods
 */
trait HasOpeningHours
{
    public $newPeriods;
    public $deprecatedPeriods;

    public function __construct()
    {
        self::saved(function ($model) {
            $model->hours()->saveMany($model->newPeriods);
            $model->deprecatedPeriods->each(function (Period $period) {
                $period->delete();
            });
        });
    }

    public function setOpeningHoursAttribute(string $value)
    {
        if (!$this instanceof Model) {
            throw new RuntimeException('This trait only for Models');
        }
        $periodModel = $this->makePeriod();

        if (empty($value)) {
            $periods = collect();
        } else {
            $periods = collect(json_decode($value, true));
        }

        $this->deprecatedPeriods = $this->hours->filter(function (Period $period) use ($periods) {
            return !$periods->first(function (array $p) use ($period) {
               return isset($p[$period->getKeyName()])
                   && $p[$period->getKeyName()] === $period->getKey();
            });
        });
        $this->newPeriods = $periods->filter(function (array $period) use ($periodModel) {
            return !isset($period[$periodModel->getKeyName()])
                || !$periodModel::where('id', $period[$periodModel->getKeyName()])->exists();
        })->map(function ($period) {    
            return $this->makePeriod()->fill($period);
        });
    }

    public function getOpeningHoursAttribute(): ?Collection
    {
        if (!$this instanceof Model) {
            throw new RuntimeException('This trait only for Models');
        }
        $result = $this->hours()->orderBy('day')->get();
        if ($result->isEmpty()) {
            return null;
        }
        return $result;
    }

    public function hours(): HasMany
    {
        if (!$this instanceof Model) {
            throw new RuntimeException('This trait only for Models');
        }
        return $this->hasMany($this->getPeriodModel());
    }

    abstract protected function getPeriodModel(): string;

    protected function makePeriod(): Period
    {
        $openingHoursModel = $this->getPeriodModel();
        return new $openingHoursModel;
    }
}