<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EventCalendar extends Component
{
    public function render()
    {
        return view('admin.calendar');
    }


    // public function addEvent($title, $start, $end){
    //     dd($title);
    // }
}
