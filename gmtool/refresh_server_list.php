<?php

include_once 'http-curl.php';
require(__DIR__.DIRECTORY_SEPARATOR.'Toba/Gmtool/Cs/MSGID.php');
require(__DIR__.DIRECTORY_SEPARATOR.'Toba/Gmtool/Cs/MSG_GetServerList_Request.php');
require(__DIR__.DIRECTORY_SEPARATOR.'GPBMetadata/TobaGmtoolCs.php');

session_start();

if (!isset($_SESSION["ServerList"])) {
	LoadJson();
}

RefreshStatus();

RefreshUI();

function RefreshStatus()
{
		$data = new Toba\Gmtool\Cs\MSG_GetServerList_Request();
		$result = http_post($_SESSION['GMToolUrl'] . '?msgId=10001&awardType=0&awardValue=0&awardLv=0&awardNum=0', $data->serializeToString());

		if ($result) {

		}
}

function RefreshUI()
{
	$ServerList = $_SESSION["ServerList"];

	while (list($id, $info) = each($ServerList))
	{
			echo '<details>';
			echo '<summary><a id="' . $info["Name"] . '">' . $info["Name"] . '</a></summary>';
			echo '<ul id="ol-' . $info["Name"] . '" style="display: block;">';
			while(list($ServerName, $ServerInfo) = each($info["Servers"]))
			{
					if ($ServerInfo["Online"]) {
						echo '<div style="color:blue">' . $ServerName . '</div>';
					}else{
						echo '<div style="color:black">' . $ServerName . '</div>';
					}
			}
			echo '</ul>';
			echo '</details>';
	}
}

function LoadJson()
{
	if (is_file('config/serverlist.json'))
	{
		$fp = fopen('config/serverlist.json', 'r');
		$source = fread($fp, filesize('config/serverlist.json'));
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
				$ServerList[$id]["Ip"] = $data->ServerList[$i]->Ip;
				$ServerList[$id]["Name"] = $data->ServerList[$i]->Name;
				$ServerList[$id]["Port"] = $data->ServerList[$i]->Port;
				$ServerList[$id]["Servers"] = array();
				for ($j=0; $j < count($data->ServerList[$i]->Servers); $j++) {
					$ServerList[$id]["Servers"][$data->ServerList[$i]->Servers[$j]->Name]["Name"] = $data->ServerList[$i]->Servers[$j]->Name;
					$ServerList[$id]["Servers"][$data->ServerList[$i]->Servers[$j]->Name]["Type"] = $data->ServerList[$i]->Servers[$j]->Type;
					$ServerList[$id]["Servers"][$data->ServerList[$i]->Servers[$j]->Name]["Online"] = false;
				}
			}
			$_SESSION["ServerList"] = $ServerList;
		}
	}

}
?>
