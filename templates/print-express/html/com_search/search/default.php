<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
JHtml::_('formbehavior.chosen', 'select');  //придаёт нормальный вид элементу select
?>

<div class="container-fluid search<?php echo $this->pageclass_sfx; ?>">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php if ($this->params->get('show_page_heading')) : ?>
                <h1 class="page-title text-center">
                    <?php if ($this->escape($this->params->get('page_heading'))) :?>
                        <?php echo $this->escape($this->params->get('page_heading')); ?>
                    <?php else : ?>
                        <?php echo $this->escape($this->params->get('page_title')); ?>
                    <?php endif; ?>
                </h1>
            <?php endif; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php echo $this->loadTemplate('form'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <?php if ($this->error == null && count($this->results) > 0) :
                echo $this->loadTemplate('results');
            else :
                echo $this->loadTemplate('error');
            endif; ?>
        </div>
    </div>
</div>
