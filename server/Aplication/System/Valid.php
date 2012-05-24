<?php
class System_Valid
{
	public static function isDate($value, $format = 'YYYY-MM-DD')
	{
		$f = new Zend_Validate_Date();
		$f->setFormat($format);
		$result = $f->isValid($value);
		return $result;
	}

	public static function isClassStart($value)
	{
		$result = preg_match('/^[a-zA-Z0-9]+\_[a-zA-Z0-9]+$/D', $value);
		return $result;
	}

	public static function isAlnum($value)
	{
		$f = new Zend_Validate_Alnum();
		$result = $f->isValid($value);
		return $result;
	}

	public static function isNotEmpty($value)
	{
		$f = new Zend_Validate_NotEmpty();
		$result = $f->isValid($value);
		return $result;
	}

	public static function isInt($value)
	{
		$f = new Zend_Validate_Int();
		$result = $f->isValid($value);
		return $result;
	}

	public static function isDigits($value)
	{
		$f = new Zend_Validate_Digits();
		$result = $f->isValid($value);
		return $result;
	}

	public static function isEmail($value)
	{
		$f = new Zend_Validate_EmailAddress();
		$result = $f->isValid($value);
		return $result;
	}

	public static function isUrl($value)
	{
		return Zend_Uri::check($value);
		$f = new Zend_Validate_HostName();
		$result = $f->isValid($value);
		return $result;
	}

	public static function isUrlCms($url)
  	{
    	$A = Array("Ą","Ć","Ę","Ś","Ń","Ó","Ł","Ż","Ź","ą","ć","ę","ś","ń","ó","ł","ż","ź"," ","!","@","#","$","%","^","&","*","(",")","_","+","|","\"","=","-","[","]","{","}",";","'",":","\"",",",".","/","<",">","?","~","`");
    	$B = Array("A","C","E","S","N","O","L","Z","Z","a","c","e","s","n","o","l","z","z","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_","_");
    	$new = str_replace($A,$B,$url);
    	if($new == $url) return true;
    	else return false;
  	}

  public static function strIsDec($tekst, $can_be_empty=false)
  {
    $tekst=trim($tekst);
    if (strlen($tekst)==0 && $can_be_empty) return true;
    preg_match("/^\\-?\\d+([\\.,]{1}\\d+)?\$/", $tekst, $rez);
    if (strlen(@$rez[0]) == 0) 
      return false;
    else
      return true;
  }

	public static function isNIP($str)
	{
		$str = str_replace('-', '', $str);
		if (strlen($str) != 10)
		{
			return false;
		}

		$arrSteps = array(6, 5, 7, 2, 3, 4, 5, 6, 7);
		$intSum=0;
		for ($i = 0; $i < 9; $i++)
		{
			$intSum += $arrSteps[$i] * $str[$i];
		}
		$int = $intSum % 11;

		$intControlNr=($int == 10)?0:$int;
		if ($intControlNr == $str[9])
		{
			return true;
		}
		return false;
	}
}
?>