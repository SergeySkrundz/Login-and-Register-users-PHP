<?php 
class LoginUser{
    private $login;
    private $password;
    public $error;
    public $login_error;
    public $password_error;
    private $storage = "data.json";
    private $stored_users;

    public function __construct($log, $password){
        $this->login = $log;
        $this->password = $password;
        $this->stored_users = json_decode(file_get_contents($this->storage), true);

        $this->login();
        $this->checkFieldValues();
    }

    private function checkFieldValues(){
        if(empty($this->login) || empty($this->password)){
            $this->error = "Все поля являются обязательными для заполнения";
            return false;
        }else{
            return true;
        }
    }

    private function login(){
        foreach($this->stored_users as $user){
            if($this->login != $user['login']){
                return $this->login_error = "Неправильный логин";
            }
            elseif($this->password != str_replace('md5','', $user['password'])){
                return $this->password_error = "Неправильный пароль";
            }
            elseif($this->password == str_replace('md5','', $user['password']) && $this->login == $user['login']){
                session_start();
                $_SESSION['user'] = $user['username'];
                header("location: account.php"); exit();
            }else{
                return $this->error = "Что-то пошло не так, пожалуйста, попробуйте еще раз";
            }
        }
    }
}
?>