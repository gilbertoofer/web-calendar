<?php

/*
 * Estabelecer a ligação com os serviços da Google Firebase
 * através de uma service account
 *
 *e para haver ligação com Realtime Database (Firebase)
 * é necessário um database URI
 *
 *
 */

namespace config;
require_once  "../vendor/autoload.php";
use \am\internet\CronofyBot;

use \Kreait\Firebase\Factory;
use \Kreait\Firebase\ServiceAccount;


class DbGoogle{

    const SERVICE_ACCOUNT = "../secret/webcalendar-277814-8f667e46fec3.json";
    const DATABASE_URI = "https://webcalendar-277814.firebaseio.com";

    private $mFactory;
    private $mDb;

    public function __construct(){


    }//__construct


    public function connectToGoogle(){
        $this->setMFactory(
            (new Factory)
                ->withServiceAccount(self::SERVICE_ACCOUNT)
                ->withDatabaseUri(self::DATABASE_URI)
        );


        $this->setMDb($this->getMFactory()->createDatabase());

    }//connectToGoogle





    /**
     * @return mixed
     */
    public function getMFactory(): Factory
    {
        return $this->mFactory ;
    }

    /**
     *
     * @param $pFactory
     * @return void
     */
    private function setMFactory($pFactory)
    {
        $this->mFactory = $pFactory;
    }

    /**
     * @return mixed
     */
    public function getMDb()
    {
        return $this->mDb;
    }

    /**
     * @param $pDb
     */
    private function setMDb($pDb)
    {
        $this->mDb = $pDb;
    }//connect




}//DbGoogle
/*
$dbg = new DbGoogle();

var_dump($dbg->getMFactory());*/