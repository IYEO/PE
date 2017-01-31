<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_sendpost
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * SendPosts View
 *
 * @since  0.0.1
 */
class SendPostViewSendPosts extends JViewLegacy {

    /**
     * Display the Send Post view
     *
     * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
     *
     * @return  void
     */
    function display($tpl = null) {
        // Get application
        //$app = JFactory::getApplication();         
        
        // Get data from the model
        $this->items = $this->get('Items');
        $this->pagination = $this->get('Pagination');

        // Check for errors.
        if (count($errors = $this->get('Errors'))) {
            JError::raiseError(500, implode('<br />', $errors));

            return false;
        }

        // Set the toolbar
        $this->addToolBar();

        // Display the template
        parent::display($tpl);
        
        // Set the document
        //$this->setDocument();
    }

    /**
     * Add the page title and toolbar.
     *
     * @return  void
     *
     * @since   1.6
     */
    protected function addToolBar() {
        $input = JFactory::getApplication()->input;

        // Hide Joomla Administrator Main menu
        //$input->set('hidemainmenu', true);

        JToolBarHelper::title(JText::_('COM_SENDPOST_MANAGER_SENDPOST'));
        JToolBarHelper::editList('sendpost.edit');
//        JToolBarHelper::apply('sendpost.apply');
//        JToolBarHelper::save('sendpost.save');
//        JToolBarHelper::cancel('sendpost.cancel');
    }

//    protected function setDocument() {
//        $document = JFactory::getDocument();
//        $document->setTitle(JText::_('COM_HELLOWORLD_ADMINISTRATION'));
//    }
}
