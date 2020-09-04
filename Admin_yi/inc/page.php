<style type="text/css">
.page a {
    color: #003366;
}
</style>
<?php
if ($num_row > 0)
{
    echo '<div class="pagin">';
    new Pager($num_row, $pagesize, $page);
    echo '</div>';
}
else
{
    echo '';
}

class Pager
{
    var $centerNum = 5;

    /**
     * 生成翻页效果
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
        echo '<div class="message">';
        echo '总 <i class="blue">'.$num_row.'</i> 条记录  分<i class="blue">'.$AllNum.'</i>页 | <i class="blue">'.$pagesize.'</i>/页  ';
        echo '</div>';
        echo '<ul class="paginList">';
        //echo '<a href="'.$this->getUrl(1).'">首页</a></td>';
        echo '<li class="paginItem"><a href="'.$this->getUrl(1).'"><span class="pagepre"></span></a></li>';
        for ($i = $startNum; $i <= $endNum; $i++)
        {
            //echo '<li class="paginItem"><a href="'.$this->getUrl($i).'">';
            echo ($page==$i) ? '<li class="paginItem current"><a href="'.$this->getUrl($i).'">'.$i.'</a></li>' : '<li class="paginItem"><a href="'.$this->getUrl($i).'">'.$i.'</a></li>';
            //echo '</a></li>';
        }
        echo '<li class="paginItem"><a href="'.$this->getUrl($AllNum).'"><span class="pagenxt"></span></a></li>';
        //$this->xption($AllNum);
        echo '</ul>';
    }

    function getUrl($page)
    {
        $list = explode("&", $_SERVER['QUERY_STRING']);
        $url = "page=".$page."&title=".$_GET['title']."&classid=".$_GET['classid']."&cid=".$_GET['cid'];
        foreach ($list as $v)
        {
            $temp = explode("=", $v);
            if ($temp[0] != "page")
            {
                $url.$v;
            }
        }
        return $_SERVER["ORIG_PATH_INFO"].'?'.$url;
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