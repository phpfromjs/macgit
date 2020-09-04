<?php

/**
 * 主模型程序
 */
class Ext_Module
{
    var $db; //数据库链接对象
    var $data; //数据表
    var $dbname; //当前操作数据表名

    function __construct()
    {
        $this->db = $_SESSION['MODULE']['db'];
        $this->data = $_SESSION['MODULE']['data'];
    }

    function Set_DB_Name($name)
    {
        $this->dbname = $name;
    }

    /**
     * 构造SQL语句
     * @param $data is_array
     * @return string
     */
    function build_sql($data)
    {
        $temp = '';
        if (!is_array($data))
        {
            return false;
        }
        foreach ($data as $key=>$v)
        {
            if (substr($key, -4) == "_int")
            {
                $temp .= substr($key, 0, strlen($key)-4)."=".(int)$v;
            }
            elseif (substr($key,-5) == '_time') 
            {
                $temp .= ($v != '') ? substr($key, 0, strlen($key)-5)."='{$v}'" : substr($key, 0, strlen($key)-5)."='".date("Y-m-d")."'";
            }
            else
            {
                //转义内容里的特殊字符
                //$v = addslashes($v);
                $v = str_replace("'", "\'", $v);
                $temp .= $key."='{$v}'";
            }
            $temp .= ",";
        }
        return substr($temp, 0, strlen($temp)-1);
    }

    /**
     * 获取表内指定条件内容
     * @param unknown_type $field
     * @param unknown_type $value
     * @return array
     */
    function getList($field = "", $value = "", $order = "ordid")
    {
        $sql = "SELECT * FROM ".$this->data[$this->dbname];
        if ($field != "")
        {
            $sql .= " WHERE ".$field."='{$value}'";
        }
        $sql .= " ORDER BY ".$order." DESC,id ASC";
        $this->db->query($sql);
        return $this->db->getResult();
    }

    /**
     * 获取指定ID记录
     * @param unknown_type $id
     * @return array
     */
    function getRow($id)
    {
        $sql = "SELECT * FROM ".$this->data[$this->dbname]." WHERE id={$id}";
        $this->db->query($sql);
        return $this->db->getRow();
    }

    /**
     * 保存操作
     */
    function save()
    {
        $result = $this->build_sql($_POST);
        $sql = "INSERT INTO ".$this->data[$this->dbname]." SET ".$result;
        $this->db->query($sql);
    }

    /**
     * 修改操作
     */
    function mod($id)
    {
        $result = $this->build_sql($_POST);
        $sql = "UPDATE ".$this->data[$this->dbname]." SET ".$result;
        $sql .= " WHERE id=".$id;
        $this->db->query($sql);
    }

    /**
     * 删除操作
     */
    function del($id)
    {
        $sql = "DELETE FROM ".$this->data[$this->dbname]." WHERE id in ($id)";
        $this->db->query($sql);
    }

    /**
     * 更新操作
     */
    function update($field, $value, $id)
    {
        $sql = "UPDATE ".$this->data[$this->dbname]." SET $field=$value WHERE id=$id";
        $this->db->query($sql);
    }
}

?>