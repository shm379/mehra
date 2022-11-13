<?php

namespace App\View\Components\Admin;

use \Illuminate\Support\Collection;
use Illuminate\View\Component;

class InputSelect extends Component
{
    public string $id;
    public string $label;
    public Collection $model;
    public string $columnName;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(string $id, string $label,Collection $model,string $columnName)
    {
        $this->label = $label;
        $this->id = $id;
        $this->model = $model;
        $this->columnName = $columnName;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('admin.components.forms.input-select');
    }
}
