@extends('layouts.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Employees</h4>

<div class="card shadow-sm border-0 mb-4 premium-hover">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold text-dark">Manage Employees</h5>
        <button type="button" class="btn btn-primary fw-bold shadow-sm" onclick="openAddModal()">
            <i class="bx bx-plus me-2"></i> Add Employee
        </button>
    </div>
    
    <div class="card-body p-3">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle mb-0" id="employeesTable" style="width: 100%">
                <thead class="table-light">
                    <tr>
                        <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Emp ID</th>
                        <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Name & Email</th>
                        <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Police Station</th>
                        <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Mobile</th>
                        <th class="px-4 py-3 text-uppercase text-dark fw-bold small">Status</th>
                        <th class="px-4 py-3 text-uppercase text-dark fw-bold small text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Employee Modal -->
<div class="modal fade" id="employeeModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="employeeModalLabel">Add New Employee</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="employeeForm">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" id="employee_record_id" name="id">
                
                <div class="modal-body">
                    <div id="formErrors" class="alert alert-danger d-none"></div>
                    
                    <div class="row g-3">
                        <div class="col-md-6 form-group">
                            <label class="form-label fw-bold">EMPLOYEE ID <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="modal_employee_id" name="employee_id" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label fw-bold">FULL NAME <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="modal_name" name="name" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label fw-bold">EMAIL ADDRESS <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" id="modal_email" name="email" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label fw-bold">MOBILE NUMBER</label>
                            <input type="text" class="form-control" id="modal_mobile_no" name="mobile_no" oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10">
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="form-label fw-bold">POLICE STATION</label>
                            <input type="text" class="form-control" id="modal_policestation" name="policestation">
                        </div>
                        <div class="col-md-12 form-group" id="passwordContainer">
                            <label class="form-label fw-bold">PASSWORD <span class="text-danger" id="passwordAsterisk">*</span></label>
                            <input type="password" class="form-control" id="modal_password" name="password">
                            <small class="text-muted" id="passwordHelpText"></small>
                        </div>
                    </div>

                    <!-- View Details Container (Hidden by Default) -->
                    <div id="viewDetailsContainer" class="d-none">
                        <div class="row g-4">
                            <div class="col-6">
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Employee ID</small>
                                <p class="mb-0 fw-semibold text-primary fs-6" id="view_emp_id"></p>
                            </div>
                            <div class="col-6">
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Full Name</small>
                                <p class="mb-0 fw-semibold text-dark fs-6" id="view_name"></p>
                            </div>
                            <div class="col-6">
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Email Address</small>
                                <p class="mb-0 fw-semibold text-dark fs-6" id="view_email"></p>
                            </div>
                            <div class="col-6">
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Mobile Number</small>
                                <p class="mb-0 fw-semibold text-dark fs-6" id="view_mobile"></p>
                            </div>
                            <div class="col-12">
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Police Station</small>
                                <p class="mb-0 fw-semibold text-dark fs-6" id="view_police"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold" id="saveEmployeeBtn">
                        <span class="spinner-border spinner-border-sm d-none me-1" role="status" aria-hidden="true" id="saveSpinner"></span>
                        Save Employee
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let empTable;
    $(document).ready(function() {
        empTable = $('#employeesTable').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: "{{ route('admin.employees') }}",
            columns: [
                {data: 'emp_id', name: 'employee_id'},
                {data: 'profile', name: 'name'},
                {data: 'police_station', name: 'policestation'},
                {data: 'mobile', name: 'mobile_no'},
                {data: 'status', name: 'is_active', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end'}
            ],
            language: {
                search: "",
                searchPlaceholder: "Search...",
                paginate: {
                    previous: "<i class='bx bx-chevron-left'></i>",
                    next: "<i class='bx bx-chevron-right'></i>"
                }
            },
            drawCallback: function() {
                // Re-bind status toggle event listeners on elements drawn by DataTables
                $('.status-toggle').on('change', function() {
                    const id = $(this).data('id');
                    toggleStatus(id, this);
                });
            }
        });

        // Make rows clickable for View Only mode
        $('#employeesTable tbody').on('click', 'tr', function(e) {
            // Prevent triggering if clicked on an action button/icon/switch
            if ($(e.target).closest('button, a, .action-btn, .form-switch, input').length > 0) {
                return;
            }
            
            // Find the edit button and extract data
            const editBtn = $(this).find('button[onclick^="openEditModal"]');
            if (editBtn.length) {
                const onclickText = editBtn.attr('onclick');
                const viewFunc = onclickText.replace('openEditModal', 'openViewModal');
                eval(viewFunc);
            }
        });
    });

    const employeeModal = new bootstrap.Modal(document.getElementById('employeeModal'));
    
    function resetFormState() {
        document.getElementById('viewDetailsContainer').classList.add('d-none');
        document.querySelector('#employeeForm .row.g-3').classList.remove('d-none');
        document.getElementById('saveEmployeeBtn').classList.remove('d-none');
    }
    
    function openAddModal() {
        resetFormState();
        document.getElementById('employeeModalLabel').innerText = 'Add New Employee';
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('employeeForm').reset();
        document.getElementById('employee_record_id').value = '';
        
        document.getElementById('modal_password').required = true;
        document.getElementById('passwordAsterisk').classList.remove('d-none');
        document.getElementById('passwordHelpText').innerText = '';
        
        document.getElementById('formErrors').classList.add('d-none');
        document.getElementById('formErrors').innerHTML = '';
        
        employeeModal.show();
    }
    
    function openViewModal(id, empId, name, email, police, mobile) {
        document.getElementById('employeeModalLabel').innerText = 'View Employee Details';
        document.getElementById('formMethod').value = '';
        document.getElementById('employee_record_id').value = id;
        
        // Hide form, show details
        document.querySelector('#employeeForm .row.g-3').classList.add('d-none');
        document.getElementById('saveEmployeeBtn').classList.add('d-none');
        document.getElementById('viewDetailsContainer').classList.remove('d-none');
        
        document.getElementById('view_emp_id').innerText = empId || '-';
        document.getElementById('view_name').innerText = name || '-';
        document.getElementById('view_email').innerText = email || '-';
        document.getElementById('view_police').innerText = police && police !== 'N/A' ? police : '-';
        document.getElementById('view_mobile').innerText = mobile && mobile !== 'N/A' ? mobile : '-';
        
        document.getElementById('formErrors').classList.add('d-none');
        document.getElementById('formErrors').innerHTML = '';
        
        employeeModal.show();
    }
    
    function openEditModal(id, empId, name, email, police, mobile) {
        resetFormState();
        document.getElementById('employeeModalLabel').innerText = 'Edit Employee';
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('employee_record_id').value = id;
        
        document.getElementById('modal_employee_id').value = empId;
        document.getElementById('modal_name').value = name;
        document.getElementById('modal_email').value = email;
        document.getElementById('modal_policestation').value = police === 'N/A' ? '' : police;
        document.getElementById('modal_mobile_no').value = mobile === 'N/A' ? '' : mobile;
        
        document.getElementById('modal_password').value = '';
        document.getElementById('modal_password').required = false;
        document.getElementById('passwordAsterisk').classList.add('d-none');
        document.getElementById('passwordHelpText').innerText = 'Leave blank to keep current password';
        
        document.getElementById('formErrors').classList.add('d-none');
        document.getElementById('formErrors').innerHTML = '';
        
        employeeModal.show();
    }

    document.getElementById('employeeForm').addEventListener('submit', function(e) {
        e.preventDefault();
        
        const form = this;
        const submitBtn = document.getElementById('saveEmployeeBtn');
        const spinner = document.getElementById('saveSpinner');
        const errorsDiv = document.getElementById('formErrors');
        
        submitBtn.disabled = true;
        spinner.classList.remove('d-none');
        errorsDiv.classList.add('d-none');
        
        const formData = new FormData(form);
        const method = document.getElementById('formMethod').value;
        const recordId = document.getElementById('employee_record_id').value;
        
        // Remove password if empty on edit
        if (method === 'PUT' && !formData.get('password')) {
            formData.delete('password');
        }
        
        const url = method === 'POST' ? '{{ route('admin.employees.store') }}' : `/admin/employees/${recordId}`;
        
        // Convert FormData to JSON, Laravel can handle FormData but JSON is cleaner for API requests.
        // However, Laravel forms use _method field for PUT. Since we use FormData, we can just send as POST with _method=PUT.
        
        fetch(url, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(response => {
            return response.json().then(data => ({ status: response.status, body: data }));
        })
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
                employeeModal.hide();
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: res.body.message || 'Employee saved successfully!',
                    showConfirmButton: false,
                    timer: 2000
                });
                
                setTimeout(() => {
                    empTable.ajax.reload(null, false);
                }, 1000);
                
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

    function toggleStatus(userId, checkbox) {
        const isChecked = checkbox.checked;
        const textElement = document.getElementById('status-text-' + userId);
        
        textElement.innerText = isChecked ? 'Active' : 'Inactive';

        fetch(`/admin/employees/${userId}/toggle-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (!data.success) {
                Swal.fire('Error', data.message || 'Failed to update status.', 'error');
                checkbox.checked = !isChecked;
                textElement.innerText = !isChecked ? 'Active' : 'Inactive';
            } else {
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: 'Status updated',
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error', 'An error occurred.', 'error');
            checkbox.checked = !isChecked;
            textElement.innerText = !isChecked ? 'Active' : 'Inactive';
        });
    }

    function confirmDelete(btn) {
        const form = $(btn).closest('form');
        Swal.fire({
            title: 'Are you sure?',
            text: "This employee will be permanently deleted!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endpush
@endsection
