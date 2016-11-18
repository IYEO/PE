<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_sendpost
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

?>
<form action="<?php echo JRoute::_('index.php?option=com_sendpost&task=sendpost.send'); ?>" method="post" class="form-validate well">

		<fieldset>
			<?php foreach ($this->form->getFieldset('sendpost') as $field) : ?>
				<?php if (!$field->hidden) : ?>
					<div class="control-group">
						<div class="control-label">
							<?php echo $field->label; ?>
						</div>
						<div class="controls">
							<?php echo $field->input; ?>
						</div>
					</div>
				<?php endif; ?>
			<?php endforeach; ?>

			<?php if ($this->tfa): ?>
				<div class="control-group">
					<div class="control-label">
						<?php echo $this->form->getField('secretkey')->label; ?>
					</div>
					<div class="controls">
						<?php echo $this->form->getField('secretkey')->input; ?>
					</div>
				</div>
			<?php endif; ?>

			<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
			<div  class="control-group">
				<div class="control-label"><label><?php echo JText::_('COM_USERS_LOGIN_REMEMBER_ME') ?></label></div>
				<div class="controls"><input id="remember" type="checkbox" name="remember" class="inputbox" value="yes"/></div>
			</div>
			<?php endif; ?>

			<div class="control-group">
				<div class="controls">
					<button type="submit" class="btn btn-primary">
						<?php echo JText::_('JLOGIN'); ?>
					</button>
				</div>
			</div>

			<?php if ($this->params->get('login_redirect_url')) : ?>
				<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_url', $this->form->getValue('return'))); ?>" />
			<?php else : ?>
				<input type="hidden" name="return" value="<?php echo base64_encode($this->params->get('login_redirect_menuitem', $this->form->getValue('return'))); ?>" />
			<?php endif; ?>
			<?php echo JHtml::_('form.token'); ?>
		</fieldset>
	</form>