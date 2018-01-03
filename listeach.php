<?php
$arr=array(
   '教学部'=>array(
       array('李某','18','人妖'),
       array('高某','20','男'),
       array('张某','21','妖人'),
   ),
   '宣传部'=>array(
       array('李某','18','人妖'),
       array('高某','20','男'),
       array('张某','21','妖人'),
   ),
   '财务部'=>array(
       array('李某','18','人妖'),
       array('高某','20','男'),
       array('张某','21','妖人'),
   ),
);

while (list($key, $value) = each($arr))
{
    echo '<div align="center">' . $key . '</div>';
    
    echo '<table width="600" border="1">';
    
    while(list($xuhao, $chengyuan) = each($value))
    {
        echo '<tr>';
        while(list($shuxinming, $shuzhi) = each($chengyuan))
        {
            echo '<td>'.$shuzhi.'</td>';
        }
        echo '</tr>';
    }
    
    echo '</table>';
}

?>