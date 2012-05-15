<?php
class System_Url_Admin extends System_Url
{
#---------------------------------------------------------------------------------------------------------

	protected static function decodeRunParam($run = null)
	{
		$result = array('module'=>null, 'show'=>null, 'action'=>null);

		if (null != $run) {
			$_tmp = explode('.', $run);

//-----> Ustawienie wartości module oraz show
			$_ms = explode('-', $_tmp[0]);
			$result['module'] = isset($_ms[0])?$_ms[0]:null;
			$result['show'] = isset($_ms[1])?$_ms[1]:null;

			switch (count($_tmp)) {
				case 2:
					$result['action'] = $_tmp[1];
					break;
				default:
					break;
			}
		}

		return $result;
	}

#---------------------------------------------------------------------------------------------------------

	public static function create($module = null, $show = null, $action = null, $params = null)
	{
		$instance = self::getInstance();
		$_url = '/';

//---> Ustawienie modułu oraz wyglądu
		if ($module !== null AND $show !== null) {
			$_url.= 'run' . $instance->separator . $module . '-' . $show;
		} elseif ($module !== null AND $show === null) {
			$_url.= 'run' . $instance->separator . $module;
		}

//---> Ustawienie akcji do wykonania
		if ($action !== null) {
			$_url.= '.' . $action;
		}

//---> Ustawienie parametrów
		if (is_array($params)) {
			$paramLn = count($params);
			$i = 0;

			foreach ($params as $var=>$value) {
				if ($value) {
					if ($i !== $paramLn AND $_url !== null) {
						$_url.= $instance->separator;
					}
					$_url.= $var . $instance->separator . $value;
				}
				$i++;
			}
		}

//---> Dodanie końcówki .html
		if ($_url !== null) {
			$_url.='.html';
		}

//---> Dodanie bazowego adresu url admina
		$_url = $instance->base_url_admin . $_url;

		return $_url;
	}

#---------------------------------------------------------------------------------------------------------
}