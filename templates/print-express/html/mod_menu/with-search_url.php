<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_menu
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

// Note. It is important to remove spaces between elements.
$IconClass = "glyphicon";
$IconSpan = '';
$class = $item->anchor_css ? 'class="' . $item->anchor_css . '" ' : '';
//Проверка на наличие иконок (класс иконок должен быть введён последним в поле "CSS-класс ссылки"):
if (substr_count(trim($item->anchor_css), $IconClass) > 0) {
    $class = 'class="' . trim(substr(trim($item->anchor_css), 0, stripos(trim($item->anchor_css), $IconClass))) . '"';
    $IconSpan = '<span class="' . substr(trim($item->anchor_css), stripos(trim($item->anchor_css), $IconClass), strlen(trim($item->anchor_css)) - stripos(trim($item->anchor_css), $IconClass)) . '" aria-hidden="true"></span> ';
}
$title = $item->anchor_title ? 'title="' . $item->anchor_title . '" ' : '';
$rel = $item->anchor_rel ? 'rel="' . $item->anchor_rel . '" ' : '';

if ($item->menu_image) {
    $item->params->get('menu_text', 1) ?
                    $linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" /><span class="image-title">' . $item->title . '</span> ' :
                    $linktype = '<img src="' . $item->menu_image . '" alt="' . $item->title . '" />';
} else {
    $item->params->get('menu_text', 1) ?
        $linktype = $item->title :
        $linktype = "";
//    $linktype = $item->title;
}

$flink = $item->flink;
$flink = JFilterOutput::ampReplace(htmlspecialchars($flink));

$data_toggle = $item->deeper ? 'data-toggle="dropdown"' : '';

switch ($item->browserNav) :
    default:
    case 0:
        ?><a <?php echo $class; ?>href="<?php echo $item->deeper ? '#' : $item->flink; ?>" <?php echo $data_toggle; ?> <?php echo $title . $rel; ?>><?php echo $IconSpan; ?><?php echo $linktype; ?><?php echo $data_toggle !== '' ? '<b class="caret"></b>' : '' ?></a><?php
        break;
    case 1:
        // _blank
        ?><a <?php echo $class; ?>href="<?php echo $flink; ?>" target="_blank" <?php echo $title; ?>><?php echo $IconSpan; ?><?php echo $linktype; ?></a><?php
        break;
    case 2:
        // Use JavaScript "window.open"
        $options = 'toolbar=no,location=no,status=no,menubar=no,scrollbars=yes,resizable=yes,' . $params->get('window_open');
        ?><a <?php echo $class; ?>href="<?php echo $flink; ?>" onclick="window.open(this.href, 'targetWindow', '<?php echo $options; ?>');
                                        return false;" <?php echo $title; ?>><?php echo $linktype; ?></a><?php
        break;
endswitch;
