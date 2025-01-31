import './bootstrap';
import Alpine from 'alpinejs';
import { toggleDropdown, triggerDropdownOnLoad } from './component.js';
import { startTime} from './clockdate.js';
// import 'flowbite';

console.log("Testing App------- Developer")

window.Alpine = Alpine;

Alpine.start();

// ComponentJS functions
window.toggleDropdown = toggleDropdown;
triggerDropdownOnLoad();

//Clockdate function
window.startTime = startTime;
