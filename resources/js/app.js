import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Paksa browser agar selalu merender mode terang (Light Mode)
document.documentElement.classList.remove('dark');
localStorage.removeItem('theme');
