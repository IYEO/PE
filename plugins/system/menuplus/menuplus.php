<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.Menuplus
 *
 * @author      Bruno Batista <bruno@atomtech.com.br>
 * @copyright   Copyright (C) 2013 AtomTech IT Services. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Joomla Menuplus plugin.
 *
 * @package     Joomla.Plugin
 * @subpackage  System.Menuplus
 * @author      Bruno Batista <bruno@atomtech.com.br>
 * @since       3.1
 */
class PlgSystemMenuplus extends JPlugin
{
	/**
	 * Constructor.
	 *
	 * @param   object  &$subject  The object to observe.
	 * @param   array   $config    An array that holds the plugin configuration.
	 *
	 * @access  protected
	 * @since   3.1
	 */
	public function __construct(& $subject, $config)
	{
		parent::__construct($subject, $config);

		$this->loadLanguage();
		JFormHelper::addFieldPath(__DIR__ . '/fields');
	}

	/**
	 * Called before a JForm is rendered.
	 *
	 * It can be used to modify the JForm object in memory before rendering.
	 *
	 * @param   JForm  $form  The form to be altered.
	 * @param   array  $data  The associated data for the form.
	 *
	 * @return  boolean
	 *
	 * @since   3.1
	 */
	public function onContentPrepareForm($form, $data)
	{
		// Ensure that data is an object.
		$data = (object) $data;

		// Check we have a form.
		if (!($form instanceof JForm))
		{
			$this->_subject->setError('JERROR_NOT_A_FORM');

			return false;
		}

		// Check we are manipulating a valid form.
		$name = $form->getName();

		if (!in_array($name, array('com_menus.item')))
		{
			return true;
		}

		// Add the registration fields to the form.
		JForm::addFormPath(__DIR__ . '/forms');
		$form->loadFile('item', false);

		return true;
	}
}
