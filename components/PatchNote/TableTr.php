<?php

namespace App\View\Components\PatchNote;

use Illuminate\View\Component;

class TableTr extends Component
{
    public string $description = '';
    public string $action = '';
    public string $method = '';
    public string $endpoint = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        string $description,
        string $action,
        string $method,
        string $endpoint
    ) {
        $this->description = $description;
        $this->action = $action;
        $this->method = $method;
        $this->endpoint = $endpoint;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.patch-note.table-tr');
    }
}
