<?php

namespace App\View\Components;

use Illuminate\View\Component;

class GuestLayout extends Component
{
    public $layout, $dir, $assets, $isHeader1, $isFooter, $isFooter1, $isFooter2;

    public function __construct($layout = '', $dir = false, $assets = [], $isHeader1 = false, $isFooter = false, $isFooter1 = false, $isFooter2 = false)
    {
        $this->layout = $layout;
        $this->dir = $dir;
        $this->assets = $assets;
        $this->isHeader1 = $isHeader1;
        $this->isFooter = $isFooter;
        $this->isFooter1 = $isFooter1;
        $this->isFooter2 = $isFooter2;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.dashboard.guest');
    }
}
