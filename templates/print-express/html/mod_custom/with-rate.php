<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_custom
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die;

function get_rate($currency) {
    $date = getdate();  // получаем ассоциативный массив с данными по дате

    $day_of_the_week = $date['wday']; // день недели
    //расчет коэффициента смещения
    switch ($day_of_the_week) {
        case 0:
            $k1 = 2;
            $k2 = 1;
            break;   // воскресенье
        case 1:
            $k1 = 3;
            $k2 = 2;
            break;   // понедельник
        case 2:
            $k1 = 3;
            $k2 = 0;
            break;  // вторник
        default:
            $k1 = 1;
            $k2 = 0;
            break;   // среда, четверг, пятница, суббота
    }

    $month = $date['mon'];    // месяц
    $day = $date['mday'];     // число сегодня
    $yesterday = $day - $k1;  // число для получения курса на предыдущий день
    $today = $day - $k2;      // число для получения курса на сегодня
    $year = $date['year'];    // год

    $date_yesterday = date("d/m/Y", mktime(0, 0, 0, $month, $yesterday, $year)); // Генерация даты для курса предыдущего дня
    $date_today = date("d/m/Y", mktime(0, 0, 0, $month, $today, $year)); // Генерация даты для курса на сегодня

    $rate = array();

    foreach ($currency as $key => $value) {
        $url = 'http://www.cbr.ru/scripts/XML_dynamic.asp?date_req1=' . $date_yesterday . '&date_req2=' . $date_today . '&VAL_NM_RQ=' . $value;
        $xml = simplexml_load_file($url);
        $rate_today = round(str_replace(',', '.', $xml->Record[1]->Value), 2);
        $rate_yesterday = round(str_replace(',', '.', $xml->Record[0]->Value), 2);
        $range = round($rate_today - $rate_yesterday, 2);

        if ($range > 0) {
            $range = '+' . $range;
            $glyph = 'glyphicon glyphicon-arrow-up';
        } elseif ($range == 0) {
            $range = 0;
            $glyph = 0;
        } else {
            $glyph = 'glyphicon glyphicon-arrow-down';
        }

        $rate[$key] = array(
            'today' => $rate_today,
            'change' => $range,
            'glyph' => $glyph
        );
    }
    return $rate;
}

$currency = array(
    'usd' => 'R01235',
    'euro' => 'R01239'
);

$rate = get_rate($currency);
?>

<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-2 col-md-2 col-lg-2 hidden-xs">
                <!-- Yandex.Metrika informer --> <a href="https://metrika.yandex.ru/stat/?id=20887777&amp;from=informer" target="_blank" rel="nofollow"><img src="https://informer.yandex.ru/informer/20887777/3_1_99C0E1FF_79A0C1FF_1_pageviews" style="width:88px; height:31px; border:0;" alt="Яндекс.Метрика" title="Яндекс.Метрика: данные за сегодня (просмотры, визиты и уникальные посетители)" class="ym-advanced-informer" data-cid="20887777" data-lang="ru" /></a> <!-- /Yandex.Metrika informer --> <!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter20887777 = new Ya.Metrika({ id:20887777, clickmap:true, trackLinks:true, accurateTrackBounce:true, webvisor:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <!-- /Yandex.Metrika counter -->
            </div>
            <div class="col-xs-4 col-sm-2 col-md-2 col-lg-1">
                <?php foreach ($rate as $key => $value) { ?>
                    <div class="rate" title="Сегодня: <?php echo $value['today']." (". $value['change'].")"; ?>">
                        <span class="glyphicon glyphicon-<?php echo $key; ?>"></span>
                        <strong><?php echo $value['today']; ?></strong>
                        <?php if ($value['change']) { ?>
                            <span class="<?php echo $value['glyph']; ?>"></span>
                        <?php }
                        ?>
                    </div>
                <?php } ?>
            </div>
            <div class="col-xs-5 col-sm-6 col-md-7 col-lg-8">
                <?php echo $module->content; ?>
            </div>
            <div class="col-xs-3 col-sm-2 col-md-1 col-lg-1">
                <a href="https://vk.com/pe_public" target="_blank">
                    <img class="img-responsive pull-right vk" src="../../../../uploaded/images/vk.svg" title="Наша группа ВКонтакте" alt="Наша группа ВКонтакте"/>
                </a>
            </div>
        </div>
    </div>
</footer>