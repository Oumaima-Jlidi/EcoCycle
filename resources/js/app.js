import './bootstrap';
import '../forum/vendors/bootstrap/bootstrap.bundle.js';
import '../forum/vendors/jquery/jquery.min.js';
import '../forum/vendors/popper/popper.min.js';
import '../forum/vendors/simplebar/simplebar.min.js';
import '../forum/js/main.js';
import 'bootstrap';
import AOS from 'aos';
import ClassicEditor from '@ckeditor/ckeditor5-build-classic';

AOS.init({
    duration: 1000,
    once: true
});
window.addEventListener('load', AOS.refresh);

// Initialiser ClassicEditor
ClassicEditor
    .create(document.querySelector('#editor'))
    .catch(error => {
        console.error(error);
    });

// Fonction de validation du formulaire
function validateForm(event) {
    // Récupère les éléments du formulaire avec des vérifications d'existence
    const title = document.querySelector('input[name="content"]');
    const image = document.querySelector('input[name="image"]');
    const description = document.querySelector('textarea[name="description"]');

    // Vérification du champ Title
    if (title && title.value.trim() === "") {
        alert("Le champ 'Title' est requis.");
        title.focus();
        event.preventDefault(); // Empêche l'envoi du formulaire
        return false;
    }

    // Vérification de la taille et du type du fichier image (200 MB max)
    if (image && image.files.length > 0) {
        const fileSize = image.files[0].size / 1024 / 1024; // Taille en MB
        const fileType = image.files[0].type;

        // Types de fichiers autorisés
        const allowedTypes = ["image/png", "image/jpeg", "image/gif", "image/webp", "video/mp4"];
        if (!allowedTypes.includes(fileType)) {
            alert("Le fichier doit être au format PNG, JPG, GIF, WEBP ou MP4.");
            image.focus();
            event.preventDefault();
            return false;
        }
        if (fileSize > 200) {
            alert("La taille du fichier ne doit pas dépasser 200 MB.");
            image.focus();
            event.preventDefault();
            return false;
        }
    }

    // Vérification du champ Description
    if (description && description.value.trim() === "") {
        alert("Le champ 'Description' est requis.");
        description.focus();
        event.preventDefault();
        return false;
    }

    return true;
}

// Attacher la fonction validateForm au formulaire
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('add-post-form');
    if (form) {
        form.addEventListener('submit', validateForm);
    }
});
