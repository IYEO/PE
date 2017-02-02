<?php

// No direct access to this file
defined('_JEXEC') or die;

/**
 * SendPost Model
 *
 * @since  0.0.1
 */
class SendPostModelSendPost extends JModelForm {
    /**
     * Method to get a table object, load it if necessary.
     *
     * @param   string  $type    The table name. Optional.
     * @param   string  $prefix  The class prefix. Optional.
     * @param   array   $config  Configuration array for model. Optional.
     *
     * @return  JTable  A JTable object
     *
     * @since   1.6
     */
//    public function getTable($type = 'SendPost', $prefix = 'SendPostTable', $config = array()) {
//        return JTable::getInstance($type, $prefix, $config);
//    }

    /**
     * Method to get the record form.
     *
     * @param   array    $data      Data for the form.
     * @param   boolean  $loadData  True if the form is to load its own data (default case), false if not.
     *
     * @return  mixed    A JForm object on success, false on failure
     *
     * @since   1.6
     */
    public function getForm($data = array(), $loadData = true) {
        // Get the form.
        $form = $this->loadForm('com_sendpost.sendpost', 'sendpost', array('load_data' => $loadData));

        if (empty($form)) {
            return false;
        }

        return $form;
    }

    /**
     * Method to get the data that should be injected in the form.
     *
     * @return  mixed  The data for the form.
     *
     * @since   1.6
     */
    protected function loadFormData() {
        // Check the session for previously entered form data.
        $data = JFactory::getApplication()->getUserState(
                'com_sendpost.sendpost.form.data', array()
        );

//        if (empty($data)) {
//            $data = $this->getItem();
//        }

        return $data;
    }

    protected function populateState() {
        // Get the application object.
        $params = JFactory::getApplication()->getParams('com_sendpost');

        // Load the parameters.
        $this->setState('params', $params);
    }

    /* Метод для сохранения в БД данных, отправленных пользователем с сайта.
     * @param    array   $formData   Данные, введённые пользователем
     */

    public function save2db($formData) {
        // Get a db connection.
        $db = JFactory::getDbo();
        
        // Create a new query object.
        $query = $db->getQuery(true);

        // Insert columns.
        $columns = array('date', 'name', 'phone', 'email', 'details', 'recipient');
//        $values = implode(',', $formData);

        $query->insert($db->quoteName('#__sendpost_data'))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $formData));

        // Set the query using our newly populated query object and execute it.
        $db->setQuery($query);
        $db->execute();
    }

}
