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

<form action="index.php?option=com_sendpost&view=sendposts" method="post" id="adminForm" name="adminForm">
    <table class="table table-striped table-hover">
        <thead>
            <tr>
                <th width="1%"><?php echo JText::_('COM_SENDPOST_NUM'); ?></th>
                <th width="2%">
                    <?php echo JHtml::_('grid.checkall'); ?>
                </th>
                <th width="90%">
                    <?php echo JText::_('COM_SENDPOST_SENDPOSTS_NAME'); ?>
                </th>
                <th width="2%">
                    <?php echo JText::_('COM_SENDPOST_ID'); ?>
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="5">
                    <?php //echo $this->pagination->getListFooter(); ?>
                </td>
            </tr>
        </tfoot>
        <tbody>
            <?php if (!empty($this->items)) : ?>
                <?php
                foreach ($this->items as $i => $row) :
                    $link = JRoute::_('index.php?option=com_sendpost&task=sendpost.edit&id=' . $row->id);
                    ?>
                    <tr>
                        <td>
                            <?php echo $this->pagination->getRowOffset($i); ?>
                        </td>
                        <td>
                            <?php echo JHtml::_('grid.id', $i, $row->id); ?>
                        </td>
                        <td>
                            <a href="<?php echo $link; ?>" title="<?php echo JText::_('COM_SENDPOST_EDIT_SENDPOST'); ?>">
                                <?php echo $row->recipient; ?>
                            </a>
                        </td>
                        <td align="center">
                            <?php echo $row->id; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <input type="hidden" name="task" value=""/>
    <input type="hidden" name="boxchecked" value="0"/>
    <?php echo JHtml::_('form.token'); ?>
</form>


<!--    <form action="index.php?option=com_sendpost&view=sendpost" method="post" id="adminForm" name="adminForm">
        <div class="form-group">
            <fieldset class="adminform">
                <label for="RecipientEmail"><?php //echo JText::_('COM_SENDPOST_ADMIN_RECIPIENT_EMAIL');     ?></label>
                <input type="email" class="form-control" id="RecipientEmail" placeholder="<?php //echo JText::_('COM_SENDPOST_ADMIN_RECIPIENT_EMAIL_PLACEHOLDER');     ?>">
            </fieldset>
        </div>
    </form>-->