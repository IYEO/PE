<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_search
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

$lang = JFactory::getLanguage();
$upper_limit = $lang->getUpperLimitSearchWord();
?>
<form id="searchForm" action="<?php echo JRoute::_('index.php?option=com_search'); ?>" method="post">
    <div class="form-group">
        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3">
                <div class="input-group input-group-lg">
                    <input type="text" name="searchword" placeholder="<?php echo JText::_('COM_SEARCH_SEARCH_KEYWORD'); ?>" id="search-searchword" size="30" maxlength="<?php echo $upper_limit; ?>" value="<?php echo $this->escape($this->origkeyword); ?>" class="inputbox form-control" />
                    <span class="input-group-btn">
                        <button type="button" name="Search" onclick="this.form.submit()" class="btn btn-primary" title="<?php echo JHtml::tooltipText('COM_SEARCH_SEARCH'); ?>"><span class="glyphicon glyphicon-search"></span> <span class="hidden-xs"><?php echo JText::_('JSEARCH_FILTER_SUBMIT'); ?></span></button>
                    </span>
                </div>
                <?php if (!empty($this->searchword)): ?>
            <span class="help-block">
                <?php echo JText::plural('COM_SEARCH_SEARCH_KEYWORD_N_RESULTS', '<span class="badge">' . $this->total . '</span>'); ?>
            </span>
        <?php endif; ?>
            </div>
        </div>
        <input type="hidden" name="task" value="search" />
        <div class="clearfix"></div>
    </div>

    <?php if ($this->params->get('search_phrases', 1)) : ?>
        <fieldset class="phrases">
            <legend><?php echo JText::_('COM_SEARCH_FOR'); ?>
            </legend>
            <div class="phrases-box">
                <?php echo $this->lists['searchphrase']; ?>
            </div>
            <div class="ordering-box">
                <label for="ordering" class="ordering">
                    <?php echo JText::_('COM_SEARCH_ORDERING'); ?>
                </label>
                <?php echo $this->lists['ordering']; ?>
            </div>
        </fieldset>
    <?php endif; ?>

    <?php if ($this->params->get('search_areas', 1)) : ?>
        <fieldset class="only">
            <legend><?php echo JText::_('COM_SEARCH_SEARCH_ONLY'); ?></legend>
            <?php
            foreach ($this->searchareas['search'] as $val => $txt) :
                $checked = is_array($this->searchareas['active']) && in_array($val, $this->searchareas['active']) ? 'checked="checked"' : '';
                ?>
                <label for="area-<?php echo $val; ?>" class="checkbox">
                    <input type="checkbox" name="areas[]" value="<?php echo $val; ?>" id="area-<?php echo $val; ?>" <?php echo $checked; ?> >
                    <?php echo JText::_($txt); ?>
                </label>
            <?php endforeach; ?>
        </fieldset>
    <?php endif; ?>

    <?php if ($this->total > 0) : ?>
        <div class="form-limit form-group">
            <div class="row">                
                <div class="col-xs-6 col-sm-3 col-md-2 col-lg-2">
                    <label for="limit">
                        <?php echo JText::_('JGLOBAL_DISPLAY_NUM'); ?>
                    </label>
                    <?php echo $this->pagination->getLimitBox(); ?>
                </div>
                <div class="col-xs-6 col-sm-9 col-md-10 col-lg-10">
                    <span class="pull-right text-muted">
                        <?php echo $this->pagination->getPagesCounter(); ?>
                    </span>
                </div>
            </div>
        </div>
    <?php endif; ?>
</form>
