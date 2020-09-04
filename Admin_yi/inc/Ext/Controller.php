<?php
class Controller
{
    var $module;
    var $postfix;

    /**
     * 生成静态页
     * $sFilePath 模版URL
     * $FilePath 生成目标文件
     */
    function create_html($sFilePath, $FilePath)
    {
        $content = file_get_contents($sFilePath);	
        $fp = fopen($FilePath, "w");
        fwrite($fp, $content);
        fclose($fp);
    }

    //删除目标文件
    function delFile ($file)
    {
        if (!is_file($file))
        {
            return false;
        }
        @chmod($file, 0777);
        @unlink($file);
        return true;
    }
}

?>