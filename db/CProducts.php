<?php
class CProducts
{
    private $PDO;
    function __construct($cfg)
    {
        $this->PDO = new PDO("mysql:host=". $cfg['host'] .";dbname=". $cfg['db_name'], $cfg['db_login'], $cfg['db_password']);

    }

    //ID	PRODUCT_ID	PRODUCT_NAME	PRODUCT_PRICE	PRODUCT_ARTICLE	PRODUCT_QUANTITY	DATE_CREATE     is_hide
    //SELECT * FROM `Products` WHERE `is_hide` = 0 ORDER BY `DATE_CREATE` DESC LIMIT  OFFSET

    function get($count = -1, $offset = 0) //get 'products' by its count; made -1 to output all data except hidden ones
    {
        $tmp_count_offset = $count == -1 ? "" : "LIMIT $count OFFSET $offset";
        //$tmp_offset = $offset == 0 ? "" : "OFFSET $offset";
        $query = $this->PDO->prepare("SELECT * FROM Products WHERE is_hide = 0 ORDER BY DATE_CREATE DESC $tmp_count_offset");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    function hide($id)
    {
        $query = $this->PDO->prepare("UPDATE Products SET is_hide=1 WHERE id='$id'");
        $query->execute();
        return $query;
    }
}



?>