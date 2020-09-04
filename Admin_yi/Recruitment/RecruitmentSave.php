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
            $title = $_POST['title'];
            $title_en = $_POST['title_en'];
            $title_j = $_POST['title_j'];
            $content = $_POST['content'];
            $content_en = $_POST['content_en'];
            $content_j = $_POST['content_j'];
            $spic = str_replace("../../", "", $_POST['cls_imgX']);
            $bpic = str_replace("../../", "", $_POST['cls_imgD']);
            $bpicj = str_replace("../../", "", $_POST['cls_imgDj']);
            $t = $_POST['t'];
            $t_en = $_POST['t_en'];
            $t_j = $_POST['t_j'];
            $k = $_POST['k'];
            $k_en = $_POST['k_en'];
            $k_j = $_POST['k_j'];
            $d = $_POST['d'];
            $d_en = $_POST['d_en'];
            $d_j = $_POST['d_j'];
            $text = $_POST['text'];
            $text_en = $_POST['text_en'];
            $text_j = $_POST['text_j'];
            $p = str_replace("../../", "", $_POST['p']);
            $p_en = str_replace("../../", "", $_POST['p_en']);
            $p_j = str_replace("../../", "", $_POST['p_j']);
            $sort = $_POST['sort'];
            $filename = $_POST['filename'];
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
            $string = "INSERT INTO ".$data['about']."(title,title_en,title_j,content,content_en,content_j,spic,bpic,bpicj,sort,tj,passed,addTime,qy,t,t_en,t_j,k,k_en,k_j,d,d_en,d_j,p,p_en,p_j,text,text_en,text_j,filename) VALUES('{$title}','{$title_en}','{$title_j}','{$content}','{$content_en}','{$content_j}','{$spic}','{$bpic}','{$bpicj}','{$sort}','{$tj}','{$passed}','{$addTime}','{$_SESSION['qy']}','{$t}','{$t_en}','{$t_j}','{$k}','{$k_en}','{$k_j}','{$d}','{$d_en}','{$d_j}','{$p}','{$p_en}','{$p_j}','{$text}','{$text_en}','{$text_j}','{$filename}')";
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:RecruitmentList.php");
            exit;
            break;
        case "Modify";
            $pid = $_POST['pid'];
            $title = $_POST['title'];
            $title_en = $_POST['title_en'];
            $title_j = $_POST['title_j'];
            $content = $_POST['content'];
            $content_en = $_POST['content_en'];
            $content_j = $_POST['content_j'];
            $spic = str_replace("../../", "", $_POST['cls_imgX']);
            $bpic = str_replace("../../", "", $_POST['cls_imgD']);
            $bpicj = str_replace("../../", "", $_POST['cls_imgDj']);
            $t = $_POST['t'];
            $t_en = $_POST['t_en'];
            $t_j = $_POST['t_j'];
            $k = $_POST['k'];
            $k_en = $_POST['k_en'];
            $k_j = $_POST['k_j'];
            $d = $_POST['d'];
            $d_en = $_POST['d_en'];
            $d_j = $_POST['d_j'];
            $text = $_POST['text'];
            $text_en = $_POST['text_en'];
            $text_j = $_POST['text_j'];
            $p = str_replace("../../","",$_POST['p']);
            $p_en = str_replace("../../","",$_POST['p_en']);
            $p_j = str_replace("../../","",$_POST['p_j']);
            $sort = $_POST['sort'];
            $filename = $_POST['filename'];
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
            $string = "UPDATE ".$data['about']." SET title='$title',title_en='$title_en',title_j='$title_j',content='$content',content_en='$content_en',content_j='$content_j',spic='$spic',bpic='$bpic',bpicj='$bpicj',sort='$sort',tj='$tj',passed='$passed',addTime='$addTime',t='$t',t_en='$t_en',t_j='$t_j',k='$k',k_en='$k_en',k_j='$k_j',d='$d',d_en='$d_en',d_j='$d_j',p='$p',p_en='$p_en',p_j='$p_j',text='$text',text_en='$text_en',text_j='$text_j',filename='$filename' WHERE id=".$pid;
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:RecruitmentList.php");
            exit;
            break;
    }
}
?>
