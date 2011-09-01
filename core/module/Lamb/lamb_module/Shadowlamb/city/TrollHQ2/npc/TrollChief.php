<?php
final class TrollHQ2_TrollChief extends SR_TalkingNPC
{
	public function getNPCPlayerName() { return 'Larry'; }
	public function getNPCLevel() { return 16; }
	public function canNPCMeet(SR_Party $party) { return false; }
	public function getNPCQuests(SR_Player $player) { return array('Troll_Intro', 'Troll_Feed', 'Troll_Support', 'Troll_Forever', 'Troll_Maniac'); }
	public function getNPCModifiers()
	{
		return array(
			'race' => 'troll',
			'strength' => rand(8, 12),
			'quickness' => rand(1, 2),
			'melee' => rand(6, 9),
			'base_hp' => rand(40, 48),
			'distance' => rand(4, 8),
			'nuyen' => rand(100, 200),
		);
	}
	
	public function getNPCEquipment()
	{
		return array(
			'weapon' => 'NinjaSword',
			'armor' => 'KevlarVest',
			'boots' => 'KevlarBoots',
			'helmet' => 'SamuraiMask',
		);
	}
	
	public function onNPCTalk(SR_Player $player, $word, array $args)
	{
		if ($this->onNPCQuestTalk($player, $word))
		{
			return true;
		}
		
		$b = chr(2);
		switch ($word)
		{
			case 'Renraku': return $this->reply('I hate Renraku. They discriment Orks and Trolls.');
			case 'Hello': return $this->reply('Me is Larry. You better have reason for the visiting me.');
			case 'Hire': return $this->reply('You kidding?');
			case 'Blackmarket': return $this->reply('I have better stuff than blackmarket.');
			case 'Cyberware': return $this->reply('Tough trolls not need cyberware.'); 
			default: return $this->reply("What is you want?");
		}		
	}
	
//	public function getNPCLoot(SR_Player $player)
//	{
//		$quest = SR_Quest::getQuest($player, 'Redmond_Orks');
//		if ($quest->isInQuest($player)) {
//			return array('Reginalds_Bracelett');
//		}
//		return array();
//	}
}
?>
