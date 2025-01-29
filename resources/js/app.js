import './bootstrap';
import { helloWorld } from './console.js';
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

window.helloWorld = helloWorld;

