import './bootstrap';
import '../forum/vendors/bootstrap/bootstrap.bundle.js';
import '../forum/vendors/jquery/jquery.min.js';
import '../forum/vendors/popper/popper.min.js';
import '../forum/vendors/simplebar/simplebar.min.js';
import '../forum/js/main.js';
import AOS from 'aos';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

	AOS.init({
			duration: 1000,
			once: true
		});	
	window.addEventListener('load', AOS.refresh);
ClassicEditor
        .create(document.querySelector('#editor'))
        .catch(error => {
            console.error(error);
        });
