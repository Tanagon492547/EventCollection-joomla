<?php
namespace My\Module\EventCollection\Site\Dispatcher;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Dispatcher\AbstractModuleDispatcher;
use My\Module\EventCollection\Site\Helper\ContentHelper;
use Joomla\CMS\Application\CMSApplicationInterface;
use Joomla\Input\Input;
use Joomla\Registry\Registry;

\defined('_JEXEC') or die;


class Dispatcher extends AbstractModuleDispatcher
{

    protected $module;

    protected $app;

    public function __construct(\stdClass $module, CMSApplicationInterface $app, Input $input)
    {
        $this->module = $module;
        $this->app = $app;
    }

    public function dispatch()
    {
        $params = new Registry($this->module->params);
        $evnetitle = $params->get('evnetitle', '');
        $urlallevents = $params->get('urlallevents', '');
        $titlecolor = $params->get('titlecolor', '#ffffff');
        $backgroundcolor = $params->get('backgroundcolor', '#ffffff');
        $groupField = $params->get('groupField', '');
        $eventcategory = $params->get('eventcategory', 0);
        $items = ContentHelper::getImagesByCategory($eventcategory, $groupField);

        require ModuleHelper::getLayoutPath('mod_event_collection');
    }

}
;