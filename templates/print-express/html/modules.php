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
    /*  Ищем пункт меню с .navbar-brand:
     *  ВАЖНО! Этот пункт меню должен находиться не в одном и том же меню с Navbar, иначе невозможно будет
     *  вывести модуль главной части меню Bootstrap, включая "Brand" (Navbar Header)!
     */
//    $menu = JFactory::getApplication()->getMenu();
//    $items = $menu->getItems("anchor_css", "navbar-brand");
    ?>
<!--    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">-->
            <?php 
//          если пункт меню с CSS-классом "navbar-brand" существует, 
//          загружаем модуль для вывода этого пункта.
//            if (isset($items)) :                 
//                $document = &JFactory::getDocument();
//                $renderer = $document->loadRenderer('modules');
//                $options = array('style' => 'xhtml');
//                $position = 'brand';
//                echo $renderer->render($position, $options, null);
//            else : ?>
<!--                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-menu" aria-expanded="false">
                        <span class="sr-only">//<?php //echo JText::_('TPL_PE_MODCHROME_PE_FIXED_NAVBAR_TOGGLE_NAVIGATION'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>-->
                    <!--<a class="navbar-brand" href="/">//<?php //echo JText::_('TPL_PE_PRINT_EXPRESS'); ?></a>;-->
                <!--</div>--> <?php
//            endif;   ?>
            <div class="module<?php echo htmlspecialchars($params->get('moduleclass_sfx')); ?>" id="top-menu">
                <?php if (!empty($module->content)) echo $module->content; ?>
            </div>
<!--        </div>
    </nav>-->
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
