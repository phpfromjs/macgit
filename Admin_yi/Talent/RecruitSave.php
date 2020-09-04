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
            $cid = $_POST['classid'];
            $sql = "SELECT * FROM ".$data['classrecruit']." WHERE classid=".$cid;
            $resul = mysql_query($sql, $conn) or die ("ERROR: ".mysql_error());
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
            $sort = $_POST['sort'];
            $job = $_POST['job'];
            $nature = $_POST['nature'];
            $place = $_POST['place'];
            $salary = $_POST['salary'];
            $num = $_POST['num'];
            $content = $_POST['content'];
            $office = $_POST['office'];
            $passed = 1;
            $addTime = $_POST['UpdateTime'];
            $deadline = $_POST['deadline'];
            $hits = $_POST['hits'];
            $string = "INSERT INTO ".$data['recruit']."(classid,bid,sort,job,nature,place,salary,num,content,office,passed,addTime,deadline,hits) VALUES('{$cid}','{$cidd}','{$sort}','{$job}','{$nature}','{$place}','{$salary}','{$num}','{$content}','{$office}','{$passed}','{$addTime}','{$deadline}','{$hits}')";
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:RecruitList.php");
            exit;
            break;
        case "modify";
            $pid = $_POST['pid'];
            $cid = $_POST['classid'];
            $sql = "SELECT * FROM ".$data['classrecruit']." WHERE classid=".$cid;
            $resul = mysql_query($sql, $conn) or die ("ERROR: ".mysql_error());
            $rs = mysql_fetch_array($resul);
            if (mysql_num_rows($resul)==0)
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
            $sort = $_POST['sort'];
            $job = $_POST['job'];
            $nature = $_POST['nature'];
            $place = $_POST['place'];
            $salary = $_POST['salary'];
            $num = $_POST['num'];
            $content = $_POST['content'];
            $office = $_POST['office'];
            $passed = 1;
            $addTime = $_POST['UpdateTime'];
            $deadline = $_POST['deadline'];
            $hits = $_POST['hits'];
            $string = "UPDATE ".$data['recruit']." SET classid='$cid',bid='$cidd',sort='$sort',job='$job',nature='$nature',place='$place',salary='$salary',num='$num',content='$content',office='$office',passed='$passed',addTime='$addTime',deadline='$deadline',hits='$hits' WHERE id=".$pid;
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:RecruitList.php");
            exit;
            break;
    }
}
?>