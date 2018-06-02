<?php
require("Repository/Configuration/conn.php");
require("Models/User.php");

class LoginService{ 

    protected $loginRepository;

    public function ValidarUsuario($login, $senha)
    {
        $user = $this->getUser($login,$senha);
        if(!$user){
            return false; 
        }else{
            return $this->criarSessao($user);
        }
    }
    private function criarSessao(User $user){
        session_start();

        $_SESSION['id_user'] = $user->id_user;
        $_SESSION['nome'] = $user->nome;
        $_SESSION['tipo'] = $user->tipo;
        $_SESSION['id_cliente'] = $user->id_cliente;
        return true;
    }

    private function getUser($login,$senha){
        try{
            $user = new User;
            $rs = $this->db->con->prepare("SELECT * FROM user WHERE senha = md5(:senha) AND email = :login");
            $rs->bindParam(':senha', $senha);
            $rs->bindParam(':login', $login);
            $rs->execute();
            $r = $rs->fetchAll();
            if (sizeof($r) > 0){
                $user->id_user = $r[0]["id_user"]; 
                $user->nome = $r[0]["nome"];
                $user->email = $r[0]["email"];
                $user->tipo = $r[0]["tipo"]; 
                $user->id_cliente = $r[0]["id_cliente"];     
                return $user;  
            }else{
                return null;
            }        
        }
        catch(Exception $e) {
            echo $e->getMessage(), "\n";
        }
    }

    public function __construct()
    {
        $this->db = new DataBase();
    }
}
?>