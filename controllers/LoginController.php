<?php

/**
 * Class LoginController
 */
class LoginController extends User{

    /**
     * LoginController constructor.
     *
     * @param null $email
     * @param null $password
     */
    public function __construct( $email = null, $password = null){
        parent::__construct();

        $this->email = $email ? $email : $_POST['email'];
        $this->password = $password ? $password : $_POST['password'];

        if ($this->validateInput())
        {
            $this->redirectUrl = $this->autenticate();
        }
        else
        {
            $this->redirectUrl = "/login";
        }
        $this->setMessage();
    }

    /**
     * @return string
     * @author Dusan Perisic
     */
    private function autenticate()
    {
        $user = $this->newQuery()->where("email", "=", $this->email)->get();
        $user = $user ? mysqli_fetch_assoc($user) : null;

        if (count($user) > 1)
        {
            if (password_verify($this->password, $user["password"]))
            {
                $this->message = [];
                $_SESSION['user'] = $user;

                return "/home";
            }
        }
        array_push($this->message, ["login" => "Error logging."]);

        return "/login";
    }
}