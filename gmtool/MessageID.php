<?php
/**
 * 消息号
 *
 */
class MessageID
{
	//获取服务器列表
	const MsgID_GetServerList   = 10001;

	//获取服务器在线人数
	const MsgID_GetServerOnline = 10002;

	//获取玩家信息
	const MsgID_GetUserInfo     = 10003;

 //踢玩家下线,封号
	const MsgID_FreeznUser      = 10004;

	 //解除封号
	const MsgID_UnFreeznUser    = 10005;

	 //发送邮件
	const MsgID_SendMail        = 10006;

	// 活动列表
	const MsgID_GetActivities   = 10007;

	 // 配置活动
	const MsgID_SetActivity     = 10008;

	// 启动服务器
	const MsgID_StartServer   = 10009;

	 // 关闭服务器
	const MsgID_StopServer     = 10010;

	 // 更新服务器
	const MsgID_UpdateServer     = 10011;
}

?>
