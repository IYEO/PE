<?php
/**
 * @package     Joomla.Site
 * @subpackage  Template.print-express
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

/*
 * Стиль модуля только для отображения содержимого
 */

function modChrome_pe_none($module, &$params, &$attribs) { 
        if (!empty($module->content)) echo $module->content;    
}

/*
 * Стиль модуля для отображения меню Bootstrap, фиксированного вверху (Fixed to top Navbar)
 */

function modChrome_pe_fixed_navbar($module, &$params, &$attribs) { ?>
    <div class="module<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>" id="top-menu">
        <?php if (!empty($module->content)) echo $module->content; ?>
        
        <?php //Выводим в меню модуль поиска, если он опубликован:
//        $searchModule = JModuleHelper::getModules('search');
//        if (!empty($searchModule)) :
//            jimport( 'joomla.application.module.helper' );
//            $module = JModuleHelper::getModule('finder');
//            $attribs['style'] = 'none';
//            echo JModuleHelper::renderModule( $module, $attribs );
//        endif; ?>
    </div>
    <?php
}

/*
 * Стиль модуля для отображения главного пункта меню Bootstrap (заголовка), включая "Brand" (Navbar Header)
 * Применяется вместе с Navbar
 */

function modChrome_pe_navbar_header($module, &$params, &$attribs) {
    ?>
    <div class="module<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-menu" aria-expanded="false">
            <span class="sr-only"><?php echo JText::_('TPL_PE_MODCHROME_PE_FIXED_NAVBAR_TOGGLE_NAVIGATION'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <?php if (!empty($module->content)) echo $module->content; ?>
    </div>
    <?php
}
