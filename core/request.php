<?php


/**
 * @summary Requêtes des utilisateurs premiums
 */

Class Request{

    private $id;
    private $langSource;
    private $langDestination;
    private $dataSource;
    private $status;

    /**
     * Translate constructor.
     * @param $id
     * @param $langSource
     * @param $langDestination
     * @param $dataSource
     * @param $status
     */
    public function __construct($id, $langSource, $langDestination, $dataSource,$status)
    {
        $this->id = $id;
        $this->langSource = $langSource;
        $this->langDestination = $langDestination;
        $this->dataSource = $dataSource;
        $this->status = $status;
    }

    public function __toString()
    {
        $string =  $this->id . '==>' . $this->langSource . '==>' . $this->langDestination . '==>' .
            $this->dataSource . '==>' . $this->status;
        return $string;
    }

    /**
     * @return int, id de la requête
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string, langue source de la requête
     */
    public function getLangSource()
    {
        return $this->langSource;
    }

    /**
     * @return string, langue cible de la requête
     */
    public function getLangDestination()
    {
        return $this->langDestination;
    }

    /**
     * @return string, mot à traduire
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * @return string, statut de la requête ( acceptée, en attente, rejetée)
     */
    public function getStatus()
    {
        return $this->status;
    }




}

