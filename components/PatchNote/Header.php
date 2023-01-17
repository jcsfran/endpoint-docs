<?php

namespace App\View\Components\PatchNote;

use Carbon\Carbon;
use Illuminate\View\Component;

class Header extends Component
{
    public string $version = '';
    public string $title = '';
    public string $date = '';

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $version, string $title, string $date)
    {
        $this->version = $version;
        $this->title = $title;

        if (empty($date)) {
            $this->date = Carbon::parse($date)->isoFormat('DD/MM/Y');
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        if (empty($this->version) && empty($this->title) && empty($this->date)) {
            return;
        }

        return view('components.patch-note.header');
    }
}
