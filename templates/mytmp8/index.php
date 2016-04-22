<?php

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();

// Добавить JavaScript Фреймворк Bootsrap
JHtml::_('bootstrap.framework');

// Добавить CSS файлы Фреймворка Bootsrap
JHtml::_( 'bootstrap.loadCss' );

// Подключение файла стилей шаблона
$doc->addStyleSheet('templates/'.$this->template.'/css/template.css');
?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <jdoc:include type="head" />
</head>
<body>
<div class="container">

    <div class="span12">
        <jdoc:include type="modules" name="position-1" style="none" />
    </div>
    <div class="row-fluid">
    
        <div class="span6">
        <!-- Имя сайта -->
            <h1> 
	             <?php echo $app->getCfg('sitename');?> 
            </h1>
        </div>
        <div class="span6">
            <jdoc:include type="modules" name="position-0" style="none" />
        </div>
    
    </div>
    
    <div class="row-fluid">
    
        <div class="span3">
            <jdoc:include type="modules" name="position-8" style="none" />
        </div>
        <div class="span6">
            <!-- Контент -->
				<jdoc:include type="modules" name="position-3" style="none" />
				<jdoc:include type="message" />
				<jdoc:include type="component" />
				<jdoc:include type="modules" name="position-2" style="none" />
				<!-- Конец контент -->
        </div>
        <div class="span3">
            <jdoc:include type="modules" name="position-7" style="none" />
        </div>
    
    </div>
    
    <div class="row-fluid">
    
        <div class="span6">
            <p><a href="#top" id="back-top"><?php echo JText::_('TPL_MYTMP8_BACKTOTOP'); ?></a></p>
        </div>
        <div class="span6">
            <jdoc:include type="modules" name="position-footer" style="none" />
        </div>
    
    </div>

</div>
</body>
</html>
