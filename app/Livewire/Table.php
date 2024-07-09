<?php

namespace App\Livewire;

use App\Models\tables;
use Livewire\Component;

class Table extends Component
{
    public $name;
    public $email;
    public $phone;
    public $count;
    public $date;
    public function render()
    {
        return view('livewire.table');
    }
    
    public function rules(){
        return [
            'name' => 'required|min:2|max:20',
            'email' => 'required|email',
            'phone' => 'required|digits:11',
            'count' => 'required',
            'date' => 'required',
        ];
    }

    public function updated($fields)
    {
        return $this->validateOnly($fields);
    }

    public function savedate(){
        $date = $this->validate();
        tables::create($date);
        session()->flash('message', 'book table success');
    }
}
