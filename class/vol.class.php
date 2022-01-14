<?php

class Vol {
    // database connection and table name
    private $connection;
    private $table="vol";
    public $error_message;
    public $response;
  
    // object properties
    private $vol_id = '';
    private $depart = '';
    private $arrivée = '';
    private $heure_depart = '';
    private $heure_arrivée = '';
    private $compagnie = '';
    private $temps_vol = '';
    private $aller_retour = '';
    private $escale = '';

    // constructor with $db as database connection
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function setInfos(
        $depart,
        $heure_depart,
        $arrivee,
        $heure_arrivee,
        $compagnie,
        $temps_vol,
        $aller_retour,
        $escale,
        $id = null
    )
    {
        $this->depart         = $depart;
        $this->heure_depart   = $heure_depart;
        $this->arrivée        = $arrivee;
        $this->heure_arrivée  = $heure_arrivee;
        $this->compagnie      = $compagnie;
        $this->temps_vol      = $temps_vol;
        $this->aller_retour   = $aller_retour;
        $this->escale         = $escale;
        $this->vol_id         = $id;
    }
    
    public function AllVol()
    {
        $query   = "SELECT * FROM vol";
        $prepare = $this->connection->prepare($query);

        if ($prepare->execute()) {
            return $prepare ->fetchAll();
        } else {
            return $prepare->errorInfo();
        }
    }

    public function get_name()
    {
        $query   = "SELECT * FROM vol WHERE vol.vol_id = :vol_id";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':vol_id', $this->vol_id);

        if ($prepare->execute()) {
            return $prepare->fetch();
        } else {
            return $prepare->errorInfo();
        }
    }

    public function createVol()
    {
        $query   = "INSERT INTO `vol` (`depart`,`heure_depart`,`arrivée`,`heure_arrivée`,`compagnie`,`temps_vol`,`aller_retour`,`escale`) VALUES (:depart, :heure_depart, :arrivee, :heure_arrivee, :compagnie, :temps_vol, :aller_retour, :escale);";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':depart', $this->depart);
        $prepare->bindParam(':heure_depart', date('Y-m-d H:i:s', strtotime($this->heure_depart)));
        $prepare->bindParam(':arrivee', $this->arrivée);
        $prepare->bindParam(':heure_arrivee', date('Y-m-d H:i:s', strtotime($this->heure_arrivée)));
        $prepare->bindParam(':compagnie', $this->compagnie);
        $prepare->bindParam(':temps_vol', $this->temps_vol);var_dump($this->temps_vol);
        $prepare->bindParam(':aller_retour', $this->aller_retour);var_dump($this->aller_retour);
        $prepare->bindParam(':escale', $this->escale);

        if ($prepare->execute()) {
            $this->user_id = $this->connection->lastInsertId();

            return true;
        } else {
            $this->error_message = $prepare->errorInfo();

            return false;
        }
    }

    public function editVol()
    {
        $query   = "UPDATE `vol` SET `depart`=:depart, `heure_depart`=:heure_depart, `arrivée`=:arrivee,`heure_arrivée`=:heure_arrivee,`compagnie`=:compagnie,`temps_vol`=:temps_vol,`aller_retour`=:aller_retour,`escale`=:escale WHERE vol_id = :id";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':depart', $this->depart);
        $prepare->bindParam(':heure_depart', date('Y-m-d H:i:s', strtotime($this->heure_depart)));
        $prepare->bindParam(':arrivee', $this->arrivée);
        $prepare->bindParam(':heure_arrivee', date('Y-m-d H:i:s', strtotime($this->heure_arrivée)));
        $prepare->bindParam(':compagnie', $this->compagnie);
        $prepare->bindParam(':temps_vol', $this->temps_vol);
        $prepare->bindParam(':aller_retour', $this->aller_retour);
        $prepare->bindParam(':escale', $this->escale);
        $prepare->bindParam(':id', $this->vol_id);

        if ($prepare->execute()) {
            return true;
        } else {
            $this->error_message = $prepare->errorInfo();

            return false;
        }
    }

    public function deleteVol(int $id)
    {
        $query   = "DELETE FROM `vol` WHERE vol_id=:id";
        $prepare = $this->connection->prepare($query);
        $prepare->bindParam(':id', $id);

        if ($prepare->execute()) {
            return true;
        } else {
            $this->error_message = $prepare->errorInfo();

            return false;
        }
    }
}