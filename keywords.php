<?php
/**
 * keywords
 *
 * DESCRIPTION
 *
 * This Snippet generates SEO keywords from Resource fields.
 *
 * PROPERTIES:
 *
 * &id Resource ID integer optional. Default: current
 * &fields string optional. A comma separated list of Resource fields. Default: 'pagetitle, longtitle, description'
 * &tvs string optional. A comma separated list of Resource TVs. Default: ''
 * &min integer optional. Minimum word length for including. Default: 4
 * &limit integer optional. Тumber of words in a list. Default: 25
 *
 * USAGE:
 *
 * [[!keywords?
 * &fields=`content`
 * &tvs=`myTV`
 * &min=`5`
 * &limit=`15`
 * ]]
 *
 * OR WITH FENOM
 *{'!keywords' | snippet: [
 *   'fields' => 'pagetitle, longtitle, content',
 *   'tvs' => 'test',
 *   'min' => 5,
 *   'limit' => 15,
 *]}
 *
 */

$id = $modx->getOption('id', $scriptProperties, $modx->resource->get('id'));
$fields = explode(',', $modx->getOption('fields', $scriptProperties, 'pagetitle, longtitle, description'));
$tvs = explode(',', $modx->getOption('tvs', $scriptProperties, ''));
$min = $modx->getOption('min', $scriptProperties, 4);
$limit = $modx->getOption('limit', $scriptProperties, 25);

$resource = $modx->getObject('modResource', $id);

foreach ($fields as $field) {
    $resArr[] = $resource->get(trim($field));
}

if ($tvs) {
    foreach ($tvs as $field) {
        $resArr[] = $resource->getTVvalue(trim($field));
    }
}

$str = mb_strtolower(preg_replace('/[^a-zA-Zа-яА-Я0-9\s]/ui', ' ', strip_tags(join($resArr, ','))), 'utf-8');
$str = preg_replace('|\s+|', ' ', $str);
$wordArr = explode(' ', $str);

foreach ($wordArr as $i => $word) {
    if (mb_strlen($word, 'utf-8') < $min) {
        unset($wordArr[$i]);
    }
}

$wordArr = array_count_values($wordArr);
arsort($wordArr);
$wordArr = array_keys(array_slice($wordArr, 0, $limit));

return join($wordArr, ', ');
