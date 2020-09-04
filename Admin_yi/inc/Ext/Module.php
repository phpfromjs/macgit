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
        $this->db = $GLOBALS['db'];
        $this->data = $GLOBALS['data'];
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
            if (substr($key, 0, 4) != "not_")
            {
                if (substr($key, -4) == "_int")
                {
                    $temp .= substr($key, 0, strlen($key)-4)."=".(int)$v;
                }
                elseif (substr($key, -5) == '_time')
                {
                    $temp .= ($v != '') ? substr($key, 0, strlen($key)-5)."='{$v}'" : substr($key, 0, strlen($key)-5)."='".date("Y-m-d H:i:s")."'";
                }
                else
                {
                    //转义内容里的特殊字符
                    //$v = addslashes($v);
                    $v = str_replace("\'", "'", $v);
                    $v = str_replace("'", "\'", $v);
                    $temp .= $key."='{$v}'";
                }
                $temp .= ",";
            }
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
        $sql .= " ORDER BY ".$order." ASC,classid ASC";
        $this->db->query($sql);
        return $this->db->getResult();
    }

    function usergetList($field = "", $value = "", $order = "ordid")
    {
        $sql = "SELECT * FROM ".$this->data[$this->dbname];
        if ($field != "")
        {
            $sql .= " WHERE ".$field."='{$value}'";
        }
        $sql .= " ORDER BY ".$order."";
        $this->db->query($sql);
        return $this->db->getResult();
    }

    function getListpostt($field = "", $value = "", $order = "ordid")
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

    function getListpostty($where, $order = "ordid")
    {
        $sql = "SELECT * FROM ".$this->data[$this->dbname];
        $sql .= " WHERE ".$where."";
        $sql .= " ORDER BY ".$order." DESC,id ASC";
        $this->db->query($sql);
        return $this->db->getResult();
    }

    //分页使用的函数
    function getLists($start = 0, $listNum = 20, $where = '', $order)
    {
        $sql = "SELECT * FROM ".$this->data[$this->dbname]." WHERE 1";
        if ($where!='')
        {
            $sql .= $where;
        }
	$this->db->query($sql);
	$temp['countAlls'] = $this->db->num_rows();
	$sql .= $order." LIMIT $start,$listNum";
	$this->db->query($sql);
	$temp['countAll'] = $this->db->num_rows();
	$temp['list'] = $this->db->getResult();
	return $temp;
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

    function getRoworder($where)
    {
        $sql = "SELECT * FROM ".$this->data[$this->dbname]." WHERE {$where} ORDER BY id ASC";
        $this->db->query($sql);
        return $this->db->getRow();
    }

    function getRows($id)
    {
        $sql = "SELECT * FROM ".$this->data[$this->dbname]." WHERE {$id}";
        $this->db->query($sql);
        return $this->db->getRow();
    }
	
    /**
     * 保存操作
     */
    function inser($arr)
    {
        $result = $this->build_sql($arr);
        $sql = "INSERT INTO ".$this->data[$this->dbname]." SET ".$result;
        $this->db->query($sql);
    }

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

    function modwhere($where)
    {
        $result = $this->build_sql($_POST);
        $sql = "UPDATE ".$this->data[$this->dbname]." SET ".$result;
        $sql .= " WHERE ".$where;
        $this->db->query($sql);
    }

    function modwhere1($arr,$where)
    {
        $result = $this->build_sql($arr);
        $sql = "UPDATE ".$this->data[$this->dbname]." SET ".$result;
        $sql .= " WHERE ".$where;
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

    //get传值
    public function curlget($src)
    {
        $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $src);
	curl_setopt($ch, CURLOPT_HEADER,FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	$Infos = curl_exec($ch);
	if (curl_errno($ch))
	{
            return curl_error($ch);
        }
        curl_close($ch);
        return $Infos;
    }

    //post传值
    public function curlpost($data, $src)
    {
        $ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $src);
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$Infos = curl_exec($ch);
        if (curl_errno($ch))
        {
            return curl_error($ch);
	}
	curl_close($ch);
	return $Infos;
    }	
}

?>