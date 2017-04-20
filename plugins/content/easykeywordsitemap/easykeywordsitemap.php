<?php
/**
 * @Copyright
 * @package        EKS - Easy Keyword Sitemap for Joomla! 3.x
 * @author         Viktor Vogel <admin@kubik-rubik.de>
 * @version        3.3.1 - 2016-03-30
 * @link           https://joomla-extensions.kubik-rubik.de/eks-easy-keyword-sitemap
 *
 * @license        GNU/GPL
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
defined('_JEXEC') or die('Restricted access');

use Joomla\String\StringHelper;
use Joomla\Registry\Registry;

/**
 * Class plgContentEasyKeywordSitemap
 *
 * Creates a semantic keyword sitemap
 */
class PlgContentEasyKeywordSitemap extends JPlugin
{
	protected $eks_parameters;

	/**
	 * PlgContentEasyKeywordSitemap constructor.
	 *
	 * @param object $subject
	 * @param array  $config
	 */
	function __construct(&$subject, $config)
	{
		// Not in administration
		$app = JFactory::getApplication();

		if($app->isAdmin())
		{
			return;
		}

		parent::__construct($subject, $config);
		$this->loadLanguage('', JPATH_ADMINISTRATOR);
	}

	/**
	 * Plugin is executed by the trigger onContentPrepare
	 *
	 * @param string   $context
	 * @param object   $article
	 * @param Registry $params
	 * @param integer  $limitstart
	 */
	function onContentPrepare($context, &$article, &$params, $limitstart)
	{
		if(strpos($context, 'com_content') === false OR strpos($article->text, '{eks}') === false)
		{
			return;
		}

		if(preg_match_all('@{eks}(.*){/eks}@isU', $article->text, $matches, PREG_PATTERN_ORDER) > 0)
		{
			foreach($matches[1] as $key => $match)
			{
				if(!empty($match))
				{
					$this->eks_parameters = array();
					$eks_parameters_temp = explode('|', $match);

					foreach($eks_parameters_temp as $eks_parameter_temp)
					{
						if(preg_match('@=@', $eks_parameter_temp))
						{
							$eks_parameter_temp = explode('=', $eks_parameter_temp);

							if(preg_match('@,@', $eks_parameter_temp[1]))
							{
								$eks_parameter_temp[1] = array_map(array($this, 'mb_trim'), explode(',', $eks_parameter_temp[1]));

								if($eks_parameter_temp[0] == 'keyword' OR $eks_parameter_temp[0] == 'nokeyword')
								{
									$eks_parameter_temp[1] = array_map('strtolower', $eks_parameter_temp[1]);
								}
							}

							$this->eks_parameters[$eks_parameter_temp[0]] = $eks_parameter_temp[1];
						}
						else
						{
							$this->eks_parameters[$eks_parameter_temp] = true;
						}
					}
				}

				if(!empty($this->eks_parameters['cache']))
				{
					$html = $this->loadCacheFile($match);
				}

				if(empty($html))
				{
					$html_replace = '<h2>Easy Keyword Sitemap</h2><p>'.JTEXT::_('PLG_EASYKEYWORDSITEMAP_NOARTICLLESFOUND').'</p>';

					$articles = $this->articlesData();

					if(!empty($articles))
					{
						$output_data = $this->keywordsData($articles);

						if(!empty($output_data))
						{
							$html_replace = '';

							if(!empty($this->eks_parameters['alpha']))
							{
								$alpha_index = $this->createAlphaIndex($output_data, $key);

								$html_replace .= $alpha_index[0];
							}

							foreach($output_data as $keyword => $output_values)
							{
								if(!empty($alpha_index[1]))
								{
									$keyword_first_char = $this->firstCharAlphaIndex($keyword);

									if(in_array($keyword_first_char, $alpha_index[1]))
									{
										$html_replace .= '<a id="eks_'.StringHelper::strtolower($keyword_first_char).'_'.$key.'"></a>';

										$alpha_index_key = array_search($keyword_first_char, $alpha_index[1]);
										unset($alpha_index[1][$alpha_index_key]);
									}
								}

								$html_replace .= '<h2>'.$keyword.'</h2>';
								$html_replace .= '<ul>';

								foreach($output_values as $output_value)
								{
									$html_replace .= '<li><a href="'.$output_value->link.'" title="'.$output_value->title.'">'.$output_value->title.'</a>';

									if(!empty($this->eks_parameters['teaser']) AND !empty($output_value->metadesc))
									{
										$html_replace .= '<br /><span class="eks_teaser">'.$output_value->metadesc.'</span>';
									}

									$html_replace .= '</li>';
								}

								$html_replace .= '</ul>';
							}
						}
					}

					// Start the output
					$html = '<!-- Easy Keyword Sitemap - Kubik-Rubik Joomla! Extensions - Viktor Vogel --><div class="eks">'.$html_replace.'</div>';

					if(!empty($this->eks_parameters['cache']))
					{
						$this->writeCacheFile($match, $html);
					}
				}

				$article->text = preg_replace('@(<p>)?{eks}'.preg_quote($match).'{/eks}(</p>)?@is', $html, $article->text);
			}

			$css = '.eks {margin: 20px 0;}'."\n";
			$css .= '.eks_alphaindex {text-align: center;}'."\n";
			$css .= '.eks_teaser {font-size: 90%; font-style: italic;}';

			JFactory::getDocument()->addStyleDeclaration($css);
		}
	}

	/**
	 * Loads cache file if already available
	 *
	 * @param string $id
	 *
	 * @return bool|string
	 */
	private function loadCacheFile($id)
	{
		jimport('joomla.filesystem.file');

		if(JFile::exists(JPATH_ROOT.'/cache/eks/'.md5($id)))
		{
			return file_get_contents(JPATH_ROOT.'/cache/eks/'.md5($id));
		}

		return false;
	}

	/**
	 * Gets all articles depending of the different factors and restrictions, e.g. the user level
	 *
	 * @return array $articles - return all articles which pass the restrictions
	 */
	private function articlesData()
	{
		JModelLegacy::addIncludePath(JPATH_SITE.'/components/com_content/models', 'ContentModel');
		$model = JModelLegacy::getInstance('Articles', 'ContentModel', array('ignore_request' => true));
		$app = JFactory::getApplication();
		$app_params = $app->getParams();
		$access = !JComponentHelper::getParams('com_content')->get('show_noauth');
		$authorised = JAccess::getAuthorisedViewLevels(JFactory::getUser()->get('id'));

		$model->setState('list.start', 0);
		$model->setState('filter.published', 1);
		$model->setState('filter.access', $access);

		if(!empty($this->eks_parameters['catid']))
		{
			$model->setState('filter.category_id', $this->eks_parameters['catid']);
		}

		$model->setState('filter.language', $app->getLanguageFilter());
		$model->setState('params', $app_params);

		$model->setState('list.ordering', 'a.title');

		if(!empty($this->eks_parameters['ordering']))
		{
			$ordering_array = array('id', 'title', 'catid', 'created', 'created_by', 'modified', 'ordering', 'hits', 'featured');

			if(in_array($this->eks_parameters['ordering'], $ordering_array))
			{
				$model->setState('list.ordering', 'a.'.$this->eks_parameters['ordering']);
			}
		}

		$model->setState('list.direction', 'ASC');

		if(!empty($this->eks_parameters['direction']))
		{
			$direction_array = array('ASC', 'DESC');

			if(in_array($this->eks_parameters['direction'], $direction_array))
			{
				$model->setState('list.direction', $this->eks_parameters['direction']);
			}
		}

		$articles = $model->getItems();
		$link_login = JRoute::_('index.php?option=com_users&view=login');

		foreach($articles as &$article)
		{
			$article->slug = $article->id.':'.$article->alias;
			$article->catslug = $article->catid.':'.$article->category_alias;
			$article->link = $link_login;

			if($access OR in_array($article->access, $authorised))
			{
				$article->link = JRoute::_(ContentHelperRoute::getArticleRoute($article->slug, $article->catslug));
			}
		}

		return $articles;
	}

	/**
	 * Extracts the keywords or tags from the articles. The tags are used if the parameter "tags" is entered in the syntax call.
	 *
	 * @param array $articles - Array of possible articles
	 *
	 * @return array $keyword_list - List of allowed keywords
	 */
	private function keywordsData($articles)
	{
		$keywords_list = array();

		foreach($articles as $article)
		{
			$this->createKeywordsList($keywords_list, $article);
		}

		$this->filterKeywordsList($keywords_list);
		ksort($keywords_list);

		return $keywords_list;
	}

	/**
	 * Creates keywords list from the loaded articles
	 *
	 * @param $keywords_list
	 * @param $article
	 */
	private function createKeywordsList(&$keywords_list, $article)
	{
		if(empty($this->eks_parameters['tags']))
		{
			if(!empty($article->metakey))
			{
				$metakey_array = array_map('trim', explode(',', $article->metakey));

				foreach($metakey_array as $metakey)
				{
					$keywords_list[StringHelper::ucfirst($metakey)][] = $article;
				}
			}

			return;
		}

		$tags_helper = new JHelperTags();
		$tags = $tags_helper->getItemTags('com_content.article', $article->id);

		if(!empty($tags))
		{
			foreach($tags as $tag)
			{
				$keywords_list[StringHelper::ucfirst($tag->title)][] = $article;
			}
		}
	}

	/**
	 * Filters keywords list if filter parameters are set
	 *
	 * @param $keywords_list
	 */
	private function filterKeywordsList(&$keywords_list)
	{
		if(!empty($this->eks_parameters['keyword']))
		{
			foreach($keywords_list as $key => $value)
			{
				if(is_array($this->eks_parameters['keyword']))
				{
					if(!in_array(StringHelper::strtolower($key), $this->eks_parameters['keyword']))
					{
						unset($keywords_list[$key]);
					}

					continue;
				}

				if(StringHelper::strtolower($key) != StringHelper::strtolower($this->eks_parameters['keyword']))
				{
					unset($keywords_list[$key]);
				}
			}
		}
		elseif(!empty($this->eks_parameters['nokeyword']))
		{
			foreach($keywords_list as $key => $value)
			{
				if(is_array($this->eks_parameters['nokeyword']))
				{
					if(in_array(StringHelper::strtolower($key), $this->eks_parameters['nokeyword']))
					{
						unset($keywords_list[$key]);
					}

					continue;
				}

				if(StringHelper::strtolower($key) == StringHelper::strtolower($this->eks_parameters['nokeyword']))
				{
					unset($keywords_list[$key]);
				}
			}
		}
	}

	/**
	 * Creates an alpha index with all items which are loaded in the sitemap
	 *
	 * @param array $data_array - Keywords list array with all articles which are included in the output
	 * @param int   $match_key  - Number for the IDs which have to be unique
	 *
	 * @return array - HTML output of the alpha index and all first letters of allowed keywords for the creation of the anchors
	 */
	private function createAlphaIndex($data_array, $match_key)
	{
		$data_keys_array = array_unique(array_map(array($this, 'firstCharAlphaIndex'), array_keys($data_array)));
		$data_range = range('A', 'Z');

		if($this->eks_parameters['alpha'] === 'cyrillic')
		{
			$data_range = array();

			foreach(range(chr(0xC0), chr(0xDF)) as $char)
			{
				$data_range[] = iconv('CP1251', 'UTF-8', $char);
			}
		}

		$html = '<div class="eks_alphaindex">';

		foreach($data_range as $value)
		{
			$html_value = $value.' ';

			if(in_array($value, $data_keys_array))
			{
				$html_value = '<a href="#eks_'.StringHelper::strtolower($value).'_'.$match_key.'">'.$value.'</a> ';
			}

			$html .= $html_value;
		}

		$html .= '</div>';

		return array($html, $data_keys_array);
	}

	/**
	 * Small helper function to get the first char of the transmitted string which is needed to create the alpha index
	 *
	 * @param string $value
	 *
	 * @return string - First character of the passed string
	 */
	private function firstCharAlphaIndex($value)
	{
		return StringHelper::substr($value, 0, 1);
	}

	/**
	 * Write the cache file with the complete output
	 *
	 * @param $id
	 * @param $html
	 */
	private function writeCacheFile($id, $html)
	{
		JFile::write(JPATH_ROOT.'/cache/eks/'.md5($id), $html);
	}

	/**
	 * Small helper function to trim UTF-8 encoded strings
	 *
	 * @param string $utf8string - UTF-8 encoded string
	 *
	 * @return string - Trimmed UTF-8 encoded string
	 */
	private function mb_trim($utf8string)
	{
		return StringHelper::trim($utf8string);
	}
}
