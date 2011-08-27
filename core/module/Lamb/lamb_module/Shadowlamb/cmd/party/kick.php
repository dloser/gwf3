<?php
final class Shadowcmd_kick extends Shadowcmd
{
	public static function execute(SR_Player $player, array $args)
	{
		$bot = Shadowrap::instance($player);
		
		if (count($args) !== 1) {
			$bot->reply(Shadowhelp::getHelp($player, 'kick'));
			return false;
		}
		
		$p = $player->getParty();
		if (false === ($target = Shadowfunc::getFriendlyTarget($player, $args[0]))) {
			$bot->reply('This player is not in your party.');
			return false;
		}
		
		if ($target->getID() === $player->getID()) {
			$bot->reply('You can not kick yourself.');
			return false;
		}
		
		$p->notice(sprintf('%s has been kicked off the party.', $target->getName()));
		
		$p->kickUser($target, true);
		$np = SR_Party::createParty();
		$np->cloneAction($p);
		$np->clonePreviousAction($p);
		$np->addUser($target, true);
		if (!$np->isIdle())
		{
			$np->popAction(true);
		}
		return true;
		
	}
}
?>
