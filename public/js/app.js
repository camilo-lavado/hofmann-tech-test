let modal = new bootstrap.Modal(document.getElementById('editModal'));

window.openModal = function (user) {
    clearErrors();
    document.getElementById('id').value = user.id;
    document.getElementById('code').value = user.code;
    document.getElementById('amount').value = Number(user.amount).toLocaleString('es-CL');
    document.getElementById('date').value = user.date.split('T')[0];
    modal.show();
}

function clearErrors() {
    ['id', 'code', 'amount', 'date'].forEach(field => {
        const errorDiv = document.getElementById('error-' + field);
        if (errorDiv) errorDiv.innerText = '';
    });
}

document.getElementById('amount').addEventListener('input', function() {
    let value = this.value.replace(/\D/g, '');
    this.value = Number(value).toLocaleString('es-CL');
});

document.getElementById('editForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    clearErrors();
    const formData = new FormData(this);
    const rawAmount = formData.get('amount').replace(/\./g, '').replace(/[^0-9]/g, '');
    const data = {
        id: formData.get('id'),
        code: formData.get('code'),
        amount: rawAmount,
        date: new Date(formData.get('date')).toISOString()
    };
    const confirm = await Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Deseas enviar los cambios?',
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sí, enviar',
        cancelButtonText: 'Cancelar'
    });

    if (!confirm.isConfirmed) return;

    Swal.fire({
        title: 'Enviando...',
        didOpen: () => Swal.showLoading(),
        allowOutsideClick: false
    });

    try {
        const response = await fetch(window.sendUserUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': window.csrfToken,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.status === 422) {
            const errors = result.errors;
            for (const field in errors) {
                const errorDiv = document.getElementById('error-' + field);
                if (errorDiv) errorDiv.innerText = errors[field][0];
            }
            Swal.close();
            return;
        }
        if (!response.ok) {
            throw new Error(result.message || 'Error inesperado.');
        }
        Swal.fire({
            icon: 'success',
            title: 'Actualizado',
            text: 'Datos enviados correctamente.'
        }).then(() => {
            modal.hide();
            window.location.reload();
        });
    } catch (err) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: err.message || 'Error desconocido.'
        });
    }
});