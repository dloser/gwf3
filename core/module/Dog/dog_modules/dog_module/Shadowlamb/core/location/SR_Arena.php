<?php
abstract class SR_Arena extends SR_Store
{
	public function getAbstractClassName() { return __CLASS__; }
	
	public function getStoreItems(SR_Player $player) { return array(); }

	/**
	 * Get available enemies. Array of array(bit, name, text, nuyen).
	 * @param SR_Player $player
	 * @return array 
	 */
	public function getArenaEnemies(SR_Player $player) { return array(); }
	
	public function getCommands(SR_Player $player) { return array('challenge'); }
	
	public function getArenaKey(SR_Player $player)
	{
		return '__ARENA_'.$this->getName();
	}
	
	public function on_challenge(SR_Player $player, array $args)
	{
		$enemies = $this->getArenaEnemies($player);
		if (count($enemies) === 0)
		{
			$player->msg('1098'); # There is currently no enemy available.
			return false;
		}
		
		if ($player->isInParty())
		{
			$player->msg('1099'); # You cannot do this when you are in a party.
			return false;
		}
		
		$key = $this->getArenaKey($player);
		$bits = SR_PlayerVar::getVal($player, $key, 0);
		
		foreach ($enemies as $data)
		{
			list($bit, $name, $text, $nuyen) = $data;
			if (($bits & $bit)===0)
			{
				return $this->onChallengeB($player, $bit, $name, $text, $nuyen);
			}
		}
		
		$player->msg('1098'); # You have defeated every enemy in this location.
		return false;
	}
	
	private function onChallengeB(SR_Player $player, $bit, $name, $text, $nuyen)
	{
		$party = $player->getParty();
		if (false === ($ep = SR_NPC::createEnemyParty($name)))
		{
			$player->message('Database error!');
			return false;
		}
		$player->msg('5141', array($text));
// 		$player->message(sprintf('You are guided into the arena and see your enemy: %s', $text));
		
		$e = $ep->getLeader();
		$e->setArenaKey($this->getArenaKey($player), $bit);
		$e->setArenaNuyen($nuyen);
		$ep->fight($party);
		return true;
	}
}
?>