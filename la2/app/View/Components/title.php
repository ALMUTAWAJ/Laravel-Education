<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class title extends Component
{
    /**
     * Create a new component instance.
     * This page related to the component page which called title, you can pass variables that will be used in that blade file
     * go to the title.blade.php to see where you want to place the variables that you are initializing here 
     */
    public $title; // initialize the variable, (you can create as many as you want of variables) 
    public function __construct($title) // passing the parameter 
    {
        $this->title = $title; // make the passed parameter = the variable title in this page 
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.title');
    }
}
