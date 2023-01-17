<?php

namespace App\View\Components\PatchNote;

use Illuminate\View\Component;

class Content extends Component
{
    public string $tag = '';
    public string $description = '';
    public array $routes = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(array|string $content)
    {
        if (!empty($content['tag'])) {
            $this->tag = $content['tag'];
        }

        if (!empty($content['description'])) {
            $this->description = $content['description'];
        }

        if (!empty($content['routes'])) {
            $this->routes = $content['routes'];
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (empty($this->tag) && empty($this->description) && empty($this->routes)) {
            return;
        }

        return view('components.patch-note.content');
    }
}
