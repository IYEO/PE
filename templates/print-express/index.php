<?php
//No direct access:
defined('_JEXEC') or die('Restricted access');

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$menu = $app->getMenu()->getActive();
$pageclass = '';
if (is_object($menu)) {
    $pageclass = $menu->params->get('pageclass_sfx');
}

if($this->countModules('search')) :    //если отображается модуль поиска
    // Добавляем data-атрибуты в пункт меню поиска, чтобы корректно работало с помощью collapse:
    JFactory::getDocument()->addScriptDeclaration('
        jQuery(document).ready(function () {
            jQuery(\'a.search\').attr(\'data-toggle\', \'collapse\');
        });');
endif;
?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
    <head>
        <jdoc:include type="head" />
        <?php        
        $doc->setGenerator(""); //remove "Joomla! - Open Source Content Management" from <head>
        $doc->setMetaData("X-UA-Compatible", "IE=edge", TRUE);
        $doc->setMetaData("viewport", "width=device-width, initial-scale=1", FALSE);        
        JHtml::stylesheet('template.css', array(), TRUE);   //add Bootstrap stylesheet (v.3.3.6)        
        JHtml::script('respond.js', FALSE, TRUE);     //add Respond.js for IE8 users
        JHtml::_('jquery.framework');   //add JQuery
        JHtml::script('bootstrap.min.js', FALSE, TRUE);     //add Bootstrap .js (v.3.3.5)        
        ?>
    </head>
    <body>
        <?php if($this->countModules('top')) :      //если отображается модуль с Navbar ?>
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-menu" aria-expanded="false">
                            <span class="sr-only"><?php echo JText::_('TPL_PE_MODCHROME_PE_FIXED_NAVBAR_TOGGLE_NAVIGATION'); ?></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <jdoc:include type="modules" name="brand" style="none" />   <?php   //модуль с брендом компании в Navbar ?>
                    </div><?php
//                  Top Menu          ?>
                    <jdoc:include type="modules" name="top" style="none" /><?php
//                  Search          ?>
                    <jdoc:include type="modules" name="search" style="none" />                    
                </div>
            </nav>
        <?php endif;

//      Breadcrumbs        ?>
        <jdoc:include type="modules" name="breadcrumbs" style="none" />
        <?php

//      Content        ?>
        <jdoc:include type="message" />

        <jdoc:include type="modules" name="carousel" style="none" />    <?php  //модуль "Carousel" для показа слайд-шоу ?>
        <jdoc:include type="component" />
        <?php

//      Footer      ?>
        <jdoc:include type="modules" name="footer" style="none" />
        <?php

//      Debug        ?>
        <jdoc:include type="modules" name="debug" style="none" />
    </body>
</html>