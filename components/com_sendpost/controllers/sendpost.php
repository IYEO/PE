<?php

// No direct access to this file
defined('_JEXEC') or die;

class SendPostControllerSendPost extends JControllerForm {

//    protected $SenderName;      //Имя отправителя письма

//    protected $SenderPhone;     //Номер телефона отправителя письма
//    protected $SenderEmail;     //Email отправителя письма
//    protected $SenderDetails;   //Подробности, которые указал отправитель письма

    public function send() {
        // Check for request forgeries.
        JSession::checkToken() or jexit(JText::_('JINVALID_TOKEN'));

        $app = JFactory::getApplication();
        $model = $this->getModel('SendPost');

        // Get the user data.
        $requestData = $this->input->post->get('jform', array(), 'array');

        // Validate the posted data.
        $form = $model->getForm();

        if (!$form) {
            JError::raiseError(500, $model->getError());

            return false;
        }

        $data = $model->validate($form, $requestData);

        // Check for validation errors.
        if ($data === false) {
            // Get the validation messages.
            $errors = $model->getErrors();

            // Push up to three validation messages out to the user.
            for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
                if ($errors[$i] instanceof Exception) {
                    $app->enqueueMessage($errors[$i]->getMessage(), 'warning');
                } else {
                    $app->enqueueMessage($errors[$i], 'warning');
                }
            }

            // Redirect back to the registration screen.
            $this->setRedirect(JRoute::_('index.php?option=com_sendpost', false));

            return false;
        } else {
            //Получаем данные, введённые пользователем на сайте:
//            $this->SenderName = $this->input->getString(trim('name'));
//            $this->SenderPhone = $this->input->getString(trim('phone'));
//            $this->SenderEmail = $this->input->getString(trim('email'));
//            $this->SenderDetails = $this->input->getString(trim('details'));
            //Создаём письмо для отправки:
            $mailer = JFactory::getMailer();

            //Если пользователь указал свой email, получаем адрес. Иначе указываем своего отправителя письма:
            if ($data['email'] <> "") {
                $sender = array($data['email'], $data['name']);   //Отправитель в формате Имя <Email>
            } else {
                $sender = array("peadmin@goethe.timeweb.ru", $data['name']);
            }

            $mailer->setSender($sender);

            //Получаем данные, введённые пользователем, формируем тело письма:
            $jinput = JFactory::getApplication()->input;
            $recipient = $jinput->get('recipient', 'smolensk@print-express99.ru', 'email');
            $mailer->addRecipient($recipient);
            $mailbody = "Имя отправителя: " . $data['name'] . "\r\n" .
                    "Контактный телефон: " . strip_tags($data['phone']) . "\r\n" .
                    "Адрес электронной почты: " . $data['email'] . "\r\n" .
                    "Текст сообщения (подробности): " . $data['details'];
            $mailer->setSubject("ЗАЯВКА С САЙТА!");
            $mailer->setBody($mailbody);

            if ($mailer->Send()) {  //если письмо успешно отправлено, сохраняем данные в БД и в сессии
             
                // сохраняем в сессию введённое пользователем имя для использования на странице с благодарностями:
                $app->setUserState('com_sendpost.sendpost.data', $data['name']);

                //подготавливаем данные для обработки в MySQL
                $db = JFactory::getDbo();

                
                $formData['date'] = $db->quote(JFactory::getDate()->toSql());
                $formData['name'] = $db->quote($data['name']);
                $formData['phone'] = $db->quote(strip_tags($data['phone']));
                $formData['email'] = $db->quote($data['email']);
                $formData['details'] = $db->quote($data['details']);
                $formData['recipient'] = $db->quote($recipient);

                $model = $this->getModel()->save2db($formData);     //сохранение данных в БД
                
                // Перенаправляем пользователя на страницу с благодарностями:
                $this->setRedirect(JRoute::_('index.php?option=com_sendpost&view=thanks', false));
            } else {
                echo '<h1>Ошибка отправки письма</h1>';
            }
        }
    }

}
