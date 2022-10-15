<?php

namespace Laravel\Nova\Fields;

use Illuminate\Support\Arr;

trait SupportsDependentFields
{
    /**
     * List of field dependencies.
     *
     * @var array<int, array{attributes: array<int, string>, mixin: callable|class-string}>
     */
    protected $fieldDependencies = [];

    /**
     * Register depends on to a field.
     *
     * @param  string|array<int, string|\Laravel\Nova\Fields\Field>  $attributes
     * @param  (callable(self, \Laravel\Nova\Http\Requests\NovaRequest, \Laravel\Nova\Fields\FormData):void)|class-string  $mixin
     * @return $this
     */
    public function dependsOn($attributes, $mixin)
    {
        array_push($this->fieldDependencies, [
            'attributes' => collect(Arr::wrap($attributes))->map(function ($item) {
                return $item instanceof Field ? $item->attribute : $item;
            })->all(),
            'mixin' => $mixin,
        ]);

        return $this;
    }
}
