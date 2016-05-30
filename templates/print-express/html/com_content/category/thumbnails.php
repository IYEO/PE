<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

//JHtml::_('behavior.caption');
?>

<div class="<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Blog" data-spy="affix">
    <?php if ($this->params->get('show_page_heading')) : ?>
        <div class="page-header">
            <h1> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
        </div>
    <?php endif; ?>

    <?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
        <h2> <?php echo $this->escape($this->params->get('page_subheading')); ?>
            <?php if ($this->params->get('show_category_title')) : ?>
                <span class="subheading-category"><?php echo $this->category->title; ?></span>
            <?php endif; ?>
        </h2>
    <?php endif; ?>

    <?php if ($this->params->get('show_cat_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
        <?php $this->category->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
        <?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
    <?php endif; ?>

    <?php if ($this->params->get('show_description', 1) || $this->params->def('show_description_image', 1)) : ?>
        <div class="category-desc clearfix">
            <?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
                <img src="<?php echo $this->category->getParams()->get('image'); ?>" alt="<?php echo htmlspecialchars($this->category->getParams()->get('image_alt')); ?>"/>
            <?php endif; ?>
            <?php if ($this->params->get('show_description') && $this->category->description) : ?>
                <?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <?php if (empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items)) : ?>
        <?php if ($this->params->get('show_no_articles', 1)) : ?>
            <p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
        <?php endif; ?>
    <?php endif; ?>



    <?php $leadingcount = 0; ?>
    <?php if (!empty($this->lead_items)) : ?>
        <div class="row">
            <div class="items-leading col-xs-12 col-sm-12 col-md-12 col-lg-12 clearfix">
                <?php foreach ($this->lead_items as &$item) : ?>
                    <div class="leading-<?php echo $leadingcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
                         itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
                             <?php
                             $this->item = & $item;
                             echo $this->loadTemplate('item');
                             ?>
                    </div>
                    <?php $leadingcount++; ?>
                <?php endforeach; ?>
            </div><!-- end items-leading -->
        </div>
    <?php endif; ?>

    <?php //Получаем количество материалов в подкатегориях:
        foreach ($this->children[$this->category->id] as $key => $subCat) {
            $subCatNumItems[$subCat->id] = $subCat->getNumItems();
        }
    ?>

    <?php
    $introcount = (count($this->intro_items));
    $counter = 0;
    $previousSubCatId = 0;     //ID предыдущей подкатегории
    $inGroupCounter = 0;    //количество материалов в подгруппе
    ?>

    <?php if (!empty($this->intro_items)) : ?>
        <?php foreach ($this->intro_items as $key => &$item) : ?>
            <?php //Получаем родительскую категорию конкретного материала (подкатегорию категории "Продукция"):
                $categories = JCategories::getInstance('Content');
                $child = $categories->get($item->catid);

                //Выводим заголовок подкатегории, если ID категории текущего материала не совпадает с ID категории предыдущего выведенного материала:
                if ($item->catid <> $previousSubCatId) : ?>
                    <?php
                    if ($previousSubCatId <> 0) :
                        $inGroupCounter = 0;
                    endif;
                    $previousSubCatId = $item->catid;
                    $rowcount = 1;
                    ?>
                    <div class="row-fluid">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <?php if ($lang->isRtl()) : ?>
                                <h2 class="page-header item-title">
                                    <?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
                                        <span class="badge badge-info tip hasTooltip" title="<?php echo JHtml::tooltipText('COM_CONTENT_NUM_ITEMS'); ?>">
                                            <?php echo $child->getNumItems(true); ?>
                                        </span>
                                    <?php endif; ?>
                                    <a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id)); ?>">
                                    <?php echo $this->escape($child->title); ?></a>
                                </h2>
                                <?php else : ?>
                                <h2 class="page-header item-title"><a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($child->id));?>">
                                    <?php echo $this->escape($child->title); ?></a>
                                    <?php if ( $this->params->get('show_cat_num_articles', 1)) : ?>
                                        <span class="badge badge-info tip hasTooltip" title="<?php echo JHtml::tooltipText('COM_CONTENT_NUM_ITEMS'); ?>">
                                            <?php echo JText::_('COM_CONTENT_NUM_ITEMS'); ?>&nbsp;
                                            <?php echo $child->getNumItems(true); ?>
                                        </span>
                                    <?php endif; ?>
                                </h2>
                                <?php endif;?>
                        </div>
                    </div>
                <?php else :
                    $rowcount = ((int) $inGroupCounter % (int) $this->columns) + 1;
                endif; ?>
            <?php if ($rowcount == 1) : ?>                
                <div class="items-row row-fluid">
            <?php endif; ?>
                <div class="col-xs-12 col-sm-6 col-md-<?php echo round((12 / $this->columns)); ?> col-lg-<?php echo round((12 / $this->columns)); ?>">
                    <div class="item column-<?php echo $rowcount; ?><?php echo $item->state == 0 ? ' system-unpublished' : null; ?> thumbnail"
                         itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
                             <?php
                             $this->item = & $item;
                             echo $this->loadTemplate('item');
                             ?>
                    </div>
                    <!-- end item -->
                    <?php 
                    $counter++;
                    $inGroupCounter ++;
                    ?>
                </div><!-- end col -->
                <?php if (!empty($subCatNumItems) and ($subCatNumItems[$item->catid] <>0 )) :
                    if (($rowcount == $this->columns) or ( $counter == $introcount) or ($inGroupCounter == $subCatNumItems[$item->catid])) : ?>
                        </div><!-- end row -->
                    <?php endif; 
                else : 
                     if (($rowcount == $this->columns) or ( $counter == $introcount)) : ?>
                        </div><!-- end row -->
                    <?php endif; ?>
                <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php if (!empty($this->link_items)) : ?>
        <div class="items-more">
            <?php echo $this->loadTemplate('links'); ?>
        </div>
    <?php endif; ?>

    <?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
        <div class="pagination">
            <?php if ($this->params->def('show_pagination_results', 1)) : ?>
                <p class="counter pull-right"> <?php echo $this->pagination->getPagesCounter(); ?> </p>
            <?php endif; ?>
            <?php echo $this->pagination->getPagesLinks(); ?> </div>
    <?php endif; ?>
</div>
