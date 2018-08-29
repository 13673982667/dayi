<?php
/**
 * Created by PhpStorm.
 * User: 72925
 * Date: 2017/12/20
 * Time: 15:18
 */
    header('content-type:text/html;charset=utf-8');
    //验证数据库连接
    include_once ('conn.php');
    if(!$conn){
        echo "error";
    }
    //接收数据
    $id = 4;
    mysqli_set_charset($conn,'utf8');
    $sql = "select * from article order by  id asc";
    $query= mysqli_query($conn,$sql);
    $arr= mysqli_fetch_all($query);

//    is_array($arr)?null:$arr = array();
    foreach($arr as $key => $link)
    {
        foreach($link as $key1 => $val)
        {
            echo $key1.'=>'.$val." ";
        }
        echo "<br/>";
    }
//    $data = array();
//    while( $res= mysqli_fetch_assoc($query)){
//        $data[] = $res;
//};
//        echo "<pre>";
//        var_dump($arr);
//        echo "</pre>";


//    if($res)



//*************************************测试*************************************//

//$arr = array(  '1'=>array('name'=>'张三','year'=>'12','sex'=>'男'),
//    '2'=>array('name'=>'李四','year'=>'12','sex'=>'男'),
//    '3'=>array('name'=>'王五','year'=>'13','sex'=>'女')
//);
//foreach($arr as $key => $link)
//{
//    foreach($link as $key1 => $val)
//    {
//        echo $val." ";
//    }
//    echo "<br/>";
//}

?>