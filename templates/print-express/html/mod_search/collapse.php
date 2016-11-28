<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_search
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

// Including fallback code for the placeholder attribute in the search field.
//JHtml::script('respond.js', FALSE, TRUE);     //add Respond.js for IE8 users
JHtml::_('jquery.framework');
//JHtml::script('bootstrap.min.js', FALSE, TRUE);     //add Bootstrap .js (v.3.3.5)
JHtml::_('script', 'system/html5fallback.js', false, true);
//JHtml::_('behavior.formvalidator');

if ($width) {
    $moduleclass_sfx .= ' ' . 'mod_search' . $module->id;
    $css = 'div.mod_search' . $module->id . ' input[type="search"]{ width:auto; }';
    JFactory::getDocument()->addStyleDeclaration($css);
    $width = ' size="' . $width . '"';
} else {
    $width = '';
}
?>
<div id="search" class="search<?php echo $moduleclass_sfx ?>">
    <form action="<?php echo JRoute::_('index.php'); ?>" method="post" role="search" class="form-validate">
        <div class="form-group">
            <div class="input-group input-group-lg">
                <span class="input-group-btn">
                    <a id="closeSearch" href="#search" role="button" class="close" data-toggle="collapse"><span aria-hidden="true" title="Закрыть">&times;</span></a>
                </span>
<?php
$output = '<label for="mod-search-searchword" class="hidden sr-only">' . $label . '</label> ';
$output .= '<input name="searchword" id="mod-search-searchword" maxlength="' . $maxlength . '"  class="required  inputbox search-query form-control" type="search"' . $width;
$output .= ' placeholder="' . $text . '" />';

if ($button) :
    if ($imagebutton) :
        $btn_output = ' <input type="image" alt="' . $button_text . '" class="button" src="' . $img . '" onclick="this.form.searchword.focus();"/>';
    else :
        $btn_output = ' <span class="input-group-btn"><button class="button btn btn-primary validate" onclick="this.form.searchword.focus();"><span class="glyphicon glyphicon-search"></span>' . $button_text . '</button></span>';
    endif;

    switch ($button_pos) :
        case 'top' :
            $output = $btn_output . '<br />' . $output;
            break;

        case 'bottom' :
            $output .= '<br />' . $btn_output;
            break;

        case 'right' :
            $output .= $btn_output;
            break;

        case 'left' :
        default :
            $output = $btn_output . $output;
            break;
    endswitch;
endif;

echo $output;
?>
            </div>
            <input type="hidden" name="task" value="search" />
            <input type="hidden" name="option" value="com_search" />
            <input type="hidden" name="Itemid" value="<?php echo $mitemid; ?>" />
        </div>
    </form>
</div>
