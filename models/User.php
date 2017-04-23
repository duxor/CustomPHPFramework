<?php

/**
 * Class User
 */
class User extends DB {
    /**
     * @var string
     */
    protected $table = "user";
    /**
     * @var string
     */
    protected $email;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var bool|string
     */
    protected $password;
    /**
     * @var string
     */
    protected $password_repeat;
    /**
     * @var
     */
    protected $valid;
    /**
     * @var
     */
    protected $message;
    /**
     * @var int
     */
    protected $password_min = 5;
    /**
     * @var string
     */
    protected $redirectUrl;

    /**
     *  Validate inputs.
     */
    protected function validateInput()
    {
        $this->valid = true;
        $this->message = [];

        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL))
        {
            $this->valid = false;
            array_push($this->message, ["email" => "Email is not valid."]);
        }
        if (strlen($this->password) < $this->password_min)
        {
            $this->valid = false;
            array_push($this->message, ["password" => "Password is not valid. Min length is {$this->password_min}."]);
        }

        return $this->valid;
    }
    /**
     * @param $email
     * @param $password
     * @param null $name
     */
    protected function saveData($email, $password, $name = null)
    {
        $password = password_hash($password, PASSWORD_BCRYPT);
        $this->set([
            'email' => $email,
            'name' => $name,
            'password' => $password
        ]);
    }

    /**
     * @return bool
     */
    public static function isLogged()
    {
        if (isset($_SESSION['user']))
            return true;
        else false;
    }

    /**
     * @param $input
     * @return string
     */
    public function search($input){
        $user = new User();
        $results = [];
        $result = $user->like('name', $input)->orLike('email', $input)->get();
        while($row = mysqli_fetch_assoc($result))
        {
            array_push($results, $row);
        }
        return json_encode($results);
    }

    /**
     * @return string
     * @author Dusan Perisic
     */
    public function getRedirectUrl() : string
    {
        return $this->redirectUrl;
    }

    /**
     * @author Dusan Perisic
     */
    protected function setMessage()
    {
        $_SESSION["errors"] = count($this->message) > 0 ? $this->message : null;
    }
}