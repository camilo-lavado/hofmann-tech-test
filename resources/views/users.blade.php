<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Usuarios Hofmann</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
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
                        <button class="btn btn-sm btn-primary" onclick="openModal({{ json_encode($user) }})">
                            <i class="bi bi-pencil-square me-1"></i> Editar
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
                        <div class="input-group">
                            <span class="input-group-text">$</span>
                            <input type="text" class="form-control" name="amount" id="amount" required>
                        </div>
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
        window.sendUserUrl = "{{ route('send-user') }}";
        window.csrfToken = "{{ csrf_token() }}";
    </script>
    <script src="{{ asset('js/app.js') }}"></script>

</body>

</html>