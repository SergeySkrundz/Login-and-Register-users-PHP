<?php
class RegisterUser {
    private $login;
    private $raw_password;
    private $encrypted_password;
    private $confirm_password;
    private $email;
    private $username;
    public $error;
    public $login_error;
    public $password_error;
    public $confirm_password_error;
    public $email_error;
    public $username_error;
    public $success;
    private $storage = "data.json";
    private $stored_users;
    private $new_user;


    public function __construct($username, $password, $confirm_password, $mail, $log){

        $this->login = filter_var(trim($log), FILTER_SANITIZE_STRING);

        $this->raw_password = filter_var(trim($password), FILTER_SANITIZE_STRING);
        $this->encrypted_password = filter_var($this->raw_password.'md5');
        $this->confirm_password = filter_var(trim($confirm_password), FILTER_SANITIZE_STRING);

        $this->email = filter_var(trim($mail), FILTER_SANITIZE_STRING);

        $this->username = trim($this->username);
        $this->username = filter_var($username, FILTER_SANITIZE_STRING); 

        $this->stored_users = json_decode(file_get_contents($this->storage), true);

        $this->new_user = [
            "login" => $this->login,
            "password" => $this->encrypted_password,
            "email" => $this->email,
            "username" => $this->username,
        ];

        if($this->checkFieldValues()){
            $this->insertUser();
        }
    }

    private function checkFieldValues(){
        if(empty($this->login) || empty($this->username) || empty($this->raw_password) || empty($this->confirm_password) || empty($this->email)){
            $this->error = "Все поля являются обязательными для заполнения";
            return false;
        }else{
            return true;
        }
    }

    private function loginExists(){
        foreach($this->stored_users as $user){
            if($this->login == $user['login']){
                $this->login_error = "Логин уже занят, пожалуйста, выберите другой";
                return true;
            }elseif(strlen($this->login) < 6){
                $this->login_error = "Логин должен состоять минимум из 6-ти букв";
                return true;
            }
        }
        return false;
    }

    private function passwordExists(){
        foreach($this->stored_users as $user){
            if($this->raw_password == str_replace('md5','', $user['password'])){
                $this->password_error = "Ненадежный пароль, пожалуйста, выберите другой";
                return true;
            }elseif(strlen($this->raw_password) < 6){
                $this->password_error = "Пароль должен состоять минимум из 6-ти символов";
                return true;
            }elseif(ctype_alnum($this->raw_password) == FALSE){
                $this->password_error = "Пароль должен состоять из букв и цифр";
                return true;
            }
        }
        return false;
    }

    private function confirm_passwordExists(){
        if($this->raw_password != $this->confirm_password){
            $this->confirm_password_error = "Пароль подтверждения не совпадает с паролем";
            return true;
        }
        return false;
    }

    private function emailExists(){
        foreach($this->stored_users as $user){
            if($this->email == $user['email']){
                $this->email_error = "Электронная почта уже занята, пожалуйста, выберите другую";
                return true;
            }elseif(filter_var($this->email, FILTER_VALIDATE_EMAIL) == FALSE){
                $this->email_error = "Электронная почта указана неверно";
                return true;
            }
        }
        return false;
    }

    private function usernameExists(){
        foreach($this->stored_users as $user){
            if($this->username == $user['username']){
                $this->username_error = "Имя пользователя уже занято, пожалуйста, выберите другое";
                return true;
            }elseif(preg_match('#[0-9]#',$this->username)){
                $this->username_error = "Имя пользователя должно состоять только из букв";
                return true;
            }elseif(strlen($this->username) < 2){
                $this->username_error = "Имя пользователя должно состоять минимум из 2-х букв";
                return true;
            }
        }
        return false;
    }

    private function insertUser(){
        if($this->loginExists() == FALSE && $this->passwordExists() == FALSE && $this->usernameExists() == FALSE && $this->confirm_passwordExists() == FALSE  && $this->emailExists() == FALSE){
            array_push($this->stored_users, $this->new_user);
            if(file_put_contents($this->storage, json_encode($this->stored_users, JSON_PRETTY_PRINT))){
                return $this->success = "Ваша регистрация прошла успешно";
            }else{
                return $this->error = "Что-то пошло не так, пожалуйста, попробуйте еще раз";
            }
        }
    }
}
?>