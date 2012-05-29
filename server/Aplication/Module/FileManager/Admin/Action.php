<?php
class Module_FileManager_Admin_Action extends Module_AdminAction
{
#---------------------------------------------------------------------------------------------------------

	public function categorySave()
	{
		if (null !== $this->getModule()->category_id) {
			$oCategory = Module_FileManager_Model_Category_Mapper::findById($this->getModule()->category_id);
			$clone_oCategory = clone $oCategory;
			$oCategory->updated_at = Zend_Registry::get('date')->get(Zend_Date::ISO_8601);
			$oCategory->updated_user_id = Zend_Registry::get('identity')->id;
		} else {
			$oCategory = Module_FileManager_Model_Category_Mapper::newItem();
			$oCategory->created_at = Zend_Registry::get('date')->get(Zend_Date::ISO_8601);
			$oCategory->created_user_id = Zend_Registry::get('identity')->id;
		}

		$oCategory->setLanguage( $this->getModule()->_i18n );
		$oCategory->name = System_Url::getPost('_name');
		$oCategory->description = System_Url::getPost('description');
		$oCategory->parent_id = System_Url::getPost('parent_id');
		$oCategory->sort = (int) System_Url::getPost('sort', 0);
		$oCategory->is_activ = System_Url::getPost('is_activ', null);

		$result = $oCategory->save();
		//$oCategory->isStored();
		if ($result) {
			$link_module = System_Url_Admin::create('fileManager', 'categoryEdit', null, array('category'=>$oCategory->id));
			$link_item = System_Url_Admin::create('fileManager', 'categoryEdit', null, array('category'=>$oCategory->id));
			$oLog = System_Logs_Model_Item_Mapper::newItem();
			$oLog->is_admin_panel = true;
			$oLog->module = 'Module_FileManager_Admin';

			if(null !== $this->getModule()->category_id) {
				$oLog->type = System_Logs::UPDATE;
				$oLog->setMessage("log_update_category", array($link_module, '<a href="'.$link_item.'">'.$clone_oCategory->name.'</a>', $this->getModule()->_i18n));
				$oLog->save();

				System_Url::redirect(
					System_Url_Admin::create('fileManager', 'categoryEdit', null, array(
						'sid'=>$this->getModule()->_sid,
						'category'=>$oCategory->id,
						'i18n'=>$this->getModule()->_i18n
					))
				);
			} else {
				$oLog->type = System_Logs::CREATE;
				$oLog->setMessage("log_new_category", array($link_module, '<a href="'.$link_item.'">'.$oCategory->name.'</a>'));
				$oLog->save();

				$this->getModule()->_redirect = System_Url_Admin::create('fileManager', 'categoryEdit', null, array(
					'sid'=>$oCategory->parent_id,
					'category'=>$oCategory->id
				));
			}
		} else {
			$this->setData('oCategory', $oCategory);
		}
	}

#---------------------------------------------------------------------------------------------------------

	public function categoryDelete($category_id = null)
	{
		if(null === $category_id) {
			$category_id = $this->getModule()->category_id;
		}

		$oCategory = Module_FileManager_Model_Category_Mapper::findById($category_id);

//--> Wstępne ustawienia dla Logów
		$link_module = System_Url_Admin::create('fileManager', 'categoryEdit', null, array('category'=>$oCategory->id));
		$link_item = System_Url_Admin::create('fileManager', 'categoryEdit', null, array('category'=>$oCategory->id));
		$oLog = System_Logs_Model_Item_Mapper::newItem();
		$oLog->is_admin_panel = true;
		$oLog->module = 'Module_FileManager_Admin';

		if ($oCategory instanceof Module_FileManager_Model_Category_Row) {
			$clone_oCategory = clone $oCategory;

			if ($oCategory->delete()) {
				$oLog->type = System_Logs::DELETE;
				$oLog->setMessage("log_delete_category", array($link_module, $clone_oCategory->name));
				$oLog->save();
			} else {
				$oLog->type = System_Logs::ERROR;
				$oLog->setMessage("log_delete_error_category", array($link_module, '<a href="'.$link_item.'">'.$oCategory->name.'</a>'));
				$oLog->save();
			}
		} else {
			$oLog->type = System_Logs::ERROR;
			$oLog->setMessage("log_delete_noexists_category", array($link_module));
			$oLog->save();
			$this->getModule()->_redirect = System_Url_Admin::create(System_Url::getRunModule(), System_Url::getRunShow(), null, System_Url::getRunParams());
		}

		$this->getModule()->_redirect = System_Url_Admin::create('fileManager', 'photoList', null, array('sid'=>$this->getModule()->_sid));
	}

#---------------------------------------------------------------------------------------------------------
}