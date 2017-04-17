<?php	/**
 * Class Group
 */
class Group	{

    private $aDataNonHydrate = array();
    private $aDataSet = array();
    private $callHydrateFromBDDOnGet = 0;

    private $_sDbInstance = null;

    private $nId;
    private $sName;
    private $sDate_created;
    private $sDate_amended;
    private $sDate_deleted;
    private $sState;
    private $nDepartement;
    private $nCirconscription;
    private $sPath_pic;
    private $sBank_name;
    private $sBank_city;
    private $nAmount_promises;
    private $nAmount_donations;
    private $sKey_edit;


    /**
     * Constructeur
     * @param array $aParam tableau de parametres ( clé "id" pour instancier un group avec un id précis )
     * @param $sDbInstance (Opt) Nom de l'instance de la bdd à utiliser
     */
    public function __construct( $aParam=array(), $sDbInstance=null )
    {
        $this->hydrate($aParam);
        $this->nId = ( isset($aParam['id']) ) ? $aParam['id'] : 0;
        $this->_sDbInstance = $sDbInstance;
    }

    /**
     * Fonction permettant d'hydrater un objet
     * @param $aDonnees array tableau clé-valeur à hydrater ( par exemple "nom"=>"DUPONT" )
     */
    public function hydrate($aDonnees)
    {
        foreach ($aDonnees as $sKey => $sValue)
        {
            if(!is_int($sKey))
            {
                $sMethode = 'set'.ucfirst($sKey);
                if (method_exists($this, $sMethode))
                {
                    if( is_null($sValue) ) $sValue="";
                    $this->$sMethode($sValue);
                }
                else
                {
                    //echo "<br />Group->$sMethode() n'existe pas!";
                    $this->addDataNonHydrate($sKey,$sValue);
                }
            }
        }
    }

    /**
     * Fonction permettant d'hydrater un objet à partir d'une liste de champs (s'appuie sur l'id de l'objet)
     * @param $aFields array tableau contenant la liste des champs à hydrater ( '*' pour tous)
     */
    public function hydrateFromBDD($aFields=array())
    {
        if(count($aFields))
        {
            //hydrate uniquement les champs de base (pour le reste coder directement dans les acesseurs)
            $aData=DbLink::getInstance($this->_sDbInstance)->selectForHydrate($this->getId(),"group",$aFields);

            //hydrate l'objet
            $this->hydrate($aData);
        }
    }


    /**
     * Fonction permettant d'ajouter des données non-hydratées à l'objet
     * @param string $sKey champs
     * @param mixed $sValue valeur
     */
    public function addDataNonHydrate($sKey,$sValue)
    {
        $this->aDataNonHydrate[$sKey]=$sValue;
    }

    /**
     * Fonction permettant de récuperer des données non-hydratées à l'objet
     * @param string $sKey champs à récupérer
     * @return string valeur du champ
     */
    public function getDataNonHydrate($sKey)
    {
        if(isset($this->aDataNonHydrate[$sKey]))
        {
            return $this->aDataNonHydrate[$sKey];
        }
        else
        {
            return "";
        }
    }

    /**
     * Fonction permettant de supprimer fictivement un objet (en lui passant un date supprime)
     */
    public function supprime()
    {
        $this->setDate_deleted(date("Y-m-d H:i:s"));
        $this->save();
    }

    /**
     * Fonction permettant de supprimer réellement un objet (en faisant un DELETE )
     */
    public function delete()
    {
        $oReq=DbLink::getInstance($this->_sDbInstance)->prepare('DELETE FROM '."group".' WHERE  id=:id ');
        $oReq->execute(array("id"=>$this->getId()));
        $this->vide();
    }

    /**
     * Consulte la base de données pour savoir si l'objet existe, en le recherchant par son id
     * @static
     * @param int $nId Id de l'objet à chercher
     * @param $sDbInstance (Opt) Nom de l'instance de la bdd
     * @return bool Vrai si l'objet existe, Faux sinon
     */
    public static function exists($nId=0, $sDbInstance=null)
    {
        $oReq=DbLink::getInstance($sDbInstance)->prepare('SELECT id FROM '."group".' WHERE  id=:id ');
        $oReq->execute(array("id"=>$nId));
        $aRes=$oReq->getRow(0);
        return (count($aRes)!=0);
    }

    /**
     * Sauvegarde l'objet en base
     */
    public function save()
    {
        $aData=array();
        if(isset($this->aDataSet["name"]))
        {
            $aData["name"]=$this->getName();
        }

        if(isset($this->aDataSet["date_created"]))
        {
            $aData["date_created"]=$this->getDate_created();
        }

        if(isset($this->aDataSet["date_amended"]))
        {
            $aData["date_amended"]=$this->getDate_amended();
        }

        if(isset($this->aDataSet["date_deleted"]))
        {
            $aData["date_deleted"]=$this->getDate_deleted();
        }

        if(isset($this->aDataSet["state"]))
        {
            $aData["state"]=$this->getState();
        }

        if(isset($this->aDataSet["departement"]))
        {
            $aData["departement"]=$this->getDepartement();
        }

        if(isset($this->aDataSet["circonscription"]))
        {
            $aData["circonscription"]=$this->getCirconscription();
        }

        if(isset($this->aDataSet["path_pic"]))
        {
            $aData["path_pic"]=$this->getPath_pic();
        }

        if(isset($this->aDataSet["bank_name"]))
        {
            $aData["bank_name"]=$this->getBank_name();
        }

        if(isset($this->aDataSet["bank_city"]))
        {
            $aData["bank_city"]=$this->getBank_city();
        }

        if(isset($this->aDataSet["amount_promises"]))
        {
            $aData["amount_promises"]=$this->getAmount_promises();
        }

        if(isset($this->aDataSet["amount_donations"]))
        {
            $aData["amount_donations"]=$this->getAmount_donations();
        }

        if(isset($this->aDataSet["key_edit"]))
        {
            $aData["key_edit"]=$this->getKey_edit();
        }

        if($this->getId()>0)
        {
            DbLink::getInstance($this->_sDbInstance)->update("group",$aData,' id="'.$this->getId().'" ');
        }
        else
        {
            $this->setId(DbLink::getInstance($this->_sDbInstance)->insert("group",$aData));
        }
        $this->aDataSet=array();
    }

    /**
     * Deshydrate complement l'objet, et vide la liste des champs à sauvegarder
     */
    private function vide()
    {
        $this->callHydrateFromBDDOnGet=0;
        $this->aDataSet=array();
        $this->setName(NULL);
        $this->setDate_created(NULL);
        $this->setDate_amended(NULL);
        $this->setDate_deleted(NULL);
        $this->setState(NULL);
        $this->setDepartement(NULL);
        $this->setCirconscription(NULL);
        $this->setPath_pic(NULL);
        $this->setBank_name(NULL);
        $this->setBank_city(NULL);
        $this->setAmount_promises(0);
        $this->setAmount_donations(0);
        $this->setKey_edit(NULL);
    }

    /**
     * Renvoie l'objet sous forme de chaine de caractère
     */
    public function __toString()
    {
        $aObjet = [
            "id" => $this->getId(),
            "name" => $this->getName(),
            "date_created" => $this->getDate_created(),
            "date_amended" => $this->getDate_amended(),
            "date_deleted" => $this->getDate_deleted(),
            "state" => $this->getState(),
            "departement" => $this->getDepartement(),
            "circonscription" => $this->getCirconscription(),
            "path_pic" => $this->getPath_pic(),
            "bank_name" => $this->getBank_name(),
            "bank_city" => $this->getBank_city(),
            "amount_promises" => $this->getAmount_promises(),
            "amount_donations" => $this->getAmount_donations(),
            "key_edit" => $this->getKey_edit()
        ];

        return json_encode($aObjet);
    }








    /**
     * Set le champ id
     * @param number $nId nouvelle valeur pour le champ id
     */
    public function setId($nId)
    {
        if( is_null($nId) ) $nId='';
        if( is_numeric($nId)  || $nId=='' )
        {
            $this->nId = $nId;
            $this->aDataSet["id"]=1;
        }
    }



    /**
     * Get le champ id
     * @return number valeur du champ id
     */
    public function getId()
    {
        if( !is_null($this->nId) )
        {
            if( $this->nId==='' )
            {
                return NULL;
            }
            else
            {
                return $this->nId;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('id'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->nId;
        }
    }



    /**
     * Set le champ name
     * @param string $sName nouvelle valeur pour le champ name
     */
    public function setName($sName)
    {
        if( is_null($sName) ) $sName='';
        $this->sName = $sName;
        $this->aDataSet["name"]=1;
    }



    /**
     * Get le champ name
     * @return string valeur du champ name
     */
    public function getName()
    {
        if( !is_null($this->sName) )
        {
            if( $this->sName==='' )
            {
                return NULL;
            }
            else
            {
                return $this->sName;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('name'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->sName;
        }
    }



    /**
     * Set le champ date_created
     * @param string $sDate_created nouvelle valeur pour le champ date_created
     */
    public function setDate_created($sDate_created)
    {
        if( is_null($sDate_created) ) $sDate_created='';
        $this->sDate_created = $sDate_created;
        $this->aDataSet["date_created"]=1;
    }



    /**
     * Get le champ date_created
     * @return string valeur du champ date_created
     */
    public function getDate_created()
    {
        if( !is_null($this->sDate_created) )
        {
            if( $this->sDate_created==='' )
            {
                return NULL;
            }
            else
            {
                return $this->sDate_created;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('date_created'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->sDate_created;
        }
    }



    /**
     * Set le champ date_amended
     * @param string $sDate_amended nouvelle valeur pour le champ date_amended
     */
    public function setDate_amended($sDate_amended)
    {
        if( is_null($sDate_amended) ) $sDate_amended='';
        $this->sDate_amended = $sDate_amended;
        $this->aDataSet["date_amended"]=1;
    }



    /**
     * Get le champ date_amended
     * @return string valeur du champ date_amended
     */
    public function getDate_amended()
    {
        if( !is_null($this->sDate_amended) )
        {
            if( $this->sDate_amended==='' )
            {
                return NULL;
            }
            else
            {
                return $this->sDate_amended;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('date_amended'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->sDate_amended;
        }
    }



    /**
     * Set le champ date_deleted
     * @param string $sDate_deleted nouvelle valeur pour le champ date_deleted
     */
    public function setDate_deleted($sDate_deleted)
    {
        if( is_null($sDate_deleted) ) $sDate_deleted='';
        $this->sDate_deleted = $sDate_deleted;
        $this->aDataSet["date_deleted"]=1;
    }



    /**
     * Get le champ date_deleted
     * @return string valeur du champ date_deleted
     */
    public function getDate_deleted()
    {
        if( !is_null($this->sDate_deleted) )
        {
            if( $this->sDate_deleted==='' )
            {
                return NULL;
            }
            else
            {
                return $this->sDate_deleted;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('date_deleted'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->sDate_deleted;
        }
    }



    /**
     * Set le champ state
     * @param string $sState nouvelle valeur pour le champ state
     */
    public function setState($sState)
    {
        if( is_null($sState) ) $sState='';
        $this->sState = $sState;
        $this->aDataSet["state"]=1;
    }



    /**
     * Get le champ state
     * @return string valeur du champ state
     */
    public function getState()
    {
        if( !is_null($this->sState) )
        {
            if( $this->sState==='' )
            {
                return NULL;
            }
            else
            {
                return $this->sState;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('state'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->sState;
        }
    }



    /**
     * Set le champ departement
     * @param number $nDepartement nouvelle valeur pour le champ departement
     */
    public function setDepartement($nDepartement)
    {
        if( is_null($nDepartement) ) $nDepartement='';
        if( is_numeric($nDepartement)  || $nDepartement=='' )
        {
            $this->nDepartement = $nDepartement;
            $this->aDataSet["departement"]=1;
        }
    }



    /**
     * Get le champ departement
     * @return number valeur du champ departement
     */
    public function getDepartement()
    {
        if( !is_null($this->nDepartement) )
        {
            if( $this->nDepartement==='' )
            {
                return NULL;
            }
            else
            {
                return $this->nDepartement;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('departement'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->nDepartement;
        }
    }



    /**
     * Set le champ circonscription
     * @param number $nCirconscription nouvelle valeur pour le champ circonscription
     */
    public function setCirconscription($nCirconscription)
    {
        if( is_null($nCirconscription) ) $nCirconscription='';
        if( is_numeric($nCirconscription)  || $nCirconscription=='' )
        {
            $this->nCirconscription = $nCirconscription;
            $this->aDataSet["circonscription"]=1;
        }
    }



    /**
     * Get le champ circonscription
     * @return number valeur du champ circonscription
     */
    public function getCirconscription()
    {
        if( !is_null($this->nCirconscription) )
        {
            if( $this->nCirconscription==='' )
            {
                return NULL;
            }
            else
            {
                return $this->nCirconscription;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('circonscription'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->nCirconscription;
        }
    }



    /**
     * Set le champ path_pic
     * @param string $sPath_pic nouvelle valeur pour le champ path_pic
     */
    public function setPath_pic($sPath_pic)
    {
        if( is_null($sPath_pic) ) $sPath_pic='';
        $this->sPath_pic = $sPath_pic;
        $this->aDataSet["path_pic"]=1;
    }



    /**
     * Get le champ path_pic
     * @return string valeur du champ path_pic
     */
    public function getPath_pic()
    {
        if( !is_null($this->sPath_pic) )
        {
            if( $this->sPath_pic==='' )
            {
                return NULL;
            }
            else
            {
                return $this->sPath_pic;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('path_pic'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->sPath_pic;
        }
    }



    /**
     * Set le champ bank_name
     * @param string $sBank_name nouvelle valeur pour le champ bank_name
     */
    public function setBank_name($sBank_name)
    {
        if( is_null($sBank_name) ) $sBank_name='';
        $this->sBank_name = $sBank_name;
        $this->aDataSet["bank_name"]=1;
    }



    /**
     * Get le champ bank_name
     * @return string valeur du champ bank_name
     */
    public function getBank_name()
    {
        if( !is_null($this->sBank_name) )
        {
            if( $this->sBank_name==='' )
            {
                return NULL;
            }
            else
            {
                return $this->sBank_name;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('bank_name'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->sBank_name;
        }
    }



    /**
     * Set le champ bank_city
     * @param string $sBank_city nouvelle valeur pour le champ bank_city
     */
    public function setBank_city($sBank_city)
    {
        if( is_null($sBank_city) ) $sBank_city='';
        $this->sBank_city = $sBank_city;
        $this->aDataSet["bank_city"]=1;
    }



    /**
     * Get le champ bank_city
     * @return string valeur du champ bank_city
     */
    public function getBank_city()
    {
        if( !is_null($this->sBank_city) )
        {
            if( $this->sBank_city==='' )
            {
                return NULL;
            }
            else
            {
                return $this->sBank_city;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('bank_city'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->sBank_city;
        }
    }



    /**
     * Set le champ amount_promises
     * @param numeric $nAmount_promises nouvelle valeur pour le champ amount_promises
     */
    public function setAmount_promises($nAmount_promises)
    {
        if( is_null($nAmount_promises) ) $nAmount_promises='';
        if( is_numeric($nAmount_promises)  || $nAmount_promises=='' )
        {
            $this->nAmount_promises = $nAmount_promises;
            $this->aDataSet["amount_promises"]=1;
        }
    }



    /**
     * Get le champ amount_promises
     * @return numeric valeur du champ amount_promises
     */
    public function getAmount_promises()
    {
        if( !is_null($this->nAmount_promises) )
        {
            if( $this->nAmount_promises==='' )
            {
                return NULL;
            }
            else
            {
                return $this->nAmount_promises;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('amount_promises'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->nAmount_promises;
        }
    }



    /**
     * Set le champ amount_donations
     * @param numeric $nAmount_donations nouvelle valeur pour le champ amount_donations
     */
    public function setAmount_donations($nAmount_donations)
    {
        if( is_null($nAmount_donations) ) $nAmount_donations='';
        if( is_numeric($nAmount_donations)  || $nAmount_donations=='' )
        {
            $this->nAmount_donations = $nAmount_donations;
            $this->aDataSet["amount_donations"]=1;
        }
    }



    /**
     * Get le champ amount_donations
     * @return numeric valeur du champ amount_donations
     */
    public function getAmount_donations()
    {
        if( !is_null($this->nAmount_donations) )
        {
            if( $this->nAmount_donations==='' )
            {
                return NULL;
            }
            else
            {
                return $this->nAmount_donations;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('amount_donations'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->nAmount_donations;
        }
    }



    /**
     * Set le champ key_edit
     * @param string $sKey_edit nouvelle valeur pour le champ key_edit
     */
    public function setKey_edit($sKey_edit)
    {
        if( is_null($sKey_edit) ) $sKey_edit='';
        $this->sKey_edit = $sKey_edit;
        $this->aDataSet["key_edit"]=1;
    }



    /**
     * Get le champ key_edit
     * @return string valeur du champ key_edit
     */
    public function getKey_edit()
    {
        if( !is_null($this->sKey_edit) )
        {
            if( $this->sKey_edit==='' )
            {
                return NULL;
            }
            else
            {
                return $this->sKey_edit;
            }
        }
        else
        {
            $this->hydrateFromBDD(array('key_edit'));
            $this->callHydrateFromBDDOnGet++;
            if($this->callHydrateFromBDDOnGet>10)
            {
                echo "<br />WARNING : trop d'appel en base depuis l'accesseur ". __CLASS__ ."::". __FUNCTION__ ."";
            }
            return $this->sKey_edit;
        }
    }

    /*
    ********************************************************************************************
    *                             DEBUT FONCTIONS PERSONNALISES                  	           *
    ********************************************************************************************
    */


    /*
    ********************************************************************************************
    *                             FIN FONCTIONS PERSONNALISES                     	           *
    ********************************************************************************************
    */


}