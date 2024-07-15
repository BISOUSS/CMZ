<!DOCTYPE html>
<html>

<head>
  <title>Service Management</title>
  <link rel="stylesheet" href="{{ asset('dash/css/styles.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dash/libs/bootstrap/dist/css/bootstrap.min.css') }}">
  <style>
    h1 {
      text-align: center;
      color: #333;
    }

    .table-container {
      width: 90%;
      max-width: 1200px;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      padding: 20px;
      border-radius: 8px;
      margin: 0 auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
      background-color: #fff;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    th,
    td {
      padding: 12px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      background-color: #f8f8f8;
      color: #333;
      text-transform: uppercase;
      font-weight: bold;
    }

    tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    tr:hover {
      background-color: #f1f1f1;
    }

    .actions button {
      background-color: #007bff;
      color: white;
      border: none;
      padding: 8px 12px;
      cursor: pointer;
      border-radius: 4px;
      margin-right: 5px;
      transition: background-color 0.3s;
    }

    .actions button:hover {
      background-color: #0056b3;
    }

    button.add-service {
      display: block;
      width: 200px;
      margin: 20px auto;
      background-color: #28a745;
      color: white;
      border: none;
      padding: 10px;
      font-size: 16px;
      cursor: pointer;
      border-radius: 4px;
      transition: background-color 0.3s;
    }
  </style>
</head>

<body>
  <div class="container">
    <h1>Liste des Services</h1>
    <div class="table-container">
      <table id="serviceTable">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($services as $service)
          <tr>
            <td>{{ $service->id }}</td>
            <td>{{ $service->name }}</td>
            <td>{{ $service->description }}</td>
            <td class="actions">
              <button class="edit-button" data-id="{{ $service->id }}" data-name="{{ $service->name }}" data-description="{{ $service->description }}">Modifier</button>
              <form action="{{ route('service.destroy', $service->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Supprimer</button>
              </form>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <button class="add-service" onclick="showAddServiceModal()">Ajouter Service</button>

    <!-- Add Service Modal -->
    <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="addServiceModalLabel">Ajouter Service</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="{{ route('service.store') }}" method="POST">
              @csrf
              <div class="mb-3">
                <label for="name" class="form-label">Nom:</label>
                <input type="text" name="name" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="description" class="form-label">Description:</label>
                <textarea name="description" class="form-control" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <!-- Edit Service Modal -->
    <div class="modal fade" id="editServiceModal" tabindex="-1" aria-labelledby="editServiceModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editServiceModalLabel">Modifier Service</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="editServiceForm" method="POST">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label for="editName" class="form-label">Nom:</label>
                <input type="text" name="name" id="editName" class="form-control" required>
              </div>
              <div class="mb-3">
                <label for="editDescription" class="form-label">Description:</label>
                <textarea name="description" id="editDescription" class="form-control" required></textarea>
              </div>
              <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script src="{{ asset('dash/libs/jquery/dist/jquery.min.js') }}"></script>
  <script src="{{ asset('dash/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('dash/js/sidebarmenu.js') }}"></script>
  <script src="{{ asset('dash/js/app.min.js') }}"></script>
  <script src="{{ asset('dash/libs/simplebar/dist/simplebar.js') }}"></script>
  <script>
    function showAddServiceModal() {
      var myModal = new bootstrap.Modal(document.getElementById('addServiceModal'), {
        keyboard: false
      });
      myModal.show();
    }

    document.querySelectorAll('.edit-button').forEach(button => {
      button.addEventListener('click', () => {
        const id = button.getAttribute('data-id');
        const name = button.getAttribute('data-name');
        const description = button.getAttribute('data-description');

        document.getElementById('editName').value = name;
        document.getElementById('editDescription').value = description;
        document.getElementById('editServiceForm').action = `/services/${id}`;

        var myModal = new bootstrap.Modal(document.getElementById('editServiceModal'), {
          keyboard: false
        });
        myModal.show();
      });
    });
  </script>
</body>

</html>