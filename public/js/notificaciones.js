function mostrarNotificacion(mensaje, tipo = 'success') {
    const noti = document.getElementById('notificacion');
    if (!noti) return;
    noti.textContent = mensaje;
    noti.style.backgroundColor = tipo === 'success' ? '#4caf50' : '#f44336';
    noti.style.color = '#fff';
    noti.style.display = 'block';
    noti.style.opacity = '1';
    setTimeout(() => {
        noti.style.transition = 'opacity 0.5s';
        noti.style.opacity = '0';
        setTimeout(() => { noti.style.display = 'none'; noti.style.transition = ''; }, 500);
    }, 3500);
} 