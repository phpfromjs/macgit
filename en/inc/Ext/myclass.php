<?php
defined('_EXEC') or die('没有访问权限');
class Ext_Sql 
{
    var $tableName;
    /* public: 数据库连接参数 */
    var $Host = "";
    var $Database = "";
    var $User = "";
    var $Password = "";

    /* public: 配置参数 */
    var $Auto_Free = 0; ## 设置为1则自动执行 mysql_free_result()
    var $Debug = 0; ## 设置为1则 debugging messages.
    var $Halt_On_Error = "yes"; ## "yes" (halt with message), "no" (ignore errors quietly), "report" (ignore errror, but spit a warning).
    var $Seq_Table = "db_sequence";

    /* public: 返回的结果和行号r */
    var $Record = array();
    var $Row;

    /* public: 当前的错误代码和消息 */
    var $Errno = 0;
    var $Error = "";

    /* public: this is an api revision, not a CVS revision. */
    var $type = "mysql";
    var $revision = "1.2";

    /* private: 连接和查询句柄 */
    var $Link_ID = 0;
    var $Query_ID = 0;

    var $weblan = 1; //语言
    var $qt = 0; //后台

    static $instance;
    /* 外部静态访问方法 */

    /* public: 构造函数 */
    function DB_Sql($query = "")
    {
        $this->query($query);
    }

    /* public: some trivial reporting */
    function link_id()
    {
        return $this->Link_ID;
    }

    function query_id()
    {
        return $this->Query_ID;
    }

    function getInstance()
    {
        if(!isset(self::$instance))
        {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /* public: 数据库连接 */
    function connect($Database = "", $Host = "", $User = "", $Password = "")
    {
        /* Handle defaults */
        //echo $this->Host.$this->User.$this->Password.$this->Database;
        if ("" == $Database)
        {
            $Database = $this->Database;
        }
        else
        {
            $this->Database = $Database;
        }
        if ("" == $Host)
        {
            $Host = $this->Host;
        }
        else
        {
            $this->Host = $Host;
        }
        if ("" == $User)
        {
            $User = $this->User;
        }
        else
        {
            $this->User = $User;
        }
        if ("" == $Password)
        {
            $Password = $this->Password;
        }
        else
        {
            $this->Password = $Password;
        }
        /* 建立连接、选择数据库逐步联接，以判断数据库连接问题! */
        if (0 == $this->Link_ID)
        {
            //$this->Link_ID = @mysql_pconnect($Host, $User, $Password);
            $this->Link_ID = @mysql_connect($Host, $User, $Password);
            if (!$this->Link_ID)
            {
                $this->halt("连接：$Host 失败 如有需要请与网管联系.");		  
                return 0;
            }
            if (!@mysql_select_db($Database,$this->Link_ID))
            {
                $this->halt("不能使用该数据库".$this->Database);
                return 0;
            }
        }
        @mysql_query('SET NAMES utf8', $this->Link_ID);
        @mysql_query('SET CHARACTER SET utf8', $this->Link_ID);
        @mysql_query('SET COLLATION_CONNECTION=\'utf8_general_ci\'', $this->Link_ID);    
        return $this->Link_ID;
    }

    function setCharset()
    {
        $dbcharset = "utf_8";
        if ($dbcharset)
        {
            @mysql_query("SET character_set_connection=$dbcharset, character_set_results=$dbcharset, character_set_client=binary", $this->Link_ID);
        }
    }

    function resetCharset()
    {
        $dbcharset = "latin1";
        if ($dbcharset)
        {
            @mysql_query("SET character_set_connection=$dbcharset, character_set_results=$dbcharset, character_set_client=binary", $this->Link_ID);
        }
    }

    /* public:释放查询结果 */
    function free()
    {
        @mysql_free_result($this->Query_ID);
        $this->Query_ID = 0;
    }

    /* public: 执行查询操作 */
    function query($Query_String)
    {
        if ($Query_String == "")
        {
            return 0;
        }
        if (!$this->connect())
        {
            return 0;
        }
        if ($this->Query_ID)
        {
            $this->free();
        }
        if ($this->Debug)
        {
            printf("Debug: query = %s<br>\n", $Query_String);
        }
        $this->Query_ID = @mysql_query($Query_String,$this->Link_ID);
        $this->Row = 0;
        $this->Errno = mysql_errno();
        $this->Error = mysql_error();
        if (!$this->Query_ID)
        {
            $this->halt("无效的查询语句: ".$Query_String);
        }
        return $this->Query_ID;
    }

    /* public: 下一条记录 */
    function next_record()
    {
        if (!$this->Query_ID)
        {
            $this->halt("next_record called with no query pending.");
            return 0;
        }
        $this->Record = @mysql_fetch_array($this->Query_ID);
        //用一个行属性记录所移到的行数
        $this->Row += 1;
        $this->Errno = mysql_errno();
        $this->Error = mysql_error();
        $stat = is_array($this->Record);
        if (!$stat && $this->Auto_Free)
        {
            $this->free();
        }
        return $stat;
    }

    /* public: 返回记录的一个二维数组 */
    function get_Fetch_Array($key)
    {
        return mysql_fetch_array($key);
    }

    function getResult()
    {
        if (!$this->Query_ID)
        {
            return false;
        }
        $this->tableArr = array();
        while ($row = @mysql_fetch_array($this->Query_ID, MYSQL_ASSOC))
        {
            $this->tableArr[] = $row;	
        }
        return $this->tableArr;
    }

    /* public: 返回记录的一组数组 */
    function getRow()
    {
        if (!$this->Query_ID)
        {	
            return false;
        }
        $row = @mysql_fetch_array($this->Query_ID, MYSQL_ASSOC);
        return $row;
    }

    /* public: 定位到某条记录 */
    function seek($pos = 0)
    {
        $status = @mysql_data_seek($this->Query_ID, $pos);
        if ($status)
        {
            $this->Row = $pos;
        }
        else
        {
            $this->halt("seek($pos) failed: result has ".$this->num_rows()." rows");
            @mysql_data_seek($this->Query_ID, $this->num_rows());
            $this->Row = $this->num_rows;
            return 0;
        }
        return 1;
    }

    /* public: 锁定表 */
    function lock($table, $mode = "write")
    {
        $this->connect();
        $query = "lock tables ";
        if (is_array($table))
        {
            while (list($key,$value) = each($table))
            {
                if ($key=="read" && $key!=0)
                {
                    $query.="$value read, ";
                }
                else
                {
                    $query.="$value $mode, ";
                }
            }
            $query = substr($query,0,-2);
        }
        else
        {
            $query.="$table $mode";
        }
        $res = @mysql_query($query, $this->Link_ID);
        if (!$res)
        {
            $this->halt("lock($table, $mode) failed.");
            return 0;
        }
        return $res;
    }

    /* public: 解锁表 */
    function unlock()
    {
        $this->connect();
        $res = @mysql_query("unlock tables");
        if (!$res)
        {
            $this->halt("unlock() failed.");
            return 0;
        }
        return $res;
    }

    /* public: 分析结果 (size, width) */
    function affected_rows()
    {
        return @mysql_affected_rows($this->Link_ID);
    }

    function num_rows()
    {
        return @mysql_num_rows($this->Query_ID);
    }

    function num_fields()
    {
        return @mysql_num_fields($this->Query_ID);
    }

    /* public: shorthand notation */
    function nf()
    {
        return $this->num_rows();
    }

    function np()
    {
        print $this->num_rows();
    }

    function f($Name)
    {
        return $this->Record[$Name];
    }

    function p($Name)
    {
        print $this->Record[$Name];
    }

    /* public: sequence numbers */
    function nextid($seq_name)
    {
        $this->connect();
        if ($this->lock($this->Seq_Table))
        {
            /* get sequence number (locked) and increment */
            $q = sprintf("select nextid from %s where seq_name = '%s'", $this->Seq_Table, $seq_name);
            $id = @mysql_query($q, $this->Link_ID);
            $res = @mysql_fetch_array($id);
            /* No current value, make one */
            if (!is_array($res))
            {
                $currentid = 0;
                $q = sprintf("insert into %s values('%s', %s)", $this->Seq_Table, $seq_name, $currentid);
                $id = @mysql_query($q, $this->Link_ID);
            }
            else
            {
                $currentid = $res["nextid"];
            }
            $nextid = $currentid + 1;
            $q = sprintf("update %s set nextid = '%s' where seq_name = '%s'", $this->Seq_Table, $nextid, $seq_name);
            $id = @mysql_query($q, $this->Link_ID);
            $this->unlock();
        }
        else
        {
            $this->halt("cannot lock ".$this->Seq_Table." - has it been created?");
            return 0;
        }
        return $nextid;
    }

    /* public: return table metadata */
    function metadata($table = '', $full = false)
    {
        $count = 0;
        $id = 0;
        $res = array();
        if ($table)
        {
            $this->connect();
            $id = @mysql_list_fields($this->Database, $table);
            if (!$id)
            {
                $this->halt("Metadata query failed.");
            }
        }
        else
        {
            $id = $this->Query_ID; 
            if (!$id)
            {
                $this->halt("No query specified.");
            }
        }
        $count = @mysql_num_fields($id);
        if (!$full)
        {
            for ($i=0; $i<$count; $i++)
            {
                $res[$i]["table"] = @mysql_field_table($id, $i);
                $res[$i]["name"] = @mysql_field_name($id, $i);
                $res[$i]["type"] = @mysql_field_type($id, $i);
                $res[$i]["len"] = @mysql_field_len($id, $i);
                $res[$i]["flags"] = @mysql_field_flags($id, $i);
            }
        }
        else
        {
            $res["num_fields"] = $count;
            for ($i=0; $i<$count; $i++)
            {
                $res[$i]["table"] = @mysql_field_table($id, $i);
                $res[$i]["name"] = @mysql_field_name($id, $i);
                $res[$i]["type"] = @mysql_field_type($id, $i);
                $res[$i]["len"] = @mysql_field_len($id, $i);
                $res[$i]["flags"] = @mysql_field_flags($id, $i);
                $res["meta"][$res[$i]["name"]] = $i;
            }
        }
        if ($table)
        {
            @mysql_free_result($id);
        }
        return $res;
    }

    /* private: 错误处理 */
    function halt($msg)
    {
        $this->Error = @mysql_error($this->Link_ID);
        $this->Errno = @mysql_errno($this->Link_ID);
        if ($this->Halt_On_Error == "no")
        {
            return;
        }
        $this->haltmsg($msg);
        if ($this->Halt_On_Error != "report")
        {
            die("Session halted.");
        }
    }

    /* private: 错误处理提示信息 */
    function haltmsg($msg)
    {
        printf("</td></tr></table><b>Database error:</b> %s<br>\n", $msg);
        printf("<b>MySQL Error</b>: %s (%s)<br>\n", $this->Errno, $this->Error);
    }

    function table_names()
    {
        $this->query("SHOW TABLES");
        $i = 0;
        while ($info = mysql_fetch_row($this->Query_ID))
        {
            $return[$i]["table_name"] = $info[0];
            $return[$i]["tablespace_name"] = $this->Database;
            $return[$i]["database"] = $this->Database;
            $i++;
        }
        return $return;
    }
}

?>
