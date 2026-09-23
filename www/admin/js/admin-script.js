var deleteId = null;
$(document).ready(function() {

    // ========================================
    // SIDEBAR TOGGLE
    // ========================================
    $('#sidebarToggle, #sidebarOverlay').on('click', function() {
        $('#sidebar').toggleClass('active');
        $('#sidebarOverlay').toggleClass('active');
    });

    // Close sidebar when clicking a link on mobile
    $('.sidebar-menu a').on('click', function() {
        if ($(window).width() < 992) {
            $('#sidebar').removeClass('active');
            $('#sidebarOverlay').removeClass('active');
        }
    });

    // ========================================
    // IMAGE PREVIEW
    // ========================================
    $('input[type="file"]').on('change', function(e) {
        const file = e.target.files[0];
        const previewId = $(this).data('preview');

        if (file && previewId) {
            const reader = new FileReader();

            reader.onload = function(e) {
                $(`#${previewId}`).attr('src', e.target.result).show();
            }

            reader.readAsDataURL(file);
        }
    });

    // ========================================
    // DELETE CONFIRMATION
    // ========================================
    $('.delete-btn').on('click', function(e) {
        e.preventDefault();
        deleteId = $(this).data('id');
        var modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
        modal.show();
    });

    $("#confirmDeleteBtn").click(function(){
        if(deleteId) {
        var f = $('<form>', {method:'GET'});
        f.append($('<input>', {type:'hidden', name:'delete', value:deleteId}));
        $('body').append(f);
        f.submit();
        }
    });

    // ========================================
    // TEXTAREA AUTO-RESIZE
    // ========================================
    $('textarea').each(function() {
        this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
    }).on('input', function() {
        this.style.height = 'auto';
        this.style.height = (this.scrollHeight) + 'px';
    });

    // ========================================
    // TOOLTIPS & POPOVERS
    // ========================================
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.map(function (popoverTriggerEl) {
        return new bootstrap.Popover(popoverTriggerEl);
    });

    // ========================================
    // COUNTER ANIMATION
    // ========================================
    $('.stat-card h3').each(function() {
        const $this = $(this);
        const countTo = parseInt($this.text());

        if (!isNaN(countTo)) {
            $({ countNum: 0 }).animate({
                countNum: countTo
            }, {
                duration: 1000,
                easing: 'linear',
                step: function() {
                    $this.text(Math.floor(this.countNum));
                },
                complete: function() {
                    $this.text(this.countNum);
                }
            });
        }
    });

    // Open Add Modal
    $('.add-btn').on('click', function() {
        let category = $(this).data('category') || 'residential';
        $('#serviceModalTitle').html('<i class="fas fa-plus"></i> Add New ' + capitalizeFirstLetter(category) + ' Service');
        $('#modal_action').val('add');
        $('#modal_id').val('');
        $('#modal_title, #modal_description').val('');
        $('#modal_icon_class').val('').trigger('input');
        $('#modal_image').val('');
        $('#modal_category').val(category);
        $('#modal_status').val('active');
        $('#modal_submit_btn').removeClass('btn-warning').addClass('btn-primary').text('Add Service');
        $('#current_img_box').hide();
        $('#serviceModal').modal('show');
    });

    // Open Edit Modal
    $('.edit-btn').on('click', function() {
        let category = $(this).data('category') || 'residential';
        $('#serviceModalTitle').html('<i class="fas fa-edit"></i> Edit ' + capitalizeFirstLetter(category) + ' Service');
        $('#modal_action').val('edit');
        $('#modal_id').val($(this).data('id'));
        $('#modal_title').val($(this).data('title'));
        $('#modal_description').val($(this).data('description'));
        $('#modal_category').val(category);
        $('#modal_status').val($(this).data('status'));
        $('#modal_icon_class').val($(this).data('icon_class')).trigger('input');
        $('#modal_submit_btn').removeClass('btn-primary').addClass('btn-warning').text('Update Service');
        $('#modal_image').val('');
        $('#modal_preview').hide();
        // Show current image if available
        let img = $(this).data('image');
        if (img) {
            $('#modal_current_image').attr('src', img);
            $('#current_img_box').show();
        } else {
            $('#current_img_box').hide();
        }
        $('#serviceModal').modal('show');
    });

    $('#modal_icon_class').on('input', function(){
        var val = $(this).val();
        if(val) {
            $('#iconPreview').html('<i class="fas '+val+'"></i>');
        } else {
            $('#iconPreview').html('');
        }
    });

    $('.view-btn').on('click', function(){
        $('#modal_lead_name').text($(this).data('name'));
        $('#modal_lead_email').text($(this).data('email'));
        $('#modal_lead_subject').text($(this).data('subject'));
        $('#modal_lead_ip').text($(this).data('ip'));
        $('#modal_lead_date').text($(this).data('date'));
        $('#modal_lead_message').text($(this).data('message'));
    });

    // Add/Edit Modal Open - Fill Data
    $('.testimonial-add-btn').on('click', function() {
        $('#testimonialModalTitle').text('Add New Testimonial');
        $('#modal_action').val('add');
        $('#testimonialForm')[0].reset();
        $('#modal_id').val('');
        $('#modal_submit_btn').text('Add');
    });

    $('.testimonial-edit-btn').on('click', function() {
        $('#testimonialModalTitle').text('Edit Testimonial');
        $('#modal_action').val('edit');
        $('#modal_id').val($(this).data('id'));
        $('#modal_name').val($(this).data('name'));
        $('#modal_title').val($(this).data('title'));
        $('#modal_designation').val($(this).data('designation'));
        $('#modal_description').val($(this).data('description'));
        $('#modal_city').val($(this).data('city'));
        $('#modal_star').val($(this).data('star'));
        $('#modal_status').val($(this).data('status'));
        $('#modal_submit_btn').text('Update');
        // Image preview logic (optional)
        if ($(this).data('image')) {
            $('#modal_current_image').attr('src', $(this).data('image')).show();
            $('#current_img_box').show();
        } else {
            $('#current_img_box').hide();
        }
        $('#testimonialModal').modal('show');
    });

    // Hide image preview on modal close
    $('#testimonialModal').on('hidden.bs.modal', function () {
        $('#modal_current_image').attr('src', '').hide();
        $('#current_img_box').hide();
    });

    $('.service-add-btn').on('click', function() {
        $('#serviceModalTitle').text('Add New Service');
        $('#modal_action').val('add');
        $('#serviceForm')[0].reset();
        $('#modal_id').val('');
        $('#modal_submit_btn').text('Add');
        $('#modal_current_image').hide();
        $('#current_img_box').hide();
        $('#serviceModal').modal('show');
    });
    $('.service-edit-btn').on('click', function() {
        $('#serviceModalTitle').text('Edit Service');
        $('#modal_action').val('edit');
        $('#modal_id').val($(this).data('id'));
        $('#modal_title').val($(this).data('title'));
        $('#modal_submit_btn').text('Update');
        // Show current image
        if ($(this).data('image')) {
            $('#modal_current_image').attr('src', $(this).data('image')).show();
            $('#current_img_box').show();
        } else {
            $('#current_img_box').hide();
        }
        $('#serviceModal').modal('show');
    });
    $('#serviceModal').on('hidden.bs.modal', function () {
        $('#modal_current_image').attr('src', '').hide();
        $('#current_img_box').hide();
    });

});

function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function togglePassword() {
    var input = document.getElementById('password');
    var icon = document.getElementById('eyeIcon');
    if (!input || !icon) return;
    if (input.type === 'password') {
        input.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        input.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}
// ========================================
// WINDOW RESIZE HANDLER
// ========================================
$(window).on('resize', function() {
    if ($(window).width() >= 992) {
        $('#sidebar').removeClass('active');
        $('#sidebarOverlay').removeClass('active');
    }
});
