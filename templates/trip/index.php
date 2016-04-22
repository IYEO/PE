<?php
//Чтобы убедиться, что к файлу не обращаются напрямую, из соображений безопасности:
	defined('_JEXEC') or die;
	JHtml::_('behavior.framework', true);
	$app=JFactory::getApplication();
?>
<?php echo "<?";?>xml version='1.0' encoding="<?php echo $this->_charset ?>"?>
<!DOCTYPE hthtml PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!--Извлекаем установленный язык из глобальной конфигурации Joomla:-->
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language;?>" lang="<?php echo $this->language; ?>"
dir="<?php echo $this->direction; ?>">
<head>
	<jdoc:include type="head"/>	<!--фрагмент кода, который включает дополнительную информацию для заголовка, которая задана в глобальной конфигурации Joomla-->
	<!--Cсылки на основные CSS стили Joomla:-->
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/system.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/system/css/general.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/menu.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
	<?php
		if($this->countModules('left and right')==0) $contentwidth = "100";	//если правая и левая колонки шаблона свёрнуты, то ширина контента занимает 100% ширины (950px)
		if($this->countModules('left or right')==1) $contentwidth = "80";	//если включена только одна колонка, то контент занимает 80% ширины
		if($this->countModules('left and right')==1) $contentwidth = "60"	//при двух включенных колонках на контент приходится 60% ширины страницы.
	?>
</head>
<body>
	<div id="page">
		<div id="top">
			<div id="logo">
				<h1><?php echo $app->getCfg('sitename');?></h1>	<!--автоматический вывод названия сайта помещаем в тег H1, что очень важно для поисковой оптимизации-->				
			</div>
			<div id="user1">
					<jdoc:include type="modules" name="user1" style="xhtml" />	<!--определяем позицию «user1» в одноименном блоке для вывода модуля поиска по сайту-->
			</div>
		</div>
		<!--Вывод модуля горизонтального меню в блоке «user2» в позиции «user2». Блок будет сворачиваться, если в этой позиции не будет модуля:-->
		<?php if($this->countModules('user2')):?>
			<div id="user2">
				<jdoc:include type="modules" name="user2" style="xhtml"/>	
			</div>
		<?php endif;?>
		<!--Определяем позицию «header» для вывода модулей. Блок будет сворачиваться, если в этой позиции не будет модуля.
			В нём можно размещать не только картинки, но и ротаторы изображений-->
		<?php if($this->countModules('header')) : ?>
			<div id="header">
				<jdoc:include type="modules" name="header" style="xhtml"/>
			</div>			
		<?php endif;?>
		<!--В блоке «user3» определим позицию «user3» для вывода модулей. Блок будет сворачиваться, если в позиции «user3» не будет выводится модуль:-->
		<?php if($this->countModules('user3')) : ?>
			<div id="user3">
				<jdoc:include type="modules" name="user3" style="xhtml"/>
			</div>
		<?php endif;?>
		<!--Блок левой колонки, которая будет сворачиваться, если в позиции «left» не будет ни одного модуля:-->
		<?php if($this->countModules('left')) : ?>
			<div id="left">
				<jdoc:include type="modules" name="left" style="xhtml"/>
			</div>
		<?php endif;?>
		<!--Самый важный блок контента, который может занимать 100% ширины страницы, 80% или 60%, в зависимости от количества включенных колонок:-->
		<div id="content<?php echo $contentwidth;?>">
			<jdoc:include type="message"/>	<!--вывод сообщений в компонентах-->
			<jdoc:include type="component" style="xhtml"/>	<!--вывод содержимого контента-->			
		</div>
		<!--Блок правой колонки, которая будет сворачиваться, если в позиции «rigth» не будет ни одного модуля:-->
		<?php if($this->countModules('right')) : ?>
			<div id="right">
				<jdoc:include type="modules" name="right" style="xhtml"/>
			</div>
		<?php endif;?>
		<!--Вывод блока «footer», предназначенного для вывода модуля «HTML код» с информацией об авторских правах. 
			Можно также разместить здесь нижнее горизонтальное меню или модуль представления контента. 
			Блок будет сворачиваться, если в этой позиции «footer» не будет выводится не один модуль-->
		<?php if($this->countModules('footer')) : ?>
			<div id="footer">
				<jdoc:include type="modules" name="footer" style="xhtml"/>
			</div>
		<?php endif;?>
	</div>		
</body>
</html>
