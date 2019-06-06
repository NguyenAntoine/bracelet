// CSS
import '../css/global.scss';

// Images
import '../images/favicon.ico';
import '../images/bg-img/1.png';
import '../images/bg-img/2.jpg';
import '../images/bg-img/3.jpg';
import '../images/bg-img/4.jpg';
import '../images/bg-img/5.jpg';
import '../images/bg-img/6.jpg';
import '../images/bg-img/7.jpg';
import '../images/bg-img/8.jpg';
import '../images/bg-img/9.jpg';
import '../images/bg-img/10.jpg';
import '../images/bg-img/11.jpg';
import '../images/bg-img/12.jpg';
import '../images/bg-img/13.jpg';
import '../images/bg-img/14.jpg';
import '../images/bg-img/15.jpg';
import '../images/bg-img/16.jpg';
import '../images/bg-img/17.jpg';
import '../images/bg-img/18.jpg';
import '../images/bg-img/19.jpg';
import '../images/bg-img/20.jpg';
import '../images/bg-img/21.jpg';
import '../images/bg-img/22.jpg';
import '../images/bg-img/23.jpg';
import '../images/bg-img/24.jpg';
import '../images/core-img/curve-1.png';
import '../images/core-img/curve-2.png';
import '../images/core-img/curve-3.png';
import '../images/core-img/curve-4.png';
import '../images/core-img/curve-5.png';
import '../images/core-img/curve-6.png';
import '../images/core-img/logo.png';

// JS
import $ from 'jquery';
import 'popper.js';
import 'bootstrap';
import 'select2';
import '@fortawesome/fontawesome-free/js/all.min';
import './active.js';

$(document).ready(function () {
  $('.select2').select2();


});

const $collectionHolder = $('ul.medications');

// setup an "add a medication" link
const $addMedicationButton = $('<button type="button" class="add_medications_link">Ajouter un traitement</button>');
const $newLinkLi = $('<div></div>').append($addMedicationButton);

jQuery(document).ready(function() {
  // add the "add a medication" anchor and li to the medications ul
  $collectionHolder.append($newLinkLi);

  // count the current form inputs we have (e.g. 2), use that as the new
  // index when inserting a new item (e.g. 2)
  $collectionHolder.data('index', $collectionHolder.find(':input').length);

  $addMedicationButton.on('click', function(e) {
    // add a new medication form (see next code block)
    addMedicationForm($collectionHolder, $newLinkLi);
  });

  $collectionHolder.find('li').each(function() {
    addMedicationFormDeleteLink($(this));
  });
});

function addMedicationForm($collectionHolder, $newLinkLi) {
  // Get the data-prototype explained earlier
  let prototype = $collectionHolder.data('prototype');

  // get the new index
  let index = $collectionHolder.data('index');

  let newForm = prototype;
  // You need this only if you didn't set 'label' => false in your medications field in TaskType
  // Replace '__name__label__' in the prototype's HTML to
  // instead be a number based on how many items we have
  // newForm = newForm.replace(/__name__label__/g, index);

  // Replace '__name__' in the prototype's HTML to
  // instead be a number based on how many items we have
  newForm = newForm.replace(/__name__/g, index);

  // increase the index with one for the next item
  $collectionHolder.data('index', index + 1);

  // Display the form in the page in an li, before the "Add a medication" link li
  const $newFormLi = $('<li></li>').append(newForm);
  addMedicationFormDeleteLink($newFormLi);
  $newLinkLi.before($newFormLi);
}

function addMedicationFormDeleteLink($medicationFormLi) {
  const $removeFormButton = $('<button type="button">Supprimer ce traitement</button>');
  $medicationFormLi.append($removeFormButton);

  $removeFormButton.on('click', function(e) {
    // remove the li for the medication form
    $medicationFormLi.remove();
  });
}
