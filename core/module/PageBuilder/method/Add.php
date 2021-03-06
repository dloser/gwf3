<?php
/**
 * Add a new page to the page builder pages.
 * @author gizmore
 */
final class PageBuilder_Add extends GWF_Method
{
	public function getPageMenuLinks()
	{
		return array(
			array(
				'page_url' => 'index.php?mo=PageBuilder&me=Add',
				'page_title' => 'Add Page',
				'page_meta_desc' => 'Add a new page with the PageBuilder',
			),
		);
	}
	
	/**
	 * @var GWF_User
	 */
	private $user;
	private $is_author = false;
	private $locked_mode = false;
	
	public function execute()
	{
		$this->user = GWF_User::getStaticOrGuest();
		if (false === ($this->is_author = $this->module->isAuthor($this->user)))
		{
			if (false === $this->module->cfgLockedPosting())
			{
				return GWF_HTML::err('ERR_NO_PERMISSION');
			}
			else
			{
				$this->locked_mode = true;
			}
		}
		
		if (isset($_POST['preview']))
		{
			return $this->onPreview().$this->templateAdd();
		}
		elseif (isset($_POST['add']))
		{
			return $this->onAdd();
		}
		elseif (isset($_POST['upload']))
		{
			require_once GWF_CORE_PATH.'module/PageBuilder/PB_Uploader.php';
			return PB_Uploader::onUpload($this->module).$this->templateAdd();
		}
		
		return $this->templateAdd();
	}
	
	private function formAdd()
	{
		$mod_cat = GWF_Module::loadModuleDB('Category', true, true);
		
		$data = array();
		$data['url'] = array(GWF_Form::STRING, '', $this->module->lang('th_url'));
		$data['type'] = array(GWF_Form::SELECT, GWF_PageType::select($this->module), $this->module->lang('th_type'));
		$data['lang'] = array(GWF_Form::SELECT, GWF_LangSelect::single(1, 'lang'), $this->module->lang('th_lang'));
		$data['groups'] = array(GWF_Form::SELECT_A, GWF_GroupSelect::multi('groups', true, true, true), $this->module->lang('th_groups'));
		$data['noguests'] = array(GWF_Form::CHECKBOX, false, $this->module->lang('th_noguests'));
		if ($this->is_author)
		{
			$data['index'] = array(GWF_Form::CHECKBOX, true, $this->module->lang('th_index'));
			$data['follow'] = array(GWF_Form::CHECKBOX, true, $this->module->lang('th_follow'));
			$data['sitemap'] = array(GWF_Form::CHECKBOX, false, $this->module->lang('th_in_sitemap'));
		}
		$data['title'] = array(GWF_Form::STRING, '', $this->module->lang('th_title'));
		if ($mod_cat !== false)
		{
			$data['cat'] = array(GWF_Form::SELECT, GWF_CategorySelect::single('cat', Common::getPostString('cat')), $this->module->lang('th_cat'));
		}
		$data['descr'] = array(GWF_Form::STRING, '', $this->module->lang('th_descr'));
		$data['tags'] = array(GWF_Form::STRING, '', $this->module->lang('th_tags'));
		$data['show_author'] = array(GWF_Form::CHECKBOX, true, $this->module->lang('th_show_author'));
		$data['show_similar'] = array(GWF_Form::CHECKBOX, true, $this->module->lang('th_show_similar'));
		$data['show_modified'] = array(GWF_Form::CHECKBOX, true, $this->module->lang('th_show_modified'));
		$data['show_trans'] = array(GWF_Form::CHECKBOX, true, $this->module->lang('th_show_trans'));
		$data['show_comments'] = array(GWF_Form::CHECKBOX, true, $this->module->lang('th_show_comments'));
		if ($this->is_author)
		{
			$data['home_page'] = array(GWF_Form::CHECKBOX, false, $this->module->lang('th_home_page'));
		}
		$data['file'] = array(GWF_Form::FILE_OPT, '', $this->module->lang('th_file'));
		$data['upload'] = array(GWF_Form::SUBMIT, $this->module->lang('btn_upload'));
		if ($this->is_author)
		{
			$data['inline_css'] = array(GWF_Form::MESSAGE_NOBB, '', $this->module->lang('th_inline_css'));
		}
		$data['content'] = array(GWF_Form::MESSAGE_NOBB, '', $this->module->lang('th_content'));
		$buttons = array(
			'preview' => $this->module->lang('btn_preview'),
			'add' => $this->module->lang('btn_add'),
		);
		$data['buttons'] = array(GWF_Form::SUBMITS, $buttons);
		return new GWF_Form($this, $data);
	}
	
	private function templateAdd()
	{
		$form = $this->formAdd();
		$tVars = array(
			'form' => $form->templateY($this->module->lang('ft_add')),
		);
		return $this->module->template('add.tpl', $tVars);
	}
	
	public function validate_title($m, $arg) { return GWF_Validator::validateString($m, 'title', $arg, 4, 255, false); }
	public function validate_descr($m, $arg) { return GWF_Validator::validateString($m, 'descr', $arg, 4, 255, false); }
	public function validate_tags($m, $arg) { return GWF_Validator::validateString($m, 'tags', $arg, 4, 255, false); }
	public function validate_content($m, $arg) { return GWF_Validator::validateString($m, 'content', $arg, 4, 65536, false); }
	public function validate_inline_css($m, $arg) { return false; }
	public function validate_url(Module_PageBuilder $m, $arg) { return $m->validateURL($arg, false); }
	public function validate_lang($m, $arg) { return GWF_LangSelect::validate_langid($arg, false); }
	public function validate_type($m, $arg) { return GWF_PageType::validateType($m, $arg, $this->locked_mode); }
	public function validate_cat($m, $arg) { return GWF_CategorySelect::validateCat($arg, true); }
	public function validate_groups($m, $arg)
	{
		if ($arg === false)
		{
			return false;
		}
		if (!is_array($arg))
		{
			return $m->lang('err_groups');
		}
		foreach ($arg as $gid)
		{
			if (!$this->user->isInGroupID($gid))
			{
				return $m->lang('err_groups');
			}
		}
		return false;
	}
	
	private function getPageObject(GWF_Form $form)
	{
		$options = 0;
		$options |= GWF_Page::ENABLED;
		$options |= isset($_POST['noguests']) ? GWF_Page::LOGIN_REQUIRED : 0;
		$options |= isset($_POST['show_author']) ? GWF_Page::SHOW_AUTHOR : 0;
		$options |= isset($_POST['show_similar']) ? GWF_Page::SHOW_SIMILAR : 0;
		$options |= isset($_POST['show_modified']) ? GWF_Page::SHOW_MODIFIED : 0;
		$options |= isset($_POST['show_trans']) ? GWF_Page::SHOW_TRANS : 0;
		$options |= isset($_POST['show_comments']) ? GWF_Page::COMMENTS : 0;
		if ($this->is_author)
		{
			$options |= isset($_POST['index']) ? GWF_Page::INDEXED : 0;
			$options |= isset($_POST['follow']) ? GWF_Page::FOLLOW : 0;
			$options |= isset($_POST['sitemap']) ? GWF_Page::IN_SITEMAP : 0;
		}
		$options |= $this->locked_mode ? GWF_Page::LOCKED : 0;
		$options |= $form->getVar('type');
		
		$gstring = $this->buildGroupString();
		$tags = ','.trim($form->getVar('tags'), ' ,').',';
		
		$page = new GWF_Page(array(
			'page_id' => '0',
			'page_otherid' => '0',
			'page_lang' => $form->getVar('lang'),
			'page_author' => GWF_Session::getUserID(),
			'page_author_name' => GWF_User::getStaticOrGuest()->getVar('user_name'),
			'page_groups' => $gstring,
			'page_create_date' => GWF_Time::getDate(GWF_Time::LEN_SECOND),
			'page_date' => GWF_Time::getDate(GWF_Time::LEN_SECOND),
			'page_time' => time(),
			'page_url' => $form->getVar('url'),
			'page_title' => $form->getVar('title'),
			'page_cat' => '0',
			'page_meta_tags' => $tags,
			'page_meta_desc' => $form->getVar('descr'),
			'page_content' => $form->getVar('content'),
			'page_views' => '0',
			'page_options' => $options,
			'page_inline_css' => $form->getVar('inline_css', NULL),
		));
		
		return $page;
	}
	
	private function onAdd()
	{
		$form = $this->formAdd();
		if (false !== ($error = $form->validate($this->module)))
		{
			return $error.$this->templateAdd();
		}
		
		$page = $this->getPageObject($form);
		
		$gstring = $page->getVar('page_groups');
		$tags = $page->getVar('page_meta_tags');
		
		if (false === $page->insert())
		{
			return GWF_HTML::err('ERR_DATABASE', array(__FILE__,__LINE__));
		}
		
		if (false === $page->saveVars(array('page_otherid'=>$page->getID())))
		{
			return GWF_HTML::err('ERR_DATABASE', array(__FILE__,__LINE__));
		}
		
		if (false === GWF_PageGID::updateGIDs($page, Common::getPostArray('groups', array())))
		{
			return GWF_HTML::err('ERR_DATABASE', array(__FILE__,__LINE__));
		}
		
		if (false === GWF_PageTags::updateTags($page, $tags, $form->getVar('lang')))
		{
			return GWF_HTML::err('ERR_DATABASE', array(__FILE__,__LINE__));
		}

		if (isset($_POST['home_page']) && $this->is_author)
		{
			$this->module->setHomePage($page->getID());
		}

		if (false === $this->module->writeHTA())
		{
			return GWF_HTML::err('ERR_GENERAL', array(__FILE__,__LINE__));
		}
		
		if ($this->locked_mode)
		{
			$this->module->sendModMails($page);
		}
		else
		{
			GWF_PageHistory::push($page);
		}
		
		return $this->locked_mode
			? $this->module->message('msg_added_locked')
			: $this->module->message('msg_added', array(GWF_WEB_ROOT.$page->getVar('page_url'), $page->getVar('page_title')));
	}

	private function buildGroupString()
	{
		if (!isset($_POST['groups']))
		{
			return '';
		}
		$back = '';
		foreach ($_POST['groups'] as $gid)
		{
			if ($gid > 0)
			{
				$back .= ','.$gid;
			}
		}
		return $back === '' ? $back : substr($back, 1);
	}
	
	###############
	### Preview ###
	###############
	private function onPreview()
	{
		$form = $this->formAdd();
		if (false !== ($error = $form->validate($this->module)))
		{
			return $error;
		}
		
		$page = $this->getPageObject($form);
		
		$page->setOption(GWF_Page::COMMENTS, false);
		
		if (false === ($method = $this->module->getMethod('Show')))
		{
			return GWF_HTML::err('ERR_GENERAL', array(__FILE__, __LINE__));
		}
		
		$method instanceof PageBuilder_Show;
		return $method->showPage($page);
	}
}
?>
