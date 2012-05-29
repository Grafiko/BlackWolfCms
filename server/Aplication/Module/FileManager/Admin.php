<?php
class Module_FileManager_Admin extends Module_Admin implements Module_AdminInterface
{
	protected $category_id = null;
	protected $_sid = null;

#---------------------------------------------------------------------------------------------------------

	public function __init()
	{
		$this->category_id = System_Url::getGP('category', null);
		$this->_sid =  System_Url::getGP('sid', null);
	}

#---------------------------------------------------------------------------------------------------------

	public function display_default()
	{
		$this->display_fileList();
	}

#---------------------------------------------------------------------------------------------------------

	protected function display_filesAdd()
	{
		System_MetaData::getInstance()->setTitle('Menadżer plików - Dodanie nowych plików');

		if($this->getData('oFile') instanceof Module_FileManager_Model_Item_Row) {
			$oItem = $this->getData('oFile');
		} else {
			$oItem = false;
		}

		$tpl_data = array(
			'V' => $oItem,
			'library' => array(
				'oCategoryList' => Module_FileManager_Model_Category_Mapper::getAll()->sortBy('name')->convertDataToSelect()
			)
		);

		$view = $this->render('filesAdd.tpl', $tpl_data);

		$tpl_data = array(
			'CONTENT' => $view
		);

//--> Pobranie wstępnego szablonu
		$modulePanelAdmin = $this->getModule('Module_Panel_Admin');
		$modulePanelAdmin->tpl_iFrame($tpl_data);

		$this->addToDisplay(
			$modulePanelAdmin->getModuleResult()
		);

		return;
		$DATA = array(
			'oFile' => $oItem,
			'E' => $this->_error['photo'],
			'SESSION' => Zend_Session::getId(),
			'CATEGORY_ID' => $this->gallery_category_id,
			'URL' => array(
				'POST' => System_Url::create('/admin/', 'galleryImage-photoAdd', 'photoSave')
			),
			'L' => array(
				'CATEGORY' => Module_GalleryImage_Model_Category_Mapper::getAll()->sortBy('name')->convertDataToSelect()
			),
			'UPLOAD_MAX_FILESIZE' => System_Utilities::maxUploadSize()
		);

		$VS = array(
			'CONTENT' => $this->render('GalleryImage', 'photo_add.tpl', $DATA)
		);

		$this->addToDisplay(
			$this->render('Start', 'iframe.tpl', $VS)
		);
	}

#---------------------------------------------------------------------------------------------------------

	public function display_fileList()
	{
		System_MetaData::getInstance()->setTitle('System');

//--> Tworzymy zakładki
		$tabs = new Plugin_Tabs();
		$tabs->setActiv($this->_hash);
		$tabsItem = new Plugin_Tabs_Item( $this->_translate->_('the_list_of_files') );
		$tabsItem->setContent($this->view_fileList());
		$tabsItem->setHash('fileList');
		$tabs->addItem($tabsItem);

		$tpl_data['PANEL_RIGHT'] = $tabs->getPluginResult();
		$tpl_data['PANEL_LEFT'] = $this->view_leftPanel();

//--> Pobranie wstępnego szablonu
		$modulePanelAdmin = $this->getModule('Module_Panel_Admin');
		$modulePanelAdmin->tpl_twoColumn($tpl_data);

		$this->addToDisplay(
			$modulePanelAdmin->getModuleResult()
		);
	}

#---------------------------------------------------------------------------------------------------------

	protected function display_categoryAdd()
	{
		$this->checkRedirectFrame();
		System_MetaData::getInstance()->setTitle( $this->_translate->_('file_manager_add_new_category') );

//--> Category Object
		if($this->getData('oCategory') instanceof Module_FileManager_Model_Category_Row) {
			$oCategory = $this->getData('oCategory');
		} else {
			$oCategory = Module_FileManager_Model_Category_Mapper::newItem();
		}

		$tpl_data = array(
			'oCategory' => $oCategory,
			'error' => $oCategory->getValidErrors(),
			'category_id' => $this->category_id,
			'library' => array(
				'oCategoryList' => Module_FileManager_Model_Category_Mapper::getAll()->sortBy('name')->convertDataToSelect()
			),
			'URL' => array(
				'POST' => System_Url_Admin::create('fileManager', 'categoryAdd', 'categorySave')
			),
		);
		$view = $this->render('categoryAdd.tpl', $tpl_data);

		$tpl_data = array(
			'CONTENT' => $view
		);

//--> Pobranie wstępnego szablonu
		$modulePanelAdmin = $this->getModule('Module_Panel_Admin');
		$modulePanelAdmin->tpl_iFrame($tpl_data);

		$this->addToDisplay(
			$modulePanelAdmin->getModuleResult()
		);
	}

#---------------------------------------------------------------------------------------------------------

	protected function display_categoryEdit()
	{
		System_MetaData::getInstance()->setTitle( $this->_translate->_('file_manager_edit_category') );

//--> Category Object
		if($this->getData('oCategory') instanceof Module_FileManager_Model_Category_Row) {
			$oCategory = $this->getData('oCategory');
		} else {
			$oCategory = Module_FileManager_Model_Category_Mapper::findById($this->category_id, $this->_i18n);	
		}

//--> Pobranie widoku wersji językowych wprowadzanych danych
		$moduleLanguageAdmin = $this->getModule('Module_Language_Admin');
		$view_language = $moduleLanguageAdmin->view_languageSelectionWhenEditingItem();

//--> Tworzymy zakładki
		$tabs = new Plugin_Tabs();
		$tabs->setActiv($this->_hash);
		$tabsItem = new Plugin_Tabs_Item( $this->_translate->_('Dane podstawowe') );
		$tabsItem->setContent($view_language);
		$tabsItem->addContent($this->view_categoryEdit($oCategory));
		$tabsItem->setHash('fileList');
		$tabs->addItem($tabsItem);

		$tpl_data = array(
			'PANEL_RIGHT' => $tabs->getPluginResult(),
			'PANEL_LEFT' => $this->view_leftPanel()
		);

//--> Pobranie wstępnego szablonu
		$modulePanelAdmin = $this->getModule('Module_Panel_Admin');
		$modulePanelAdmin->tpl_twoColumn($tpl_data);

		$this->addToDisplay(
			$modulePanelAdmin->getModuleResult()
		);
	}

#---------------------------------------------------------------------------------------------------------

	protected function display_categoryDelete()
	{
		$this->checkRedirectFrame();
		System_MetaData::getInstance()->setTitle( $this->_translate->_('file_manager_delete_category') );

//--> Category Object
		if($this->getData('oCategory') instanceof Module_FileManager_Model_Category_Row) {
			$oCategory = $this->getData('oCategory');
		} else {
			$oCategory = Module_FileManager_Model_Category_Mapper::findById($this->category_id);
		}

		$tpl_data = array(
			'oCategory' => $oCategory,
			'error' => $oCategory->getValidErrors(),
			'URL' => array(
				'DELETE' => System_Url_Admin::create('fileManager', 'categoryDelete', 'categoryDelete', array('sid'=>$this->_sid, 'category'=>$this->category_id))
			),
		);
		$view = $this->render('categoryDelete.tpl', $tpl_data);

		$tpl_data = array(
			'CONTENT' => $view
		);

//--> Pobranie wstępnego szablonu
		$modulePanelAdmin = $this->getModule('Module_Panel_Admin');
		$modulePanelAdmin->tpl_iFrame($tpl_data);

		$this->addToDisplay(
			$modulePanelAdmin->getModuleResult()
		);
	}

#---------------------------------------------------------------------------------------------------------

	public function view_fileList()
	{

	}

#---------------------------------------------------------------------------------------------------------

	private function view_categoryEdit(Module_FileManager_Model_Category_Row $oCategory)
	{
		$tpl_data = array(
			'oCategory' => $oCategory,
			'error' => $oCategory->getValidErrors(),
			'category_id' => $this->category_id,
			'library' => array(
				'oCategoryList' => Module_FileManager_Model_Category_Mapper::getAll()->sortBy('name')->convertDataToSelect()
			),
			'URL' => array(
				'POST' => System_Url_Admin::create('fileManager', 'categoryEdit', 'categorySave', array('sid'=>$this->_sid, 'category'=>$this->category_id, 'i18n'=>$this->_i18n)),
				'DELETE' => System_Url_Admin::create('fileManager', 'categoryDelete', null, array('sid'=>$this->_sid, 'category'=>$this->category_id))
			),
		);
		$view = $this->render('categoryEdit.tpl', $tpl_data);

		return $view;
	}

#---------------------------------------------------------------------------------------------------------

	private function view_leftPanel()
	{
		$result = $this->view_panelLeft_Menu();
		$result.= $this->view_panelLeft_Navigation();
		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	private function view_panelLeft_Menu()
	{
		$pMenu = new Plugin_MenuLeft( $this->_translate->_('auxiliary_menu') );
		$pMenu->setActiv( System_Url::getRunShow() );

		$pMenuItem = new Plugin_MenuLeft_Item( $this->_translate->_('all_files') );
		$pMenuItem->setHref( System_Url_Admin::create('fileManager', 'fileList') );
		$pMenuItem->setHash('setting');
		$pMenu->addItem($pMenuItem);

		$link = self::url_addNewFiles();
		$pMenuItem = new Plugin_MenuLeft_Item( $this->_translate->_('add_a_new_files') );
		$pMenuItem->setOnClick("$('<div />')._window({ id: 'addFiles', title:'Formularz dodania nowych plików', content: '{$link}' });");
		$pMenuItem->setHash('cache');
		$pMenu->addItem($pMenuItem);

		$link = self::url_addNewCategory();
		$pMenuItem = new Plugin_MenuLeft_Item( $this->_translate->_('add_a_new_category') );
		$pMenuItem->setOnClick("$('<div />')._window({ id: 'addFileCategory', title:'Formularz dodania nowej kategorii', content: '{$link}' });");
		$pMenuItem->setHash('cache');
		$pMenu->addItem($pMenuItem);

		return $pMenu->getPluginResult();
	}

#---------------------------------------------------------------------------------------------------------

	private function view_panelLeft_Navigation()
	{
		$aPathCategoryList = $this->fn_categoryPath($this->_sid);
		$oCategoryList = Module_FileManager_Model_Category_Mapper::findByParentId($this->_sid);

		if (is_array($aPathCategoryList)) {
			foreach ($aPathCategoryList as $oCategory) {
				if ($oCategory->id == $this->_sid) {
					$oCategory->_is_current = true;
				} else {
					$oCategory->_is_current = false;
				}
				if ($oCategory->id == $this->category_id) {
					$oCategory->_is_edit = true;
				} else {
					$oCategory->_is_edit = false;
				}
				$oCategory->_url = array(
					'structure' => System_Url_Admin::create(System_Url::getRunModule(), System_Url::getRunShow(), null, System_Url::getRunParams(array('sid'=>$oCategory->parent_id))),
					'edit' => System_Url_Admin::create('fileManager' ,'categoryEdit', null, array('sid'=>$this->_sid, 'category'=>$oCategory->id))
				);
			}
		}

		foreach ($oCategoryList as $oCategory) {
			if ($oCategory->id == $this->category_id) {
				$oCategory->_is_edit = true;
			} else {
				$oCategory->_is_edit = false;
			}
			$oCategory->_url = array(
				'structure' => System_Url_Admin::create(System_Url::getRunModule(), System_Url::getRunShow(), null, System_Url::getRunParams(array('sid'=>$oCategory->id))),
				'edit' => System_Url_Admin::create('fileManager', 'categoryEdit', null, array('sid'=>$this->_sid, 'category'=>$oCategory->id))
			);
		}

		$tpl_data = array(
			'box_title' => $this->getTranslate()->_('category_structure'),
			'aPathCategoryList' => $aPathCategoryList,
			'oCategoryList' => $oCategoryList
		);

		$view = $this->render('structureNavigation.tpl', $tpl_data);

		return $view;
	}

#---------------------------------------------------------------------------------------------------------
# FUNCTIONS
#---------------------------------------------------------------------------------------------------------

	public function fn_categoryPath($start_category_id)
	{
		$path = array();
		$oCategory = Module_FileManager_Model_Category_Mapper::findById($start_category_id);
		if ($oCategory instanceof Module_FileManager_Model_Category_Row) {
			if ($oCategory->parent_id !== null) {
				$result = $this->fn_categoryPath($oCategory->parent_id);
				if (false !== $result) {
					$path = array_merge($path, $result);
				}
			}
			$path[] = $oCategory;
		} else {
			return false;
		}

		return $path;
	}

#---------------------------------------------------------------------------------------------------------
# URL'S
#---------------------------------------------------------------------------------------------------------

	public static function url_addNewFiles()
	{
		$category_id = System_Url::getGP('category');
		$link = System_Url_Admin::create('fileManager', 'filesAdd', null, array('category' => $category_id));
		return $link;
	}

#---------------------------------------------------------------------------------------------------------

	public static function url_addNewCategory()
	{
		$category_id = System_Url::getGP('category');
		$link = System_Url_Admin::create('fileManager', 'categoryAdd', null, array('category' => $category_id));
		return $link;
	}

#---------------------------------------------------------------------------------------------------------
}