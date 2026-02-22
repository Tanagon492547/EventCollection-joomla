<?php

namespace My\Module\EventCollection\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;

class ContentHelper
{
  public static function getImagesByCategory(int $eventcategor, string $groupName)
  {
    
    $db = Factory::getContainer()->get('DatabaseDriver');

    $queryGroup = $db->getQuery(true);
    $queryGroup->select($db->quoteName('id'))
        ->from($db->quoteName('#__fields_groups'))
        ->where($db->quoteName('title') . ' = ' . $db->quote($groupName));
    $db->setQuery($queryGroup);
    $fieldGroupId = (int) $db->loadResult();


    $query = $db->getQuery(true);

    $query->select('*')
      ->from($db->quoteName('#__content'));

    if (!empty($eventcategor)) {
        $query->where($db->quoteName('catid') . ' = ' . (int) $eventcategor);
    }

    $query->where($db->quoteName('state') . ' = 1');

    $db->setQuery($query);

    $items = $db->loadObjectList();
    if (!empty($items)) {
      foreach ($items as &$item) {

        $groups = $fieldGroupId > 0 ? [$fieldGroupId] : null;

        $fields = \Joomla\Component\Fields\Administrator\Helper\FieldsHelper::getFields('com_content.article', $item, true, $groups);

        $item->jcfields = [];
        foreach ($fields as $field) {
          $item->jcfields[$field->name] = $field;
        }
      }
    }
    return $items;
  }
}