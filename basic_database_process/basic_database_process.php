<?php
/*
* Veritabanına PDO yöntemi ile bağlantı ve temel alınabilecek tüm veritabanı sorguları aşağıda yer almaktadır.
* Tüm veritabanı içeren web utgulamalarda kullanılması amaçlanmıştır.
*
* host= Bağlanılacak sunucu
* db_name=Veritabanı ismi
* db_username=Veritabanı kullanıcı adı
* db_password=Veritabanı kullanıcı şifresi
*
*/
class basic_database_process
{
    private $db_connect_values = array(
        "host" => "localhost:3306",
        "db_name" => "db_name",
        "db_username" => "db_username",
        "db_password" => "db_password"
    );
    private $db;
    //Bir class içerisinde private değişkenlere fonksiyon içerisinden erişmek için $this anahtar sözcüğü kullanılmaktadır.

    //Yapıcı metod ile db connected tamamlanması.
    public function __construct()
    {
        try {
            $host = $this->db_connect_values['host'];
            $dbname = $this->db_connect_values['db_name'];
            $username = $this->db_connect_values['db_username'];
            $password = $this->db_connect_values['db_password'];
            $this->db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            //echo "Connected to $dbname at $host successfully.";
        } catch (PDOException $pe) {
            die("Could not connect to the database $dbname :" . $pe->getMessage());
        }
    }
    //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_all($query, $where_array)//Bir tablodaki koşullu ya da koşulsuz olarak tüm verilerin getirilmesini sağlar.
    {
        $prepare_query = $this->db->prepare($query); //Burada sorgu hazırlanmakta ve içerisinde kapsül şeklinde yolladığımız veriyi ayıklanmakta da diyebiliriz.
        if ($where_array != null) {
            $prepare_query->execute($where_array);
        } else if ($where_array == null) {
            $prepare_query->execute();
        }
        $result = $prepare_query->fetchAll(PDO::FETCH_ASSOC);
        //print_r($result);//Gelen veriyi bu şekilde ekrana basarak kontrol edebiliriz.
        return $result;
    }
    //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_all_object($query, $where_array)//Çekilen veri obje olarak gelir ve kullanırken obje gibi davranılması gerekir.
    {
        $prepare_query = $this->db->prepare($query); 
        if ($where_array != null) {
            $prepare_query->execute($where_array);
        } else if ($where_array == null) {
            $prepare_query->execute();
        }
        $result = $prepare_query->fetchAll(PDO::FETCH_OBJ);
        //print_r($result); //Gelen veriyi bu şekilde ekrana basarak kontrol edebiliriz.
        return $result;
    }
    //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_one_row($query, $where_array)//Çekilen veriden bir satır olarak tüm değerleri getirir
    {
        $prepare_query = $this->db->prepare($query); 
        if ($where_array != null) {
            $prepare_query->execute($where_array);
        } else if ($where_array == null) {
            $prepare_query->execute();
        }
        $result = $prepare_query->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function get_one_cell($query, $where_array) //Çekilen veriden ilk kolon ilk satırdaki veriyi getirir
    {
        $prepare_query = $this->db->prepare($query); 
        if ($where_array != null) {
            $prepare_query->execute($where_array);
        } else if ($where_array == null) {
            $prepare_query->execute();
        }
        $result = $prepare_query->fetch(PDO::FETCH_COLUMN);
        return $result;
    }

    //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function insert($query, $insert_array)//Veri ekleme
    {
        $prepare_query = $this->db->prepare($query); 
        $prepare_query->execute($insert_array);
        return $prepare_query->fetch(); // 0 or 1 -- false or true
    }
    //---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------
    public function update($query, $update_array)//Veri güncelleme
    {
        $prepare_query = $this->db->prepare($query);
        $prepare_query->execute($update_array);
        //return $prepare_query->fetch();
    }
} //Class EndOfFile
