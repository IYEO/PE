<?php

// No direct access to this file
defined('_JEXEC') or die;

class SendPostControllerSendPost extends JControllerForm {

    protected $SenderName;      //Имя отправителя письма
    protected $SenderPhone;     //Номер телефона отправителя письма
    protected $SenderEmail;     //Email отправителя письма
    protected $SenderDetails;   //Подробности, которые указал отправитель письма

    public function send() {
////        if (!$model->validate($model,$model->get("Form"))) {
////            return FALSE;
////        }

        //Получаем данные, введённые пользователем на сайте:
        $this->SenderName = $this->input->getString(trim('name'));
        $this->SenderPhone = $this->input->getString(trim('phone'));
        $this->SenderEmail = $this->input->getString(trim('email'));
        $this->SenderDetails = $this->input->getString(trim('details'));

        //Создаём письмо для отправки:
        $mailer = JFactory::getMailer();

        $sender = array($this->SenderEmail, $this->SenderName);   //Отправитель в формате Имя <Email>
        $mailer->setSender($sender);

        $jinput = JFactory::getApplication()->input;
        $recipient = $jinput->get('recipient', 'smolensk@print-express99.ru', 'email');
        $mailer->addRecipient($recipient);
        $mailbody = "Имя отправителя: " . $this->SenderName . "\r\n" .
                "Контактный телефон: " . $this->SenderPhone . "\r\n" .
                "Адрес электронной почты: " . $this->SenderEmail . "\r\n" .
                "Текст сообщения (подробности): " . $this->SenderDetails;
        $mailer->setSubject("ЗАЯВКА С САЙТА!");
        $mailer->setBody($mailbody);

        if ($mailer->Send()) {
            $db = JFactory::getDbo();
            
            $formData = array();
            $formData['date'] = $db->quote(JFactory::getDate()->toSql());
            $formData['name'] = $db->quote($this->SenderName);
            $formData['phone'] = $db->quote($this->SenderPhone);
            $formData['email'] = $db->quote($this->SenderEmail);
            $formData['details'] = $db->quote($this->SenderDetails);
            $formData['recipient'] = $db->quote($recipient);
            
            $model = $this->getModel()->save2db($formData);
            echo '<h1>Письмо успешно отправлено</h1>';
        } else {
            echo '<h1>Ошибка отправки письма</h1>';
        }
    }

}
