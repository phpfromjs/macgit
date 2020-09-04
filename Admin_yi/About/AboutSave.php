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
        case "add";
            $src = $_POST['src'];
            $s = $_POST['s'];
            $s_en = $_POST['s_en'];
            $title = $_POST['title'];
            $title_en = $_POST['title_en'];
            $title_j = $_POST['title_j'];
            $text = $_POST['text'];
            $text_en = $_POST['text_en'];
            $text_j = $_POST['text_j'];
            $content = $_POST['content'];
            $content_en = $_POST['content_en'];
            $content_j = $_POST['content_j'];
            $t = str_replace("../../", "", $_POST['t']);
            $t_en = $_POST['t_en'];
            $t_j = $_POST['t_j'];
            $k = str_replace("../../", "", $_POST['k']);
            $k_en = $_POST['k_en'];
            $k_j = $_POST['k_j'];
            $d = str_replace("../../", "", $_POST['d']);
            $d_en = $_POST['d_en'];
            $d_j = $_POST['d_j'];
            $yyff = $_POST['yyff'];
            $yyff_en = $_POST['yyff_en'];
            $yyff_j = $_POST['yyff_j'];
            $wdxz = $_POST['wdxz'];
            $wdxz_en = $_POST['wdxz_en'];
            $nn = $_POST['nn'];
            $nn_en = $_POST['nn_en'];
            $nn_j = $_POST['nn_j'];
            $spic = str_replace("../../", "", $_POST['spic']);
            $spicen = str_replace("../../", "", $_POST['spicen']);
            $bpic = str_replace("../../", "", $_POST['bpic']);
            $sort = $_POST['sort'];
            $model = $_POST['model'];
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
            for ($i = 1; $i <= 10; $i++)
            {
                $pic = str_replace("../../", "", $_POST['pic_'.$i]);
                if (!empty($pic))
                {
                    $arrPic = $arrPic.$pic."|";
                }
            }
            if (!empty($arrPic))
            {
                $cd = strlen($arrPic)-1;
                $mpic = substr($arrPic, 0, $cd);
            }
            $sql = "SELECT * FROM ".$data['classabout']." WHERE classid=".$cid;
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
            $link_id = $rs['link_id'];
            //扩展分类
            $gl = $_POST['gl'];
            $gl = implode("|",$gl);
            if (!empty($gl))
            {
                $gl = "|".$gl."|";
            }
            else
            {
                $gl = "";
            }
            //扩展分类
            $cid1 = $_POST['classid1'];
            $cid1 = implode("|",$cid1);
            if (!empty($cid1))
            {
                $cid1 = "|".$cid1."|";
            }
            else
            {
                $cid1 = "";
            }
            $link_id1 = $cid1;
            $cid1 = 0;
            $string = "INSERT INTO ".$data['about']."(hits,link_id,classid,bid,title,title_en,title_j,content,content_en,content_j,spic,spicen,bpic,sort,tj,passed,addTime,model,text,text_en,text_j,mpic,yyff,yyff_en,yyff_j,wdxz,wdxz_en,classid1,link_id1,nn,nn_en,nn_j,t,t_en,t_j,k,k_en,k_j,d,d_en,d_j,s,s_en,gl,src,isnew) VALUES('{$hits}','{$link_id}','{$cid}','{$cidd}','{$title}','{$title_en}','{$title_j}','{$content}','{$content_en}','{$content_j}','{$spic}','{$spicen}','{$bpic}','{$sort}','{$tj}','{$passed}','{$addTime}','{$model}','{$text}','{$text_en}','{$text_j}','{$mpic}','{$yyff}','{$yyff_en}','{$yyff_j}','{$wdxz}','{$wdxz_en}','{$cid1}','{$link_id1}','{$nn}','{$nn_en}','{$nn_j}','{$t}','{$t_en}','{$t_j}','{$k}','{$k_en}','{$k_j}','{$d}','{$d_en}','{$d_j}','{$s}','{$s_en}','{$gl}','{$src}','{$isnew}')";
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:AboutList.php");
            exit;
            break;
        case "Modify";
            $src = $_POST['src'];
            $pid = $_POST['pid'];
            $s = $_POST['s'];
            $s_en = $_POST['s_en'];
            $title = $_POST['title'];
            $title_en = $_POST['title_en'];
            $title_j = $_POST['title_j'];
            $text = $_POST['text'];
            $text_en = $_POST['text_en'];
            $text_j = $_POST['text_j'];
            $content = $_POST['content'];
            $content_en = $_POST['content_en'];
            $content_j = $_POST['content_j'];
            $t = str_replace("../../", "", $_POST['t']);
            $t_en = $_POST['t_en'];
            $t_j = $_POST['t_j'];
            $k = str_replace("../../", "", $_POST['k']);
            $k_en = $_POST['k_en'];
            $k_j = $_POST['k_j'];
            $d = str_replace("../../", "", $_POST['d']);
            $d_en = $_POST['d_en'];
            $d_j = $_POST['d_j'];
            $yyff = $_POST['yyff'];
            $yyff_en = $_POST['yyff_en'];
            $yyff_j = $_POST['yyff_j'];
            $wdxz = $_POST['wdxz'];
            $wdxz_en = $_POST['wdxz_en'];
            $nn = $_POST['nn'];
            $nn_en = $_POST['nn_en'];
            $nn_j = $_POST['nn_j'];
            $spic = str_replace("../../", "", $_POST['spic']);
            $spicen = str_replace("../../", "", $_POST['spicen']);
            $bpic = str_replace("../../", "", $_POST['bpic']);
            $sort = $_POST['sort'];
            $model = $_POST['model'];
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
            for ($i = 1; $i <= 10; $i++)
            {
                $pic = str_replace("../../", "", $_POST['pic_'.$i]);
		if (!empty($pic))
                {
                    $arrPic = $arrPic.$pic."|";
                }
            }
            if (!empty($arrPic))
            {
                $cd = strlen($arrPic)-1;
                $mpic = substr($arrPic, 0, $cd);
            }
            $sql = "SELECT * FROM ".$data['classabout']." WHERE classid=".$cid;
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
            $link_id = $rs['link_id'];
            //扩展分类
            $gl = $_POST['gl'];
            $gl = implode("|", $gl);
            if (!empty($gl))
            {
                $gl = "|".$gl."|";
            }
            else
            {
                $gl = "";
            }
            //扩展分类
            $cid1 = $_POST['classid1'];
            $cid1 = implode("|", $cid1);
            if (!empty($cid1))
            {
                $cid1 = "|".$cid1."|";
            }
            else
            {
                $cid1 = "";
            }
            $link_id1 = $cid1;
            $cid1 = 0;
            $string = "UPDATE ".$data['about']." SET classid='$cid',bid='$cidd',link_id='$link_id',hits='$hits',title='$title',title_en='$title_en',title_j='$title_j',content='$content',content_en='$content_en',content_j='$content_j',spic='$spic',spicen='$spicen',bpic='$bpic',sort='$sort',tj='$tj',passed='$passed',addTime='$addTime',model='$model',text='$text',text_en='$text_en',text_j='$text_j',mpic='$mpic',yyff='$yyff',yyff_en='$yyff_en',yyff_j='$yyff_j',wdxz='$wdxz',wdxz_en='$wdxz_en',classid1='$cid1',link_id1='$link_id1',nn='$nn',nn_en='$nn_en',nn_j='$nn_j',t='$t',t_en='$t_en',t_j='$t_j',k='$k',k_en='$k_en',k_j='$k_j',d='$d',d_en='$d_en',d_j='$d_j',s='$s',s_en='$s_en',gl='$gl',src='$src',isnew='$isnew' WHERE id=".$pid;
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:AboutList.php");
            exit;
            break;
    }
}
?>