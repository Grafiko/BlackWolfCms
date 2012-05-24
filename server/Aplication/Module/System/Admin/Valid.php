<?php
class Module_System_Admin_Valid
{
#---------------------------------------------------------------------------------------------------------

	public static function saveSmtpSetting(Module_System_Admin_Action $object)
	{
		$errors = false;
		$data_to_valid = $object->getData('mail');

		if (!System_Valid::isNotEmpty( $data_to_valid['smtp_server'] )) {
			$errors['smtp_server'] = $object->_translate->_('you_have_not_specified_smtp_server_name');
		}

		if (!System_Valid::isNotEmpty( $data_to_valid['smtp_email'] )) {
			$errors['smtp_email'] = $object->_translate->_('you_have_not_specified_an_email_address');
		}

		if (!System_Valid::isNotEmpty( $data_to_valid['smtp_pass'] )) {
			$errors['smtp_pass'] = $object->_translate->_('no_password_is_supplied');
		}

		if (!System_Valid::isNotEmpty( $data_to_valid['smtp_send_perminute'] )) {
			$errors['smtp_send_perminute'] = $object->_translate->_('there_are_defined_options_for_number_of_emails_sent_by_the_server_per_minute');
		} elseif (!System_Valid::isInt( $data_to_valid['smtp_send_perminute'] )) {
			$errors['smtp_send_perminute'] = $object->_translate->_('the_value_must_be_a_number');
		} elseif ( $data_to_valid['smtp_send_perminute'] < 1 ) {
			$errors['smtp_send_perminute'] = $object->_translate->_('the_value_must_be_greater_than_0');
		}

		if (!System_Valid::isNotEmpty( $data_to_valid['email_from'] )) {
			$errors['email_from'] = $object->_translate->_('do_not_see_your_email_from');
		} elseif (!System_Valid::isEmail( $data_to_valid['email_from'] )) {
			$errors['email_from'] = $object->_translate->_('the_email_address_is_incorrect');
		}

		if (!System_Valid::isNotEmpty( $data_to_valid['email_name'] )) {
			$errors['email_name'] = $object->_translate->_('you_have_not_specified_a_name_for_the_default_address_from');
		}

		$object->setData('mail_errors', $errors);

		return $errors;
	}

#---------------------------------------------------------------------------------------------------------
}