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
    <?php if ($this->params->get('show_page_heading') != 0) : ?>
        <div class="page-header">
            <h1>
                <?php echo $this->escape($this->params->get('page_heading')); ?>
            </h1>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-12">
            <p class="text-justify"><?php echo JText::_("COM_SENDPOST_FORM_DEFAULT_LABEL") ?></p>
        </div>
        <div class="col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
            <form id="sendpost" action="<?php echo JRoute::_('index.php?option=com_sendpost&task=sendpost.send'); ?>" method="post" class="form-validate">
                <fieldset>
                    <?php foreach ($this->form->getFieldset('sendpost') as $field) : ?>
                        <div class="form-group has-feedback">
                            <?php echo $field->label; ?>
                            <?php echo $field->input; ?>
                            <?php if ($field->fieldname == "captcha") : ?>                                
                                    <span class="help-block">
                                        <?php echo JText::plural('COM_SENDPOST_FORM_REQUIRED_FIELDS_HELP_TEXT', '<span class="glyphicon glyphicon-asterisk"></span>'); ?>
                                    </span>
                            <?php endif; ?>                            
                        </div>
                    <?php endforeach; ?>
                </fieldset>
                <div class="form-group">
                    <input type="reset" class="btn btn-default" value="Очистить поля">
                    <button type="submit" class="btn btn-primary validate pull-right">
                        <span class="glyphicon glyphicon-plane"></span>
                        <?php echo JText::_("COM_SENDPOST_FORM_SUBMIT_BUTTON_TEXT"); ?>
                    </button>

                    <input type="hidden" name="option" value="com_sendpost" />
                    <input type="hidden" name="task" value="sendpost.send" />
                </div>
                <?php echo JHtml::_('form.token'); ?>
            </form>
        </div>
    </div>
</div>