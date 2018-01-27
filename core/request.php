<?php

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
    public function getStatus()
    {
        return $this->status;
    }




}

