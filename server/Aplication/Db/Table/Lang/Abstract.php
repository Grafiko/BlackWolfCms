<?php
abstract class Db_Table_Lang_Abstract extends Db_Table_Abstract
{
	protected $_language = null;

#---------------------------------------------------------------------------------------------------------

	public function __construct($config = array(), $definition = null)
	{
		//$user_setting = Zend_Registry::get('user_setting');
		//$this->_language = $user_setting->language;
		parent::__construct($config, $definition);
	}

#---------------------------------------------------------------------------------------------------------

	public function setLanguage($language)
	{
		if (in_array($language, Module_Language_Model_Language_Mapper::getSiteAvailableLanguages()->getArrayCode())) {
			$this->_language = $language;
		} else {
			throw new System_Exception('Do systemu nie został dodany wybrany język: '.$language);
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function getLanguage()
	{
		return $this->_language;
	}

#---------------------------------------------------------------------------------------------------------

	public function getLanguageTable()
	{
		return $this->_name_i18n;
	}

#---------------------------------------------------------------------------------------------------------

	public function getLangFields()
	{
		return $this->lang_fields;
	}

#---------------------------------------------------------------------------------------------------------

	public function select($withFromPart = self::SELECT_WITHOUT_FROM_PART)
	{
		$select = new Zend_Db_Table_Select($this);
		$select->setIntegrityCheck(false)
			->from($this->_name)
			->joinLeft(
				array('i18n' => $this->_name_i18n),
				"i18n.id = {$this->_name}.id AND i18n.language = '{$this->_language}'",
				$this->lang_fields
			);

		foreach($this->lang_fields as $field) {
			$select->columns("IF( (i18n.{$field} IS NULL), {$this->_name}.{$field}, i18n.{$field}) as {$field}");
		}

		return $select;
	}

#---------------------------------------------------------------------------------------------------------

	public function insert(array $data)
	{
		$primaryKey = (int) parent::insert($data['row']);
		$tableSpec = ($this->_schema ? $this->_schema . '.' : '') . $this->getLanguageTable();
		$data['row_lang']['id'] = $primaryKey;
		$this->_db->insert($tableSpec, $data['row_lang']);

		return $primaryKey;
	}

#---------------------------------------------------------------------------------------------------------

	public function update(array $data, $where)
	{
		$rowCount = parent::update($data['row'], $where['row']);

		$tableSpec = ($this->_schema ? $this->_schema . '.' : '') . $this->getLanguageTable();
		$select = $this->_db->select();
		$select->from($tableSpec, 'count(*)');
		$select->where($where['row_lang']);
		$isset_row = (int) $this->_db->fetchOne($select);
		if ($isset_row) {
			if (isset($data['row_lang']['id'])) {
				unset($data['row_lang']['id']);
			}
			if (isset($data['row_lang']['language'])) {
				unset($data['row_lang']['language']);
			}
			$this->_db->update($tableSpec, $data['row_lang'], $where['row_lang']);
		} else {
			$this->_db->insert($tableSpec, $data['row_lang']);
		}

		return $rowCount;
	}

#---------------------------------------------------------------------------------------------------------

	private function separateLangRows(array $data)
	{
		$oLanguageList = Module_Language_Model_Language_Mapper::getSiteAvailableLanguages();
		$langData  = array();
		foreach ($this->lang_fields as $field) {
			foreach ($oLanguageList as $oLanguage) {
				$colName = $field . '_' . $oLanguage->code;
				if (isset($data[$colName])) {
					$langData[$oLanguage->code][$field] = $data[$colName];
				}
			}
		}
		return $langData;
	}

#---------------------------------------------------------------------------------------------------------
}