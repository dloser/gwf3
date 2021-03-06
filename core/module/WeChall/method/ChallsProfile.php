<?php
final class WeChall_ChallsProfile extends GWF_Method
{
	const DEFAULT_BY = 'chall_score';
	const DEFAULT_DIR = 'ASC';
	
	public function execute()
	{
		return $this->templateChalls($user);
	}
	
	public function templateChalls(GWF_User $user)
	{
		$whitelist = array('chall_score','chall_title','chall_creator_name','chall_solvecount','chall_date','chall_dif','chall_edu','chall_fun','csolve_date', 'csolve_time_taken');
		
		require_once GWF_CORE_PATH.'module/WeChall/WC_ChallSolved.php';
		$challs = GDO::table('WC_Challenge');
		
		$db = gdo_db();
		$uid = $user->getVar('user_id');
		$challs = GWF_TABLE_PREFIX.'wc_chall';
		$solved = GWF_TABLE_PREFIX.'wc_chall_solved';
		
		$by = GDO::getWhitelistedByS(Common::getGet('pcby'), $whitelist, self::DEFAULT_BY);
		$dir = GDO::getWhitelistedDirS(Common::getGet('pcdir'), self::DEFAULT_DIR);
		$orderby = "ORDER BY $by $dir";
		
		$query = "SELECT c.*, s.* FROM $challs c LEFT JOIN $solved s ON c.chall_id=s.csolve_cid AND s.csolve_uid=$uid $orderby";
		
		$tVars = array(
			'data' => $db->queryAll($query),
			'sort_url' => GWF_WEB_ROOT.'index.php?mo=Profile&me=Profile&username='.$user->urlencode('user_name').'&pcby=%BY%&pcdir=%DIR%#wc_profile_challenges',
			'table_title' => $this->module->lang('tt_challs_for', array('', $user->display('user_name'))),
		);
		return $this->module->templatePHP('challs_profile.php', $tVars);
	}
}
?>