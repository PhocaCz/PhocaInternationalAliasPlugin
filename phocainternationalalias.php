<?php
/**
 * @version		$Id:output.php 6961 2007-03-15 16:06:53Z tcp $
 * @package		Joomla.Framework
 * @subpackage	Filter
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @copyright	Copyright (C) 2008 Protos Extensions
 * @copyright	Copyright (C) 2008 Phoca ( www.phoca.cz ) 
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */
 
/**
 * JFilterOutput
 *
 * @static
 * @package 	Joomla.Framework
 * @subpackage	Filter
 * @since		1.5
 */
 
class JFilterOutput
{
	/**
	* Makes an object safe to display in forms
	*
	* Object parameters that are non-string, array, object or start with underscore
	* will be converted
	*
	* @static
	* @param object An object to be parsed
	* @param int The optional quote style for the htmlspecialchars function
	* @param string|array An optional single field name or array of field names not
	*					 to be parsed (eg, for a textarea)
	* @since 1.5
	*/
	
	function objectHTMLSafe( &$mixed, $quote_style=ENT_QUOTES, $exclude_keys='' )
	{
		if (is_object( $mixed ))
		{
			foreach (get_object_vars( $mixed ) as $k => $v)
			{
				if (is_array( $v ) || is_object( $v ) || $v == NULL || substr( $k, 1, 1 ) == '_' ) {
					continue;
				}

				if (is_string( $exclude_keys ) && $k == $exclude_keys) {
					continue;
				} else if (is_array( $exclude_keys ) && in_array( $k, $exclude_keys )) {
					continue;
				}

				$mixed->$k = htmlspecialchars( $v, $quote_style, 'UTF-8' );
			}
		}
	}

	/**
	 * This method processes a string and replaces all instances of & with &amp; in links only
	 *
	 * @static
	 * @param	string	$input	String to process
	 * @return	string	Processed string
	 * @since	1.5
	 */
	function linkXHTMLSafe($input)
	{
		$regex = 'href="([^"]*(&(amp;){0})[^"]*)*?"';
		return preg_replace_callback( "#$regex#i", array('JFilterOutput', '_ampReplaceCallback'), $input );
	}

	/**
	 * This method processes a string and replaces all accented UTF-8 characters by unaccented
	 * ASCII-7 "equivalents", whitespaces are replaced by hyphens and the string is lowercased.
	 *
	 * @static
	 * @param	string	$input	String to process
	 * @return	string	Processed string
	 * @since	1.5
	 */
	function stringURLSafe($string)
	{
	
		
		
	/**
    * Jan: the czech version use the same code as bulgarian from Ivo but with different characters	
	* iapostolov: Now let's start overwriting the core class for alias replacing
	* Joomla! 1.5 checks if a class is already loaded so we can load the whole class and overwrite it :)
	*/
		
	//	jimport('joomla.plugin.helper');
		$plugin = JPluginHelper::getPlugin('system','phocainternationalalias');
		
		$paramsP	= new JParameter( $plugin->params );
		$hrLang		= $paramsP->get( 'croatian-lang',1);
		$czLang		= $paramsP->get( 'czech-lang',1);
		$grLang		= $paramsP->get( 'greek-lang',1);
		$huLang		= $paramsP->get( 'hungarian-lang',1);
		$plLang		= $paramsP->get( 'polish-lang',1);
		$ruLang		= $paramsP->get( 'russian-lang',1);
		$skLang		= $paramsP->get( 'slovak-lang',1);
		$slLang		= $paramsP->get( 'slovenian-lang',1);
		$ltLang		= $paramsP->get( 'lithuanian-lang',1);
		$isLang		= $paramsP->get( 'icelandic-lang',1);
		$tuLang		= $paramsP->get( 'turkish-lang',1);
		$langFrom	= array();
		$langTo		= array();
		
		
		// CZECH
		if ($czLang == 1) {
			$czLangFrom 	= array('á','č','ď','é','ě','í','ň','ó','ř','š','ť','ú','ů','ý','ž','Á','Č','Ď','É','Ě','Í','Ň','Ó','Ř','Š','Ť','Ú','Ů','Ý','Ž');
			$czLangTo 		= array('a','c','d','e','e','i','n','o','r','s','t','u','u','y','z','a','c','d','e','e','i','ň','o','r','s','t','u','u','y','z');
			$langFrom		= $czLangFrom;
			$langTo			= $czLangTo;
		}
		
		// CROATIAN
		if ($hrLang == 1) {
			$hrLangFrom 	= array('č','ć','đ','š','ž','Č','Ć','Đ','Š','Ž');
			$hrLangTo 		= array('c','c','d','s','z','c','c','d','s','z');
			$langFrom		= array_merge ($langFrom, $hrLangFrom);
			$langTo			=  array_merge ($langTo, $hrLangTo);
		}
		
		// GREEK
		if ($grLang == 1) {
			$grLangFrom = array('α', 'β', 'γ', 'δ', 'ε', 'ζ', 'η', 'θ',  'η', 'ι', 'κ', 'λ', 'μ', 'ν', 'ξ',  'ο', 'π', 'ρ', 'σ', 'τ', 'υ', 'φ', 'χ', 'ψ',  'ω', 'Α', 'Β', 'Γ', 'Δ', 'Ε', 'Ζ', 'Η', 'Θ',  'Ι', 'Κ', 'Λ', 'Μ', 'Ν', 'Ξ',  'Ο', 'Π', 'Ρ', 'Σ', 'Τ', 'Υ', 'Φ', 'Χ', 'Ψ',  'Ω', 'Ά', 'Έ', 'Ή', 'Ί', 'Ύ', 'Ό', 'Ώ', 'ά', 'έ', 'ή', 'ί', 'ύ', 'ό', 'ώ', 'ΰ', 'ΐ', 'ϋ', 'ϊ', 'ς', '«', '»' );
			$grLangTo   = array('a', 'b', 'g', 'd', 'e', 'z', 'h', 'th', 'i', 'i', 'k', 'l', 'm', 'n', 'ks', 'o', 'p', 'r', 's', 't', 'u', 'f', 'x', 'ps', 'o', 'A', 'B', 'G', 'D', 'E', 'Z', 'I', 'Th', 'I', 'K', 'L', 'M', 'N', 'Ks', 'O', 'P', 'R', 'S', 'T', 'Y', 'F', 'X', 'Ps', 'O', 'A', 'E', 'I', 'I', 'U', 'O', 'O', 'a', 'e', 'i', 'i', 'u', 'o', 'o', 'u', 'i', 'u', 'i', 's', '_', '_' );
			$langFrom      = array_merge ($langFrom, $grLangFrom);
			$langTo         =  array_merge ($langTo, $grLangTo);
		}
		
		// HUNGARIAN
		if ($huLang == 1) {
			$huLangFrom 	= array('á','é','ë','í','ó','ö','ő','ú','ü','ű','Á','É','Ë','Í','Ó','Ö','Ő','Ú','Ü','Ű');
			$huLangTo 		= array('a','e','e','i','o','o','o','u','u','u','a','e','e','i','o','o','o','u','u','u');
			$langFrom		= array_merge ($langFrom, $huLangFrom);
			$langTo			=  array_merge ($langTo, $huLangTo);
		}
		
		// POLISH
		if ($plLang == 1) {
			$plLangFrom 	= array('ą','ć','ę','ł','ń','ó','ś','ź','ż','Ą','Ć','Ę','Ł','Ń','Ó','Ś','Ź','Ż');
			$plLangTo 		= array('a','c','e','l','n','o','s','z','z','a','c','e','l','n','o','s','z','z');
			$langFrom		= array_merge ($langFrom, $plLangFrom);
			$langTo			= array_merge ($langTo, $plLangTo);
		}
		
		// RUSSIAN
		if ($ruLang == 1) {
			$ruLangFrom 	= array('А', 'а', 'Б', 'б', 'В', 'в', 'Г', 'г', 'Д', 'д', 'Е', 'е', 'Ё', 'ё', 'Ж', 'ж', 'З', 'з', 'И', 'и', 'Й', 'й', 'К', 'к', 'Л', 'л', 'М', 'м', 'Н', 'н', 'О', 'о', 'П', 'п', 'Р', 'р', 'С', 'с', 'Т', 'т', 'У', 'у', 'Ф', 'ф', 'Х', 'х', 'Ц', 'ц', 'Ч', 'ч', 'Ш', 'ш', 'Щ', 'щ', 'Ъ', 'ъ', 'Ы', 'ы', 'Ь', 'ь', 'Э', 'э', 'Ю', 'ю', 'Я', 'я');
			$ruLangTo 		= array('A', 'a', 'B', 'b', 'V', 'v', 'G', 'g', 'D', 'd', 'E', 'e', 'Jo', 'jo', 'Zh', 'zh', 'Z', 'z', 'I', 'i', 'J', 'j', 'K', 'k', 'L', 'l', 'M', 'm', 'N', 'n', 'O', 'o', 'P', 'p', 'R', 'r', 'S', 's', 'T', 't', 'U', 'u', 'F', 'f', 'H', 'h', 'C', 'c', 'Ch', 'ch', 'Sh', 'sh', 'Shh', 'shh', '', '', 'Y', 'y', '', '', 'Je', 'je', 'Ju', 'ju', 'Ja', 'ja');
			$langFrom		= array_merge ($langFrom, $ruLangFrom);
			$langTo			= array_merge ($langTo, $ruLangTo);
		}
		
		// SLOVAK
		if ($skLang == 1) {
			$skLangFrom 	= array('á','ä','č','ď','é','í','ľ','ĺ','ň','ó','ô','ŕ','š','ť','ú','ý','ž','Á','Ä','Č','Ď','É','Í','Ľ','Ĺ','Ň','Ó','Ô','Ŕ','Š','Ť','Ú','Ý','Ž');
			$skLangTo 		= array('a','a','c','d','e','i','l','l','n','o','o','r','s','t','u','y','z','a','a','c','d','e','i','l','l','n','o','o','r','s','t','u','y','z');
			$langFrom		= array_merge ($langFrom, $skLangFrom);
			$langTo			=  array_merge ($langTo, $skLangTo);
		}
		
		// SLOVENIAN
		if ($slLang == 1) {
			$slLangFrom 	= array('č','š','ž','Č','Š','Ž');
			$slLangTo 		= array('c','s','z','c','s','z');
			$langFrom		= array_merge ($langFrom, $slLangFrom);
			$langTo			= array_merge ($langTo, $slLangTo);
		}
		
		// LITHUANIAN
		if ($ltLang == 1) {
			$ltLangFrom 	= array('ą','č','ę','ė','į','š','ų','ū','ž','Ą','Č','Ę','Ė','Į','Š','Ų','Ū','Ž');
			$ltLangTo 		= array('a','c','e','e','i','s','u','u','z','A','C','E','E','I','S','U','U','Z');
			$langFrom       = array_merge ($langFrom, $ltLangFrom);
            $langTo         = array_merge ($langTo, $ltLangTo);
		}
		
		// ICELANDIC		
		if ($isLang == 1) {
			$isLangFrom 	= array('þ', 'æ', 'ð', 'ö', 'í', 'ó', 'é', 'á', 'ý', 'ú', 'Þ', 'Æ', 'Ð', 'Ö', 'Í', 'Ó', 'É', 'Á', 'Ý', 'Ú');
			$isLangTo 		= array('th','ae','d', 'o', 'i', 'o', 'e', 'a', 'y', 'u', 'Th','Ae','D', 'O', 'I', 'O', 'E', 'A', 'Y', 'U');
			$langFrom       = array_merge ($langFrom, $isLangFrom);
            $langTo         = array_merge ($langTo, $isLangTo);
		}
		
		// TURKISH
		if ($tuLang == 1) {
			$tuLangFrom 	= array('ş','ı','ö','ü','ğ','ç','Ş','İ','Ö','Ü','Ğ','Ç');
			$tuLangTo 		= array('s','i','o','u','g','c','S','I','O','U','G','C');
			$langFrom		= array_merge ($langFrom, $tuLangFrom);
			$langTo			=  array_merge ($langTo, $tuLangTo);
		}


		// GERMAN - because of german names used in Czech, Hungarian, Polish or Slovak (because of possible
		// match - e.g. German ä => ae, but Slovak ä => a ... we can use only one, so we use:
		// a not ae, u not ue, o not oe, ß will be ss
		
		$deLangFrom 	= array('ä','ö','ü','ß','Ä','Ö','Ü');
		$deLangTo 		= array('a','o','u','ss','a','o','u');
		//$deLangTo 		= array('ae','oe','ue','ss','ae','oe','ue');
		
		$langFrom		= array_merge ($langFrom, $deLangFrom);
		$langTo			=  array_merge ($langTo, $deLangTo);

				
		$string = JString::strtolower($string);
        $string = JString::str_ireplace($langFrom, $langTo, $string);
		
		//remove any '-' from the string they will be used as concatonater
		$str = str_replace('-', ' ', $string);

		$lang =& JFactory::getLanguage();
		$str = $lang->transliterate($str);

		// remove any duplicate whitespace, and ensure all characters are alphanumeric
		$str = preg_replace(array('/\s+/','/[^A-Za-z0-9\-]/'), array('-',''), $str);

		// lowercase and trim
		$str = trim(strtolower($str));
		return $str;
	}

	/**
	* Replaces &amp; with & for xhtml compliance
	*
	* @todo There must be a better way???
	*
	* @static
	* @since 1.5
	*/
	function ampReplace( $text )
	{
		$text = str_replace( '&&', '*--*', $text );
		$text = str_replace( '&#', '*-*', $text );
		$text = str_replace( '&amp;', '&', $text );
		$text = preg_replace( '|&(?![\w]+;)|', '&amp;', $text );
		$text = str_replace( '*-*', '&#', $text );
		$text = str_replace( '*--*', '&&', $text );

		return $text;
	}

	/**
	 * Callback method for replacing & with &amp; in a string
	 *
	 * @static
	 * @param	string	$m	String to process
	 * @return	string	Replaced string
	 * @since	1.5
	 */
	function _ampReplaceCallback( $m )
	{
		 $rx = '&(?!amp;)';
		 return preg_replace( '#'.$rx.'#', '&amp;', $m[0] );
	}

	/**
	* Cleans text of all formating and scripting code
	*/
	function cleanText ( &$text )
	{
		$text = preg_replace( "'<script[^>]*>.*?</script>'si", '', $text );
		$text = preg_replace( '/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)', $text );
		$text = preg_replace( '/<!--.+?-->/', '', $text );
		$text = preg_replace( '/{.+?}/', '', $text );
		$text = preg_replace( '/&nbsp;/', ' ', $text );
		$text = preg_replace( '/&amp;/', ' ', $text );
		$text = preg_replace( '/&quot;/', ' ', $text );
		$text = strip_tags( $text );
		$text = htmlspecialchars( $text );
		return $text;
	}
}
