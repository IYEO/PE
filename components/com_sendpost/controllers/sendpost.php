<?php

// No direct access to this file
defined('_JEXEC') or die;

class SendPostControllerSendPost extends JControllerForm {

    protected $SenderName;      //Имя отправителя письма
    protected $SenderPhone;     //Номер телефона отправителя письма
    protected $SenderEmail;     //Email отправителя письма
    protected $SenderDetails;   //Подробности, которые указал отправитель письма

    public function send() {
        $model = $this->getModel();        
//        if (!$model->validate($model,$model->get("Form"))) {
//            return FALSE;
//        }

        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $query->select('recipient');
        $query->from($db->quoteName('#__sendpost_recipient'));        

        // Reset the query using our newly populated query object.
        $db->setQuery($query);
        $recipient = $db->loadResult();

        //Получаем данные, введённые пользователем на сайте:
        $this->SenderName = $this->input->getString(trim('name'));
        $this->SenderPhone = $this->input->getString(trim('phone'));
        $this->SenderEmail = $this->input->getString(trim('email'));
        $this->SenderDetails = $this->input->getString(trim('details'));

        //Создаём письмо для отправки:
        $mailer = JFactory::getMailer();
        $sender = array($this->SenderEmail, $this->SenderName);   //Отправитель в формате Имя <Email>
        $mailer->setSender($sender);
        $mailer->addRecipient($recipient);
        $mailbody = "Имя отправителя: " . $this->SenderName . "\r\n" .
                "Контактный телефон: " . $this->SenderPhone . "\r\n" .
                "Адрес электронной почты: " . $this->SenderEmail . "\r\n" .
                "Текст сообщения (подробности): " . $this->SenderDetails;
        $mailer->setSubject("ЗАЯВКА С САЙТА!");
        $mailer->setBody($mailbody);

        $send = $mailer->Send();
        if ($send !== true) {
            echo '<h1>Ошибка отправки письма</h1>';
        } else {
            echo '<h1>Письмо успешно отправлено</h1>';
        }
    }

}
