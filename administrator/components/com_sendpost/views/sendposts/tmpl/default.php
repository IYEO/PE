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
                <th width="2%">
                    <?php echo JText::_('COM_SENDPOST_SENDPOSTS_NUM'); ?>
                </th>
                <th width="3%">
                    <?php echo JText::_('COM_SENDPOST_SENDPOSTS_ID'); ?>
                </th>
                <th width="10%">
                    <?php echo JText::_('COM_SENDPOST_SENDPOSTS_DATE'); ?>
                </th>
                <th width="20%">
                    <?php echo JText::_('COM_SENDPOST_SENDPOSTS_NAME'); ?>
                </th>
                <th width="20%">
                    <?php echo JText::_('COM_SENDPOST_SENDPOSTS_PHONE'); ?>
                </th>
                <th width="10%">
                    <?php echo JText::_('COM_SENDPOST_SENDPOSTS_EMAIL'); ?>
                </th>
                <th width="25%">
                    <?php echo JText::_('COM_SENDPOST_SENDPOSTS_DETAILS'); ?>
                </th>
                <th width="10%">
                    <?php echo JText::_('COM_SENDPOST_SENDPOSTS_RECIPIENT'); ?>
                </th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td colspan="8">
                    <?php echo $this->pagination->getListFooter(); ?>
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
                            <?php echo $row->id; ?>
                        </td>
                        <td>
                            <?php echo $row->date; ?>
                        </td>
                        <td>
                            <?php echo $row->name; ?>
                        </td>
                        <td>
                            <?php echo $row->phone; ?>
                        </td>
                        <td>
                            <?php echo $row->email; ?>
                        </td>
                        <td>
                            <?php echo $row->details; ?>
                        </td>
                        <td>
                            <?php echo $row->recipient; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>

    <input type="hidden" name="task" value=""/>    
    <?php echo JHtml::_('form.token'); ?>
</form>