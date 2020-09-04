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
            $CompanyNameCn = $_POST['CompanyNameCn'];
            $CompanyNameEn = $_POST['CompanyNameEn'];
            $AddressCn = $_POST['AddressCn'];
            $Addressen = $_POST['Addressen'];
            $mobilephone1 = $_POST['mobilephone1'];
            $mobilephoneen1 = $_POST['mobilephoneen1'];
            $mobilephone2 = $_POST['mobilephone2'];
            $mobilephoneen2 = $_POST['mobilephoneen2'];
            $TelePhone = $_POST['TelePhone'];
            $TelePhoneen = $_POST['TelePhoneen'];
            $Fax = $_POST['Fax'];
            $Faxen = $_POST['Faxen'];
            $postalcodecn= $_POST['postalcodecn'];
            $postalcodeen = $_POST['postalcodeen'];
            $emailcn= $_POST['emailcn'];
            $emailen = $_POST['emailen'];
            $worktimecn = $_POST['worktimecn'];
            $worktimeen= $_POST['worktimeen'];
            $Longitude = $_POST['Longitude'];
            $Latitude=$_POST['Latitude'];
            $content = $_POST['content'];
            $content_en = $_POST['content_en'];
            $content_j = $_POST['content_j'];
            $spic = str_replace("../../", "", $_POST['spic']);
            $spicen = str_replace("../../", "", $_POST['spicen']);
            $bpic = str_replace("../../", "", $_POST['cls_imgD']);
            $bpicj = str_replace("../../", "", $_POST['cls_imgDj']);
            $t = $_POST['t'];
            $k = $_POST['k'];
            $d = $_POST['d'];
            $t_en = $_POST['t_en'];
            $k_en = $_POST['k_en'];
            $d_en = $_POST['d_en'];
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
            $string = "INSERT INTO ".$data['contact']."(title,title_en,title_j,CompanyNameCn,CompanyNameEn,AddressCn,Addressen,mobilephone1,mobilephoneen1,mobilephone,mobilephoneen2,TelePhone,TelePhoneen,Fax,Faxen,postalcodecn,postalcodeen,emailcn,emailen,worktimecn,worktimeen,Longitude,Latitude,content,content_en,content_j,spic,spicen,bpic,bpicj,sort,tj,passed,addTime,qy,t,k,d,t_en,k_en,d_en,p,p_en,p_j,text,text_en,text_j,filename) VALUES('{$title}','{$title_en}','{$title_j}','{$CompanyNameCn}','{$CompanyNameEn}','{$AddressCn}','{$Addressen}','{$mobilephone1}','{$mobilephoneen1}','{$mobilephone2}','{$mobilephoneen2}','{$TelePhone}','{$TelePhoneen}','{$Fax}','{$Faxen}','{$postalcodecn}','{$postalcodeen}','{$emailcn}','{$emailen}','{$worktimecn}','{$worktimeen}','{$Longitude}','{$Latitude}','{$content}','{$content_en}','{$content_j}','{$spic}','{$spicen}','{$bpic}','{$bpicj}','{$sort}','{$tj}','{$passed}','{$addTime}','{$_SESSION['qy']}','{$t}','{$k}','{$d}','{$t_en}','{$k_en}','{$d_en}','{$p}','{$p_en}','{$p_j}','{$text}','{$text_en}','{$text_j}','{$filename}')";
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:ContactList.php");
            exit;
            break;
        case "Modify";
            $pid = $_POST['pid'];
            $title = $_POST['title'];
            $title_en = $_POST['title_en'];
            $title_j = $_POST['title_j'];
            $CompanyNameCn = $_POST['CompanyNameCn'];
            $CompanyNameEn = $_POST['CompanyNameEn'];
            $AddressCn = $_POST['AddressCn'];
            $Addressen = $_POST['Addressen'];
            $mobilephone1 = $_POST['mobilephone1'];
            $mobilephoneen1 = $_POST['mobilephoneen1'];
            $mobilephone2 = $_POST['mobilephone2'];
            $mobilephoneen2 = $_POST['mobilephoneen2'];
            $TelePhone = $_POST['TelePhone'];
            $TelePhoneen = $_POST['TelePhoneen'];
            $Fax = $_POST['Fax'];
            $Faxen = $_POST['Faxen'];
            $postalcodecn= $_POST['postalcodecn'];
            $postalcodeen = $_POST['postalcodeen'];
            $emailcn= $_POST['emailcn'];
            $emailen = $_POST['emailen'];
            $worktimecn = $_POST['worktimecn'];
            $worktimeen= $_POST['worktimeen'];
            $Longitude = $_POST['Longitude'];
            $Latitude=$_POST['Latitude'];
            $content = $_POST['content'];
            $content_en = $_POST['content_en'];
            $content_j = $_POST['content_j'];
            $spic = str_replace("../../", "", $_POST['spic']);
            $spicen = str_replace("../../", "", $_POST['spicen']);
            $bpic = str_replace("../../", "", $_POST['cls_imgD']);
            $bpicj = str_replace("../../", "", $_POST['cls_imgDj']);
            $t = $_POST['t'];
            $k = $_POST['k'];
            $d = $_POST['d'];
            $t_en = $_POST['t_en'];
            $k_en = $_POST['k_en'];
            $d_en = $_POST['d_en'];
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
            $string = "UPDATE ".$data['contact']." SET title='$title',title_en='$title_en',title_j='$title_j',CompanyNameCn='$CompanyNameCn',CompanyNameEn='$CompanyNameEn',AddressCn='$AddressCn',Addressen='$Addressen',mobilephone1='$mobilephone1',mobilephoneen1='$mobilephoneen1',mobilephone2='$mobilephone2',mobilephoneen2='$mobilephoneen2',TelePhone='$TelePhone',TelePhoneen='$TelePhoneen',Fax='$Fax',Faxen='$Faxen',postalcodecn='$postalcodecn',postalcodeen='$postalcodeen',emailcn='$emailcn',emailen='$emailen',worktimecn='$worktimecn',worktimeen='$worktimeen',Longitude='$Longitude',Latitude='$Latitude',content='$content',content_en='$content_en',content_j='$content_j',spic='$spic',spicen='$spicen',bpic='$bpic',bpicj='$bpicj',sort='$sort',tj='$tj',passed='$passed',addTime='$addTime',t='$t',k='$k',d='$d',t_en='$t_en',k_en='$k_en',d_en='$d_en',p='$p',p_en='$p_en',p_j='$p_j',text='$text',text_en='$text_en',text_j='$text_j',filename='$filename' WHERE id=".$pid;
            mysql_query($string, $conn) or die("ERROR: ".mysql_error());
            header("Location:ContactList.php");
            exit;
            break;
    }
}
?>
