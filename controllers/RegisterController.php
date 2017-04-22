<?php

/**
 * Class RegisterController
 */
class RegisterController extends User{
    /**
     * RegisterController constructor.
     *
     * @param null $email
     * @param null $name
     * @param null $password
     * @param null $password_repeat
     */
    public function __construct( $email = null, $name = null, $password = null, $password_repeat = null)
    {
        parent::__construct();

        $this->email = $email ? $email : $_POST['email'];
        $this->name = $name ? $name : $_POST['name'];
        $this->password = $password ? $password : $_POST['password'];
        $this->password_repeat = $password_repeat ? $password_repeat : $_POST['password_repeat'];

        if($this->validateInput())
        {
            $this->message = [];
            $this->saveData($this->email, $this->password, $this->name);
            $this->redirectUrl = "/login";
        }
        else
        {
            $this->redirectUrl = "/register";
        }
        $this->setMessage();

        return $this->redirect();
    }

    /**
     *  Validate inputs.
     */
    protected function validateInput(){
        parent::validateInput();

        if ($this->newQuery()->where("email", "=", $this->email)->exists())
        {
            $this->valid = false;
            array_push($this->message, ["email" => "Email is registered."]);
        }
        if ($this->password != $this->password_repeat)
        {
            $this->valid = false;
            array_push($this->message, ["password" => "Password is not repeat correct."]);
        }

        return $this->valid;
    }
}