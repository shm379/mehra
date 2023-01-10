<?php
namespace App\Services\Admin;

class AdminForm {

    protected $form;
    public static $instance;

    /**
     * @return mixed
     */
    public function getForm(): mixed
    {
        return $this->form;
    }

    public static function getInstance() {
        if (!static::$instance) {
            static::$instance = new static;
        }
        return static::$instance;
    }
}
