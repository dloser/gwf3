<?php
/**
 * @author gizmore
 * @author spaceone
 * @author noother
 * @see https://github.com/noother/Nimda3/blob/master/plugins/user/Plugin_Translate.php
 */
class DOGMOD_Translate extends Dog_Module
{
	private static $LANGUAGES = array(
		'af', 'ar', 'az', 'be', 'bg', 'bn', 'ca', 'cs', 'cy', 'da', 'de', 'el', 'en', 'es',
		'et', 'eu', 'fa', 'fi', 'fr', 'ga', 'gl', 'gu', 'hi', 'hr', 'ht', 'hu', 'hy', 'id',
		'is', 'it', 'iw', 'ja', 'ka', 'kn', 'ko', 'la', 'lt', 'lv', 'mk', 'ms', 'mt', 'nl',
		'no', 'pl', 'pt', 'ro', 'ru', 'sk', 'sl', 'sq', 'sr', 'sv', 'sw', 'ta', 'te', 'th',
		'tl', 'tr', 'uk', 'ur', 'vi', 'yi'
	);
	public static function hasLanguage($iso) { return in_array($iso, self::$LANGUAGES, true); }

	public function event_privmsg()
	{
		$msg = $this->msg();
		if (Dog::isTriggered())
		{
			if (preg_match('/^([a-z]{2})-([a-z]{2})$/', substr($msg, 1, 5), $l))
			{
				if (!self::hasLanguage($l[1]))
				{
					$this->rply('err_src');
				}
				elseif (!self::hasLanguage($l[2]))
				{
					$this->rply('err_dst');
				}
				else
				{
					self::translate($l[1], $l[2], substr($msg, 6));
				}
			}
		}
	}
	
	public function on_translate_Pb()
	{
		$msg = $this->msgarg();
		if ($msg === '')
		{
			$this->showHelp('translate');
		}
		else
		{
			$this->translate('auto', self::getAutoTargetISO(), $msg);
		}
	}
	
	private static function getAutoTargetISO()
	{
		if (false !== ($channel = Dog::getChannel()))
		{
			return $channel->getLangISO();
		}
		else
		{
			return Dog::getUser()->getLangISO();
		}
	}
	
	private function translate($sl, $tl, $message)
	{
		if (false === ($translation = self::googleTranslate($message, $sl, $tl, $sl=='auto')))
		{
			$this->rply('weird');
		}
		elseif ($sl === 'auto')
		{
			$this->rply('trans_auto', array($translation['source_lang'], $translation['translation']));
		}
		else
		{
			$this->rply('trans', array($translation));
		}
	}

	private static function googleTranslate($text, $from='auto', $to='de', $return_source_lang=false)
	{
		$url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=$from&tl=$to&dt=t&q=" . urlencode($text);
		
		$html = GWF_HTTP::getFromURL($url);

		$result = json_decode($html, true);
		
		if (!($translation = $result[0][0][0]))
		{
			echo "GTranslate failed: $url\n";
			echo $translation . "\n";
			echo $html . "\n";
			return false;
		}
		
		if(!$return_source_lang)
		{
			return $translation;
		}

		return array('translation' => $translation, 'source_lang' => $result[2]);
	}
}
?>
