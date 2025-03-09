@extends('admin.dashboard')

<title>Admin: Create Resident </title>


<style>

.header-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

</style>

@section('content')
<div class="container">
  @if(session('success'))
      <div class="alert alert-success alert-dismissible" role="alert">
          <strong>Success!</strong>
          <span>{{ session('success') }}</span>
          <button class="close" onclick="this.parentElement.style.display='none'">
              <i class="fas fa-times"></i>
          </button>
      </div>
  @endif
  <!-- Page Header -->
  <div class="header-container mb-4">
  <h1 class="fw-bold" style="font-size: 3rem; font-weight: bold;">Resident Management</h1>

        <a href="{{ route('admin.residents.create') }}" class="btn btn-lg btn-primary px-4 py-2">
            <i class="fas fa-plus"></i> Add New Resident
        </a>
    </div>

  <!-- Search and Filter -->
  <div class="card mb-4">
      <div class="card-body">
          <form method="GET" action="{{ route('admin.residents.index') }}" class="search-form">
              <div class="d-flex flex-column flex-md-row gap-4">
                  <div class="flex-grow-1">
                      <div class="search-input-group">
                          <i class="fas fa-search search-icon"></i>
                          <input type="text" name="search" class="form-control search-input" placeholder="Search by name, address..." value="{{ request('search') }}">
                          <button type="submit" class="btn btn-primary">
                      Search
                  </button>
                      </div>
                  </div>
              </div>
          </form>
      </div>
  </div>

  <!-- Table -->
  <div class="card">
      <div class="table-container">
          <table class="table table-hover">
              <thead>
                  <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Gender</th>
                      <th>Address</th>
                      <th>Valid ID</th>
                      <th class="text-center">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse ($residents as $resident)
                      <tr>
                          <td>{{ $resident->id }}</td>
                          <td class="font-weight-medium">
                              {{ $resident->first_name }} {{ $resident->middle_name }} {{ $resident->last_name }}
                          </td>
                          <td>{{ ucfirst($resident->gender) }}</td>
                          <td>{{ $resident->block_street }}, {{ $resident->barangay }}, {{ $resident->district }}, {{ $resident->city }}</td>
                          <td>
                              <a href="{{ asset('storage/' . $resident->valid_id) }}" target="_blank" class="text-primary">View ID</a>
                          </td>
                          <td>
                              <div class="action-buttons">
                                  <a href="{{ route('admin.residents.show', $resident->id) }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg">
                                      <i class="fas fa-eye mr-1"></i> View
                                  </a>
                                  <a href="{{ route('admin.residents.edit', $resident->id) }}" class="px-4 py-2 bg-yellow-500 text-white rounded-lg">
                                      <i class="fas fa-edit mr-1"></i> Edit
                                  </a>
                                  <button type="button" onclick="confirmDelete({{ $resident->id }})" class="px-4 py-2 bg-red-600 text-white rounded-lg">
                                      <i class="fas fa-trash mr-1"></i> Delete
                                  </button>
                              </div>
                          </td>
                      </tr>
                  @empty
                      <tr>
                          <td colspan="6" class="text-center p-4">
                              <div class="empty-state">
                                  <i class="fas fa-users empty-state-icon"></i>
                                  <p class="empty-state-title">No residents found</p>
                                  <p class="empty-state-description">Try adjusting your search or add a new resident</p>
                              </div>
                          </td>
                      </tr>
                  @endforelse
              </tbody>
          </table>
      </div>
      
      <!-- Pagination -->
      <div class="card-footer">
          @if(method_exists($residents, 'links'))
              {{ $residents->links() }}
          @endif
      </div>
  </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteModal" class="modal">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-body text-center p-4">
              <i class="fas fa-exclamation-triangle text-danger" style="font-size: 3rem; margin-bottom: 1rem;"></i>
              <h3 class="modal-title mb-2">Confirm Deletion</h3>
              <p class="text-secondary mb-4">Are you sure you want to delete this resident? This action cannot be undone.</p>
              
              <form id="deleteForm" method="POST" class="d-inline">
                  @csrf
                  @method('DELETE')
                  <div class="d-flex justify-content-center gap-3">
                      <button type="button" onclick="closeDeleteModal()" class="btn btn-secondary">
                          Cancel
                      </button>
                      <button type="submit" class="btn btn-danger">
                          Delete
                      </button>
                  </div>
              </form>
          </div>
      </div>
  </div>
</div>

<script>
  function confirmDelete(id) {
      const modal = document.getElementById('deleteModal');
      const form = document.getElementById('deleteForm');
      
      form.action = `/admin/residents/${id}`;
      modal.style.display = 'flex';
  }
  
  function closeDeleteModal() {
      const modal = document.getElementById('deleteModal');
      modal.style.display = 'none';
  }
  
  // Close modal when clicking outside
  window.onclick = function(event) {
      const modal = document.getElementById('deleteModal');
      if (event.target == modal) {
          closeDeleteModal();
      }
  }
</script>
@endsection

