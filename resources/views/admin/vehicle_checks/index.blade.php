@extends('layouts.app')

@section('content')
<h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Admin /</span> Vehicle Checks</h4>

<style>
    /* Fix Select2 Height & alignment to match Bootstrap form-control */
    .select2-container .select2-selection--single {
        height: 38.6px !important;
        border: 1px solid #d9dee3 !important;
        border-radius: 0.375rem !important;
        display: flex;
        align-items: center;
    }
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        color: #697a8d !important;
        padding-left: 0.875rem !important;
        line-height: normal !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 36px !important;
        right: 5px !important;
    }
</style>

<div class="card shadow-sm border-0 mb-4 premium-hover">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h5 class="mb-0 fw-bold text-dark">Vehicle Checking Records</h5>
    </div>
    
    <div class="card-body p-3 border-bottom">
        <div class="bg-lighter rounded p-4 mb-3 border">
            <h6 class="text-uppercase text-primary fw-bold mb-3 d-flex align-items-center" style="letter-spacing: 1px; font-size: 0.8rem;">
                <i class="bx bx-slider-alt me-2 fs-5"></i> Dataset Query Parameters
            </h6>
            <div class="row g-3">
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <label class="form-label fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">Filter by Vehicle No</label>
                    <select class="form-select select2-filter" id="filter_vehicle_no" data-placeholder="All Vehicles">
                        <option value="">All Vehicles</option>
                        @foreach($vehicleNumbers as $vNo)
                            <option value="{{ $vNo }}">{{ $vNo }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <label class="form-label fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">Filter by Police Station</label>
                    <select class="form-select select2-filter" id="filter_police_station" data-placeholder="All Police Stations">
                        <option value="">All Police Stations</option>
                        @foreach($policeStations as $station)
                            <option value="{{ $station }}">{{ $station }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <label class="form-label fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">Filter Date</label>
                    <select class="form-select" id="filter_date">
                        <option value="">All Time</option>
                        <option value="today">Today</option>
                        <option value="yesterday">Yesterday</option>
                        <option value="last_7_days">Last 7 Days</option>
                        <option value="last_15_days">Last 15 Days</option>
                        <option value="last_30_days">Last 30 Days</option>
                        <option value="this_month">This Month</option>
                        <option value="last_month">Last Month</option>
                        <option value="custom">Custom Date</option>
                    </select>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-none custom-date-fields">
                    <label class="form-label fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">Start Date</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control flatpickr-date-input bg-white" id="filter_start_date" placeholder="YYYY-MM-DD">
                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3 d-none custom-date-fields">
                    <label class="form-label fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">End Date</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control flatpickr-date-input bg-white" id="filter_end_date" placeholder="YYYY-MM-DD">
                        <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <label class="form-label fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">Start Time</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control flatpickr-time-input bg-white" id="filter_start_time" placeholder="HH:MM">
                        <span class="input-group-text"><i class="bx bx-time"></i></span>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                    <label class="form-label fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px; font-size: 0.75rem;">End Time</label>
                    <div class="input-group input-group-merge">
                        <input type="text" class="form-control flatpickr-time-input bg-white" id="filter_end_time" placeholder="HH:MM">
                        <span class="input-group-text"><i class="bx bx-time"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body p-3">
        <div class="table-responsive text-nowrap">
            <table class="table table-hover align-middle mb-0" id="vehicleChecksTable" style="width: 100%;">
                <thead class="table-light">
                    <tr>
                        <th class="px-3 py-3 text-uppercase text-dark fw-bold small">Person & Vehicle</th>
                        <th class="px-3 py-3 text-uppercase text-dark fw-bold small">Emp. ID</th>
                        <th class="px-3 py-3 text-uppercase text-dark fw-bold small">Checking Point</th>
                        <th class="px-3 py-3 text-uppercase text-dark fw-bold small">Shift & Time</th>
                        <th class="px-3 py-3 text-uppercase text-dark fw-bold small">Remark</th>
                        <th class="px-3 py-3 text-uppercase text-dark fw-bold small">Recorded By</th>
                        <th class="px-3 py-3 text-uppercase text-dark fw-bold small text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="vehicleCheckModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Record Vehicle Check</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="vehicleCheckForm" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">
                <input type="hidden" id="record_id" name="id">
                
                <div class="modal-body">
                    <div id="formErrors" class="alert alert-danger d-none mb-3"></div>
                    
                    <!-- View Details Container (Hidden by Default) -->
                    <div id="viewDetailsContainer" class="d-none">
                        <div class="row g-4">
                            <div class="col-6">
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Checking Point</small>
                                <p class="mb-0 fw-semibold text-dark fs-6" id="view_checking_point"></p>
                            </div>
                            <div class="col-6">
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Shift Date</small>
                                <p class="mb-0 fw-semibold text-dark fs-6" id="view_shift_date"></p>
                            </div>
                            <div class="col-6">
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Person Name</small>
                                <p class="mb-0 fw-semibold text-dark fs-6" id="view_person_name"></p>
                            </div>
                            <div class="col-6">
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Vehicle No</small>
                                <p class="mb-0 fw-semibold text-primary fs-6" id="view_vehicle_no"></p>
                            </div>
                            <div class="col-6">
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Shift Type</small>
                                <p class="mb-0 fw-semibold text-dark fs-6" id="view_shift_type"></p>
                            </div>
                            <div class="col-6">
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Checking Time</small>
                                <p class="mb-0 fw-semibold text-dark fs-6" id="view_checking_time"></p>
                            </div>
                            <div class="col-6">
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Employee ID No</small>
                                <p class="mb-0 fw-semibold text-dark fs-6" id="view_employee_id_no"></p>
                            </div>
                            <div class="col-12">
                                <small class="text-muted text-uppercase fw-bold" style="letter-spacing: 0.5px;">Remark</small>
                                <p class="mb-0 fw-semibold text-dark fs-6" id="view_remark"></p>
                            </div>
                            <div class="col-12 text-center d-none" id="view_vehicle_photo_container">
                                <hr class="my-2">
                                <small class="text-muted text-uppercase fw-bold d-block mb-2" style="letter-spacing: 0.5px;">Vehicle Photo</small>
                                <img id="view_vehicle_photo" src="" class="img-fluid rounded shadow-sm" style="max-height: 300px; cursor: pointer;" onclick="showImage(this.src)">
                            </div>
                        </div>
                    </div>
                    
                    <div id="editFormContainer" class="row g-3">
                        <div class="col-md-12 form-group">
                            <label class="form-label fw-bold">Checking Point <span class="text-danger">*</span></label>
                            <select class="form-select" id="modal_checking_point_id" name="checking_point_id" required>
                                <option value="">Select Checking Point</option>
                                @foreach($checkingPoints as $station => $points)
                                    <optgroup label="{{ $station }}">
                                        @foreach($points as $cp)
                                            <option value="{{ $cp->id }}">{{ $cp->name }}</option>
                                        @endforeach
                                    </optgroup>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label fw-bold">Person Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="modal_person_name" name="person_name" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label fw-bold">Vehicle No <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="modal_vehicle_no" name="vehicle_no" required>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label fw-bold">Shift Date <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control flatpickr-date-input bg-white" id="modal_shift_date" name="shift_date" placeholder="YYYY-MM-DD" required>
                                <span class="input-group-text"><i class="bx bx-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label fw-bold">Shift Type</label>
                            <select class="form-select" id="modal_shift_type" name="shift_type" style="pointer-events: none; background-color: #e9ecef;" tabindex="-1">
                                <option value="" disabled selected>Select Shift</option>
                                <option value="Morning">Morning Shift</option>
                                <option value="Evening">Evening Shift</option>
                                <option value="Night">Night Shift</option>
                            </select>
                            <small class="text-muted mt-1 d-block"><i class="bx bx-info-circle"></i> Assigned automatically based on checking time.</small>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label fw-bold">Checking Time <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <input type="text" class="form-control flatpickr-time-input bg-white" id="modal_checking_time" name="checking_time" placeholder="HH:MM" required>
                                <span class="input-group-text"><i class="bx bx-time"></i></span>
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="form-label fw-bold">Employee ID No</label>
                            <input type="text" class="form-control" id="modal_employee_id_no" name="employee_id_no">
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="form-label fw-bold">Vehicle Photo (Optional)</label>
                            <input type="file" class="form-control" id="modal_vehicle_photo" name="vehicle_photo" accept="image/*">
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="form-label fw-bold">Remark (Optional)</label>
                            <textarea class="form-control" id="modal_remark" name="remark" rows="2"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary fw-bold" id="saveBtn">
                        <span class="spinner-border spinner-border-sm d-none me-1" role="status" aria-hidden="true" id="saveSpinner"></span>
                        Save Record
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Image Viewer Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-transparent shadow-none">
            <div class="modal-header border-0 d-flex justify-content-end p-2">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0 text-center">
                <img id="previewImage" src="" class="img-fluid rounded shadow-lg" style="max-height: 80vh;">
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let vcTable;
    $(document).ready(function() {
        vcTable = $('#vehicleChecksTable').DataTable({
            processing: true,
            serverSide: true,
            order: [],
            ajax: {
                url: "{{ route('admin.vehicle-checks.index') }}",
                data: function(d) {
                    d.vehicle_no = $('#filter_vehicle_no').val();
                    d.police_station = $('#filter_police_station').val();
                    d.filter_date = $('#filter_date').val();
                    d.start_date = $('#filter_start_date').val();
                    d.end_date = $('#filter_end_date').val();
                    d.start_time = $('#filter_start_time').val();
                    d.end_time = $('#filter_end_time').val();
                }
            },
            columns: [
                {data: 'person_vehicle', name: 'person_name'},
                {data: 'emp_id', name: 'employee_id_no'},
                {data: 'checking_point', name: 'checkingPoint.name'},
                {data: 'shift_time', name: 'shift_date'},
                {data: 'remark', name: 'remark', orderable: false},
                {data: 'recorded_by', name: 'user.name'},
                {data: 'action', name: 'action', orderable: false, searchable: false, className: 'text-end text-nowrap'}
            ],
            search: {
                search: "{!! addslashes(request('global_search')) !!}"
            },
            language: {
                search: "",
                searchPlaceholder: "Search...",
                paginate: {
                    previous: "<i class='bx bx-chevron-left'></i>",
                    next: "<i class='bx bx-chevron-right'></i>"
                }
            }
        });

        // Initialize Select2 for the filter
        $('.select2-filter').each(function() {
            $(this).select2({
                placeholder: $(this).data('placeholder'),
                allowClear: true,
                width: '100%'
            });
        });

        // Initialize Flatpickr Date and Time
        flatpickr('.flatpickr-date-input', {
            dateFormat: "Y-m-d",
            allowInput: true,
            disableMobile: "true"
        });
        
        flatpickr('.flatpickr-time-input', {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: false, // user showed am/pm in the screenshot for time
            allowInput: true,
            disableMobile: "true"
        });

        // Redraw table when filter changes
        $('#filter_date').on('change', function() {
            if ($(this).val() === 'custom') {
                $('.custom-date-fields').removeClass('d-none');
            } else {
                $('.custom-date-fields').addClass('d-none');
                $('#filter_start_date, #filter_end_date').val('');
                vcTable.ajax.reload();
            }
        });

        $('#filter_vehicle_no, #filter_police_station, #filter_start_date, #filter_end_date, #filter_start_time, #filter_end_time').on('change', function() {
            vcTable.ajax.reload();
        });

        // Make rows clickable for View Only mode
        $('#vehicleChecksTable tbody').on('click', 'tr', function(e) {
            // Prevent triggering if clicked on an action button/icon
            if ($(e.target).closest('button, a, .action-btn').length > 0) {
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

    const vcModal = new bootstrap.Modal(document.getElementById('vehicleCheckModal'));
    const imgModal = new bootstrap.Modal(document.getElementById('imageModal'));
    
    function showImage(src) {
        document.getElementById('previewImage').src = src;
        imgModal.show();
    }

    function resetFormState() {
        document.getElementById('viewDetailsContainer').classList.add('d-none');
        document.getElementById('editFormContainer').classList.remove('d-none');
        document.getElementById('saveBtn').classList.remove('d-none');
    }

    function openAddModal() {
        resetFormState();
        document.getElementById('modalLabel').innerText = 'Record Vehicle Check';
        document.getElementById('formMethod').value = 'POST';
        document.getElementById('vehicleCheckForm').reset();
        document.getElementById('record_id').value = '';
        
        // Default to today
        document.getElementById('modal_shift_date').value = new Date().toISOString().split('T')[0];
        
        // Default to current time
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const defaultTime = `${hours}:${minutes}`;
        document.getElementById('modal_checking_time').value = defaultTime;
        autoAssignShift(defaultTime);

        document.getElementById('formErrors').classList.add('d-none');
        document.getElementById('formErrors').innerHTML = '';
        
        vcModal.show();
    }
    
    function autoAssignShift(timeString) {
        if (!timeString) return;
        const hour = parseInt(timeString.split(':')[0], 10);
        let shift = '';
        if (hour >= 8 && hour < 16) {
            shift = 'Morning';
        } else if (hour >= 16 && hour <= 23) {
            shift = 'Evening';
        } else {
            shift = 'Night';
        }
        document.getElementById('modal_shift_type').value = shift;
    }

    document.getElementById('modal_checking_time').addEventListener('change', function(e) {
        autoAssignShift(e.target.value);
    });
    
    function openViewModal(id, cpId, person, date, shift, vehicle, empId, time, remark, photoUrl) {
        document.getElementById('modalLabel').innerText = 'View Vehicle Check Details';
        document.getElementById('formMethod').value = '';
        document.getElementById('record_id').value = id;
        
        // Hide form, show details
        document.getElementById('editFormContainer').classList.add('d-none');
        document.getElementById('saveBtn').classList.add('d-none');
        document.getElementById('viewDetailsContainer').classList.remove('d-none');
        
        const cpSelect = document.getElementById('modal_checking_point_id');
        cpSelect.value = cpId;
        const cpText = cpSelect.options[cpSelect.selectedIndex] ? cpSelect.options[cpSelect.selectedIndex].text : '-';
        
        document.getElementById('view_checking_point').innerText = cpText;
        document.getElementById('view_person_name').innerText = person || '-';
        document.getElementById('view_shift_date').innerText = date || '-';
        document.getElementById('view_shift_type').innerText = shift || '-';
        document.getElementById('view_vehicle_no').innerText = vehicle || '-';
        document.getElementById('view_employee_id_no').innerText = empId || '-';
        document.getElementById('view_checking_time').innerText = time || '-';
        document.getElementById('view_remark').innerText = remark || '-';
        
        if (photoUrl) {
            document.getElementById('view_vehicle_photo').src = photoUrl;
            document.getElementById('view_vehicle_photo_container').classList.remove('d-none');
        } else {
            document.getElementById('view_vehicle_photo_container').classList.add('d-none');
        }
        
        document.getElementById('formErrors').classList.add('d-none');
        document.getElementById('formErrors').innerHTML = '';
        
        vcModal.show();
    }

    function openEditModal(id, cpId, person, date, shift, vehicle, empId, time, remark, photoUrl) {
        resetFormState();
        document.getElementById('modalLabel').innerText = 'Edit Vehicle Check';
        document.getElementById('formMethod').value = 'PUT';
        document.getElementById('record_id').value = id;
        
        document.getElementById('modal_checking_point_id').value = cpId;
        document.getElementById('modal_person_name').value = person;
        document.getElementById('modal_shift_date').value = date;
        document.getElementById('modal_shift_type').value = shift;
        document.getElementById('modal_vehicle_no').value = vehicle;
        document.getElementById('modal_employee_id_no').value = empId;
        document.getElementById('modal_checking_time').value = time;
        document.getElementById('modal_remark').value = remark;
        
        document.getElementById('formErrors').classList.add('d-none');
        document.getElementById('formErrors').innerHTML = '';
        
        vcModal.show();
    }

    document.getElementById('vehicleCheckForm').addEventListener('submit', function(e) {
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
        
        const url = method === 'POST' ? '{{ route('admin.vehicle-checks.store') }}' : `/admin/vehicle-checks/${recordId}`;
        
        fetch(url, {
            method: 'POST',
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
            
            if (res.status === 422) {
                let errorHtml = '<ul class="mb-0">';
                for (let key in res.body.errors) {
                    errorHtml += `<li>${res.body.errors[key][0]}</li>`;
                }
                errorHtml += '</ul>';
                errorsDiv.innerHTML = errorHtml;
                errorsDiv.classList.remove('d-none');
            } else if (res.status >= 200 && res.status < 300) {
                vcModal.hide();
                Swal.fire({
                    toast: true,
                    position: 'top-end',
                    icon: 'success',
                    title: res.body.message || 'Saved successfully!',
                    showConfirmButton: false,
                    timer: 2000
                });
                setTimeout(() => {
                    vcTable.ajax.reload(null, false);
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

    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "This record will be permanently deleted!",
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
