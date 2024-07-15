@include('dash.layout.header')
@include('dash.layout.CSS')

<<div class="container-fluid">
  <div class="container">
    <div class="row mb-3">
      <div class="col-md-9">
        <h1>Liste des Services</h1>
      </div>
      <div class="col-md-3 text-right">
        <!-- Bouton global pour ajouter un service -->
        <button class="btn btn-primary" onclick="showAddServiceModal()">Ajouter un Service</button>
      </div>
    </div>
    <table class="table table-hover">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Description</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody id="servicesTable">
        @foreach($services as $service)
        <tr id="service-{{ $service->id }}">
          <td>{{ $service->name }}</td>
          <td>{{ $service->description }}</td>
          <td class="actions">
            <button class="btn btn-warning edit-button" data-id="{{ $service->id }}" data-name="{{ $service->name }}" data-description="{{ $service->description }}">Modifier</button>
            <form action="{{ route('service.destroy', $service->id) }}" method="POST" style="display:inline;">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
  </div>

  <!-- Modal pour l'ajout de service -->
  <div class="modal fade" id="addServiceModal" tabindex="-1" role="dialog" aria-labelledby="addServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addServiceModalLabel">Ajouter un Service</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="addServiceForm" action="{{ route('service.store') }}" method="POST">
            @csrf
            <div class="form-group">
              <label for="name">Nom du service</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="form-group">
              <label for="description">Description</label>
              <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script>
    function showAddServiceModal() {
      $('#addServiceModal').modal('show');
    }

    $('#addServiceForm').on('submit', function(e) {
      e.preventDefault();
      var form = $(this);
      $.ajax({
        url: form.attr('action'),
        method: form.attr('method'),
        data: form.serialize(),
        success: function(response) {
          var newRow = `
          <tr id="service-${response.id}">
            <td>${response.name}</td>
            <td>${response.description}</td>
            <td class="actions">
              <button class="btn btn-warning edit-button" data-id="${response.id}" data-name="${response.name}" data-description="${response.description}">Modifier</button>
              <form action="/service/${response.id}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
              </form>
            </td>
          </tr>`;
          $('#servicesTable').append(newRow);
          $('#addServiceModal').modal('hide');
          form[0].reset();
        },
        error: function(response) {
          // Handle errors here
          console.log(response);
        }
      });
    });

    $(document).on('click', '.edit-button', function() {
      var id = $(this).data('id');
      var name = $(this).data('name');
      var description = $(this).data('description');

      // Pré-remplir le formulaire d'édition avec les données existantes
      $('#editServiceModal input[name="name"]').val(name);
      $('#editServiceModal textarea[name="description"]').val(description);
      $('#editServiceForm').attr('action', '/service/' + id); // Ajustez l'URL selon votre route

      $('#editServiceModal').modal('show');
    });
  </script>


  @include('dash.layout.footer')