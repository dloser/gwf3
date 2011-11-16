<?php
final class GWF_HTAccess
{
	################
	### HTACCESS ###
	################
	public static function getHTAccess()
	{
		$custom_hta = GWF_WWW_PATH.'protected/pre_htaccess.txt';
		$custom = Common::isFile($custom_hta) ? (file_get_contents($custom_hta).PHP_EOL) : '';
		
		if ($custom === '')
		{
			$custom = 
				'##################################'.PHP_EOL.
				'### protected/pre_htaccess.txt ###'.PHP_EOL.
				'##################################'.PHP_EOL.
				$custom.PHP_EOL.
				PHP_EOL;
		}
		return
			$custom.
			'#############################'.PHP_EOL.
			'### Generated by GWFv3.00 ###'.PHP_EOL.
			'#############################'.PHP_EOL.
			PHP_EOL.
			'# Secure Limits'.PHP_EOL.
			'<LimitExcept GET HEAD POST>'.PHP_EOL.
			'Deny from all'.PHP_EOL.
			'</LimitExcept>'.PHP_EOL.
			PHP_EOL.
			'# No dot files'.PHP_EOL.
			'RedirectMatch 404 /\..*$'.PHP_EOL.
			PHP_EOL.
			'# Custom error pages'.PHP_EOL.
			'ErrorDocument 403 '.GWF_WEB_ROOT.'index.php?mo=GWF&me=Error&code=403'.PHP_EOL.
			'ErrorDocument 404 '.GWF_WEB_ROOT.'index.php?mo=GWF&me=Error&code=404'.PHP_EOL.
			PHP_EOL.
			'RewriteEngine On'.PHP_EOL.
			PHP_EOL.
			self::getLangRewrites().PHP_EOL.
			PHP_EOL;
			
	}
	
	private static function getLangRewrites()
	{
		$back = '';
		$back .= '############'.PHP_EOL;
		$back .= '### /de/ ###'.PHP_EOL;
		$back .= '############'.PHP_EOL;
		foreach (preg_split('/[;,]+/', GWF_SUPPORTED_LANGS) as $iso)
		{
			if (false !== GWF_Language::getByISO($iso))
			{
				$back .= sprintf('RewriteRule ^%s/(.*) /$1', $iso).PHP_EOL;
			}
		}
		return $back;
	}
	
	###############
	### Protect ###
	###############
	/**
	 * Deny access to a directory via .hatccess
	 * @param string $dir
	 * @return true|false
	 */
	public static function protect($dir)
	{
		$content = 'deny from all'.PHP_EOL;
		return self::protectB($dir, $content);
	}
	
	
	/**
	 * Deny access to a directory via .htaccess and a fake 404 response.
	 * @param string $dir
	 * @return true|false
	 */
	public static function protect404($dir)
	{
		$content = 'RewriteEngine On'.PHP_EOL.'RewriteRule .* /index.php?mo=GWF&me=Error&code=404'.PHP_EOL;
		return self::protectB($dir, $content);
	}
	
	/**
	 * HTA Writer.
	 * @param string $dir
	 * @param string $content
	 */
	private static function protectB($dir, $content)
	{
		$dir = rtrim($dir, "\\/");
		$path = $dir.'/.htaccess';
		
		if (!is_dir($dir))
		{
			GWF_Log::logCritical(sprintf('Supported arg is not a dir in %s.', __METHOD__));
			return false;
		}
		
		if (!is_writable($dir))
		{
			GWF_Log::logCritical(sprintf('Cannot write to directory %s in %s.', $dir, __METHOD__));
			return false;
		}
		
		if (false === file_put_contents($path, $content))
		{
			GWF_Log::logCritical(sprintf('Cannot write to file %s in %s.', $path, __METHOD__));
			return false;
		}
		
		return true;
	}
}
?>