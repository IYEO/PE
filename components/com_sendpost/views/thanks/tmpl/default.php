<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_sendpost
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access to this file
defined('_JEXEC') or die;
//JHtml::stylesheet('home.css', array(), TRUE);   //добавляем CSS для формирования фона страницы
?>
<div class="thanks container-fluid">
    <!--<div class="jumbotron">-->
        <div class="text-center">
            <p class="lead"><?php echo JText::plural("COM_SENDPOST_THANKS_TITLE", ucfirst($this->SenderName)); ?></p>
        </div>
        <div class="row">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <p class="lead text-lending">                    
                </p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-xs-12 col-sm-4 col-md-2 col-md-offset-3 col-lg-2 col-lg-offset-3">
                <a href="index.php/promo" class="thanks-link">
                    <span class="glyphicon glyphicon-gift fs50"></span>
                    <p>Акции</p>
                </a>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
                <a href="index.php/products" class="thanks-link">
                    <span class="glyphicon glyphicon-book fs50"></span>
                    <p>Продукция</p>
                </a>
            </div>
            <div class="col-xs-12 col-sm-4 col-md-2 col-lg-2">
                <a href="index.php/services" class="thanks-link">
                    <span class="glyphicon glyphicon-print fs50"></span>
                    <p>Услуги</p>
                </a>
            </div>
        </div>
    <!--</div>-->
</div>