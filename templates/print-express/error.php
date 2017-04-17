<?php
/**
 * @package     Joomla.Site
 * @subpackage  Template.system
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

if (!isset($this->error)) {
    $this->error = JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
    $this->debug = false;
}
jimport('joomla.application.module.helper'); // Подключение вывода модулей из ядра
//get language and direction
$doc = JFactory::getDocument();
// Добавляем data-атрибуты в пункт меню поиска, чтобы корректно работало с помощью collapse:
$doc->addScriptDeclaration('
    jQuery(document).ready(function () {
        jQuery(\'a.search\').attr(\'data-toggle\', \'collapse\');
    });');
$this->language = $doc->language;
$this->direction = $doc->direction;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
    <head>
        <base href="http://jpe:8080/" />
        <meta http-equiv="content-type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="rights" content="© ООО &quot;Принт-Экспресс&quot;, 2017" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link href="/templates/print-express/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />
        <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/template.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $this->baseurl; ?>/templates/print-express/css/system/../../css/home.css" rel="stylesheet" type="text/css" />

        <script src="<?php echo $this->baseurl; ?>/media/jui/js/jquery.min.js" type="text/javascript"></script>
        <script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/respond.js" type="text/javascript"></script>
        <script src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="/media/system/js/html5fallback.js" type="text/javascript"></script>
        <script type="text/javascript">
            jQuery(document).ready(function () {
                jQuery('a.search').attr('data-toggle', 'collapse');
            });
        </script>
        <title><?php echo $this->error->getCode(); ?> - <?php echo $this->title; ?></title>
        <?php
        $debug = JFactory::getConfig()->get('debug_lang');
        if (JDEBUG || $debug) {
            ?>
            <link rel="stylesheet" href="<?php echo $this->baseurl ?>/media/cms/css/debug.css" type="text/css" />
            <?php
        }
        ?>
    </head>
    <body class="error404">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-menu" aria-expanded="false">
                        <span class="sr-only"><?php echo JText::_('TPL_PE_MODCHROME_PE_FIXED_NAVBAR_TOGGLE_NAVIGATION'); ?></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <?php
                    //модуль с брендом компании в Navbar
                    $modules = JModuleHelper::getModules('brand'); // Здесь вводим название модульной позиции
                    foreach ($modules as $module) {
                        echo JModuleHelper::renderModule($module);
                    }
                    ?>
                </div><?php
//              Top Menu
                $modules = JModuleHelper::getModules('top');
                foreach ($modules as $module) {
                    echo JModuleHelper::renderModule($module);
                }
//              Search
                $modules = JModuleHelper::getModules('search');
                foreach ($modules as $module) {
                    echo JModuleHelper::renderModule($module);
                }
                ?>
            </div>
        </nav>

        <div class = "container-fluid">
            <div id="help404" class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 text-center">
                    <span class="fs20">Начните с <a href="<?php echo $this->baseurl; ?>index.php">главной страницы</a> или воспользуйтесь <a href="<?php echo $this->baseurl; ?>index.php/search">поиском</a>.</span>
                </div>
            </div>            
        </div>
    </body>
</html>
