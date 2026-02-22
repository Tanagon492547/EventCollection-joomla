if (!window.Joomla) {
  throw new Error('Joomla API was not properly initialised');
}

const { suffix } = Joomla.getOptions('mod_event_collection.vars');
document.querySelectorAll('.mod_event_collection').forEach(element => {
  element.innerText += suffix;
});