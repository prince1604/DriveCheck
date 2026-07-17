@extends('layouts.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Checking Points</h4>

<div class="card shadow-sm border-0 mb-4 premium-hover">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold text-dark">Manage Checking Points</h5>
        <button type="button" class="btn btn-primary fw-bold shadow-sm" onclick="openAddModal()">
            <i class="bx bx-plus me-2"></i> Add Checking Point
        </button>
    </div>
    
    <div class="card-body p-3">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle mb-0" id="checkingPointsTable" style="width: 100%;">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3 text-uppercase text-dark fw-bold small">ID</th>
                        <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Name</th>
                        <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Police Station</th>
                        <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Incharge Name</th>
                        <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Added On</th>
                        <th class="px-4 py-3 text-uppercase text-dark fw-bold small text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="checkingPointModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Add Checking Point</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="checkingPointForm">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" id="record_id" name="id">
                
                <div class="modal-body">
                    <div id="formErrors" class="alert alert-danger d-none"></div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold">Checking Point Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="modal_name" name="name" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold">Police Station <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="modal_police_station" name="police_station" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold">Incharge Name <span class="text-muted fw-normal">(Optional)</span></label>
                        <input type="text" class="form-control" id="modal_incharge_name" name="incharge_name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold" id="saveBtn">
                        <span class="spinner-border spinner-border-sm d-none me-1" role="status" aria-hidden="true" id="saveSpinner"></span>
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let cpTable;
    $(document).ready(function() {
        cpTable = $('#checkingPointsTable').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: "{{ route('admin.checking-points.index') }}",
            columns: [
                {data: 'id', name: 'id'},
                {data: 'name', name: 'name', className: 'fw-bold text-dark point-name'},
                {data: 'police_station', name: 'police_station', className: 'text-dark'},
                {data: 'incharge_name', name: 'incharge_name', className: 'text-dark', render: function(data) { return data || '-'; }},
                {data: 'created_at', name: 'created_at', className: 'text-muted'},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end'}
            ],
            language: {
                search: "",
                searchPlaceholder: "Search...",
                paginate: {
                    previous: "<i class='bx bx-chevron-left'></i>",
                    next: "<i class='bx bx-chevron-right'></i>"
                }
            }
        });
    });

    const cpModal = new bootstrap.Modal(document.getElementById('checkingPointModal'));
    
    function openAddModal() {
        document.getElementById('modalLabel').innerText = 'Add Checking Point';
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('checkingPointForm').reset();
        document.getElementById('record_id').value = '';
        
        document.getElementById('formErrors').classList.add('d-none');
        document.getElementById('formErrors').innerHTML = '';
        
        cpModal.show();
    }
    
    function openEditModal(id, name, police_station = '', incharge_name = '') {
        document.getElementById('modalLabel').innerText = 'Edit Checking Point';
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('record_id').value = id;
        
        document.getElementById('modal_name').value = name;
        document.getElementById('modal_police_station').value = police_station;
        document.getElementById('modal_incharge_name').value = incharge_name;
        
        document.getElementById('formErrors').classList.add('d-none');
        document.getElementById('formErrors').innerHTML = '';
        
        cpModal.show();
    }

    document.getElementById('checkingPointForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const submitBtn = document.getElementById('saveBtn');
        const spinner = document.getElementById('saveSpinner');
        const errorsDiv = document.getElementById('formErrors');
        
        submitBtn.disabled = true;
        spinner.classList.remove('d-none');
        errorsDiv.classList.add('d-none');
        
        const formData = new FormData(form);
        const method = document.getElementById('formMethod').value;
        const recordId = document.getElementById('record_id').value;
        
        const url = method === 'POST' ? '{{ route('admin.checking-points.store') }}' : `/admin/checking-points/${recordId}`;
        
        fetch(url, {
            method: 'POST', // always POST with _method spoofing for FormData
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => response.json().then(data => ({ status: response.status, body: data })))
        .then(res => {
            submitBtn.disabled = false;
            spinner.classList.add('d-none');
            
            if (res.status === 422) { // Validation error
                let errorHtml = '<ul class="mb-0">';
                for (let key in res.body.errors) {
                    errorHtml += `<li>${res.body.errors[key][0]}</li>`;
                }
                errorHtml += '</ul>';
                errorsDiv.innerHTML = errorHtml;
                errorsDiv.classList.remove('d-none');
            } else if (res.status >= 200 && res.status < 300) {
                cpModal.hide();
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: res.body.message || 'Saved successfully!',
                    showConfirmButton: false,
                    timer: 2000
                });
                
                // Dynamic DOM update
                cpTable.ajax.reload(null, false);
            } else {
                errorsDiv.innerHTML = res.body.message || 'An error occurred. Please try again.';
                errorsDiv.classList.remove('d-none');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            submitBtn.disabled = false;
            spinner.classList.add('d-none');
            errorsDiv.innerHTML = 'A network error occurred.';
            errorsDiv.classList.remove('d-none');
        });
    });

    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This checking point will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteForm' + id).submit();
            }
        });
    }
</script>
@endpush
@endsection
