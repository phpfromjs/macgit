<?php
//php sql防注入代码
define("XH_PARAM_INT", 0);
define("XH_PARAM_TXT", 1);
function PAPI_GetSafeParam($pi_strName, $pi_Def = "", $pi_iType = XH_PARAM_TXT)
{
    if (isset($_REQUEST[$pi_strName]))
    {
        $t_Val = trim($_REQUEST[$pi_strName]);
    }  
    else
    {
        return $pi_Def;
    }
    //INT
    if ( XH_PARAM_INT == $pi_iType)
    {
        if (is_numeric($t_Val))
        {
            return $t_Val;
        }
        else
        {
            return $pi_Def;
        }
    }
    //String
    $t_Val = str_replace("&", "&amp;", $t_Val);
    $t_Val = str_replace("<", "&lt;", $t_Val);
    $t_Val = str_replace(">", "&gt;", $t_Val);
    $t_Val = str_replace("and", "", $t_Val);
    $t_Val = str_replace("script", "", $t_Val);
    $t_Val = str_replace("alert", "", $t_Val);
    $t_Val = str_replace("eval", "", $t_Val);
    $t_Val = str_replace(")", "", $t_Val);
    $t_Val = str_replace("(", "", $t_Val);
    $t_Val = str_replace("execute", "", $t_Val);
    $t_Val = str_replace("update", "", $t_Val);
    $t_Val = str_replace("count", "", $t_Val);
    $t_Val = str_replace("chr", "", $t_Val);
    $t_Val = str_replace("mid", "", $t_Val);
    $t_Val = str_replace("master", "", $t_Val);
    $t_Val = str_replace("truncate", "", $t_Val);
    $t_Val = str_replace("char", "", $t_Val);
    $t_Val = str_replace("declare", "", $t_Val);
    $t_Val = str_replace("select", "", $t_Val);
    $t_Val = str_replace("create", "", $t_Val);
    $t_Val = str_replace("delete", "", $t_Val);
    $t_Val = str_replace("insert", "", $t_Val);
    $t_Val = str_replace("+", "", $t_Val);
    $t_Val = str_replace("or", "", $t_Val);
    $t_Val = str_replace("=", "", $t_Val);
    $t_Val = str_replace("%", "", $t_Val);
    $t_Val = str_replace("classid", "", $t_Val);
    $t_Val = str_replace("'", "", $t_Val);
    $t_Val = str_replace('id', "", $t_Val);
    if (get_magic_quotes_gpc())
    {
        $t_Val = str_replace("\\\"", "&quot;", $t_Val);
        $t_Val = str_replace("\\''", "&#039;", $t_Val);
    }
    else
    {
        $t_Val = str_replace("\"", "&quot;", $t_Val);
        $t_Val = str_replace("'", "&#039;", $t_Val);
    }
    return $t_Val;
}

class sqlin
{
    function dowith_sql($str)
    {
        $str = str_replace("and", "", $str);
        $str = str_replace("script", "", $str);
        $str = str_replace("alert", "", $str);
        $str = str_replace("eval", "", $str);
        $str = str_replace(")", "", $str);
        $str = str_replace("(", "", $str);
        $str = str_replace("execute", "", $str);
        $str = str_replace("update", "", $str);
        $str = str_replace("count", "", $str);
        $str = str_replace("chr", "", $str);
        $str = str_replace("mid", "", $str);
        $str = str_replace("master", "", $str);
        $str = str_replace("truncate", "", $str);
        $str = str_replace("char", "", $str);
        $str = str_replace("declare", "", $str);
        $str = str_replace("select", "", $str);
        $str = str_replace("create", "", $str);
        $str = str_replace("delete", "", $str);
        $str = str_replace("insert", "", $str);
        $str = str_replace("'", "", $str);
        $str = str_replace('"', "", $str);
        $str = str_replace(">", "", $str);
        $str = str_replace("<", "", $str);
        $str = str_replace("&gt;", "", $str);
        $str = str_replace("&lt;", "", $str);
        $str = str_replace("+", "", $str);
        $str = str_replace("or", "", $str);
        $str = str_replace("=", "", $str);
        $str = str_replace("%20", "", $str);
        $str = str_replace(".", "", $str);
        $str = str_replace("/", "", $str);
        return $str;
    }
    //sqlin()防SQL注入函数
    function sqlin()
    {
        foreach ($_GET as $key => $value)
        {
            if ($key == "db" || $key == "title" || $key == "classname" || $key == "username" || $key == "codee")
            {
                $_GET[$key] = htmlentities($this->dowith_sql($value));
            }
            else
            {
               $_GET[$key]=$this->dowith_sql((int)$value);
            }
        }
        foreach ($_POST as $key => $value)
        {
            $_POST[$key] = htmlentities($this->dowith_sql($value));
        }
    }
}
//$dbsql = new sqlin();

?>