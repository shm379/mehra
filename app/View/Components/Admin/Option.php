<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;


class Option extends Component
{
    public $type;
    public $keys;
    public $model;
    public $show;
    public $edit;
    public $delete;
    public $restore;
    public $showRoute;
    public $editRoute;
    public $deleteRoute;
    public $restoreRoute;

    /**
     * Create a new component instance.
     *
     * @param $type
     * @param $model
     * @param array $keys
     * @param bool $show
     * @param bool $edit
     * @param bool $delete
     * @param bool $restore
     */
    public function __construct($type, $model, $keys=[], $show=null, $edit=null, $delete=null,$restore=null)
    {
        $this->type = $type;
        $this->model = $model;
        $this->keys = $keys;
        $this->show = $show;
        $this->edit = $edit;
        $this->delete = $delete;
        $this->restore = $restore;
        $this->showRoute = route('admin.'.$this->type.'.show',$this->model);
        $this->editRoute = route('admin.'.$this->type.'.edit',$this->model);
        $this->deleteRoute = route('admin.'.$this->type.'.destroy',$this->model);
        if($restore) {
            $this->restoreRoute = route('admin.' . $this->type . '.restore', $this->model);
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('admin.components.option');
    }
}
