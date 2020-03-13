<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Message extends Component
{
    public $name;
    public $author;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$author)
    {
        $this->name = $name;
        $this->author = $author;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.message');
    }
}
