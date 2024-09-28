import './bootstrap';
import '../forum/vendors/bootstrap/bootstrap.bundle.js';
import '../forum/vendors/jquery/jquery.min.js';
import '../forum/vendors/popper/popper.min.js';
import '../forum/vendors/simplebar/simplebar.min.js';
import '../forum/js/main.js';
import AOS from 'aos';

	AOS.init({
			duration: 1000,
			once: true
		});	

// Pour réinitialiser les animations lors de chaque rechargement de la page (si nécessaire)
window.addEventListener('load', AOS.refresh);