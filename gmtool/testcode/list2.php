<?php
session_start();

if (is_file('config/serverlist.json'))
{
	$fp = fopen('config/serverlist.json', 'r');
	$data = json_decode(fread($fp, filesize('config/serverlist.json')));
	if ($data)
	{
		$ServerList = array();
		for ($i=0; $i<count($data->ServerList); $i++)
		{
			$id = $data->ServerList[$i]->Id;
			// $ServerList[$id] = array();
			$ServerList[$id]["Id"] = $id;
			$ServerList[$id]["Ip"] = $data->ServerList[$i]->Ip;
			$ServerList[$id]["Name"] = $data->ServerList[$i]->Name;
			$ServerList[$id]["Port"] = $data->ServerList[$i]->Port;

			echo '<details>';
			echo '<summary><a id="' . $data->ServerList[$i]->Name . '">' . $data->ServerList[$i]->Name . '</a></summary>';
			echo '<ol id="ol-' . $data->ServerList[$i]->Name . '" style="display: block;">';

			echo '<li class="dd-item"><div class="dd-content"><a href="javascript:void(0)">网关</a></div></li>';
			echo '<li class="dd-item"><div class="dd-content"><a href="javascript:void(0)">中心</a></div></li>';
			echo '<li class="dd-item"><div class="dd-content"><a href="javascript:void(0)">登录</a></div></li>';
			echo '<li class="dd-item"><div class="dd-content"><a href="javascript:void(0)">游戏</a></div></li>';
			echo '<li class="dd-item"><div class="dd-content"><a href="javascript:void(0)">匹配</a></div></li>';
			echo '<li class="dd-item"><div class="dd-content"><a href="javascript:void(0)">战斗</a></div></li>';

			echo '</ol>';
			echo '</details>';
		}
		$_SESSION["ServerList"] = $ServerList;
	}
}

?>
