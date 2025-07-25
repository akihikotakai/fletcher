<?php

namespace Fletcher\Components;

use Illuminate\View\Component;

class Wing extends Component
{
    public string $component;

    public function __construct(string $component)
    {
        $this->component = $component;
    }

    public function render()
    {
        return view('fletcher::wing');
    }
}