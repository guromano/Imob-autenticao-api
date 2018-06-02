<?php
require("Repository/Services/LoginService.php");

class LoginController { 

    protected $loginService;

    public function Login($request, $response, $args)
    {
        $queryParams = $request->getQueryParams();
        $login = $queryParams['email'];   
        $senha = $queryParams['senha'];    
        $validacao = $this->loginService->ValidarUsuario($login,$senha);
        if($validacao){
            $response->withStatus(200);
        }else{
            $response->withStatus(401);
        }

        $response->write($validacao == 1 ? 'true' : 'false');

        return $response;
    }

    public function __construct()
    {
        $this->loginService = new LoginService();
    }


}
?>