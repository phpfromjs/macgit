<?php
if ($pages > 1)
{
    echo '<ul class="yema">';
    new Pager($num_row, $pagesize, $page);
    echo '</ul>';
}

class Pager
{
    var $centerNum = 5;

    /**
     * 生成翻页效果
     *
     * @param unknown_type $num_row 总数量
     * @param unknown_type $pagesize 每页数量
     * @param unknown_type $page 当前页
     * @return Pager
     */
    function Pager($num_row, $pagesize, $page)
    {
        //总页数
        $AllNum =($num_row % $pagesize == 0) ? $num_row/$pagesize : (int)($num_row/$pagesize)+1;
        $startNum = $page-$this->centerNum;
        $endNum = $page+$this->centerNum;
        if ($startNum < 1)
        {
            $endNum = $endNum-($startNum);
            $startNum = 1;
        }
        if ($endNum > $AllNum)
        {
            $startNum = $startNum-($endNum-$AllNum);
            $endNum = $AllNum;
            if ($startNum <= 0)
            {
                $startNum = 1;
            }
        }
        //echo '<table  style="border:none;"><tr><td  style="border:none;">';
        //echo '总记录 <font color="#FF0000">'.$num_row.'</font> 条记录  分<font color="#FF0000">'.$AllNum.'</font>页 | <font color="#FF0000">'.$pagesize.'</font>/页 | ';

        echo ' <ul class="yema">';
        echo '<li class="first"><a href="'.$this->getUrl($startNum).'">首页</a></li>';
        if ($page > 1)
        {
            echo '<li><a href="'.$this->getUrl($page-1).'"> 上一页</a></li>';
        }
        else
        {
            echo '<li><a href="#">上一页</a></li>';
        }
        for ($i = $startNum; $i <= $endNum; $i++)
        {
            //echo '<td  style="border:none;"><a href="'.$this->getUrl($i).'">';
            echo ($page == $i) ? '<li><a class="cur">'.$i.'</a></li>' : '<li><a href="'.$this->getUrl($i).'" >'.$i.'</a></li>';
            //echo '</a></td>';
        }
        if ($page < $AllNum)
        {
            echo '<li><a href="'.$this->getUrl($page+1).'"> 下一页 </a></li>';
        }
        else
        {
            echo '<li><a href="#">下一页</a></li>';
        }
        echo '<li class="last"><a href="'.$this->getUrl( $endNum).'">尾页</a></li>';
        echo '</ul>';

        //$this->xption($AllNum);
        //echo '</td></tr></table>';
    }
    function getUrl($page)
    {
        $list = explode("&", $_SERVER['QUERY_STRING']);
        if (empty($_GET['classname']))
        {
            $url = "page=".$page;
            foreach ($list as $v)
            {
                $temp = explode("=", $v);
                if ($temp[0] != "page" && !empty($temp[0]))
                {
                    $url .= "&".$v;
                }
            }
        }
        else
        {
            $url = $_GET['classname']."_".$page.".html";
        }
        if (empty($_GET['classname']))
        {
            return '?'.$url;
        }
        else
        {
            return $url;
        }
    }

    function xption($total)
    {
        echo '<select onchange="javascript:location=this.options[this.selectedIndex].value;"><option>跳转</option>';
        for($i = 1; $i <= $total; $i++)
        {
            echo '<option value="'.$this->getUrl($i).'">'.$i.'</option>';
        }
        echo '</select>';
    }
}
?>