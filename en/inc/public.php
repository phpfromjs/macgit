<?php
//获取符合条件的记录数组
function getSub($table, $where = "1", $order = "")
{
    global $db, $data, $tj;
    $sql = "SELECT * FROM ".$data[$table]." WHERE ".$where.$order;
    $db->query($sql);
    $tj = $db->num_rows();
    return $db->getResult();
}

//获取符合条件的记录数组
function getSubm($table, $where = "1", $order = "")
{
    global $db, $data;
    $sql = "SELECT YEAR(addTime) AS month FROM ".$data[$table]." WHERE ".$where.$order;
    $db->query($sql);
    return $db->getResult();
}

//获取符合条件的记录数组
function getSubb($table, $where = "1", $order = "")
{
    global $db, $data;
    $sql = "SELECT * FROM ".$data[$table]." WHERE ".$where.$order;
    $db->query($sql);
    return $db->getResult();
}

//分页使用的函数
function getList($table, $start = 0, $listNum = 20, $where = '', $order)
{
    global $db, $data;
    $sql = "SELECT * FROM ".$data[$table]." WHERE 1";
    if ($where != '')
    {
        $sql.=$where;
    }
    $db->query($sql);
    $temp['countAll'] = $db->num_rows();
    $sql.=$order." LIMIT $start,$listNum";
    $db->query($sql);
    $temp['countAlls'] = $db->num_rows();
    $temp['list'] = $db->getResult();
    return $temp;
}

//获取单条记录
function getSingle($table,  $where = "1", $order = "")
{
    global $db, $data;
    $sql = "SELECT * FROM ".$data[$table]." WHERE ".$where.$order;
    $db->query($sql);
    return $db->getRow();
}
function getRow($table, $id = "1")
{
    global $db, $data;
    $sql = "SELECT * FROM ".$data[$table]." WHERE ".$id;
    $db->query($sql);
    return $db->getRow();
}

function getHot($table, $listNum = 1, $where = "")
{
    global $db, $data;
    $sql = "SELECT * FROM ".$data[$table]." WHERE 1".$where;
    if ($where != "")
    {
        $sql .= $where;
    }
    $sql .= " ORDER BY sort DESC,id DESC LIMIT 0,".$listNum;
    $db->query($sql);
    return $db->getResult();
}

function getNews($id = 0, $start = 0, $listNum = 20)
{
    global $db, $data;
    $id = $id.getSubId($id, "channel");	
    $sql = "SELECT * FROM ".$data['article']." WHERE channel IN($id) ORDER BY is_index DESC,ordid DESC,id DESC";
    $db->query($sql);
    $temp['countAll'] = $db->num_rows();
    $sql .= " LIMIT $start,$listNum";
    $db->query($sql);
    $temp['list'] = $db->getResult();
    return $temp;
}

function getHostNews($id, $num)
{
    global $db, $data;
    $id = $id.getSubId($id, "channel");	
    $sql = "SELECT * FROM ".$data['article']." WHERE channel IN($id) AND is_index=1 LIMIT 0,".$num;
    $db->query($sql);
    return $db->getResult();
}

function getSubId($id, $table = "channel")
{
    global $db, $data;
    $sql = "SELECT id FROM ".$data[$table]." WHERE parent_id=".$id;
    $db->query($sql);
    if ($db->num_rows() == 0)
    {
        return '';
    }
    $list = $db->getResult();
    foreach($list as $v)
    {
        $tempId .= ",".$v['id'];
        $tempId .= getSubId($v['id'], $table);
    }
    return $tempId;
}

function getArticle($id)
{
    global $db, $data;
    $sql = "UPDATE ".$data['article']." SET cknum=cknum+1 WHERE id={$id}";
    $db->query($sql);
    $sql = "SELECT * FROM ".$data['article']." WHERE id={$id}";
    $db->query($sql);
    return $db->getRow();
}

//上一页，下一页
function udNew($id, $type = 1)
{
    global $db, $data;
    $sql = "SELECT * FROM ".$data['article'];
    $sql .= ($type==1) ? " WHERE id>".$id : " WHERE id<".$id;
    $sql .= " LIMIT 0,1";
    $db->query($sql);
    return $db->getRow();
}

function getJob($start = 0, $listNum = 20)
{
    global $db, $data;
    $sql = "SELECT * FROM ".$data['job']." WHERE weblan=1 ORDER BY ordid DESC,id DESC";
    $db->query($sql);
    $temp['countAll'] = $db->num_rows();
    $sql .= " LIMIT $start,$listNum";
    $db->query($sql);
    $temp['list'] = $db->getResult();
    return $temp;
}

//招聘录入
function SaveJob()
{
    global $db, $data;
    $arr = $_POST;
    $job = PAPI_GetSafeParam("job", "", XH_PARAM_TXT);
    $name = PAPI_GetSafeParam("name", "", XH_PARAM_TXT);
    $phone = PAPI_GetSafeParam("phone", "", XH_PARAM_TXT);
    $email = PAPI_GetSafeParam("email", "", XH_PARAM_TXT);
    $address = PAPI_GetSafeParam("address", "", XH_PARAM_TXT);
    $course = PAPI_GetSafeParam("course", "", XH_PARAM_TXT);
    $experience = PAPI_GetSafeParam("experience", "", XH_PARAM_TXT);
    //$sex = PAPI_GetSafeParam("sex", "", XH_PARAM_TXT);
    //$birthday = PAPI_GetSafeParam("birthday", "", XH_PARAM_TXT);
    //$edu_level = PAPI_GetSafeParam("edu_level", "", XH_PARAM_TXT);
    //$native = PAPI_GetSafeParam("native", "", XH_PARAM_TXT);
    //$ethnic = PAPI_GetSafeParam("ethnic", "", XH_PARAM_TXT);
    //$health = PAPI_GetSafeParam("health", "", XH_PARAM_TXT);
    //$workingyears = PAPI_GetSafeParam("workingyears", "", XH_PARAM_TXT);
    //$intro = PAPI_GetSafeParam("intro", "", XH_PARAM_TXT);;
    $sql = "INSERT INTO ".$data['candidate']
        ." SET job='{$job}'"
        .",name='{$name}'"
        .",phone='{$phone}'"
        .",email='{$email}'"
        .",address='{$address}'"
        .",course='{$course}'"
        .",experience='{$experience}'"
        .",addtime='".date("Y-m-d H:i:s")."'"
    ;
    $db->query($sql);
    return true;
}

//报名
function Save_Sign()
{
    global $db, $data;
    $arr = $_POST;
    $product = PAPI_GetSafeParam("product", "", XH_PARAM_TXT);
    $contactman = PAPI_GetSafeParam("contactman", "", XH_PARAM_TXT);
    $phone = PAPI_GetSafeParam("phone", "", XH_PARAM_TXT);
    $email = PAPI_GetSafeParam("email", "", XH_PARAM_TXT);
    $quantity = PAPI_GetSafeParam("quantity", "", XH_PARAM_TXT);
    $delivery = PAPI_GetSafeParam("delivery", "", XH_PARAM_TXT);
    $address = PAPI_GetSafeParam("address", "", XH_PARAM_TXT);
    $content = PAPI_GetSafeParam("content", "", XH_PARAM_TXT);
    $sql = "INSERT INTO ".$data['order']
        ." SET product='{$product}'"
        .",contactman='{$contactman}'"
        .",phone='{$phone}'"
        .",email='{$email}'"
        .",quantity='{$quantity}'"
        .",delivery='{$delivery}'"
        .",address='{$address}'"
        .",content='{$content}'"
        .",addtime='".date("Y-m-d H:i:s")."'"
    ;
    $db->query($sql);
    return true;
}

//订票
function Save_book()
{
    global $db, $data;
    $arr = $_POST;
    $product = PAPI_GetSafeParam("product", "", XH_PARAM_TXT);
    $come_nian = PAPI_GetSafeParam("come_nian", "", XH_PARAM_TXT);
    $come_yue = PAPI_GetSafeParam("come_yue", "", XH_PARAM_TXT);
    $come_ri = PAPI_GetSafeParam("come_ri", "", XH_PARAM_TXT);
    $delivery = $come_nian."-".$come_yue."-".$come_ri;
    $go_nian = PAPI_GetSafeParam("go_nian", "", XH_PARAM_TXT);
    $go_yue = PAPI_GetSafeParam("go_yue", "", XH_PARAM_TXT);
    $go_ri = PAPI_GetSafeParam("go_ri", "", XH_PARAM_TXT);
    $departuredate = $go_nian."-".$go_yue."-".$go_ri;
    $about_what = PAPI_GetSafeParam("about_what", "", XH_PARAM_TXT);
    $chengnian = PAPI_GetSafeParam("chengnian", "", XH_PARAM_TXT);
    $erton = PAPI_GetSafeParam("erton", "", XH_PARAM_TXT);
    $contactman = PAPI_GetSafeParam("contactman", "", XH_PARAM_TXT);
    $userr = PAPI_GetSafeParam("userr", "", XH_PARAM_TXT);
    $zhengjianleibie = PAPI_GetSafeParam("zhengjianleibie", "", XH_PARAM_TXT);
    $zjhm = PAPI_GetSafeParam("zjhm", "", XH_PARAM_TXT);
    $company = PAPI_GetSafeParam("company", "", XH_PARAM_TXT);
    $address = PAPI_GetSafeParam("address", "", XH_PARAM_TXT);
    $phone = PAPI_GetSafeParam("phone", "", XH_PARAM_TXT);
    $email = PAPI_GetSafeParam("email", "", XH_PARAM_TXT);
    $fax = PAPI_GetSafeParam("fax", "", XH_PARAM_TXT);
    $content = PAPI_GetSafeParam("content", "", XH_PARAM_TXT);
    $sql = "INSERT INTO ".$data['book']
        ." SET product='{$product}'"
        .",delivery='{$delivery}'" 
        .",departuredate='{$departuredate}'" 
        .",about_what='{$about_what}'" 
        .",chengnian='{$chengnian}'" 
        .",erton='{$erton}'" 
        .",contactman='{$contactman}'"
        .",userr='{$userr}'"
        .",zhengjianleibie='{$zhengjianleibie}'"
        .",zjhm='{$zjhm}'"
        .",company='{$company}'"
        .",address='{$address}'"
        .",phone='{$phone}'"
        .",email='{$email}'"	
        .",fax='{$fax}'"
        .",content='{$content}'"
        .",addtime='".date("Y-m-d H:i:s")."'"
    ;	 
    $db->query($sql);
    return true;
}

//留言
function Save_MES()
{
    global $db, $data;
    $arr = $_POST;
    $content = PAPI_GetSafeParam("content", "", XH_PARAM_TXT);
    $title = PAPI_GetSafeParam("title", "", XH_PARAM_TXT);
    $user = PAPI_GetSafeParam("username", "", XH_PARAM_TXT);
    $sql = "INSERT INTO ".$data['message']
        ." SET title='{$title}'"
        .",user='{$user}'"		
        .",content='{$content}'"
        .",addtime='".date("Y-m-d H:i:s")."'"
    ;
    $db->query($sql);
    return true;
}

//留言
function get_ip()
{
    if (getenv('HTTP_CLIENT_IP') && strcasecmp(getenv('HTTP_CLIENT_IP'), 'unknown'))
    {
        $ip = getenv('HTTP_CLIENT_IP');
    }
    elseif (getenv('HTTP_X_FORWARDED_FOR') && strcasecmp(getenv('HTTP_X_FORWARDED_FOR'), 'unknown'))
    {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    }
    elseif (getenv('REMOTE_ADDR') && strcasecmp(getenv('REMOTE_ADDR'), 'unknown'))
    {
        $ip = getenv('REMOTE_ADDR');
    }
    elseif (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], 'unknown'))
    {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return preg_match('/[\d\.]{7,15}/', $ip, $matches) ? $matches [0] : '127.0.0.1';
}
function Save_FBK()
{
    global $db, $data;
    $arr = $_POST;
    $content = PAPI_GetSafeParam("content", "", XH_PARAM_TXT);
    $title = PAPI_GetSafeParam("title", "", XH_PARAM_TXT);
    $user = PAPI_GetSafeParam("user", "", XH_PARAM_TXT);
    $company = PAPI_GetSafeParam("company", "", XH_PARAM_TXT);
    $address = PAPI_GetSafeParam("address", "", XH_PARAM_TXT);
    $tel = PAPI_GetSafeParam("tel", "", XH_PARAM_TXT);
    $country = PAPI_GetSafeParam("city", "", XH_PARAM_TXT);
    $email = PAPI_GetSafeParam("email", "", XH_PARAM_TXT);
    $phone = PAPI_GetSafeParam("phone", "", XH_PARAM_TXT);
    $msn = PAPI_GetSafeParam("msn", "", XH_PARAM_TXT);
    $qq = PAPI_GetSafeParam("qq", "", XH_PARAM_TXT);
    $zip = PAPI_GetSafeParam("zip", "", XH_PARAM_TXT);
    $sex = PAPI_GetSafeParam("sex", "", XH_PARAM_TXT);
    $ip = get_ip();//ip
    $sql = "INSERT INTO ".$data['feedback']
        ." SET title='{$title}'"
        .",user='{$user}'"
        .",company='{$company}'"
        .",address='{$address}'"
        .",tel='{$tel}'"
        .",country='{$country}'"
        .",email='{$email}'"
        .",phone='{$phone}'"
        .",msn='{$msn}'"
        .",qq='{$qq}'"
        .",sex='{$sex}'"
        .",zip='{$zip}'"
        .",content='{$content}'"
        .",lx='中文'"
        .",ip='{$ip}'"
        .",addtime='".date("Y-m-d H:i:s")."'"
    ;	 
        $res= $db->query($sql);
        if($res){
            echo "<script>alert('留言成功');location.href = index.php;</script>";
        } else {
            echo "<script>alert('留言失败');location.href = 'weblist.php';</script>";
            die;
        }

}

function getFbk($start = 0, $listNum = 20, $search = '')
{
    global $db, $data;
    $sql = "SELECT * FROM ".$data['feedback']." WHERE weblan=1";
    if ($search != "")
    {
        $sql .= " AND title LIKE '%$search%'";
    }
    $db->query($sql);
    $temp['countAll'] = $db->num_rows();
    $sql .= " ORDER BY id DESC LIMIT $start,$listNum";
    $db->query($sql);
    $temp['list'] = $db->getResult();
    return $temp;
}

function getFbk_Row($id)
{
    global $db, $data;
    $sql = "SELECT * FROM ".$data['feedback']." WHERE id={$id}";
    $db->query($sql);
    return $db->getRow();
}

function getPt($id)
{
    global $db, $data;
    $sql = "SELECT * FROM ".$data['product']." WHERE id={$id}";
    $db->query($sql);
    return $db->getRow();
}

function getPtype()
{
    global $db, $data;
    $sql = "SELECT * FROM ".$data['ptype'];
    $db->query($sql);
    $list = $db->getResult();
    $list = Redefide($list);
    $list = mySort($list);
    $list = myOrder($list);
    return $list;
}

function getPtList($type, $start = 0, $listNum = 20, $where = '')
{
    global $db, $data;
    $id = $type.return_Ptype($type);
    $sql = "SELECT * FROM ".$data['product']." WHERE ptype IN($id)".$where;
    $db->query($sql);
    $temp['countAll'] = $db->num_rows();
    $sql .= " ORDER BY ordid DESC,id DESC LIMIT $start,$listNum";
    $db->query($sql);
    $temp['list'] = $db->getResult();
    return $temp;
}

function return_Ptype($id)
{
    global $db, $data;
    $temp = "";
    $list = getSub($id, "ptype", "");
    if (!empty($list))
    {
        foreach($list as $v)
        {
            $temp .= ",".$v['id'];
            $temp .= return_Ptype($v['id']);
        }
    }
    return $temp;
}

//类别排序方法
/**
 * 设置数组
 * @param unknown_type $arr
 * @return unknown
 */
function Redefide($arr)
{
    if (!is_array($arr))
    {
        return false;
    }
    $temp = '';
    foreach($arr as $v)
    {
        if ($v['parent_id'] > 0)
        {
            $path = return_path(explode("/", $v['path']));
            $field = "['sub']['".$v['id']."']";
            eval("\$temp$path$field=\$v;");
        }
        else
        {
            $temp[$v['id']] = $v;
        }
    }
    return $temp;
}

function return_path($arr)
{
    if (!is_array($v));
    $total = count($arr);
    $i = 1;
    foreach($arr as $v)
    {
        if ($i == $total)
        {
            $temp .= "[$v]";
        }				
        else
        {
            $temp .= "[$v]['sub']";
        }
        $i++;
    }
    return $temp;
}

function myEval($key, $vaule)
{
    eval("\$ptype$key = \$vaule;");
}

/**
 * 重置数组
 *
 * @param unknown_type $arr
 * @return unknown
 */
function mySort($arr)
{
    if (!is_array($arr))
    {
        return false;
    }
    $i = 0;
    foreach ($arr as $v)
    {
        $temp[$i] = $v;
        if ($v['sub'] != "")
        {
            $temp[$i]['sub'] = mySort($v['sub']);
        }
        $i++;
    }
    return $temp;
}

/**
 * 排序
 *
 * @param unknown_type $list
 */
function myOrder($list)
{
    if (!is_array($list))
    {
        return false;
    }
    $num = count($list);
    for ($i = 0; $i < $num; $i++)
    {
        if (is_array($list[$i]['sub']))
        {
            $list[$i]['sub'] = myOrder($list[$i]['sub']);
        }
        if($num > 1)
        {
            for($j = $i+1; $j < $num; $j++)
            {
                if ($list[$i]['ordid'] < $list[$j]['ordid'])
                {
                    $temp = $list[$i];
                    $list[$i] = $list[$j];
                    $list[$j] = $temp;
                }
            }
        }
    }
    return $list;
}

function replaceHtmlAndJs($document)
{
    $document = trim($document);
    if (strlen($document) <= 0)
    {
    return $document;
    }
    $search = array(
        "'<script[^>]*?>.*?</script>'si", //去掉javascript
        "'<[\/\!]*?[^<>]*?>'si", //去掉HTML标记
        "'([\r\n])[\s]+'", //去掉空白字符
        "'&(quot|#34);'i", //替换HTML实体
        "'&(amp|#38);'i",
        "'&(lt|#60);'i",
        "'&(gt|#62);'i",
        "'&(nbsp|#160);'i"
    ); //作为PHP代码运行
    $replace = array(
        "",
        "",
        "\\1",
        "\"",
        "&",
        "<",
        ">",
        " "
    );
    return @preg_replace ($search, $replace, $document);
}

/**
 * utf-8、gb2312都支持的汉字截取函数
 * cut_str(字符串, 截取长度, 开始长度, 编码);
 * 编码默认为utf-8 
 * 开始长度默认为0
 */
function cut_str($string, $sublen, $dot = '...', $start = 0, $code = 'UTF-8')
{
    if ($code == 'UTF-8')
    {
        $pa ="/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/";
        preg_match_all($pa, $string, $t_string);
        if (count($t_string[0]) - $start > $sublen)
        {
            return join('', array_slice($t_string[0], $start, $sublen)).$dot;
        }
        return join('', array_slice($t_string[0], $start, $sublen));
    }
    else
    {
        $start = $start*2;
        $sublen = $sublen*2;
        $strlen = strlen($string);
        $tmpstr = '';
        for ($i = 0; $i < $strlen; $i++)
        {
            if ($i >= $start && $i < ($start+$sublen))
            {
                if(ord(substr($string, $i, 1)) > 129)
                {
                    $tmpstr .= substr($string, $i, 2);
                }
                else
                {
                    $tmpstr .= substr($string, $i, 1);
                }
            }
            if(ord(substr($string, $i, 1)) > 129)
            {
                $i++;
            }
        }
        if (strlen($tmpstr) < $strlen)
        {
            $tmpstr.= "";
        }
        return $tmpstr;
    }
}

function sysSubStr($String, $Length, $Append = false)
{
    if (strlen($String) <= $Length)
    {
        return $String;
    }
    else
    {
        $I = 0;
        while ($I < $Length)
        {
            $StringTMP = substr($String, $I, 1);
            if ( ord($StringTMP) >= 224)
            {
                $StringTMP = substr($String, $I, 3);
                $I = $I + 3;
            } 
            elseif(ord($StringTMP) >= 192)
            {
                $StringTMP = substr($String, $I, 2);
                $I = $I + 2;
            }
            else
            {
                $I = $I + 1;
            }
            $StringLast[] = $StringTMP;
        }
        $StringLast = implode("", $StringLast);
        if ($Append)
        {
            $StringLast .= "...";
        }
        return $StringLast;
    }
}

function yf($yf)
{
    switch ($yf)
    {
        case 1: 
            return "Jan";
            break;
        case 2: 
            return "Feb";
            break;
        case 3: 
            return "Mar";
            break;
        case 4: 
            return "Apr";
            break;
        case 5: 
            return "May";
            break;
        case 6: 
            return "Jun";
            break;
        case 7: 
            return "Jul";
            break;
        case 8: 
            return "Aug";
            break;
        case 9: 
            return "Sep";
            break;
        case 10: 
            return "Oct";
            break;
        case 11: 
            return "Nov";
            break;
        case 12: 
            return "Dec";
            break;
    }
}

//add by wengwenjin
function getZd($ziduan, $table, $where = "1", $order = "")
{
    global $db, $data, $tj;
    $sql = "SELECT ".$ziduan." FROM ".$data[$table]." WHERE ".$where.$order;
    $db->query($sql);
    $tj = $db->num_rows();
    return $db->getResult();
}

/*
 * 根据条件查询数据表，并返回所查到的所有记录
 * @param string $sql 查询语句
 * @return array $data 所查到的所有记录
 */
function get_all($sql)
{
    $res = mysql_query($sql);
    $data = array();
    if ($res && mysql_num_rows($res))
    {
        while ($arr = mysql_fetch_array($res, MYSQL_ASSOC))
        {
            $data[] = $arr;
        }
    }
    return $data;
}
    
/*
 * 根据条件查询数据表，并返回所查到的一条记录
 * @param string $sql 查询语句
 * @return array $data 所查到的一条记录
 */
function get_one($sql)
{
    $result = mysql_query($sql);
    $data = array();
    if ($result && mysql_num_rows($result) > 0)
    {
        $data = mysql_fetch_array($result, MYSQL_ASSOC);
    }
    return $data;
}
function get_chapter($ID,$table,$ClassID='')
{
    $url = $_SERVER['PHP_SELF'];
    $html='';
    $html.='<p class="link2">';
    if ($ClassID != '') {
        $condition = 'AND ClassID = '.$ClassID;
    }else{
        $condition = '';
    }
    $sql = "SELECT * FROM ".$table." WHERE id > ".$ID." ".$condition." ORDER BY sort ASC LIMIT 0,1";

    $result = mysql_query( $sql );
    if( mysql_num_rows( $result ) )
    {
        $rs = mysql_fetch_array( $result );
        $html.= " <a href='$url?id=".$rs['id']."' >previous：".cut_str($rs['title_en'], 15, $dot = '...')."</a>";
    }
    else
    {
        $html .= "<a href='javascript:void(0);'>previous：null</a>";
    }
    $sql = "SELECT * FROM ".$table." WHERE id < ".$ID." ".$condition."  ORDER BY sort DESC LIMIT 0,1";
    $result = mysql_query( $sql );
    if( mysql_num_rows( $result ) )
    {
        $rs = mysql_fetch_array( $result );
        $html .= "<a  href='$url?id=".$rs['id']."'> next：".cut_str($rs['title_en'], 15, $dot = '...')."</a>";
    }
    else
    {

        $html .= "<a  href='javascript:void(0);'> next：null</a>";

    }
    $html.='	</p>';
    echo $html;
}
?>