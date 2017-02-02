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
     *
     * @var         string
     */
    protected $type = 'SendPost';

    /**
     * Method to get a list of options for a list input.
     *
     * @return  array  An array of JHtml options.
     */
//    protected function getOptions() {
//        $db = JFactory::getDBO();
//        $query = $db->getQuery(true);
//        $query->select('id,recipient');
//        $query->from('#__sendpost_recipient');
//        $db->setQuery((string) $query);
//        $messages = $db->loadObjectList();
//        $options = array();
//
//        if ($messages) {
//            foreach ($messages as $message) {
//                $options[] = JHtml::_('select.option', $message->id, $message->recipient);
//            }
//        }
//
//        $options = array_merge(parent::getOptions(), $options);
//
//        return $options;
//    }

    protected function getInput() {
//        $db = JFactory::getDBO();
//        $query = $db->getQuery(true);
//        $query->select('recipient');
//        $query->from($db->quoteName('#__sendpost_recipient'));
//        $db->setQuery((string) $query);
//        $recipient = $db->loadResult();
//
//        if ($recipient) $this->value = $recipient;

        return parent::getInput();
    }

}
