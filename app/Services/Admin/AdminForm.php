<?php
namespace App\Services\Admin;

class AdminForm {

    protected $form;

    /**
     * @return mixed
     */
    public function getData(): mixed
    {
        return $this->form;
    }
}
