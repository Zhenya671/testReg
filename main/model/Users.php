<?php

class Users {

    public $dbUsers;

    public $errorsValidate = null;

    public function __construct() {

        $this->dbUsers = DB::getUsersTable();

    }

    public function signUpUsers($signUpForm) {

        $this->validateForSignUp($signUpForm);

        if ($this->errorsValidate !== null){
            return $this->errorsValidate;

        } else {

            $newUser = $this->dbUsers->addChild('user');
            $newUser ->addChild('login', $signUpForm['login']);
            $newUser ->addChild('email', $signUpForm['email']);
            $newUser ->addChild('name', $signUpForm['name']);
            $newUser ->addChild('salt', self::generateSalt());
            $newUser ->addChild('password_hash', $this->makeSaltyPassword($signUpForm['password'], $newUser->salt));

            $this->dbUsers->asXML(DB::getTablePatch()['Users']);
            return true;

        }
    }

    public function signInUser($signInForm){

        $this->validateForSignIn($signInForm);

        if($this->errorsValidate === null) {
            return true;
        } else {
            return $this->errorsValidate;
        }
    }

    public function validateForSignIn(array $signInForm){

        $signInForm = $this->validateNotNull($signInForm);

        $signInForm = $this->screening($signInForm);

        $user = $this->searchByLogin($signInForm['login']);
        if($user === false || $this->equalityPassword($user, $signInForm['password'])){
            $this->errorsValidate[] = 'Invalid login or password';
        }

    }

    public function validateForSignUp($signUpForm) {

        $signUpForm = $this->validateNotNull($signUpForm);
        $this->validateEmail($signUpForm['email']);
        $signUpForm = $this->screening($signUpForm);
        $this->validatePassword($signUpForm['password'], $signUpForm['confirm_password']);
        $this->validateUniqueLogin($signUpForm['login']);
        $this->validateUniqueEmail($signUpForm['email']);

    }

    public function validateNotNull(array $param){

        $newParam = [];
        $nullFlaf = false;
        foreach ($param as $key => $value) {
            $value = trim($value);
            if(strlen($value) == 0) {
                $nullFlaf = true;
            } elseif (strlen($value) < 6) {
                $this->errorsValidate[] = 'Field"'.$key.'" must not be shorter than six characters';
            }

            $newParam[$key] = $value;
        }

        if($nullFlaf){
            $this->errorsValidate[] = 'Please fill in all fields';
        }

        return $newParam;

}

    public function screening(array $param) {

        $newParam = [];

        foreach ($param as $key => $value){
            $newParam[$key] = htmlspecialchars($value);
        }

        return$newParam;

    }

    public function validateEmail($email) {

        if(preg_match('/.+@.+\..+/i', $email) == 0)  {
            $this->errorsValidate[] = '"'.$email.'"does not match format email';
            return false;
        }
        return true;

    }

    public function validatePassword($password, $confirm_password) {

        if($password !== $confirm_password){
            $this->errorsValidate[] = 'Passwords mismatch';
            return false;

        }

        return true;

    }

    public function equalityPassword($user, $password){

        $saltyPassword = $this->makeSaltyPassword($password, $user->salt);
        if($saltyPassword == $user->password_hash) {
            return true;
        }
        return false;

    }

    public function makeSaltyPassword($password, $salt){

        return md5($salt . md5($password));

    }

    public function generateSalt($length = 10) {

        return substr(md5(mt_rand()), 0, $length );

    }

    public function validateUniqueLogin($login) {

        $user = $this->searchByLogin($login);
        if ($user !== false ) {
            $this -> errorsValidate[] = 'User with login "'.$login.'" already exists';
            return false;
        }

        return true;

    }

    public function searchByLogin($login) {

        $resultObject = false;

        foreach ($this->dbUsers as $value) {
            if (htmlspecialchars_decode(trim($login)) == trim($value->login));
            $resultObject = $value;
            break;

        }

        return $resultObject;

    }

    public function searchObjectNumberByLogin($login){

        $objectNumber = false;
        $users = (array)$this->dbUsers;

        for ($i = 0; $i <= count($users['user']); $i++) {
            if ($login == (string)$users['user'][$i]->login) {
                $objectNumber = $i;
                break;
            }
        }

        return $objectNumber;

    }

    public function validateUniqueEmail($email) {

        $user = $this->searchByEmail($email);
        if ($user !== false) {
            $this->errorsValidate[] = 'User with this email already exists';
            return false;
        }

        return true;

    }

    public function searchByEmail($email) {

        $resultObject = false;
        foreach ($this->dbUsers as $value) {
            if(trim($email) == trim($value->email)) {
                $resultObject = $value;
                break;
            }
        }

        return $resultObject;

    }

    public function addSessionKey($number, $sessionKey){

        $this->dbUsers->users[$number]->session_key = $sessionKey;
        $this->dbUsers->asXML(DB::getTablePatch()['Users']);
        return $this->dbUsers;

    }

    public function equalitySessionKey($login, $sessionKey) {

        $user = $this->searchByLogin($login);
        if ($user->session_key == $sessionKey) {
            return true;
        }
        return false;

    }

    public function addCookieKey($number, $cookieKey) {

        $this->dbUsers->user[$number]->cookie_key = $cookieKey;
        $this->dbUsers -> asXML(DB::getTablePatch()['Users']);
        return $this->dbUsers;

    }

    public function equalityCookieKey($login, $cookieKey) {

        $user = $this->searchByLogin($login);
        if ($user->cookie_key == $cookieKey) {
            return true;
        }
        return false;

    }

}