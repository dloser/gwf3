<?php # :Dog!gizmore@localhost NICK gizmore
$old_user = Dog::setupUser();
$serv = Dog::getServer();
if (false === ($new_user = Dog::getOrCreateUserByName(Dog::argv(0))))
{
	return Dog_Log::critical('Cannot create user!');
}
# Copy channels with privs 
$old_uid = $old_user->getID();
$serv->addUser($new_user);
foreach ($serv->getChannels() as $channel)
{
	$channel instanceof Dog_Channel;
	if (false !== $channel->getUserByID($old_uid))
	{
		$channel->addUser($new_user, $channel->getPriv($old_user));
	}
}
$serv->removeUser($old_user);

if ($old_user->getName() === Dog::getNickname())
{
	if (false !== ($nick = Dog_Nick::getExistingNick($serv, Dog::argv(0))))
	{
		$serv->setNick($nick);
	}
	else
	{
		$serv->setNickName(Dog::argv(0));
	}
}
?>