<?php
class System_Translate_Zend extends Zend_Translate
{
#---------------------------------------------------------------------------------------------------------

	public function _()
	{
		$args = func_get_args();
		$num = func_num_args();

		$adapter = $this->getAdapter();
		$args[0] = $adapter->_($args[0]);

		if ($num <= 1) {
			return $args[0];
		}

		if (is_array($args[1])) {
			$new[] = $args[0];
			for ($i=0,$ln=count($args[1]);$i<$ln;$i++) {
				$new[] = '<strong>' . $args[1][$i] . '</strong>';
			}
			return call_user_func_array('sprintf', $new);
		} else {
			return call_user_func_array('sprintf', $args);
		}
	}

#---------------------------------------------------------------------------------------------------------
}