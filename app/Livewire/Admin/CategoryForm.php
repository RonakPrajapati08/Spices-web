<?php

namespace App\Livewire\Admin;

use App\Models\CategoryModel;
use Livewire\Component;

class CategoryForm extends Component
{
    public $name, $status = 1, $category_id;
    public $updateMode = false;

    protected $rules = [
        'name' => 'required|string|max:255',
        'status' => 'required|boolean',
    ];

    public function save()
    {
        $this->validate();

        CategoryModel::updateOrCreate(
            ['id' => $this->category_id],
            ['name' => $this->name, 'status' => $this->status]
        );

        session()->flash('success', 'Category saved successfully');
        $this->resetForm();
    }

    public function edit($id)
    {
        $cat = CategoryModel::findOrFail($id);
        $this->category_id = $cat->id;
        $this->name = $cat->name;
        $this->status = $cat->status;
        $this->updateMode = true;
    }

    public function delete($id)
    {
        CategoryModel::findOrFail($id)->delete();
        session()->flash('success', 'Category deleted');
    }

    public function resetForm()
    {
        $this->reset(['name', 'status', 'category_id']);
        $this->status = 1;
        $this->updateMode = false;
    }

    public function render()
    {
        $categories = CategoryModel::latest()->get();
        return view('livewire.admin.category-form', compact('categories'));
    }
}
