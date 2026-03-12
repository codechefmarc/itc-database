import './bootstrap';
import '@tailwindplus/elements';

// Date range picker.
import flatpickr from "flatpickr";
import "flatpickr/dist/flatpickr.css";

// Sortable.
import Sortable from 'sortablejs';
window.Sortable = Sortable;

// Alpine.
import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

const date_range = document.getElementById('date_range');
if (date_range) {
  flatpickr(date_range, {
    mode: "range",
  });
}

if (window.apiRoute === undefined) {
  window.apiRoute = '/api/model-numbers/search';
}

// Autocomplete.
import './model-select.js';
