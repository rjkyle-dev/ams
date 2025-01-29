import './bootstrap';
import Alpine from 'alpinejs';
import { toggleDropdown } from './component.js';
import { startTime} from './clockdate.js';

console.log("Testing App------- Developer")

window.Alpine = Alpine;

Alpine.start();



window.toggleDropdown = toggleDropdown;

window.startTime = startTime;
