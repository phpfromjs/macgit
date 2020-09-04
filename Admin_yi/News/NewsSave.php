<?php
require_once("../inc/AdminCheck.php");
require_once("../inc/conn1.php");
?>
<?php
if (!empty($_GET['action']))
{
    $action = $_GET['action'];
    switch($action)
    {
        //添加新闻
        case "add";
            $title = $_POST['title'];
            $title_en = $_POST['title_en'];
            $content = $_POST['content'];
            $content_en = $_POST['content_en'];
            $text = $_POST['text'];
            $text_en = $_POST['text_en'];
            $t = $_POST['t'];
            $t_en = $_POST['t_en'];
            $k = $_POST['k'];
            $k_en = $_POST['k_en'];
            $d = $_POST['d'];
            $d_en = $_POST['d_en'];
            $tpid = $_POST['tpid'];
            $spic = str_replace("../../", "", $_POST['cls_imgX']);
            $bpic = str_replace("../../", "", $_POST['cls_imgD']);
            $sort = $_POST['sort'];
            $author = $_POST['author'];
            $author_en = $_POST['author_en'];
            $hits = $_POST['hits'];
            if (!empty($_POST['tj']))
            {
                $tj = $_POST['tj'];
            }
            else
            {
                $tj = 0;
            }
            $addTime = $_POST['UpdateTime'];
            if (!empty($_POST['passed']))
            {
                $passed = $_POST['passed'];
            }
            else
            {
                $passed = 0;
            }
            if (!empty($_POST['isnew']))
            {
                $isnew = $_POST['isnew'];
            }
            else
            {
                $isnew = 0;
            }
            $cid = $_POST['classid'];
            $sql = "SELECT * FROM ".$data['classnews']." WHERE classid=".$cid;
            $resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
            $rs = mysql_fetch_array($resul);
            if (mysql_num_rows($resul) == 0)
            {
                $cidd = $cid;
            }
            else
            {
                if ($rs['prv_id'] == 0)
                {
                    $cidd = $cid;
                }
                else
                {
                    $cidd = $rs['prv_id'];
                }
            }
            $string = "INSERT INTO ".$data['news']."(hits,author,author_en,classid,bid,title,title_en,content,content_en,spic,bpic,sort,tj,passed,addTime,text,text_en,tpid,t,t_en,k,k_en,d,d_en,isnew) VALUES('{$hits}','{$author}','{$author_en}','{$cid}','{$cidd}','{$title}','{$title_en}','{$content}','{$content_en}','{$spic}','{$bpic}','{$sort}','{$tj}','{$passed}','{$addTime}','{$text}','{$text_en}','{$tpid}','{$t}','{$t_en}','{$k}','{$k_en}','{$d}','{$d_en}','{$isnew}')";
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:NewsList.php");
            exit;
            break;
        //修改新闻
        case "modify";
            $pid = $_POST['pid'];
            $title = $_POST['title'];
            $title_en = $_POST['title_en'];
            $content = $_POST['content'];
            $content_en = $_POST['content_en'];
            $text = $_POST['text'];
            $text_en = $_POST['text_en'];
            $t = $_POST['t'];
            $t_en = $_POST['t_en'];
            $k = $_POST['k'];
            $k_en = $_POST['k_en'];
            $d = $_POST['d'];
            $d_en = $_POST['d_en'];
            $tpid = $_POST['tpid'];
            $spic = str_replace("../../", "", $_POST['cls_imgX']);
            $bpic = str_replace("../../", "", $_POST['cls_imgD']);
            $sort = $_POST['sort'];
            $author = $_POST['author'];
            $author_en = $_POST['author_en'];
            $hits = $_POST['hits'];
            if (!empty($_POST['tj']))
            {
                $tj = $_POST['tj'];
            }
            else
            {
                $tj = 0;
            }
            if (!empty($_POST['isnew']))
            {
                $isnew = $_POST['isnew'];
            }
            else
            {
                $isnew = 0;
            }
            $addTime = $_POST['UpdateTime'];
            if (!empty($_POST['passed']))
            {
                $passed = $_POST['passed'];
            }
            else
            {
                $passed = 0;
            }
            $cid = $_POST['classid'];
            $sql = "SELECT * FROM ".$data['classnews']." WHERE classid=".$cid;
            $resul = mysql_query($sql, $conn) or die("ERROR: ".mysql_error());
            $rs = mysql_fetch_array($resul);
            if (mysql_num_rows($resul) == 0)
            {
                $cidd = $cid;
            }
            else
            {
                if ($rs['prv_id'] == 0)
                {
                    $cidd = $cid;
                }
                else
                {
                    $cidd = $rs['prv_id'];
                }
            }
            $string = "UPDATE ".$data['news']." SET classid='$cid',bid='$cidd',author='$author',author_en='$author_en',hits='$hits',title='$title',title_en='$title_en',content='$content',content_en='$content_en',spic='$spic',bpic='$bpic',sort='$sort',tj='$tj',passed='$passed',addTime='$addTime',text='$text',text_en='$text_en',tpid='$tpid',t='$t',t_en='$t_en',k='$k',k_en='$k_en',d='$d',d_en='$d_en',isnew='$isnew' WHERE id=".$pid;
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:NewsList.php");
            exit;
            break;
    }
}
?>