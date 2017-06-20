<?php
require_once CLASSES_DIR  . 'dbconnection.php';
require_once CLASSES_DIR  . 'testtest.php';


class TestObj extends CI_Controller {
    private $db;
    private $conn;
    private $objCall;

    public function __construct() {
        $this->objCall = new TestTest();
        $this->db = new DB();
        $this->conn = $this->db->connect();
    }

    public function index() {
        $this->getData("ASC",1,4);
    }

    public function getData($sort, $page, $limitItemPage)
    {   
        $rows = [];
        $i=0;
        $object;


        $page=($page*$limitItemPage)-$limitItemPage;
        $query =
        "SELECT
        pengguna.pengguna_id,
        pengguna.nama,
        pengguna.nip,
        pengguna.username,
        pengguna.role
        FROM
        pengguna
        ORDER BY `pengguna`.`pengguna_id` 
        $sort LIMIT $page,$limitItemPage";
        $result = $this->conn->query($query);
        
        while($row = mysqli_fetch_array($result))
        {   
            //$rows[] = $row['nama'];
            $object{$i} = new TestTest();
            $object{$i}->setNama($row['nama']);
            $object{$i}->setNip($row['nip']);
            $i++;
        } 

        //echo($rows[0]);
        //echo "<br>";
        //echo $i;
        //var_dump ($object);
        //echo $object[2]->getNip();

        foreach($object as $value){
            $nestedData = array();
            $nestedData['nama'] = $value->getNama();
            $nestedData['nip'] = $value->getNip();
            $arrayNama[] = $nestedData;
        }

        $data=array("data"=>$arrayNama);
        //var_dump($data);

        foreach ($data['data'] as $field => $values) {
            echo "<td>".$values['nama']."</td><br>";
        }

    }
}
