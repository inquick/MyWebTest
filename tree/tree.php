<?php

tree2();

function tree2(){
	$r = array(
		array(
			'id'=>1,
			'name'=>'智慧教育',
			'parent_id'=>0,
			'level'=>0 //一级分类
			),
		array(
			'id'=>2,
			'name'=>'学校列表',
			'parent_id'=>1,
			'level'=>1 //二级分类
			),
		array(
			'id'=>4,
			'name'=>'智慧医疗',
			'parent_id'=>0,
			'level'=>0 //一级分类
			),
		array(
			'id'=>5,
			'name'=>'医院列表',
			'parent_id'=>4,
			'level'=>1 //二级分类
			),
		array(
			'id'=>6,
			'name'=>'名医列表',
			'parent_id'=>5,
			'level'=>2 //三级分类
			)
		);
	//输出为select标签：
	echo '<h1>PHPTree</h1>';
	echo '<select  style="width:300px;">';
	foreach($r as $item){
		echo '<option>';
		//根据所在的层次缩进
		echo str_repeat('|—',$item['level']);
		echo $item['name'];
		echo '</option>';
	}
	echo '</select>';
}

function tree3($pid=0,$level=0){
	$cat = M('category');
	$data = $cat ->where("parentid = $pid") ->field('id,catname,parentid') ->select();

	$level ++;
	if(!empty($data)){
		$tree = array();
		foreach ($data as $val) {
			$val['catname'] = str_repeat('|—', $level-1).$val['catname'];
			$child = $this ->tree2($val[id],$level);
			$tree[] = array('self'=>$val,'child'=>$child,'level'=>$level);
		}
	}
	return $tree;
}

function test(){
	$allcat = tree3(0);
	dump(json_encode($allcat));
}

test();

?>