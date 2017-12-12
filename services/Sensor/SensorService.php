<?php
/**
 * User: quentin
 * Date: 27/11/2017
 */

namespace Services\Sensor;

use Services\database\DatabaseServiceInterface;
use Services\database\DatabaseObjectInterface;


class SensorService implements SensorServiceInterface
{


    /**
     * TODO: what ?
     * The database connection
     * @var DatabaseServiceInterface
     */
    protected $serviceConnect;

    /**
     * The database connection
     * @var DatabaseObjectInterface
     */
    protected $databaseObject;


    /**
     * constructor
     * @var $serviceConnect DatabaseServiceInterface
     * @var $databaseObject DatabaseObjectInterface*
     * @TODO: typer les paramètres du constructeur
     */
    public function __construct(DatabaseServiceInterface $serviceConnect,DatabaseObjectInterface $databaseObject) {
        $this->serviceConnect = $serviceConnect;
        $this->databaseObject = $databaseObject;
    }


    /**
     * @inheritdoc
     */
    public function createSensor($type, $name, $room_id) {

        $conn = $this->serviceConnect->connect($this->databaseObject);

        $sql = "INSERT INTO sensor(type, name, room_id) VALUES ('$type', '$name','$room_id')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
    }

    /**
     * delete a sensor 
     * @param string $idSensor the sensor to delete
     * @return boolean|\LogicException
     */
    public function deleteSensor($idSensor) {

        $conn = $this->serviceConnect->connect($this->databaseObject);

        //TODO:: try catch exception($e)
        //TODO:: pas besoin de concaténation lors de l'utilsiation des "" en php.
        $sql = "DELETE FROM sensor WHERE id='".$idSensor."')";
        $stmt = $conn->prepare($sql);
        $stmt->execute();

    }

    /**
     * update a sensor 
     * @param SensorInterface $sensor the sensor to update
     * @return SensorInterface|\LogicException
     */
    public function updateSensor(SensorInterface $sensor){

        $conn = $this->serviceConnect->connect($this->databaseObject);

        $sql = "UPDATE sensor SET type=:type, name=:name, room_id=:room_id WHERE id=:id)";

        $stmt = $pdo->prepare($sql);                                  
        $stmt->bindParam(':type', $sensor->getType(), PDO::PARAM_STR);       
        $stmt->bindParam(':name', $sensor->getName(), PDO::PARAM_STR);    
        $stmt->bindParam(':room_id', $sensor->getRoomId(), PDO::PARAM_STR);
        $stmt->bindParam(':id', $sensor->getId(), PDO::PARAM_INT);   
        $stmt->execute();

    }
    
    /**
     * Search sensor(s) by the field in parameter
     * @param string $field id_room|id|type
     * @param string $value
     * @return array of SensorInterface|\LogicException
     */
    public function getSensorBy($field, $value){
        //TODO:: ??
    }





}