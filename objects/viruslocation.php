    <?php
    class Virus{

        // database connection and table name
        private $conn;
        private $table_name;
        // object properties
        public $date;
        public $address;
        public $species;
        public $block;
        public $street;
        public $trap;
        public $addressnumberandstreet;
        public $lattitude;
        public $longitude;
        public $addressaccuracy;
        public $nummosquitos;
        public $vpresent;

        // constructor with $db as database connection
        public function __construct($db){
            $this->conn = $db;
            $this->table_name = 'viruslocation';
        }

        function insertion(){
            $sql = "INSERT INTO $this->table_name (`date`, `address`, `species`, `latitude`, `longitude`, `addressaccuracy`, `nummosquitos`, `vpresent`) VALUES ('$this->date', '$this->add', '$this->spec', '$this->lat', '$this->long', '$this->add_acc', '$this->num_mosq', '1')";
            //echo $sql;
            $stmt = $this->conn->prepare( $sql);
            $stmt->execute();
        }

        function getlocationDetails(){
            $arr =  array();
            $sql = "SELECT `date`, `address`, `species`, `latitude`, `longitude`, `addressaccuracy`, `nummosquitos`, `vpresent` FROM $this->table_name";
            $stmt = $this->conn->prepare( $sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($arr,$row);
            }
            $myJSON = json_encode($arr);
            return $myJSON;
        }

        function getaddresses(){
            $map =  array();
            $sql = "SELECT `address`, `latitude`, `longitude` FROM $this->table_name WHERE vpresent=1";
            $stmt = $this->conn->prepare( $sql);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                array_push($map,$row);
            }
            //print_r($map);
            //$myJSON = json_encode($map);
            return $map;
        }
    }
