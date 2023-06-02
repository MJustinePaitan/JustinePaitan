<?php

namespace App\Http\Livewire;

use App\Models\ListItem;
use Livewire\Component;
use Livewire\WithPagination;

class ReorderList extends Component
{
    use WithPagination;

    public $Employee;

    public function mount()
    {
        $this->Employee = Employee::orderBy('order')->get();
    }

    public function render()
    {
        return view('livewire.reorder-list');
    }

    public function dragDrop($list)
    {
        foreach ($list as $index => $item) {
            Employee::where('FirstName', $item['value'])->update(['order' => $index]);
        }

        $this->Employee = Employee::orderBy('order')->get();
    }
}
