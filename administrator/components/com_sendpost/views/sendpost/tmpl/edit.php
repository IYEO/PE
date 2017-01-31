<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_sendpost
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die('Restricted Access');
?>

<div class="col-sm-12 col-md-12 col-lg-12">
    <form action="<?php echo JRoute::_('index.php?option=com_sendpost&layout=edit&id=' . (int) $this->item->id); ?>" method="post" name="adminForm" id="adminForm">
        <div class="form-horizontal">
            <fieldset class="adminform">                
                <div class="row-fluid">
                    <div class="span6">
                        <?php foreach ($this->form->getFieldset() as $field): ?>
                            <div class="control-group">
                                <div class="control-label"><?php echo $field->label; ?></div>
                                <div class="controls"><?php echo $field->input; ?></div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </fieldset>
        </div>
        <input type="hidden" name="task" value="sendpost.edit" />
        <?php echo JHtml::_('form.token'); ?>
    </form>


<!--    <form action="index.php?option=com_sendpost&view=sendpost" method="post" id="adminForm" name="adminForm">
        <div class="form-group">
            <fieldset class="adminform">
                <label for="RecipientEmail"><?php //echo JText::_('COM_SENDPOST_ADMIN_RECIPIENT_EMAIL'); ?></label>
                <input type="email" class="form-control" id="RecipientEmail" placeholder="<?php //echo JText::_('COM_SENDPOST_ADMIN_RECIPIENT_EMAIL_PLACEHOLDER'); ?>">
            </fieldset>            
        </div>        
    </form>-->
</div>