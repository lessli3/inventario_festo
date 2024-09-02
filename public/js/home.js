document.addEventListener('DOMContentLoaded', function () {
    var loginModal = new bootstrap.Modal(document.getElementById('exampleModal'));
    var verificationModal = new bootstrap.Modal(document.getElementById('verificationModal'));
    var registerModal = new bootstrap.Modal(document.getElementById('registerModal'));


    var checkDocumentForm = document.getElementById('checkDocumentForm');
    var verificationForm = document.getElementById('verificationForm');
    var registerForm = document.querySelector('form[action="' + registerFormAction + '"]');

    if (checkDocumentForm) {
        checkDocumentForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var form = e.target;
            var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            var csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        throw new Error(text);
                    });
                }
            })
            .then(data => {
                if (data.message === 'Código de verificación enviado') {
                   // Mostrar el correo electrónico en el modal de verificación
                   var emailPart = data.email.replace(/(.{3})(.*)(@.*)/, '$1******$3');
                    var verificationMessage = `Revisa el correo ${emailPart} para obtener el código de verificación`;
                    document.getElementById('verificationMessage').textContent = verificationMessage;

                    loginModal.hide();
                    verificationModal.show();
                } else {
                    alert('Error: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Ocurrió un error. Por favor, inténtalo de nuevo.');
            });
        });
    } else {
        console.error('Formulario #checkDocumentForm no encontrado');
    }

    if (verificationForm) {
        verificationForm.addEventListener('submit', function (e) {
            e.preventDefault();
            var form = e.target;
            var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            var csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            })
            .then(response => {
                if (response.ok) {
                    return response.json();
                } else {
                    return response.text().then(text => {
                        throw new Error(text);
                    });
                }
            })
            .then(data => {
                if (data.message === 'Código de verificación válido') {
                    window.location.href = '/dashboard'; // Redirige al dashboard
                } else {
                    // Manejo de mensajes de error en la interfaz
                    alert(data.message); // Muestra un mensaje de error
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Se ha producido un error en la verificación del código.');
            });
        });
    } else {
        console.error('Formulario #verificationForm no encontrado');
    }
    
    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            e.preventDefault();

             // Limpiar mensajes de error previos
            document.getElementById('emailError').innerText = '';
            document.getElementById('identityError').innerText = '';
            var form = e.target;

            var csrfTokenMeta = document.querySelector('meta[name="csrf-token"]');
            var csrfToken = csrfTokenMeta ? csrfTokenMeta.getAttribute('content') : '';

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: {
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json',
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                // Mostrar errores debajo de los campos correspondientes
                if (data.errors.email) {
                    document.getElementById('emailError').innerText = data.errors.email;
                }
                if (data.errors.identity) {
                    document.getElementById('identityError').innerText = data.errors.identity;
                }
            } else {
                // Registro exitoso, redirigir o mostrar mensaje de éxito
                alert(data.message);
                window.location.href = '/home';  // Redirigir a la página principal
            }
            })
            .catch(error => {
                // Mostrar alerta de error en caso de excepción
                alert('Ocurrió un error: ' + error.message);
            });
        });
    }
});