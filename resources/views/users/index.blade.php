@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.min.css" rel="stylesheet">
    <style>
        body {
            background: #f5f5f5;
        }
        .main-container {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            padding: 0;
            overflow: hidden;
        }
        .header-section {
            background: #2c3e50;
            color: white;
            padding: 25px 30px;
            margin-bottom: 0;
            border-bottom: 3px solid #34495e;
        }
        .header-section h2 {
            margin: 0;
            font-weight: 600;
            font-size: 1.75rem;
        }
        .header-section p {
            margin: 0;
            font-size: 0.9rem;
            opacity: 0.9;
        }
        .content-section {
            padding: 30px;
        }
        .table-container {
            display: block;
        }
        .form-container {
            display: none;
        }
        .action-buttons {
            gap: 10px;
        }
        .btn-action {
            padding: 10px 20px;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.2s ease;
            border: none;
        }
        .btn-primary {
            background: #3498db;
            color: white;
        }
        .btn-primary:hover {
            background: #2980b9;
            color: white;
        }
        .btn-danger {
            background: #e74c3c;
            color: white;
        }
        .btn-danger:hover {
            background: #c0392b;
            color: white;
        }
        .btn-success {
            background: #27ae60;
            color: white;
        }
        .btn-success:hover {
            background: #229954;
            color: white;
        }
        .btn-secondary {
            background: #95a5a6;
            color: white;
        }
        .btn-secondary:hover {
            background: #7f8c8d;
            color: white;
        }
        .table {
            margin-top: 20px;
            border-radius: 4px;
            overflow: hidden;
            border: 1px solid #dee2e6;
        }
        .table thead {
            background: #34495e;
            color: white;
        }
        .table thead th {
            border: none;
            padding: 12px 15px;
            font-weight: 500;
            font-size: 0.875rem;
            letter-spacing: 0.3px;
        }
        .table tbody tr {
            transition: background-color 0.2s ease;
            border-bottom: 1px solid #ecf0f1;
        }
        .table tbody tr:hover {
            background-color: #f8f9fa;
        }
        .table tbody td {
            vertical-align: middle;
            padding: 12px 15px;
            color: #2c3e50;
        }
        .edit-row {
            background-color: #ecf8ff !important;
        }
        .badge-hobby {
            background: #ecf0f1;
            color: #2c3e50;
            padding: 4px 10px;
            border-radius: 3px;
            font-size: 0.75rem;
            font-weight: 500;
            margin: 2px;
            display: inline-block;
            border: 1px solid #bdc3c7;
        }
        .form-control:focus {
            border-color: #3498db;
            box-shadow: 0 0 0 0.2rem rgba(52, 152, 219, 0.15);
        }
        .form-label {
            font-weight: 500;
            color: #2c3e50;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }
        .form-check-input:checked {
            background-color: #3498db;
            border-color: #3498db;
        }
        .hobby-section {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #dee2e6;
        }
        .form-card {
            background: white;
            border-radius: 4px;
            padding: 30px;
        }
        .btn-group-table {
            display: flex;
            gap: 5px;
        }
        .btn-sm-action {
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 0.813rem;
            font-weight: 500;
        }
        .checkbox-custom {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        #selectAll {
            width: 18px;
            height: 18px;
            cursor: pointer;
        }
        .profile-preview {
            margin-top: 10px;
            text-align: center;
        }
        .profile-preview img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid #bdc3c7;
        }
    </style>

<div class="container">
        <div class="main-container">
            <div id="tableView" class="table-container">
                <div class="header-section">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2><i class="bi bi-people-fill"></i> User Management System</h2>
                            <p class="mb-0 mt-2" style="opacity: 0.9;">Manage your users efficiently</p>
                        </div>
                        <div class="d-flex action-buttons">
                            <button id="bulkDeleteBtn" class="btn btn-danger btn-action">
                                <i class="bi bi-trash3-fill"></i> Bulk Delete
                            </button>
                            <button id="addNewBtn" class="btn btn-primary btn-action">
                                <i class="bi bi-plus-circle-fill"></i> Add New
                            </button>
                        </div>
                    </div>
                </div>
                
                <div class="content-section">
                    <div class="table-responsive">
                        <table id="usersTable" class="table table-hover">
                            <thead>
                                <tr>
                                    <th style="width: 50px;"><input type="checkbox" id="selectAll" class="checkbox-custom"></th>
                                    <th style="width: 60px;">ID</th>
                                    <th style="width: 80px;">Profile</th>
                                    <th>Name</th>
                                    <th>Phone</th>
                                    <th>Category</th>
                                    <th>Hobbies</th>
                                    <th style="width: 250px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div id="formView" class="form-container">
                <div class="header-section">
                    <h2><i class="bi bi-person-plus-fill"></i> Add New User</h2>
                    <p class="mb-0 mt-2" style="opacity: 0.9;">Fill in the details below</p>
                </div>
                
                <div class="content-section">
                    <div class="form-card">
                        <form id="userForm" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-person"></i> Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Enter full name" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-image"></i> Profile Picture</label>
                                    <input type="file" name="profile_pic" id="profilePicInput" class="form-control" accept="image/*">
                                    <div class="invalid-feedback"></div>
                                    <small class="text-muted">Allowed: JPG, JPEG, PNG, GIF (Max: 2MB)</small>
                                    <div id="profilePreview" class="profile-preview" style="display:none;">
                                        <img id="previewImg" src="" alt="Preview">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-telephone"></i> Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Enter phone number" required>
                                    <div class="invalid-feedback"></div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><i class="bi bi-tag"></i> Category</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback"></div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label"><i class="bi bi-heart"></i> Hobbies</label>
                                <div class="hobby-section">
                                    <div class="row">
                                        @foreach($hobbies as $hobby)
                                            <div class="col-md-3 col-sm-6 mb-2">
                                                <div class="form-check">
                                                    <input class="form-check-input hobby-checkbox" type="checkbox" name="hobbies[]" value="{{ $hobby->id }}" id="hobby{{ $hobby->id }}">
                                                    <label class="form-check-label" for="hobby{{ $hobby->id }}">
                                                        {{ $hobby->name }}
                                                    </label>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="invalid-feedback"></div>
                            </div>
                            
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-success btn-action">
                                    <i class="bi bi-check-circle-fill"></i> Save
                                </button>
                                <button type="button" id="cancelBtn" class="btn btn-secondary btn-action">
                                    <i class="bi bi-x-circle-fill"></i> Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.32/dist/sweetalert2.all.min.js"></script>
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let table;
        let editingRowId = null;
        
        $(document).ready(function() {
            loadUsers();
            
            $('#profilePicInput').change(function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#previewImg').attr('src', e.target.result);
                        $('#profilePreview').show();
                    }
                    reader.readAsDataURL(file);
                } else {
                    $('#profilePreview').hide();
                }
            });
            
            $('#addNewBtn').click(function() {
                $('#tableView').hide();
                $('#formView').show();
            });
            
            $('#cancelBtn').click(function() {
                $('#formView').hide();
                $('#tableView').show();
                $('#userForm')[0].reset();
                $('.form-control').removeClass('is-invalid');
                $('#profilePreview').hide();
            });
            
            $('#userForm').submit(function(e) {
                e.preventDefault();
                
                let formData = new FormData();
                formData.append('name', $('[name="name"]').val());
                formData.append('phone', $('[name="phone"]').val());
                formData.append('category_id', $('[name="category_id"]').val());
                
                let profilePicFile = $('[name="profile_pic"]');
                if (profilePicFile.length > 0 && profilePicFile[0].files && profilePicFile[0].files.length > 0) {
                    formData.append('profile_pic', profilePicFile[0].files[0]);
                }
                
                $('[name="hobbies[]"]:checked').each(function() {
                    formData.append('hobbies[]', $(this).val());
                });
                
                $.ajax({
                    url: '{{ route("users.store") }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        $('#formView').hide();
                        $('#tableView').show();
                        $('#userForm')[0].reset();
                        $('#profilePreview').hide();
                        loadUsers();
                        Swal.fire({
                            icon: 'success',
                            title: 'Success!',
                            text: response.message,
                            confirmButtonColor: '#27ae60',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            $('.form-control').removeClass('is-invalid');
                            $('.invalid-feedback').text('');
                            
                            let errorMsg = '';
                            for (let field in errors) {
                                $('[name="' + field + '"]').addClass('is-invalid');
                                $('[name="' + field + '"]').siblings('.invalid-feedback').text(errors[field][0]);
                                errorMsg += errors[field][0] + '<br>';
                            }
                            
                            if (errors.hobbies) {
                                $('.hobby-section').siblings('.invalid-feedback').text(errors.hobbies[0]);
                                errorMsg += errors.hobbies[0] + '<br>';
                            }
                            
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: errorMsg,
                                confirmButtonColor: '#3498db'
                            });
                        }
                    }
                });
            });
            
            $('#selectAll').click(function() {
                $('.row-checkbox').prop('checked', this.checked);
            });
            
            $('#bulkDeleteBtn').click(function() {
                let selectedIds = [];
                $('.row-checkbox:checked').each(function() {
                    selectedIds.push($(this).val());
                });
                
                if (selectedIds.length === 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'No Selection',
                        text: 'Please select at least one row to delete',
                        confirmButtonColor: '#3498db'
                    });
                    return;
                }
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You are about to delete ' + selectedIds.length + ' user(s)!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74c3c',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete them!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route("users.bulkDestroy") }}',
                            method: 'POST',
                            data: { ids: selectedIds },
                            success: function(response) {
                                loadUsers();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message,
                                    confirmButtonColor: '#27ae60',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        });
                    }
                });
            });
        });
        
        function loadUsers() {
            $.ajax({
                url: '{{ route("users.getData") }}',
                method: 'GET',
                success: function(users) {
                    let tbody = $('#usersTable tbody');
                    tbody.empty();
                    
                    users.forEach(function(user) {
                        let hobbies = user.hobbies.map(h => `<span class="badge-hobby">${h.name}</span>`).join(' ');
                        let timestamp = new Date().getTime();
                        let profilePic = user.profile_pic 
                            ? `<img src="/uploads/profiles/${user.profile_pic}?v=${timestamp}" alt="Profile" style="width: 50px; height: 50px; object-fit: cover; border-radius: 50%; border: 2px solid #bdc3c7;">` 
                            : `<div style="width: 50px; height: 50px; background: #95a5a6; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-weight: 600; font-size: 20px;">${user.name.charAt(0)}</div>`;
                        
                        let row = `
                            <tr data-id="${user.id}" data-profile-pic="${user.profile_pic || 'None'}">
                                <td><input type="checkbox" class="row-checkbox checkbox-custom" value="${user.id}"></td>
                                <td><strong>#${user.id}</strong></td>
                                <td class="editable" data-field="profile_pic">${profilePic}</td>
                                <td class="editable" data-field="name">${user.name}</td>
                                <td class="editable" data-field="phone">${user.phone}</td>
                                <td class="editable" data-field="category_id" data-category-id="${user.category_id}">${user.category.name}</td>
                                <td class="editable" data-field="hobbies" data-hobby-ids="${user.hobbies.map(h => h.id).join(',')}">${hobbies}</td>
                                <td>
                                    <div class="btn-group-table">
                                        <button class="btn btn-sm btn-primary btn-sm-action edit-btn"><i class="bi bi-pencil-fill"></i> Edit</button>
                                        <button class="btn btn-sm btn-success btn-sm-action save-btn" style="display:none;"><i class="bi bi-check-lg"></i> Save</button>
                                        <button class="btn btn-sm btn-secondary btn-sm-action cancel-edit-btn" style="display:none;"><i class="bi bi-x-lg"></i> Cancel</button>
                                        <button class="btn btn-sm btn-danger btn-sm-action delete-btn"><i class="bi bi-trash-fill"></i> Delete</button>
                                    </div>
                                </td>
                            </tr>
                        `;
                        tbody.append(row);
                    });
                    
                    attachEditHandlers();
                }
            });
        }
        
        function attachEditHandlers() {
            $('.edit-btn').off('click').on('click', function() {
                let row = $(this).closest('tr');
                let userId = row.data('id');
                
                row.addClass('edit-row');
                
                row.find('.editable').each(function() {
                    let field = $(this).data('field');
                    let value = $(this).text().trim();
                    
                    console.log('Field:', field, 'Value:', value);
                    
                    if (field === 'profile_pic') {
                        let fileInput = '<input type="file" class="form-control form-control-sm edit-input" data-field="profile_pic" accept="image/*" id="edit_profile_pic_' + userId + '">';
                        fileInput += '<small class="text-muted d-block mt-1">Current: ' + (row.data('profile-pic') || 'No image') + '</small>';
                        $(this).html(fileInput);
                        
                        $('#edit_profile_pic_' + userId).on('change', function() {
                            if (this.files && this.files[0]) {
                                $(this).next('small').text('Selected: ' + this.files[0].name);
                            }
                        });
                    } else if (field === 'category_id') {
                        let categoryId = $(this).data('category-id');
                        let select = '<select class="form-control form-control-sm edit-input" data-field="category_id">';
                        select += '<option value="">Select Category</option>';
                        @foreach($categories as $category)
                            select += '<option value="{{ $category->id }}" ' + (categoryId == {{ $category->id }} ? 'selected' : '') + '>{{ $category->name }}</option>';
                        @endforeach
                        select += '</select>';
                        $(this).html(select);
                    } else if (field === 'hobbies') {
                        let hobbyIdsStr = $(this).data('hobby-ids') ? $(this).data('hobby-ids').toString() : '';
                        let hobbyIds = hobbyIdsStr ? hobbyIdsStr.split(',').map(id => id.trim()) : [];
                        console.log('Hobby IDs array:', hobbyIds);
                        let checkboxes = '<div>';
                        @foreach($hobbies as $hobby)
                            checkboxes += '<div class="form-check form-check-inline">';
                            checkboxes += '<input class="form-check-input edit-hobby-checkbox" type="checkbox" value="{{ $hobby->id }}" id="edit_hobby_{{ $hobby->id }}_' + userId + '" ' + (hobbyIds.includes('{{ $hobby->id }}') ? 'checked' : '') + '>';
                            checkboxes += '<label class="form-check-label" for="edit_hobby_{{ $hobby->id }}_' + userId + '">{{ $hobby->name }}</label>';
                            checkboxes += '</div>';
                        @endforeach
                        checkboxes += '</div>';
                        $(this).html(checkboxes);
                    } else {
                        let escapedValue = value.replace(/"/g, '&quot;').replace(/'/g, '&#39;');
                        $(this).html('<input type="text" class="form-control form-control-sm edit-input" data-field="' + field + '" value="' + escapedValue + '">');
                    }
                });
                
                $(this).hide();
                row.find('.save-btn').show();
                row.find('.cancel-edit-btn').show();
                row.find('.delete-btn').hide();
            });
            
            $('.save-btn').off('click').on('click', function() {
                let row = $(this).closest('tr');
                let userId = row.data('id');
                
                let formData = new FormData();
                formData.append('_method', 'PUT');
                
                let profilePicInput = row.find('.edit-input[data-field="profile_pic"]');
                console.log('Profile pic input found:', profilePicInput.length);
                if (profilePicInput.length > 0 && profilePicInput[0].files && profilePicInput[0].files.length > 0) {
                    console.log('Profile pic file selected:', profilePicInput[0].files[0].name);
                    formData.append('profile_pic', profilePicInput[0].files[0]);
                }
                
                let hobbies = [];
                row.find('.edit-hobby-checkbox:checked').each(function() {
                    hobbies.push($(this).val());
                    formData.append('hobbies[]', $(this).val());
                });
                
                console.log('Checked hobbies:', hobbies);
                console.log('Total checkboxes:', row.find('.edit-hobby-checkbox').length);
                console.log('Checked checkboxes:', row.find('.edit-hobby-checkbox:checked').length);
                
                let nameInput = row.find('.edit-input[data-field="name"]');
                let phoneInput = row.find('.edit-input[data-field="phone"]');
                let categoryInput = row.find('.edit-input[data-field="category_id"]');
                
                let nameVal = nameInput.val();
                let phoneVal = phoneInput.val();
                let categoryVal = categoryInput.val();
                
                console.log('Validation - Name:', nameVal, 'Phone:', phoneVal, 'Category:', categoryVal);
                console.log('Name input found:', nameInput.length);
                console.log('Phone input found:', phoneInput.length);
                console.log('Category select found:', categoryInput.length);
                
                let errors = [];
                if (!nameVal) errors.push('Name is required');
                if (!phoneVal) errors.push('Phone is required');
                if (!categoryVal) errors.push('Category is required');
                if (hobbies.length === 0) errors.push('At least one hobby is required');
                
                if (errors.length > 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Validation Error',
                        html: errors.join('<br>'),
                        confirmButtonColor: '#3498db'
                    });
                    return;
                }
                
                formData.append('name', nameVal);
                formData.append('phone', phoneVal);
                formData.append('category_id', categoryVal);
                
                $.ajax({
                    url: '/users/' + userId,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        console.log('Update response:', response);
                        if (response.user && response.user.profile_pic) {
                            console.log('New profile pic:', response.user.profile_pic);
                        }
                        loadUsers();
                        Swal.fire({
                            icon: 'success',
                            title: 'Updated!',
                            text: response.message,
                            confirmButtonColor: '#27ae60',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMsg = '';
                            for (let field in errors) {
                                errorMsg += errors[field][0] + '<br>';
                            }
                            Swal.fire({
                                icon: 'error',
                                title: 'Validation Error',
                                html: errorMsg,
                                confirmButtonColor: '#3498db'
                            });
                        }
                    }
                });
            });
            
            $('.cancel-edit-btn').off('click').on('click', function() {
                loadUsers();
            });
            
            $('.delete-btn').off('click').on('click', function() {
                let row = $(this).closest('tr');
                let userId = row.data('id');
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#e74c3c',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/users/' + userId,
                            method: 'DELETE',
                            success: function(response) {
                                loadUsers();
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Deleted!',
                                    text: response.message,
                                    confirmButtonColor: '#27ae60',
                                    timer: 2000,
                                    showConfirmButton: false
                                });
                            }
                        });
                    }
                });
            });
        }
    </script>
@endsection

