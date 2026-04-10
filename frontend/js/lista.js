const tablaUsuarios = document.getElementById('tablaUsuarios');
const inputBusqueda = document.getElementById('busquedaUsuario');

async function cargarUsuarios() {
    try {
        const response = await fetch('http://localhost/tp1/backend/lista.php?action=BUSCAR');
        const data = await response.json();

        renderizarTabla(data);
    } catch (error) {
        console.error(error);
        tablaUsuarios.innerHTML = `
      <tr>
        <td colspan="6">Error al cargar usuarios</td>
      </tr>
    `;
    }
}

async function buscarUsuarios() {
    const usuario = inputBusqueda.value.trim();

    try {
        const response = await fetch(`http://localhost/tp1/backend/lista.php?action=BUSCAR&usuario=${encodeURIComponent(usuario)}`);
        const data = await response.json();

        renderizarTabla(data);
    } catch (error) {
        console.error(error);
        tablaUsuarios.innerHTML = `
      <tr>
        <td colspan="6">Error al buscar usuarios</td>
      </tr>
    `;
    }
}

async function cambiarEstado(id, estadoActual) {
    const nuevoEstado = estadoActual === 'Y' ? 'N' : 'Y';

    try {
        const response = await fetch(`http://localhost/tp1/backend/lista.php?action=BLOQUEAR&idUser=${id}&estado=${nuevoEstado}`);
        const data = await response.json();

        if (data.respuesta === 'OK') {
            cargarUsuarios();
        } else {
            alert(data.mje);
        }
    } catch (error) {
        console.error(error);
        alert('Error al actualizar el estado');
    }
}

function renderizarTabla(usuarios) {
    if (!usuarios || usuarios.length === 0) {
        tablaUsuarios.innerHTML = `
      <tr>
        <td colspan="6">No se encontraron usuarios</td>
      </tr>
    `;
        return;
    }

    tablaUsuarios.innerHTML = usuarios.map((u) => `
    <tr class="${u.bloqueado === 'Y' ? 'bloqueado' : 'activo'}">
      <td>${u.id}</td>
      <td>${u.usuario}</td>
      <td>${u.apellido}</td>
      <td>${u.nombre}</td>
      <td>${u.bloqueado}</td>
      <td class="acciones">
        <button class="btn ${u.bloqueado === 'Y' ? 'btn-verde' : 'btn-rojo'}" type="button"
          onclick="cambiarEstado(${u.id}, '${u.bloqueado}')">
          ${u.bloqueado === 'Y' ? 'Desbloquear' : 'Bloquear'}
        </button>
      </td>
    </tr>
  `).join('');
}

window.onload = cargarUsuarios;