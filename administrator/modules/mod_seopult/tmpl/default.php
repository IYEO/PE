<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  mod_quickicon
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JHtml::_('behavior.modal');
//$html = JHtml::_('icons.buttons', $buttons);




$html = '<div class="row-fluid">
<div class="span12">
<a href="'.Jroute::_('index.php?option=com_seopult').'">
<i class="icon-vcard"></i>
<span>SEOPULT</span>
</a>
</div>
</div>';
?>
<?php if (!empty($html)): ?>
<div class="row-striped">
    <?php echo $html;?>
</div>
<?php endif;?>
