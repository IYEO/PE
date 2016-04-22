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
 * Стиль модуля для отображения меню Bootstrap, фиксированного вверху (Fixed to top Navbar)
 */

function modChrome_pe_fixed_navbar($module, &$params, &$attribs) {
//    $menu=JFactory::getApplication()->getMenu();
//    $items= $menu->getItems("anchor_css", "navbar-brand");
//    <?php
//                if (isset($items)) {
//                    $menu->load($items);
//                } else {
    ?>
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-menu" aria-expanded="false">
                    <span class="sr-only"><?php echo JText::_('TPL_PE_MODCHROME_PE_FIXED_NAVBAR_TOGGLE_NAVIGATION'); ?></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/"><?php echo JText::_('TPL_PE_PRINT_EXPRESS'); ?></a>;
            </div>

            <div class="module<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?> collapse navbar-collapse" id="top-menu">
                <?php echo $module->content; ?>
            </div>
        </div>
    </nav>
    <?php
}

/*
 * Стиль модуля для отображения пункта меню Bootstrap "Brand" (Brand Navbar)
 * Применяется вместе с Navbar
 */

function modChrome_pe_brand_navbar($module, &$params, &$attribs) {
//    ?>
<!--    <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-menu" aria-expanded="false">
            <span class="sr-only"><?php //echo JText::_('TOGGLE_NAVIGATION'); ?></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        //<?php //echo $module->content; ?>
    </div>-->
    <?php
}
