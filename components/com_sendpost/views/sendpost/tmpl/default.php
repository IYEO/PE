<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_sendpost
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;

JHtml::_('behavior.keepalive');
JHtml::_('behavior.formvalidator');
?>

<div class="sendpost<?php echo $this->pageclass_sfx; ?>">
    <h1><?php // echo $this->header;   ?></h1>

    <form action="<?php echo JRoute::_('index.php?option=com_sendpost&task=sendpost.send'); ?>" method="post" class="form-validate">
        <fieldset>
            <?php foreach ($this->form->getFieldset('sendpost') as $field) : ?>
                <?php if (!$field->hidden) : ?>
                    <div class="form-group">                        
                        <?php echo $field->label; ?>
                        <?php echo $field->input; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
            
            <?php foreach ($this->form->getFieldset('captcha') as $field) : ?>
                <?php if (!$field->hidden) : ?>
                    <div class="form-group">                        
                        <?php echo $field->input; ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-primary validate">
                <?php // echo JText::_('JLOGIN'); ?>
                <?php echo 'Оформить предварительный заказ'; ?>
            </button>
            
            <?php echo JHtml::_('form.token'); ?>
        </fieldset>
    </form>
</div>