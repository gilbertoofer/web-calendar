<?php


namespace am\internet;


use Cronofy\Cronofy;
use Cronofy\Exception\CronofyException;

class CronofyBot{

   // const CRONOFY_API_BASE = "https://api.cronofy.com/";

    const SECRETS_CRONOFY=
        [
            "client_id" => "f54rsN1HvOJC2UUeyAw5jZDcuWsXPm-i",
            "client_secret" => "qQT8J9rKjrTMTEV3jtPV2vTRUX3sRNMDgAd1mI4ai8_hY2sUYIXyBZdyUVpOxGlCQAgvoKtGpLZUMgMRHQnGHg",
            "access_token" => "VP_YLipoo-ZFN26wJVdlFdA4cAVxuNXP", //first access_token
            "refresh_token" => "EeLszdFBOQzsPM0J0woTrpD_faAPU7oK" //sempre o mesmo, para que o access_token seja atualizado após expirar
        ];


    private $objCronofy;

    public function __construct(){

        $this->setObjCronofy(new Cronofy(self::SECRETS_CRONOFY));
        //o access_token tem um tempo de expiração, acabando esse tempo é estritamente necessário atualizar com o novo
        $this->getObjCronofy()->refreshToken();

    }//constructor


    //================== GETTERS AND SETTERS ==========================

    /**
     * @return Cronofy
     */
    public function getObjCronofy(): Cronofy
    {
        return $this->objCronofy;
    }

    /**
     * @param Cronofy $objCronofy
     */
    private function setObjCronofy(Cronofy $objCronofy)
    {
        $this->objCronofy = $objCronofy;
    }
    //==================== ./GETTER AND SETTERS =======================


    // usar com ação de um button
    // permitir a autorização de acesso ao(s) calendarios dessa conta de email
    public function generateLinkGrantAuthorizationUserAccountMail(){
        $redirect_uri = "http://localhost:88/webcalendar/oauth2/callback";

        $params = [
            'redirect_uri' => $redirect_uri,
            'scope' => ['read_account','list_calendars','read_events','create_event','delete_event']
            //scope -> conjunto de permissões que o USER autoriza a fazer no(s) seu(s) calendar(s) da sua conta email
        ];


        $auth = $this->getObjCronofy()->getAuthorizationURL($params);


        //Depois de criado o url para a Authorization, redirecionar para a lá
        //header('Location: '. $auth);
        return $auth;
    }//generateLinkGrantAccessUserAccountMail

    private function auxArrayToString ($a){
        $m="";

        foreach ($a as $k=>$v){
            if (is_array($v)){
                $m.= $this->auxArrayToString ($v);
            }
            else{

                $m.= "<mark>$k</mark> &nbsp;&nbsp;&nbsp; : &nbsp;&nbsp;&nbsp; $v<br>";
                /*if($k=== "provider_name" && $k==="profile_name"){


                }*/

            }
        }//foreach

        return $m;
    }//auxArrayToString

    public function  loadProfilesToRadioForm (){

        $a =  $this->getObjCronofy()->getProfiles();



        foreach ($a as $k=>$v){
            if(is_array($v)){

                    foreach ($v as $arr) {


                        echo "<input type='radio' name='nProfiles' value='".   $arr['profile_id']   ."' /> ";
                        echo $arr['profile_name'] . "<br>";
                    }//foreach
            }//if
        }//foreach

    }//loadProfilesToRadioForm


    public function loadProfilesToSelectOption(){

        $a =  $this->getObjCronofy()->getProfiles();


        echo "<select name='sProfiles'>";
        foreach ($a as $k=>$v){
            if(is_array($v)){

                foreach ($v as $arr) {


                    echo "<option  value='".   $arr['profile_id']   ."' > ";
                    echo $arr['profile_name'] . "</option>";

                }//foreach
            }//if
        }//foreach
        echo "</select>";

    }//loadProfilesToSelectOption


    public function loadCalendars(){

        $a =  $this->getObjCronofy()->listCalendars();


        foreach ($a as $k=>$v){
            if(is_array($v)){

                foreach ($v as $arr) {


                    echo $arr['calendar_name'] . "<br>";

                }//foreach
            }//if
        }//foreach
    }//loadCalendars


    public function loadAllEvents(): array{
        $arrayEvents = [];

        $params = [
            'tzid' => 'Etc/UTC' //Required: time-zone
        ];

        $events = $this->getObjCronofy()->readEvents($params);


        foreach($events->each() as $event){
            // process event

                array_push($arrayEvents, $event);




            //var_dump($event);
            //var_dump(auxArrayToString($calendars));
        }

        return $arrayEvents;
    }//loadAllEvents


    //public or private? someone will use that?
    /*
     * IF public
     * THEN  $obj->createJsonFileWithArray($obj->loadAllEvents());
     *
     */
    public function createJsonFileWithArray($a): bool{
        $out = array_values($a);
        $json_encode = json_encode($out);

        if($json_encode){
            return $this->writeJsonIntoFile($json_encode);
        }

        return false;
    }//createJsonFileWithArray


    private function writeJsonIntoFile($pJe): bool{
        $path = "./results/results.json";
        $fp = fopen($path, 'w');
        $fw =    fwrite($fp, $pJe);

        if($fw == false){
            return false;
        }

        fclose($fp);
        return true;
    }//writeJsonIntoFile



    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }//generateRandomString


}//CronofyBot


