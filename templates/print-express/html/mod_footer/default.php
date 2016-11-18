<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_footer
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

// Добавляем CSS, чтобы подвал был всегда внизу страницы:
JFactory::getDocument()->addScriptDeclaration('
    jQuery(window).ready(function () {
        //jQuery(\'html\').css("position", "relative").css("min-height", "100%");
        jQuery(\'body\').css("margin-bottom", "60px");
    });');
?>
<div class="footer">
    <div class="container">
        <a href="https://vk.com/pe_public" target="_blank">
            <img class="img-responsive navbar-right" src="../../../../uploaded/images/vk.png" title="Наша группа ВКонтакте" alt="Наша группа ВКонтакте" />
        </a>
    </div>
</div>