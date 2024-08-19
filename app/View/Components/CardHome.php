<?php

namespace App\View\Components;

use App\Models\Evento;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardHome extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(public Evento $evento)
    {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-home');
    }
}
