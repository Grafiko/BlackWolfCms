<?
class System_Email
{
	private $_setting = null;
	private $transport = null;
	private $mailer = null;

#---------------------------------------------------------------------------------------------------------

	public function __construct()
	{
		if (!Zend_Registry::isRegistered('system_setting')) {
			throw(new Zend_Mail_Exception('Brak konfiguracji w rejestrze aplikacji.'));
		}

		$this->_setting = Zend_Registry::get('system_setting');
		$login = array(
			'auth' => 'login',
			'username' => $this->_setting['smtp_email'],
			'password' => $this->_setting['smtp_pass']
		);
		$this->transport = new Zend_Mail_Transport_Smtp($this->_setting['smtp_server'], $login);
		$this->mailer = new Zend_Mail('utf-8');
	}

#---------------------------------------------------------------------------------------------------------

	public function addTo($email, $name='')
	{
		$this->mailer->addTo($email, $name);
		return $this;
	}

#---------------------------------------------------------------------------------------------------------

	public function addAttachment($zalaczniki = null)
	{
		if (is_array($zalaczniki)) {
			foreach ($zalaczniki as $zalacznik) {
				$at = $this->mailer->createAttachment(fopen($zalacznik['file'], 'r'));
				$at->type = $zalacznik['type'];
				//$at->encoding			= Zend_Mime::ENCODING_BASE64;
				//$at->disposition	= Zend_Mime::DISPOSITION_INLINE;
				$at->filename = $zalacznik['name'];
			}
		}
		return $this;
	}

#---------------------------------------------------------------------------------------------------------

	public function _send($subject, $body_html, $body_text = null)
	{
		try {
			$r = $this->mailer
				->setFrom($this->_setting['email_from'], $this->_setting['email_name'])
				->setSubject($subject)
				->setBodyText($body_text)
				->setBodyHtml($body_html)
				->send($this->transport)
			;
			Zend_Debug::dump($r);
			exit;
			return true;
		} catch (Exception $e) {
			return false;
    		echo 'Caught exception: ',  $e->getMessage(), "\n";
			exit;
		}
		return $this;
	}

#---------------------------------------------------------------------------------------------------------

	public static function newEmail()
	{
		return new self;
	}

#---------------------------------------------------------------------------------------------------------
}