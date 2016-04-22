<?php
//No direct access:
defined('_JEXEC') or die('Restricted access');

$app = JFactory::getApplication();
$params = JFactory::getApplication()->getTemplate(true)->params;
$doc = JFactory::getDocument();
/* $this->language = $doc->language;
  $this->direction = $doc->direction; */

$menu = $app->getMenu()->getActive();
$pageclass = '';
if (is_object($menu)) {
    $pageclass = $menu->params->get('pageclass_sfx');
}
?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
    <head>
        <jdoc:include type="head" />
        <?php
        $doc->setGenerator(""); //remove from <head> "Joomla! - Open Source Content Management"
        $doc->setMetaData("X-UA-Compatible", "IE=edge", TRUE);
        $doc->setMetaData("viewport", "width=device-width, initial-scale=1", FALSE);
        JHtml::stylesheet('template.css', array(), TRUE);   //add Bootstrap stylesheet (v.3.3.6)
        JHtml::script('respond.js', FALSE, TRUE);     //add Respond.js for IE8 users
        JHtml::_('jquery.framework');   //add JQuery
        JHtml::script('bootstrap.min.js', FALSE, TRUE);     //add Bootstrap .js (v.3.3.5)
        ?>
    </head>
    <body>
        <!--<jdoc:include type="modules" name="brand" style="none" />-->
        <jdoc:include type="modules" name="top" style="none" />


        <!--Breadcrumbs-->
        <!--            <div class="row">-->
        <jdoc:include type="modules" name="breadcrumbs" style="none" />
        <!--            </div>-->
        <!--Content-->
        <!--            <div class="row">-->
        <jdoc:include type="message" />
        <jdoc:include type="component" />
        <!--            </div>-->

        <!--Footer-->
        <!--            <footer>
                        <div class="row">
                            <div class="col-md-12">
                                <jdoc:include type="modules" name="footer" style="none" />
                            </div>
                        </div>
                    </footer>-->
        <jdoc:include type="modules" name="footer" style="none" />
        <!--        </div>-->
        <jdoc:include type="modules" name="debug" style="none" />
    </body>
</html>