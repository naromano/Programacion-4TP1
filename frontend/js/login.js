const form = document.getElementById('loginForm');
const mensaje = document.getElementById('mensaje');

form.addEventListener('submit', async function (e) {
    e.preventDefault();

    const usuario = document.getElementById('usuario').value.trim();
    const clave = document.getElementById('clave').value.trim();

    mensaje.textContent = '';
    mensaje.className = 'mensaje';

    if (!usuario || !clave) {
        mensaje.textContent = 'Completá usuario y clave';
        mensaje.classList.add('error');
        return;
    }

    try {
        const url = `http://localhost/tp1/backend/login.php?user=${encodeURIComponent(usuario)}&pass=${encodeURIComponent(clave)}`;

        const response = await fetch(url);
        const data = await response.json();

        if (data.respuesta === 'OK') {
            mensaje.textContent = data.mje;
            mensaje.classList.add('ok');

            setTimeout(() => {
                window.location.href = './lista.html';
            }, 800);
        } else {
            mensaje.textContent = data.mje;
            mensaje.classList.add('error');
        }
    } catch (error) {
        console.log(error);
        mensaje.textContent = 'Error al conectar con el servidor';
        mensaje.classList.add('error');
    }
});