<?php

namespace Laravel\Nova\Fields;

use Illuminate\Support\Fluent;
use Laravel\Nova\Http\Requests\NovaRequest;

class FormData extends Fluent
{
    /**
     * Make fluent payload from request.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  array<string, mixed>  $fields
     * @return static
     */
    public static function make(NovaRequest $request, array $fields)
    {
        if (! is_null($request->resource) && ! is_null($request->resourceId)) {
            $fields["resource:{$request->resource}"] = $request->resourceId;
        }

        if (! is_null($request->relatedResource) && ! is_null($request->relatedResourceId)) {
            $fields["resource:{$request->relatedResource}"] = $request->relatedResourceId;
        }

        return new static($fields);
    }

    /**
     * Make fluent payload from request only on specific keys.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  array<int, string>  $onlyAttributes
     * @return static
     */
    public static function onlyFrom(NovaRequest $request, array $onlyAttributes)
    {
        return static::make($request, $request->only($onlyAttributes));
    }

    /**
     * Get an resource attribute from the fluent instance.
     *
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
     */
    public function resource($key, $default = null)
    {
        return $this->get("resource:{$key}", $default);
    }
}
