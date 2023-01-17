<?php

namespace App\View\Components\PatchNote;

use Illuminate\View\Component;

class DivPatchNote extends Component
{
    public array $info = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($value = [])
    {
        $this->info = $value['info'];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.patch-note.div-patch-note');
    }
}
