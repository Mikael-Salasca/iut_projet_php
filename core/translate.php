<?php

/**
 * @summary Traductions
 */
Class Translate{

        private $id;
        private $langSource;
        private $langDestination;
        private $dataSource;
        private $dataDestination;

    /**
     * Translate constructor.
     * @param $id
     * @param $langSource
     * @param $langDestination
     * @param $dataSource
     * @param $dataDestination
     */
    public function __construct($id, $langSource, $langDestination, $dataSource, $dataDestination) //  l'id est vide si on ne passe pas de parametre (pour les nouvelles traductions a ajouter dans la base de donnée par exemple)
    {
        $this->id = $id;
        $this->langSource = $langSource;
        $this->langDestination = $langDestination;
        $this->dataSource = $dataSource;
        $this->dataDestination = $dataDestination;
    }

    public function __toString()
    {
        $string =  $this->id . '==>' . $this->langSource . '==>' . $this->langDestination . '==>' .
            $this->dataSource . '==>' . $this->dataDestination;
        return $string;
    }

    /**
     * @return int, id de la traduction
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string, langue source
     */
    public function getLangSource()
    {
        return $this->langSource;
    }

    /**
     * @return string, langue cible de la traduction
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
     * @return string, mot traduit
     */
    public function getDataDestination()
    {
        return $this->dataDestination;
    }




}

