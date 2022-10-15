<?php

namespace Laravel\Nova\Fields;

class URL extends Text
{
    /**
     * The field's component.
     *
     * @var string
     */
    public $component = 'url-field';

    /**
     * The text used for the link.
     *
     * @var string
     */
    public $displayedAs;

    /**
     * Create a new field.
     *
     * @param  string  $name
     * @param  string|\Closure|callable|object|null  $attribute
     * @param  (callable(mixed, mixed, ?string):mixed)|null  $resolveCallback
     * @return void
     */
    public function __construct($name, $attribute = null, callable $resolveCallback = null)
    {
        parent::__construct($name, $attribute, $resolveCallback);

        $this->textAlign(Field::CENTER_ALIGN);
    }

    /**
     * Define the callback that should be used to display the field's value.
     *
     * @param  callable(mixed, mixed, string):mixed  $displayCallback
     * @return $this
     */
    public function displayUsing(callable $displayCallback)
    {
        $this->displayCallback = $displayCallback;

        return $this;
    }

    /**
     * Resolve the field's value.
     *
     * @param  mixed  $resource
     * @param  string|null  $attribute
     * @return void
     */
    public function resolve($resource, $attribute = null)
    {
        $this->displayedAs = $this->name;

        parent::resolve($resource, $attribute);
    }

    /**
     * Resolve the field's value using the display callback.
     *
     * @param  mixed  $value
     * @param  mixed  $resource
     * @param  string  $attribute
     * @return void
     */
    protected function resolveUsingDisplayCallback($value, $resource, $attribute)
    {
        $this->value = $value;
        $this->displayedAs = call_user_func($this->displayCallback, $value, $resource, $attribute);
    }

    /**
     * Prepare the field for JSON serialization.
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        return array_merge([
            'displayedAs' => $this->displayedAs,
        ], parent::jsonSerialize());
    }
}
