<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$msgList = $displayData['msgList'];

?>
<div id="system-message-container">
	<?php if (is_array($msgList) && !empty($msgList)) : ?>
		<div id="system-message">
			<?php foreach ($msgList as $type => $msgs) : ?>
				<div class="alert alert-<?php echo getMatchedCode($type); ?> alert-dismissible" role="alert">
					<?php // This requires JS so we should add it trough JS. Progressive enhancement and stuff. ?>
					<button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
					    <span aria-hidden="true">&times;</span>
                    </button>

					<?php if (!empty($msgs)) : ?>
						<!--<h4 class="alert-heading"><?php echo JText::_($type); ?></h4>
						<div>-->
							<?php foreach ($msgs as $msg) : ?>
								<p><?php echo $msg; ?></p>
							<?php endforeach; ?>
						<!--</div>-->
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
</div>

<?php
/* This function translates Joomla message types to Boostrap 3.0 message types*/
function getMatchedCode($code){
    $txt = null;    
    switch($code){
        case 'warning': 
            $txt = 'warning'; break;
        case 'notice': 
            $txt = 'info'; break;
        case 'error': 
            $txt = 'danger'; break;
        case 'message': 
            $txt = 'success'; break;
        default:
            $txt = 'success'; break;
    }    
    return $txt;
} ?>