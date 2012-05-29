<?php
abstract class Db_Table_Rowset_Abstract extends Zend_Db_Table_Rowset_Abstract
{

#---------------------------------------------------------------------------------------------------------

	public function getArrayTree($parent_id = null)
	{
		$data = array();

		foreach ($this->_data as $item) {
			if (array_key_exists('parent_id', $item)) {
				if($item['parent_id'] == $parent_id) {
					$data[] = $item;
					$data[count($data)-1]['children'] = $this->getArrayTree($item['id']);
				}
			} else {
				$data[] = $item;
			}
		}

		return $data;
	}

#---------------------------------------------------------------------------------------------------------

	public function convertDataToSelect($array_tree = null, $level = 0, $parent_id = null)
	{
		if ($array_tree === null) {
			$array_tree = $this->getArrayTree($parent_id);
		}
//Zend_Debug::dump($array_tree);
//exit;
		$new  = array();

		foreach ($array_tree as $item) {
			//Zend_Debug::dump($item);
			$tmp  = null;
			for ($n=0; $n<$level; $n++) {
				if($n == 0) {
					$tmp.='';
				}
				if ($n == ($level-1)) {
					$tmp.='&mdash;&mdash;|&nbsp;';
				} else {
					$tmp.='&mdash;&mdash;';
				}	
			}

			$item['level'] = $level;
			$item['name'] = $tmp . System_Utilities::_stripslashes($item['name']);
			$new[count($new)] = $item;

			unset($new[count($new)-1]['children']); 
			if(isset($item['children']))
			$new = array_merge($new, $this->convertDataToSelect($item['children'], $level+1));
		}

		return $new;
	}

#---------------------------------------------------------------------------------------------------------
# Sortowanie tablicy
#---------------------------------------------------------------------------------------------------------

	public function sortBy($key, $order = SORT_ASC)
	{
		if ($order == 'ASC') {
			$order = SORT_ASC;
		} elseif ($order == 'DESC') {
			$order = SORT_DESC;
		}

		if ($order != SORT_DESC) {
			$order = SORT_ASC;
		}

		$key = strtolower($key);
		$array = $this->_data;
		$new_array = array();
		$sortable_array = array();

		if (count($array) > 0) {
			foreach ($array as $k => $v) {
				if (is_array($v)) {
					foreach ($v as $k2 => $v2) {
						if ($k2 == $key) {
							$sortable_array[$k] = $v2;
						}
					}
				} else {
					$sortable_array[$k] = $v;
				}
			}

			switch ($order) {
				case SORT_ASC:
					asort($sortable_array);
					break;
				case SORT_DESC:
					arsort($sortable_array);
					break;
			}

			foreach ($sortable_array as $k => $v) {
				$new_array[] = $array[$k];
			}
		}

		$this->_data = $new_array;
		return $this;
	}

#---------------------------------------------------------------------------------------------------------	
}