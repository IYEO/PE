<?php

// No direct access to this file
defined('_JEXEC') or die;

/**
 * SendPost Model
 *
 * @since  0.0.1
 */
class SendPostModelSendPost extends JModelForm {

    protected $data;

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
        $form = $this->loadForm('com_sendpost.sendpost', 'sendpost', array('control' => 'jform', 'load_data' => $loadData));

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
        $data = $this->getdata();

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

        $query->insert($db->quoteName('#__sendpost'))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $formData));

        // Set the query using our newly populated query object and execute it.
        $db->setQuery($query);
        $db->execute();
    }

    public function getData() {
        if ($this->data === null) {
            $this->data = new stdClass;
            $app = JFactory::getApplication();
            $params = JComponentHelper::getParams('com_sendpost');

            // Override the base user data with any data in the session.
            $temp = (array) $app->getUserState('com_sendpost.sendpost.data', array());

            $form = $this->getForm(array(), false);

            foreach ($temp as $k => $v) {
                // Only merge the field if it exists in the form.
                if ($form->getField($k) !== false) {
                    $this->data->$k = $v;
                }
            }

            // Get the dispatcher.
            $dispatcher = JEventDispatcher::getInstance();

            // Trigger the data preparation event.
            $results = $dispatcher->trigger('onContentPrepareData', array('com_sendpost.sendpost', $this->data));

            // Check for errors encountered while preparing the data.
            if (count($results) && in_array(false, $results, true)) {
                $this->setError($dispatcher->getError());
                $this->data = false;
            }
        }

        return $this->data;
    }

}
