<?php

$sites[] = 'https://site.ru/folder/page.html';
$sites[] = 'https://sub.site.ru/folder/page.html';

foreach ($sites as $site) {
    $match = [];

    preg_match('#(?:https?://)?([^/]+)#', $site, $match);

    echo $match[1];
    echo "<br/>";
}