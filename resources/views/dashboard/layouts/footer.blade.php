</div>
</div>
<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <script>
                    document.write(new Date().getFullYear())
                </script> © fronx Solution - fronxsolution.com
            </div>
            <div class="col-md-6">
                <div class="text-md-end footer-links d-none d-md-block">
                    <a href="javascript: void(0);">About</a>
                    <a href="javascript: void(0);">Support</a>
                    <a href="javascript: void(0);">Contact Us</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- end Footer -->

</div>

<!-- ============================================================== -->
<!-- End Page content -->
<!-- ============================================================== -->

</div>
<!-- END wrapper -->

<!-- Theme Settings -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="theme-settings-offcanvas">
    <div class="d-flex align-items-center bg-primary p-3 offcanvas-header">
        <h5 class="text-white m-0">Theme Settings</h5>
        <button type="button" class="btn-close btn-close-white ms-auto" data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
    </div>

    <div class="offcanvas-body p-0">
        <div data-simplebar class="h-100">
            <div class="card mb-0 p-3">
                <div class="alert alert-warning" role="alert">
                    <strong>Customize </strong> the overall color scheme, sidebar menu, etc.
                </div>

                <h5 class="mt-0 fs-16 fw-bold mb-3">Choose Layout</h5>
                <div class="d-flex flex-column gap-2">
                    <div class="form-check form-switch">
                        <input id="customizer-layout01" name="data-layout" type="checkbox" value="vertical"
                            class="form-check-input">
                        <label class="form-check-label" for="customizer-layout01">Vertical</label>
                    </div>
                    <div class="form-check form-switch">
                        <input id="customizer-layout02" name="data-layout" type="checkbox" value="horizontal"
                            class="form-check-input">
                        <label class="form-check-label" for="customizer-layout02">Horizontal</label>
                    </div>
                </div>

                <h5 class="my-3 fs-16 fw-bold">Color Scheme</h5>

                <div class="d-flex flex-column gap-2">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-light"
                            value="light">
                        <label class="form-check-label" for="layout-color-light">Light</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="data-bs-theme" id="layout-color-dark"
                            value="dark">
                        <label class="form-check-label" for="layout-color-dark">Dark</label>
                    </div>
                </div>

                <div id="layout-width">
                    <h5 class="my-3 fs-16 fw-bold">Layout Mode</h5>

                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-layout-mode"
                                id="layout-mode-fluid" value="fluid">
                            <label class="form-check-label" for="layout-mode-fluid">Fluid</label>
                        </div>

                        <div id="layout-boxed">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-layout-mode"
                                    id="layout-mode-boxed" value="boxed">
                                <label class="form-check-label" for="layout-mode-boxed">Boxed</label>
                            </div>
                        </div>

                        <div id="layout-detached">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" name="data-layout-mode"
                                    id="data-layout-detached" value="detached">
                                <label class="form-check-label" for="data-layout-detached">Detached</label>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 class="my-3 fs-16 fw-bold">Topbar Color</h5>

                <div class="d-flex flex-column gap-2">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="data-topbar-color" id="topbar-color-light"
                            value="light">
                        <label class="form-check-label" for="topbar-color-light">Light</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="data-topbar-color"
                            id="topbar-color-dark" value="dark">
                        <label class="form-check-label" for="topbar-color-dark">Dark</label>
                    </div>

                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="data-topbar-color"
                            id="topbar-color-brand" value="brand">
                        <label class="form-check-label" for="topbar-color-brand">Brand</label>
                    </div>
                </div>

                <div>
                    <h5 class="my-3 fs-16 fw-bold">Menu Color</h5>

                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-menu-color"
                                id="leftbar-color-light" value="light">
                            <label class="form-check-label" for="leftbar-color-light">Light</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-menu-color"
                                id="leftbar-color-dark" value="dark">
                            <label class="form-check-label" for="leftbar-color-dark">Dark</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-menu-color"
                                id="leftbar-color-brand" value="brand">
                            <label class="form-check-label" for="leftbar-color-brand">Brand</label>
                        </div>
                    </div>
                </div>

                <div id="sidebar-size">
                    <h5 class="my-3 fs-16 fw-bold">Sidebar Size</h5>

                    <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                id="leftbar-size-default" value="default">
                            <label class="form-check-label" for="leftbar-size-default">Default</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                id="leftbar-size-compact" value="compact">
                            <label class="form-check-label" for="leftbar-size-compact">Compact</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                id="leftbar-size-small" value="condensed">
                            <label class="form-check-label" for="leftbar-size-small">Condensed</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                id="leftbar-size-small-hover" value="sm-hover">
                            <label class="form-check-label" for="leftbar-size-small-hover">Hover View</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                id="leftbar-size-full" value="full">
                            <label class="form-check-label" for="leftbar-size-full">Full Layout</label>
                        </div>

                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="data-sidenav-size"
                                id="leftbar-size-fullscreen" value="fullscreen">
                            <label class="form-check-label" for="leftbar-size-fullscreen">Fullscreen Layout</label>
                        </div>
                    </div>
                </div>

                <div id="layout-position">
                    <h5 class="my-3 fs-16 fw-bold">Layout Position</h5>

                    <div class="btn-group checkbox" role="group">
                        <input type="radio" class="btn-check" name="data-layout-position"
                            id="layout-position-fixed" value="fixed">
                        <label class="btn btn-soft-primary w-sm" for="layout-position-fixed">Fixed</label>

                        <input type="radio" class="btn-check" name="data-layout-position"
                            id="layout-position-scrollable" value="scrollable">
                        <label class="btn btn-soft-primary w-sm ms-0"
                            for="layout-position-scrollable">Scrollable</label>
                    </div>
                </div>

                <div id="sidebar-user">
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <label class="fs-16 fw-bold m-0" for="sidebaruser-check">Sidebar User Info</label>
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" name="sidebar-user"
                                id="sidebaruser-check">
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <div class="offcanvas-footer border-top p-3 text-center">
        <div class="row">
            <div class="col-6">
                <button type="button" class="btn btn-light w-100" id="reset-layout">Reset</button>
            </div>
            <div class="col-6">
                <a href="#" role="button" class="btn btn-primary w-100">Buy Now</a>
            </div>
        </div>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Select2 CSS & JS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/css/select2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0/dist/js/select2.min.js"></script>


{{-- Upload files directly --}}

<script>
    $('#uploadFileButton').click(function() {
        let files = $('#attachment')[0].files;

        if (files.length === 0) {
            alert('Please select at least one file.');
            return;
        }

        let formData = new FormData();
        for (let i = 0; i < files.length; i++) {
            formData.append('filename[]', files[i]);
        }

        // CSRF Token
        formData.append('_token', '{{ csrf_token() }}');

        $.ajax({
            url: "{{ route('media.upload') }}", // 👈 Your Laravel route
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Files uploaded successfully!');
                $('#uploadFileModal').modal('hide');
                clearFileInput();
                location.reload(); // reload to update media list, or you can append dynamically
            },
            error: function(xhr) {
                alert('Something went wrong!');
                console.log(xhr.responseText);
            }
        });
    });

    function clearFileInput() {
        $('#attachment').val('');
    }
</script>

{{-- Multiple select upload from gallery --}}
<script>
    $(document).ready(function() {
        let selectedMedia = [];

        // Load media on modal open
        $('#mediaGalleryModal').on('show.bs.modal', function() {
            $.ajax({
                url: '{{ route('media-gallery') }}',
                method: 'GET',
                success: function(data) {
                    $('#mediaGalleryModalBody').empty();

                    if (data.length > 0) {
                        data.forEach(function(item) {
                            const mediaType = item.file_type;
                            const mediaUrl = '/dashboard/uploads/' + item.filename;
                            const mediaName = item.filename;
                            const fileExtension = mediaName.split('.').pop()
                                .toUpperCase();

                            let previewContent = '';

                            if (mediaType === 'image') {
                                previewContent = `
                            <img class="card-img-top" src="${mediaUrl}" alt="${mediaName}" style="height: 10rem; object-fit: cover;">
                        `;
                            } else {
                                previewContent = `
                            <div class="d-flex align-items-center justify-content-center" style="height: 10rem; background-color: #f1f1f1;">
                                <strong>${fileExtension}</strong>
                            </div>
                        `;
                            }

                            const mediaCard = `
                        <div class="col-md-4 mb-3">
                            <div class="card position-relative media-item" data-url="${mediaUrl}" data-type="${mediaType}">
                                ${previewContent}
                                <div class="card-body">
                                    <h6 class="card-title text-truncate" title="${mediaName}">${mediaName}</h6>
                                </div>
                            </div>
                        </div>
                    `;
                            $('#mediaGalleryModalBody').append(mediaCard);
                        });
                    } else {
                        $('#mediaGalleryModalBody').append('<p>No media available</p>');
                    }
                },
                error: function(error) {
                    console.log('Error loading media:', error);
                    $('#mediaGalleryModalBody').append(
                        '<p>Error loading media. Please try again.</p>');
                }
            });
        });

        // Select media
        $(document).on('click', '.media-item', function(e) {
            if ($(e.target).closest('.remove-selected-media').length) return;

            const mediaUrl = $(this).data('url');
            const mediaType = $(this).data('type');
            const mediaName = $(this).find('.card-title').text();

            const existingIndex = selectedMedia.findIndex(media => media.url === mediaUrl);
            if (existingIndex > -1) {
                selectedMedia.splice(existingIndex, 1);
                $(this).removeClass('bg-info');
            } else {
                selectedMedia.push({
                    url: mediaUrl,
                    type: mediaType,
                    name: mediaName
                });
                $(this).addClass('bg-info');
            }
        });

        // Show selected media with trash icon on all
        $('#selectMediaBtn').on('click', function() {
            const selectedMediaDisplay = $('#selectedMediaDisplay');
            selectedMediaDisplay.empty();

            selectedMedia.forEach(function(media, index) {
                const fileExtension = media.name.split('.').pop().toUpperCase();

                const preview = media.type === 'image' ?
                    `<img class="card-img-top" src="${media.url}" alt="${media.name}" style="height: 8rem; object-fit: cover;">` :
                    `<div class="d-flex align-items-center justify-content-center" style="height: 8rem; background-color: #f4f4f4;">
                   <strong>${fileExtension}</strong>
               </div>`;

                const deleteBtn = `
            <button class="btn btn-sm btn-outline-danger position-absolute top-0 end-0 m-1 remove-selected-media" data-index="${index}">
                <i class="fas fa-trash"></i>
            </button>`;

                const mediaElement = `
            <div class="media-preview position-relative" data-index="${index}">
                <div class="card m-2" style="width: 10rem; position: relative;">
                    ${preview}
                    ${deleteBtn}
                    <div class="card-body">
                        <h6 class="card-title text-truncate">${media.name}</h6>
                    </div>
                </div>
            </div>
        `;
                selectedMediaDisplay.append(mediaElement);
            });

            // Create hidden input fields for each selected media
            const selectedMediaSection = $('#selectedMediaSection');
            selectedMediaSection.find('input').remove(); // Remove any previous inputs

            selectedMedia.forEach(function(media, index) {
                const inputElement = `
            <input type="hidden" name="attachment[]" value="${media.url}">
        `;
                selectedMediaSection.append(inputElement);
            });
        });

        // Delete selected file (image or non-image)
        $(document).on('click', '.remove-selected-media', function(e) {
            e.stopPropagation();
            const index = $(this).data('index');
            selectedMedia.splice(index, 1);
            $('#selectMediaBtn').trigger('click');
        });
    });
</script>

{{-- Notification --}}

<script>
    // Function to clear the file input when the modal is closed (either via the Close button or the X button)
    function clearFileInput() {
        var fileInput = document.getElementById('attachment');
        if (fileInput) {
            fileInput.value = ''; // Clear the file input
        }
    }
</script>

<script>
    $(document).ready(function() {
        function fetchNotifications() {
            $.ajax({
                url: "{{ route('notifications.fetch') }}",
                method: "GET",
                success: function(response) {
                    let notificationDropdown = $("#notificationDropdown");
                    let notificationCount = $("#notificationCount");

                    notificationDropdown.empty();

                    let unreadCount = 0;

                    // Set inline styles for the notification dropdown to enable scrolling
                    notificationDropdown.css({
                        'max-height': '300px', // Adjust the max-height as per your requirement
                        'overflow-y': 'auto' // Enable vertical scrolling
                    });

                    if (response.length > 0) {
                        response.forEach(notification => {
                            if (!notification.is_read) {
                                unreadCount++;
                            }

                            let iconClass = notification.type === 'message' ?
                                'ri-message-3-line' : 'ri-user-add-line';
                            let bgColor = notification.type === 'message' ? 'bg-primary' :
                                'bg-info';
                            let timeAgo = notification.created_at ?? 'Just now';

                            function timeago(timestamp) {
                                const now = new Date();
                                const createdAt = new Date(timestamp);
                                const diffInSeconds = Math.floor((now - createdAt) / 1000);

                                if (diffInSeconds < 60) return `${diffInSeconds}s ago`;
                                const diffInMinutes = Math.floor(diffInSeconds / 60);
                                if (diffInMinutes < 60) return `${diffInMinutes}m ago`;
                                const diffInHours = Math.floor(diffInMinutes / 60);
                                if (diffInHours < 24) return `${diffInHours}h ago`;
                                const diffInDays = Math.floor(diffInHours / 24);
                                return `${diffInDays}d ago`;
                            }

                            timeAgo = timeago(notification.created_at);

                            let readClass = notification.is_read ? 'bg-light-subtle' :
                                'bg-secondary-subtle';

                            let text =
                                `${notification.task.assigned_from.first_name}`;
                            text = text.charAt(0).toUpperCase() + text.slice(1);


                            notificationDropdown.append(`
                            <a href="{{ url('/view-taskdetails/${notification.id}') }}" 
                                class="dropdown-item notify-item card m-0 shadow-none ${readClass}" 
                                data-id="${notification.id}">
                                <div class="card-body">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">
                                            <div class="notify-icon ${bgColor}">
                                                <i class="${iconClass} fs-18"></i>
                                            </div>
                                        </div>
                                        <div class="flex-grow-1 text-truncate ms-2">
                                          <h5 class="noti-item-title fw-medium fs-12">
                                         ${notification.message}
                                        </h5>
                                            <small class="noti-item-subtitle text-muted">${text}</small> -<small class="fw-normal text-muted ms-1">${timeAgo}</small>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        `);
                        });

                        if (unreadCount > 0) {
                            notificationCount.text(unreadCount).show();
                        } else {
                            notificationCount.hide();
                        }
                    } else {
                        notificationCount.hide();
                        notificationDropdown.append(
                            '<li class="p-2 text-muted">No new notifications</li>');
                    }
                },
                error: function() {
                    console.error("Failed to fetch notifications.");
                }
            });
        }

        $(document).on('click', '.notify-item', function(event) {
            event.preventDefault();
            let notificationId = $(this).data('id');
            let notificationLink = $(this).attr('href');

            $.ajax({
                url: "{{ route('notifications.markAsRead') }}",
                method: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: notificationId
                },
                success: function() {
                    fetchNotifications();
                    window.location.href = notificationLink;
                },
                error: function() {
                    console.error("Failed to mark notification as read.");
                    window.location.href = notificationLink;
                }
            });
        });

        setInterval(fetchNotifications, 10000);
        fetchNotifications();
    });
</script>

{{-- Remove attached files from edit Task form --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        document.querySelectorAll('.remove-attachment').forEach(button => {
            button.addEventListener('click', function() {
                let file = this.getAttribute('data-file');
                let listItem = this.closest('li'); // Select only the parent <li>

                // Fade-out effect before removal
                listItem.style.transition = "opacity 0.3s ease";
                listItem.style.opacity = "0";

                setTimeout(() => {
                    listItem.remove(); // Remove only this <li>
                }, 300);

                // Send request to delete file on the server
                fetch("{{ route('remove.attachment') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        file: file
                    })
                });
            });
        });
    });
</script>
{{-- mark as read btn --}}

<script>
    $(document).ready(function() {
        $("#clearNotifications").on("click", function() {
            $.ajax({
                url: "{{ route('notifications.markAsRead') }}", // Your route
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.success) {
                        $(".noti-icon-badge").hide(); // Hide notification count
                        $("#notificationDropdown").empty().append(
                            '<li class="p-2 text-muted">No new notifications</li>');
                    }
                },
                error: function() {
                    console.error("Failed to mark notifications as read.");
                }
            });
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let dueDateInput = document.getElementById("due_date");

        // Get today's date in YYYY-MM-DD format
        let today = new Date().toISOString().split("T")[0];

        // Set the min attribute to prevent past dates
        dueDateInput.setAttribute("min", today);
    });
</script>




<!-- Quill Editor js -->
<script src="{{ asset('dashboard/assets/vendor/quill/quill.min.js') }}"></script>

<!-- Quill Demo js -->
<script src="{{ asset('dashboard/assets/js/pages/demo.quilljs.js') }}"></script>

<!-- Vendor js -->
<script src="{{ asset('dashboard/assets/js/vendor.min.js') }}"></script>

<!-- Daterangepicker js -->
<script src="{{ asset('dashboard/assets/vendor/daterangepicker/moment.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/daterangepicker/daterangepicker.js') }}"></script>

<!-- Apex Charts js -->
<script src="{{ asset('dashboard/assets/vendor/apexcharts/apexcharts.min.js') }}"></script>

<!-- Vector Map js -->
<script src="{{ asset('dashboard/assets/vendor/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js') }}">
</script>
<script
    src="{{ asset('dashboard/assets/vendor/admin-resources/jquery.vectormap/maps/jquery-jvectormap-world-mill-en.js') }}">
</script>

<!-- Dashboard App js -->
<script src="{{ asset('dashboard/assets/js/pages/demo.dashboard.js') }}"></script>


<!-- Datatables js -->
<script src="{{ asset('dashboard/assets/vendor/datatables.net/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables.net-responsive/js/dataTables.responsive.min.js') }}">
</script>
<script src="{{ asset('dashboard/assets/vendor/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}">
</script>
<script src="{{ asset('dashboard/assets/vendor/datatables.net-fixedcolumns-bs5/js/fixedColumns.bootstrap5.min.js') }}">
</script>
<script src="{{ asset('dashboard/assets/vendor/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}">
</script>
<script src="{{ asset('dashboard/assets/vendor/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset('dashboard/assets/vendor/datatables.net-select/js/dataTables.select.min.js') }}"></script>

<!-- Datatable Demo Aapp js -->
<script src="{{ asset('dashboard/assets/js/pages/demo.datatable-init.js') }}"></script>

<!--  Select2 Plugin Js -->
<script src="{{ asset('dashboard/assets/vendor/select2/js/select2.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('dashboard/assets/js/app.min.js') }}"></script>

<!-- Fullcalendar js -->
<script src="{{ asset('dashboard/assets/vendor/fullcalendar/main.min.js') }}"></script>

<!-- Calendar App Demo js -->
<script src="{{ asset('dashboard/assets/js/pages/demo.calendar.js') }}"></script>

</body>

</html>
