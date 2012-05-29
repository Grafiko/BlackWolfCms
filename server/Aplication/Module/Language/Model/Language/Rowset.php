<?php
class Module_Language_Model_Language_Rowset extends Db_Table_Rowset_Abstract
{
#---------------------------------------------------------------------------------------------------------

	public function getArrayCode()
	{
		$aCode = array();
		foreach ($this as $oLanguageRow) {
			$aCode[] = $oLanguageRow->code;
		}

		return $aCode;
	}

#---------------------------------------------------------------------------------------------------------	
}