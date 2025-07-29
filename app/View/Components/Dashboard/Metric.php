<?php

namespace App\View\Components\Dashboard;

use Illuminate\View\Component;

class Metric extends Component
{
    public $title;
    public $value;
    public $percentage;

    public function __construct($title, $value, $percentage = null)
    {
        $this->title = $title;
        $this->value = $value;
        $this->percentage = $percentage;
    }

    public function render()
    {
        return view('components.dashboard.metric');
    }
}
