<?php

namespace Laravel\Nova\Menu;

use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Makeable;

/**
 * @method static static make(array $items)
 */
class MenuList implements \JsonSerializable
{
    use Makeable;

    /**
     * The menu's component.
     *
     * @var string
     */
    public $component = 'menu-list';

    /**
     * The menu's items.
     *
     * @var \Illuminate\Support\Collection
     */
    public $items;

    /**
     * Construct a new Menu List instance.
     *
     * @param  array  $items
     */
    public function __construct($items)
    {
        $this->items($items);
    }

    /**
     * Set menu's items.
     *
     * @param  array  $items
     * @return $this
     */
    public function items($items = [])
    {
        $this->items = collect($items);

        return $this;
    }

    /**
     * Prepare the menu for JSON serialization.
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $request = app(NovaRequest::class);

        return [
            'component' => $this->component,
            'items' => $this->items->reject(function ($item) use ($request) {
                return method_exists($item, 'authorizedToSee') && ! $item->authorizedToSee($request);
            })->values(),
        ];
    }
}
