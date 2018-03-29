<?php

include_once('ServerType.php');

session_start();

if (!isset($_SESSION["ServerList"])) {
	LoadJson();
}

$ServerList = $_SESSION["ServerList"];
// var_dump($ServerList);
while (list($id, $info) = each($ServerList))
{
	$selected = false;
		if (isset($_SESSION['SelectedServer']['Id']) && $_SESSION['SelectedServer']['Id'] == $id) {
			echo '<details open>';
			echo '<summary><a server_id="'. $id . '" style="background-color:Darkorange" onclick="SelectServer(this)">' . $info["Name"] . '</a></summary>';
			$selected = true;
		} else {
			echo '<details>';
			echo '<summary><a server_id="'. $id . '" onclick="SelectServer(this)">' . $info["Name"] . '</a></summary>';
		}
		echo '<ul id="ol-' . $info["Name"] . '" style="display: block">';
		// var_dump(' 服务器id' . $id . '  选中的服务器id' . $_SESSION['SelectedServer']['Id']);
		while(list($ServerName, $ServerInfo) = each($info["Servers"]))
		{
			// var_dump($ServerInfo["Online"]);
			$onlineCnt = '';
			if ($selected && $ServerInfo["Type"] == ServerType::ServerType_World) {
				$onlineCnt = '(' . $ServerInfo["OnlineCnt"] . ')';
			}
			if ($selected && isset($_SESSION['SelectedServer']['Name']) && $_SESSION['SelectedServer']['Name'] == $ServerName) {
				if ($ServerInfo["Online"]) {
						echo '<div><a server_id="'. $id . '" server_name="' . $ServerName . '" style="color:blue; background-color:Darkorange" onclick="SelectSubServer(this)">' . $ServerName . $onlineCnt . '</a></div>';
				}else{
					echo '<div><a server_id="'. $id . '" server_name="' . $ServerName . '" style="color:black; background-color:Darkorange" onclick="SelectSubServer(this)">' . $ServerName . '</a></div>';
				}
			} else {
				if ($ServerInfo["Online"]) {
						echo '<div><a server_id="'. $id . '" server_name="' . $ServerName . '" style="color:blue" onclick="SelectSubServer(this)">' . $ServerName . $onlineCnt . '</a></div>';
				}else{
					echo '<div><a server_id="'. $id . '" server_name="' . $ServerName . '" style="color:black" onclick="SelectSubServer(this)">' . $ServerName . '</a></div>';
				}
			}
		}
		echo '</ul>';
		echo '</details>';

		// var_dump($_SESSION["ServerList"]);
}

function LoadJson()
{
	$path = '../../GMTool/serverlist.json';
	if (is_file($path))
	{
		$fp = fopen($path, 'r');
		$source = fread($fp, filesize($path));
		$data = json_decode($source);
		fclose($fp);
		if ($data)
		{
			$ServerList = array();
			for ($i=0; $i<count($data->ServerList); $i++)
			{
				$id = $data->ServerList[$i]->Id;
				// $ServerList[$id] = array();
				$ServerList[$id]["Id"] = $id;
				$ServerList[$id]["Url"] = $data->ServerList[$i]->Url;
				$ServerList[$id]["Name"] = $data->ServerList[$i]->Name;
				$ServerList[$id]["Servers"] = array();
				for ($j=0; $j < count($data->ServerList[$i]->Servers); $j++) {
					$name = $data->ServerList[$i]->Servers[$j]->Name;
					$ServerList[$id]["Servers"][$name]["Name"] = $name;
					$ServerList[$id]["Servers"][$name]["Type"] = $data->ServerList[$i]->Servers[$j]->Type;
					$ServerList[$id]["Servers"][$name]["Online"] = false;
					if ($ServerList[$id]["Servers"][$name]["Type"] == ServerType::ServerType_World) {
						$ServerList[$id]["Servers"][$name]["OnlineCnt"] = 0;
					}
				}
			}
			$_SESSION["ServerList"] = $ServerList;
		}
	}

	// 测试代码
	$_SESSION['SelectedServer'] = array();
}
?>
