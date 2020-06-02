<?php

namespace App\Operations;
use App\User;

class BaseOperation
{
    public $user;
    public $params;
    public $messages;

    public static function call(User $user, array $params = array())
    {
        $instance = get_called_class();
        $instance = new $instance($user, $params);
        $instance->run();
    }

    public function __construct(User $user, array $params = array())
    {
        $this->user = $user;
        $this->params = $params;
    }

    public function run()
    {
        $this->init();
        $this->validate();
        $this->process();
        $this->postProcess();
    }

    public function init(){}
    public function validate(){}
    public function process(){}
    public function postProcess(){}

    public function addMessage($messageType, $message)
    {

    }
}
