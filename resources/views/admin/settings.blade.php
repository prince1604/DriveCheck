@extends('layouts.app')

@section('title', 'System Settings')

@section('content')
<h4 class="fw-bold py-3 mb-4">
    <span class="text-muted fw-light">Administration /</span> System Settings
</h4>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <h5 class="card-header border-bottom">General Configuration</h5>
            <div class="card-body mt-4">
                <form onsubmit="event.preventDefault(); Swal.fire('Saved', 'Configuration updated successfully.', 'success');">
                    <div class="row">
                        <div class="mb-3 col-md-6">
                            <label for="systemName" class="form-label">System Name</label>
                            <input class="form-control" type="text" id="systemName" name="systemName" value="DriveCheck Police HRMS" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label for="timezone" class="form-label">Timezone</label>
                            <select id="timezone" class="select2 form-select">
                                <option value="Asia/Kolkata" selected>Asia/Kolkata (IST)</option>
                                <option value="UTC">UTC</option>
                            </select>
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Default Shift Duration (Hours)</label>
                            <input class="form-control" type="number" value="8" />
                        </div>
                        <div class="mb-3 col-md-6">
                            <label class="form-label">Allow Employee Self-Registration</label>
                            <div class="form-check form-switch mt-2">
                                <input class="form-check-input" type="checkbox" id="selfReg" checked />
                                <label class="form-check-label" for="selfReg">Enabled</label>
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <button type="submit" class="btn btn-primary me-2">Save changes</button>
                        <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        
        <div class="card">
            <h5 class="card-header border-bottom text-danger">Danger Zone</h5>
            <div class="card-body mt-3">
                <div class="mb-3 col-12 mb-0">
                    <div class="alert alert-warning">
                        <h6 class="alert-heading fw-bold mb-1">Are you sure you want to clear system cache?</h6>
                        <p class="mb-0">Once you clear the cache, the system will temporarily slow down while regenerating data.</p>
                    </div>
                </div>
                <button type="button" class="btn btn-danger deactivate-account" onclick="Swal.fire('Cache Cleared', 'System cache has been successfully wiped.', 'success')">Clear System Cache</button>
            </div>
        </div>
    </div>
</div>
@endsection
