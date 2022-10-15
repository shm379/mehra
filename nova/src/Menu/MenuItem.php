<?php

namespace Laravel\Nova\Menu;

use Illuminate\Support\Traits\Macroable;
use InvalidArgumentException;
use JsonSerializable;
use Laravel\Nova\AuthorizedToSee;
use Laravel\Nova\Makeable;
use Laravel\Nova\URL;
use Laravel\Nova\WithBadge;

/**
 * @method static static make(string $name, string|null $path = null)
 */
class MenuItem implements JsonSerializable
{
    use AuthorizedToSee;
    use Makeable;
    use WithBadge;
    use Macroable;

    /**
     * The menu's component.
     *
     * @var string
     */
    public $component = 'menu-item';

    /**
     * The menu item's name.
     *
     * @var string
     */
    public $name;

    /**
     * The menu's path.
     *
     * @var string|null
     */
    public $path;

    /**
     * The menu's request method (GET, POST, PUT, PATCH, DELETE).
     *
     * @var string
     */
    public $method = 'GET';

    /**
     * The menu's data.
     *
     * @var array<string, string>|null
     */
    public $data = null;

    /**
     * The menu's headers.
     *
     * @var array<string, string>|null
     */
    public $headers = null;

    /**
     * Indicate whether the menu's resolve to an external URL.
     *
     * @var bool
     */
    public $external = false;

    /**
     * Construct a new Menu Item instance.
     *
     * @param  string  $name
     * @param  string|null  $path
     */
    public function __construct($name, $path = null)
    {
        $this->name = $name;
        $this->path = $path;
    }

    /**
     * Create a menu item from a resource class.
     *
     * @param  class-string<\Laravel\Nova\Resource>  $resourceClass
     * @return static
     */
    public static function resource($resourceClass)
    {
        return static::make(
            $resourceClass::label()
        )->path('/resources/'.$resourceClass::uriKey())
        ->canSee(function ($request) use ($resourceClass) {
            return $resourceClass::availableForNavigation($request) && $resourceClass::authorizedToViewAny($request);
        });
    }

    /**
     * Create a menu item from a lens class.
     *
     * @param  class-string<\Laravel\Nova\Resource>  $resourceClass
     * @param  class-string<\Laravel\Nova\Lenses\Lens>  $lensClass
     * @return static
     */
    public static function lens($resourceClass, $lensClass)
    {
        return with(new $lensClass, function ($lens) use ($resourceClass) {
            return static::make($lens->name())
                ->path('/resources/'.$resourceClass::uriKey().'/lens/'.$lens->uriKey())
                ->canSee(function ($request) use ($lens) {
                    return $lens->authorizedToSee($request);
                });
        });
    }

    /**
     * Set menu's path.
     *
     * @param  string  $href
     * @return $this
     */
    public function path($href)
    {
        $this->path = $href;

        return $this;
    }

    /**
     * Create a menu from dashboard class.
     *
     * @param  class-string<\Laravel\Nova\Dashboard>  $dashboard
     * @return static
     */
    public static function dashboard($dashboard)
    {
        return with(new $dashboard(), function ($dashboard) {
            return static::make(
                $dashboard->label(),
                '/dashboards/'.$dashboard->uriKey()
            )->canSee(function ($request) use ($dashboard) {
                return $dashboard->authorizedToSee($request);
            });
        });
    }

    /**
     * Create menu to an internal Nova path.
     *
     * @param  string  $name
     * @param  string  $path
     * @return static
     */
    public static function link($name, $path)
    {
        return new static($name, $path);
    }

    /**
     * Create menu to an external URL.
     *
     * @param  string  $name
     * @param  string  $path
     * @return static
     */
    public static function externalLink($name, $path)
    {
        return (new static($name, $path))->external();
    }

    /**
     * Marked as external url.
     *
     * @return $this
     */
    public function external()
    {
        $this->external = true;

        return $this;
    }

    /**
     * Set menu's method, and optionally data or headers.
     *
     * @param  string  $method
     * @param  array<string, string>|null  $data
     * @param  array<string, string>|null  $headers
     * @return $this
     */
    public function method($method, $data = null, $headers = null)
    {
        if (! in_array($method, ['GET', 'POST', 'PUT', 'PATCH', 'DELETE'])) {
            throw new InvalidArgumentException('Only supports GET, POST, PUT, PATCH or DELETE method');
        }

        $this->method = $method;

        return $this->data($data)
            ->headers($headers);
    }

    /**
     * Set menu's headers.
     *
     * @param  array<string, string>|null  $headers
     * @return $this
     */
    public function headers($headers = null)
    {
        $this->headers = $headers;

        return $this;
    }

    /**
     * Set menu's data.
     *
     * @param  array<string, string>|null  $data
     * @return $this
     */
    public function data($data = null)
    {
        $this->data = $data;

        return $this;
    }

    /**
     * Set menu's name.
     *
     * @param  string  $name
     * @return $this
     */
    public function name($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Prepare the menu for JSON serialization.
     *
     * @return array<string, mixed>
     */
    public function jsonSerialize(): array
    {
        $url = URL::make($this->path, $this->external);

        return [
            'name' => __($this->name),
            'component' => $this->component,
            'path' => (string) $url,
            'external' => $this->external,
            'method' => $this->method,
            'data' => $this->data,
            'headers' => $this->headers,
            'active' => $url->active(),
            'badge' => $this->resolveBadge(),
        ];
    }
}
