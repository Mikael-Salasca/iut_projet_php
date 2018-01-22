<?php

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
    public function __construct($id, $langSource, $langDestination, $dataSource, $dataDestination)
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
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLangSource()
    {
        return $this->langSource;
    }

    /**
     * @return mixed
     */
    public function getLangDestination()
    {
        return $this->langDestination;
    }

    /**
     * @return mixed
     */
    public function getDataSource()
    {
        return $this->dataSource;
    }

    /**
     * @return mixed
     */
    public function getDataDestination()
    {
        return $this->dataDestination;
    }




}