import './bootstrap';
import Alpine from 'alpinejs';
import { toggleDropdown, triggerDropdownOnLoad } from './component.js';
import { startTime} from './clockdate.js';
import { testStudentForm } from './dashboard.js'; //imported testStudentForm
import Swal from 'sweetalert2'; //Added Sweet Alert module
import 'flowbite'; //I restored Flowbite kay wala nigana ang Dropdowns na gikan Flowbite

console.log("Testing App------- Developer")

// AlpineJS
window.Alpine = Alpine;

Alpine.start();

// ComponentJS functions
window.toggleDropdown = toggleDropdown;
triggerDropdownOnLoad();

//Clockdate function
window.startTime = startTime;

//Sweet AlertJS
window.Swal = Swal;

//Dashboard JS Functions
window.testStudentForm = testStudentForm;
