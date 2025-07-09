<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Usuarios Hofmann</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light p-4">
    <div class="container">
        <h1 class="mb-4">Usuarios</h1>
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Código</th>
                    <th>Monto</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user['id'] }}</td>
                    <td>{{ $user['code'] }}</td>
                    <td>${{ number_format($user['amount'], 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($user['date'])->format('d-m-Y') }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary"
                            onclick="openModal({{ json_encode($user) }})">
                            Editar
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form id="editForm" class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id" id="id">
                    <div class="mb-3">
                        <label for="code" class="form-label">Código</label>
                        <select class="form-select" name="code" id="code" required>
                            @foreach($codes as $c)
                            <option value="{{ $c['code'] }}">{{ $c['code'] }} - {{ $c['name'] }}</option>
                            @endforeach
                        </select>
                        <div class="text-danger small" id="error-code"></div>
                    </div>
                    <div class="mb-3">
                        <label for="amount" class="form-label">Monto</label>
                        <input type="number" class="form-control" name="amount" id="amount" required>
                        <div class="text-danger small" id="error-amount"></div>
                    </div>
                    <div class="mb-3">
                        <label for="date" class="form-label">Fecha</label>
                        <input type="date" class="form-control" name="date" id="date" required>
                        <div class="text-danger small" id="error-date"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Enviar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let modal = new bootstrap.Modal(document.getElementById('editModal'));

        function openModal(user) {
            clearErrors();
            document.getElementById('id').value = user.id;
            document.getElementById('code').value = user.code;
            document.getElementById('amount').value = user.amount;
            document.getElementById('date').value = user.date.split('T')[0];
            modal.show();
        }

        function clearErrors() {
            ['id', 'code', 'amount', 'date'].forEach(field => {
                const errorDiv = document.getElementById('error-' + field);
                if (errorDiv) errorDiv.innerText = '';
            });
        }

        document.getElementById('editForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            clearErrors();
            const formData = new FormData(this);
            const data = {
                id: formData.get('id'),
                code: formData.get('code'),
                amount: formData.get('amount'),
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
                const response = await fetch('{{ route("send-user") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
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
    </script>
</body>

</html>