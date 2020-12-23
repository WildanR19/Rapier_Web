<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Department;

class Departments extends Component
{
    public $departments, $name, $dept_id;
    public $isModal = 0;

    public function render()
    {
        $this->departments = Department::orderBy('created_at', 'DESC')->get();
        return view('livewire.departments');
    }

    public function create()
    {
        $this->resetFields();
        $this->openModal();
    }

    public function closeModal()
    {
        $this->isModal = false;
    }

    public function openModal()
    {
        $this->isModal = true;
    }

    public function resetFields()
    {
        $this->name = '';
    }

    //add and update data
    public function store()
    {
        $this->validate([
            'name' => 'required|string',
        ]);

        Department::updateOrCreate(['id' => $this->dept_id], [
            'name' => $this->name,
        ]);

        session()->flash('message', $this->dept_id ? $this->name . ' Updated': $this->name . ' Added');
        $this->closeModal();
        $this->resetFields();
    }

    public function edit($id)
    {
        $dept = Department::find($id);
        $this->id = $id;
        $this->name = $dept->name;
        $this->openModal();
    }

    public function delete($id)
    {
        $dept = Department::find($id);
        $dept->delete();
        session()->flash('message', $dept->name . ' Deleted');
    }
}
