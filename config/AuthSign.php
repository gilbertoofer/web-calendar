<?php
/*
 *
 * Esta Classe tem o prpósito de efetuar todas as ações de entrada do login
 * estabelecendo a ligação com google firebase usando a classe DbGoogle
 *
 * Features:
 *
 *      Verificação de dados
 *      Estabelecer uma rota, se email e pwd corretos
 *          Para que página
 */
namespace config;

//require_once  "../vendor/autoload.php";



use \am\internet\CronofyBot;
use \config\DbGoogle;
use \login\User;

use \Kreait\Firebase\Factory;
use \Kreait\Firebase\ServiceAccount;






class AuthSign
{


    /**
     * AuthSign constructor.
     * @param $pEmail
     * @param $pPwd
     */

    public function __construct()
    {

      //  $user = new User ($pEmail, $pPwd); // já faz o set do email e pwd



    }//__construct

    private function getConnectionWithDbGoogle() : DbGoogle{
        $dbgoogle = new DbGoogle();
        $dbgoogle->connectToGoogle();

        return $dbgoogle;
    }//getConnectionWithDbGoogle


    public function createAuthWithDbGoogle($pEmail, $pPwd){

        if($this->bPostedEmailAndPwd($pEmail, $pPwd)){


            $conn = $this->getConnectionWithDbGoogle();
            $newAuth = $conn->getMFactory()->createAuth();


            $signIn = $newAuth->signInWithEmailAndPassword($pEmail, $pPwd);

            $bAllOK = $newAuth && $signIn;

            if($bAllOK){
                //criar session
                $this->createSession($pEmail);

                header("Location: ". "../index.php");
            }
        }
    }//createAuthWithDbGoogle


    public function addLoginData($pEmail, $pPwd){
        $conn = $this->getConnectionWithDbGoogle();
        $newAuth = $conn->getMFactory()->createAuth();

        $newAuth->createUserWithEmailAndPassword($pEmail, $pPwd);
    }//addLoginData




    public function createSession($pEmail){
        session_start();
        $_SESSION['emailSignin'] = $pEmail;
        $_SESSION['user'] = true;

    }//createSession


    public function bExistsSession(): bool{
        if(isset($_SESSION['user']) && $_SESSION['user'] === true){
            $_SESSION['user'] = true;
            return true;
        }//if
        return false;
    }


    public function closeSession(){

        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();

        header("Location: ". "./login/login.php");


    }//closeSession


    private function bPostedEmailAndPwd($pEmail, $pPwd) : bool {

        return ($pEmail && $pPwd);
    }
}//AuthSign



/*
$aut = new AuthSign();
$aut->createAuthwithDbGoogle();*/

