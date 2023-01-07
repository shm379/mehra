<?php
namespace App\Services\Admin;

class AdminForm {

    protected $form;

    /**
     * @return mixed
     */
    private function getData($form='create'): mixed
    {
        return $this->form;
    }
}
