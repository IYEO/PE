<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_sendpost
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

JFormHelper::loadFieldClass('email');

/**
 * SendPost Form Field class for the SendPost component
 *
 * @since  0.0.1
 */
class JFormFieldSendPost extends JFormFieldEMail {

    /**
     * The field type.     
     */
    
    protected function getInput() {
        return parent::getInput();  //получаем поле типа email
    }

}
