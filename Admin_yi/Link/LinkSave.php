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
            $linkurl = $_POST['linkurl'];
            $linkurlen = $_POST['linkurlen'];
            $spic = str_replace("../../", "", $_POST['cls_imgX']);
            $bpic = str_replace("../../", "", $_POST['cls_imgD']);
            $bpicj = str_replace("../../", "", $_POST['cls_imgDj']);
            $text = $_POST['text'];
            $text_en = $_POST['text_en'];
            $text_j = $_POST['text_j'];
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
            $string = "INSERT INTO ".$data['link']."(title,title_en,title_j,linkurl,linkurlen,spic,bpic,bpicj,sort,tj,passed,addTime,qy,text,text_en,text_j,filename) VALUES('{$title}','{$title_en}','{$title_j}','{$linkurl}','{$linkurlen}','{$spic}','{$bpic}','{$bpicj}','{$sort}','{$tj}','{$passed}','{$addTime}','{$_SESSION['qy']}','{$text}','{$text_en}','{$text_j}','{$filename}')";
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:LinkList.php");
            exit;
            break;
        case "Modify";
            $pid = $_POST['pid'];
            $title = $_POST['title'];
            $title_en = $_POST['title_en'];
            $title_j = $_POST['title_j'];
            $linkurl = $_POST['linkurl'];
            $linkurlen = $_POST['linkurlen'];
            $spic = str_replace("../../", "", $_POST['cls_imgX']);
            $bpic = str_replace("../../", "", $_POST['cls_imgD']);
            $bpicj = str_replace("../../", "", $_POST['cls_imgDj']);
            $text = $_POST['text'];
            $text_en = $_POST['text_en'];
            $text_j = $_POST['text_j'];
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
            $string = "UPDATE ".$data['link']." SET title='$title',title_en='$title_en',title_j='$title_j',linkurl='$linkurl',linkurlen='$linkurlen',spic='$spic',bpic='$bpic',bpicj='$bpicj',sort='$sort',tj='$tj',passed='$passed',addTime='$addTime',text='$text',text_en='$text_en',text_j='$text_j',filename='$filename' WHERE id=".$pid;
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:LinkList.php");
            exit;
            break;
    }
}
?>
