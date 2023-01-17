<?php

namespace App\View\Components\PatchNote;

use Illuminate\View\Component;

class Table extends Component
{
    public array $routes = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (!isset($this->routes[0])) {
            return;
        }

        $route =  $this->routes[0];

        if (
            empty($route['description']) &&
            empty($route['method']) &&
            empty($route['endpoint']) &&
            empty($route['action'])
        ) {
            return;
        }

        return view('components.patch-note.table');
    }
}
