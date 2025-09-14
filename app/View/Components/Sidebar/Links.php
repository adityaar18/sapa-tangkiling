<?php

namespace App\View\Components\Sidebar;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Links extends Component
{
    /**
     * Create a new component instance.
     */
    public string $title, $route, $icon, $active;
    public function __construct(string $title, string $route, string $icon)
    {
        $this->title = $title;
        $this->route = $route;
        $this->icon = $icon;
        $basepath = $this->generatePath($route);
        $this->active = request()->routeIs($basepath) ? 'active' : '';
    }

    public function generatePath($route)
    {
        if (str_contains($route, '.')) {
            $path = explode('.', $route);
            return $path[0] . '.*';
        } else {
            return $route;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar.links');
    }
}
