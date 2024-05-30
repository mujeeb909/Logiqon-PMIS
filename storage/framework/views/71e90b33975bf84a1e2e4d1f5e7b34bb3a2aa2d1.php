<?php $__env->startSection('page-title'); ?>
    <?php echo e(ucwords($project->project_name).__("'s Tasks")); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/plugins/dragula.min.css')); ?>" id="main-style-link">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('css/summernote/summernote-bs4.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/plugins/dragula.min.js')); ?>"></script>
    <script>
        !function (a) {
            "use strict";
            var t = function () {
                this.$body = a("body")
            };
            t.prototype.init = function () {
                a('[data-plugin="dragula"]').each(function () {
                    var t = a(this).data("containers"), n = [];
                    if (t) for (var i = 0; i < t.length; i++) n.push(a("#" + t[i])[0]); else n = [a(this)[0]];
                    var r = a(this).data("handleclass");
                    r ? dragula(n, {
                        moves: function (a, t, n) {
                            return n.classList.contains(r)
                        }
                    }) : dragula(n).on('drop', function (el, target, source, sibling) {
                        var sort = [];
                        $("#" + target.id + " > div").each(function () {
                            sort[$(this).index()] = $(this).attr('id');
                        });

                        var id = el.id;
                        var old_stage = $("#" + source.id).data('status');
                        var new_stage = $("#" + target.id).data('status');
                        var project_id = '<?php echo e($project->id); ?>';

                        $("#" + source.id).parent().find('.count').text($("#" + source.id + " > div").length);
                        $("#" + target.id).parent().find('.count').text($("#" + target.id + " > div").length);
                        $.ajax({
                            url: '<?php echo e(route('tasks.update.order',[$project->id])); ?>',
                            type: 'PATCH',
                            data: {id: id, sort: sort, new_stage: new_stage, old_stage: old_stage, project_id: project_id, "_token": "<?php echo e(csrf_token()); ?>"},
                            success: function (data) {
                            }
                        });
                    });
                })
            }, a.Dragula = new t, a.Dragula.Constructor = t
        }(window.jQuery), function (a) {
            "use strict";
            a.Dragula.init()
        }(window.jQuery);

        $(document).ready(function () {
            /*Set assign_to Value*/
            $(document).on('click', '.add_usr', function () {
                var ids = [];
                $(this).toggleClass('selected');
                var crr_id = $(this).attr('data-id');
                $('#usr_txt_' + crr_id).html($('#usr_txt_' + crr_id).html() == 'Add' ? '<?php echo e(__('Added')); ?>' : '<?php echo e(__('Add')); ?>');
                if ($('#usr_icon_' + crr_id).hasClass('ti-plus')) {
                    $('#usr_icon_' + crr_id).removeClass('ti-plus');
                    $('#usr_icon_' + crr_id).addClass('ti-check');
                } else {
                    $('#usr_icon_' + crr_id).removeClass('ti-check');
                    $('#usr_icon_' + crr_id).addClass('ti-plus');
                }
                $('.selected').each(function () {
                    ids.push($(this).attr('data-id'));
                });
                $('input[name="assign_to"]').val(ids);
            });

            $(document).on("click", ".del_task", function () {
                var id = $(this);
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    dataType: 'JSON',
                    data: {"_token": "<?php echo e(csrf_token()); ?>"},
                    success: function (data) {
                        $('#' + data.task_id).remove();
                        show_toastr('<?php echo e(__('success')); ?>', '<?php echo e(__("Task Deleted Successfully!")); ?>');
                    },
                });
            });

            /*For Task Comment*/
            $(document).on('click', '#comment_submit', function (e) {
                var curr = $(this);

                var comment = $.trim($("#form-comment textarea[name='comment']").val());
                if (comment != '') {
                    $.ajax({
                        url: $("#form-comment").data('action'),
                        data: {comment: comment, "_token": "<?php echo e(csrf_token()); ?>"},
                        type: 'POST',
                        success: function (data) {
                            data = JSON.parse(data);
                            console.log(data);
                            var html = "<div class='list-group-item px-0'>" +
                                "                    <div class='row align-items-center'>" +
                                "                        <div class='col-auto'>" +
                                "                            <a href='#' class='avatar avatar-sm rounded-circle ms-2'>" +
                                "                                <img src="+data.default_img+" alt='' class='avatar-sm rounded-circle'>" +
                                "                            </a>" +
                                "                        </div>" +
                                "                        <div class='col ml-n2'>" +
                                "                            <p class='d-block h6 text-sm font-weight-light mb-0 text-break'>" + data.comment + "</p>" +
                                "                            <small class='d-block'>"+data.current_time+"</small>" +
                                "                           </div>" +
                                "                        <div class='action-btn bg-danger me-4'><div class='col-auto'><a href='#' class='mx-3 btn btn-sm  align-items-center delete-comment' data-url='" + data.deleteUrl + "'><i class='ti ti-trash text-white'></i></a></div></div>" +
                                "                    </div>" +
                                "                </div>";

                            $("#comments").prepend(html);
                            $("#form-comment textarea[name='comment']").val('');
                            load_task(curr.closest('.task-id').attr('id'));
                            show_toastr('<?php echo e(__('success')); ?>', '<?php echo e(__("Comment Added Successfully!")); ?>');
                        },
                        error: function (data) {
                            show_toastr('error', '<?php echo e(__("Some Thing Is Wrong!")); ?>');
                        }
                    });
                } else {
                    show_toastr('error', '<?php echo e(__("Please write comment!")); ?>');
                }
            });
            $(document).on("click", ".delete-comment", function () {
                var btn = $(this);

                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    dataType: 'JSON',
                    data: {"_token": "<?php echo e(csrf_token()); ?>"},
                    success: function (data) {
                        load_task(btn.closest('.task-id').attr('id'));
                        show_toastr('<?php echo e(__('success')); ?>', '<?php echo e(__("Comment Deleted Successfully!")); ?>');
                        btn.closest('.list-group-item').remove();
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            show_toastr('error', data.message);
                        } else {
                            show_toastr('error', '<?php echo e(__("Some Thing Is Wrong!")); ?>');
                        }
                    }
                });
            });

            /*For Task Checklist*/
            $(document).on('click', '#checklist_submit', function () {
                var name = $("#form-checklist input[name=name]").val();
                if (name != '') {
                    $.ajax({
                        url: $("#form-checklist").data('action'),
                        data: {name: name, "_token": "<?php echo e(csrf_token()); ?>"},
                        type: 'POST',
                        success: function (data) {
                            data = JSON.parse(data);
                            console.log('form-checklist', data);
                            load_task($('.task-id').attr('id'));
                            show_toastr('<?php echo e(__('success')); ?>', '<?php echo e(__("Checklist Added Successfully!")); ?>');
                            var html = '<div class="card border shadow-none checklist-member">' +
                                '                    <div class="px-3 py-2 row align-items-center">' +
                                '                        <div class="col">' +
                                '                            <div class="form-check form-check-inline">' +
                                '                                <input type="checkbox" class="form-check-input" id="check-item-' + data.id + '" value="' + data.id + '" data-url="' + data.updateUrl + '">' +
                                '                                <label class="form-check-label h6 text-sm" for="check-item-' + data.id + '">' + data.name + '</label>' +
                                '                            </div>' +
                                '                        </div>' +
                                '                        <div class="col-auto"> <div class="action-btn bg-danger ms-2">' +
                                '                            <a href="#" class="mx-3 btn btn-sm  align-items-center delete-checklist" role="button" data-url="' + data.deleteUrl + '">' +
                                '                                <i class="ti ti-trash text-white"></i>' +
                                '                            </a>' +
                                '                        </div></div>' +
                                '                    </div>' +
                                '                </div>'

                            $("#checklist").append(html);
                            $("#form-checklist input[name=name]").val('');
                            $("#form-checklist").collapse('toggle');
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            show_toastr('error', data.message);
                        }
                    });
                } else {
                    show_toastr('error', '<?php echo e(__("Please write checklist name!")); ?>');
                }
            });
            $(document).on("change", "#checklist input[type=checkbox]", function () {
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'POST',
                    dataType: 'JSON',
                    data: {"_token": "<?php echo e(csrf_token()); ?>"},
                    success: function (data) {
                        load_task($('.task-id').attr('id'));
                        show_toastr('<?php echo e(__('Success')); ?>', '<?php echo e(__("Checklist Updated Successfully!")); ?>', 'success');
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            show_toastr('error', data.message);
                        } else {
                            show_toastr('error', '<?php echo e(__("Some Thing Is Wrong!")); ?>');
                        }
                    }
                });
            });
            $(document).on("click", ".delete-checklist", function () {
                var btn = $(this);
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    dataType: 'JSON',
                    data: {"_token": "<?php echo e(csrf_token()); ?>"},
                    success: function (data) {
                        load_task($('.task-id').attr('id'));
                        show_toastr('<?php echo e(__('success')); ?>', '<?php echo e(__("Checklist Deleted Successfully!")); ?>');
                        btn.closest('.checklist-member').remove();
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            show_toastr('error', data.message);
                        } else {
                            show_toastr('error', '<?php echo e(__("Some Thing Is Wrong!")); ?>');
                        }
                    }
                });
            });

            /*For Task Attachment*/
            $(document).on('click', '#file_attachment_submit', function () {
                var file_data = $("#task_attachment").prop("files")[0];
                if (file_data != '' && file_data != undefined) {
                    var formData = new FormData();
                    formData.append('file', file_data);
                    formData.append('_token', "<?php echo e(csrf_token()); ?>");
                    $.ajax({
                        url: $("#file_attachment_submit").data('action'),
                        type: 'POST',
                        data: formData,
                        cache: false,
                        processData: false,
                        contentType: false,
                        success: function (data) {
                            $('#task_attachment').val('');
                            $('.attachment_text').html('<?php echo e(__('Choose a file…')); ?>');
                            data = JSON.parse(data);
                            load_task(data.task_id);
                            show_toastr('<?php echo e(__('success')); ?>', '<?php echo e(__("File Added Successfully!")); ?>');

                            var delLink = '';
                            if (data.deleteUrl.length > 0) {
                                delLink = ' <div class="action-btn bg-danger "><a href="#" class="action-item delete-comment-file" role="button" data-url="' + data.deleteUrl + '">' +
                                    '                                        <i class="ti ti-trash text-white"></i>' +
                                    '                                    </a></div>';
                            }

                            var html = '<div class="card mb-3 border shadow-none task-file">' +
                                '                    <div class="px-3 py-3">' +
                                '                        <div class="row align-items-center">' +
                                '                            <div class="col ml-n2">' +
                                '                                <h6 class="text-sm mb-0">' +
                                '                                    <a href="#">' + data.name + '</a>' +
                                '                                </h6>' +
                                '                                <p class="card-text small text-muted">' + data.file_size + '</p>' +
                                '                           </div>' +
                                '                            <div class="col-auto"> <div class="action-btn bg-secondary ">' +
                                '                                <a href="<?php echo e(asset(Storage::url('tasks'))); ?>/' + data.file + '" download class="action-item" role="button">' +
                                '                                    <i class="ti ti-download text-white"></i>' +
                                '                                </a>' +
                                '                            </div></div>' +
                                delLink +
                                '                        </div>' +
                                '                    </div>' +
                                '                </div>'

                            $("#comments-file").prepend(html);
                        },
                        error: function (data) {
                            data = data.responseJSON;
                            console.log('error', data);
                            if (data.message) {
                                show_toastr('error', data.errors.file[0]);
                                $('#file-error').text(data.errors.file[0]).show();
                            } else {
                                show_toastr('error', '<?php echo e(__("Some Thing Is Wrong!")); ?>');
                            }
                        }
                    });
                } else {
                    show_toastr('error', '<?php echo e(__("Please select file!")); ?>');
                }
                console.log('not working');
            });
            $(document).on("click", ".delete-comment-file", function () {
                var btn = $(this);
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'DELETE',
                    dataType: 'JSON',
                    data: {"_token": "<?php echo e(csrf_token()); ?>"},
                    success: function (data) {
                        load_task(btn.closest('.task-id').attr('id'));
                        show_toastr('<?php echo e(__('success')); ?>', '<?php echo e(__("File Deleted Successfully!")); ?>');
                        btn.closest('.task-file').remove();
                    },
                    error: function (data) {
                        data = data.responseJSON;
                        if (data.message) {
                            show_toastr('error', data.message);
                        } else {
                            show_toastr('error', '<?php echo e(__("Some Thing Is Wrong!")); ?>');
                        }
                    }
                });
            });

            /*For Favorite*/
            $(document).on('click', '#add_favourite', function () {
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'POST',
                    data: {"_token": "<?php echo e(csrf_token()); ?>"},
                    success: function (data) {
                        if (data.fav == 1) {
                            $('#add_favourite').addClass('action-favorite');
                        } else if (data.fav == 0) {
                            $('#add_favourite').removeClass('action-favorite');
                        }
                    }
                });
            });

            /*For Complete*/
            $(document).on('change', '#complete_task', function () {
                $.ajax({
                    url: $(this).attr('data-url'),
                    type: 'POST',
                    data: {"_token": "<?php echo e(csrf_token()); ?>"},
                    success: function (data) {
                        if (data.com == 1) {
                            $("#complete_task").prop("checked", true);
                        } else if (data.com == 0) {
                            $("#complete_task").prop("checked", false);
                        }
                        $('#' + data.task).insertBefore($('#task-list-' + data.stage + ' .empty-container'));
                        load_task(data.task);
                    }
                });
            });

            /*Progress Move*/
            $(document).on('change', '#task_progress', function () {
                var progress = $(this).val();
                $('#t_percentage').html(progress);
                $.ajax({
                    url: $(this).attr('data-url'),
                    data: {progress: progress, "_token": "<?php echo e(csrf_token()); ?>"},
                    type: 'POST',
                    success: function (data) {
                        load_task(data.task_id);
                    }
                });
            });
        });

        function load_task(id) {
            $.ajax({
                url: "<?php echo e(route('projects.tasks.get','_task_id')); ?>".replace('_task_id', id),
                dataType: 'html',
                data: {"_token": "<?php echo e(csrf_token()); ?>"},
                success: function (data) {
                    $('#' + id).html('');
                    $('#' + id).html(data);
                }
            });
        }

    </script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('projects.index')); ?>"><?php echo e(__('Project')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('projects.show',$project->id)); ?>"><?php echo e(ucwords($project->project_name)); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Task')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row kanban-wrapper horizontal-scroll-cards" data-containers='<?php echo e(json_encode($stageClass)); ?>' data-plugin="dragula">
                <?php $__currentLoopData = $stages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php ($tasks = $stage->tasks); ?>
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create project task')): ?>
                                    <div class="float-end">
                                        <a href="#" data-size="lg" data-url="<?php echo e(route('projects.tasks.create',[$project->id,$stage->id])); ?>" data-ajax-popup="true" data-bs-toggle="tooltip" title="<?php echo e(__('Add Task in ').$stage->name); ?>" class="btn btn-sm btn-primary">
                                            <i class="ti ti-plus"></i>
                                        </a>
                                    </div>
                                <?php endif; ?>
                                <h4 class="mb-0"><?php echo e($stage->name); ?></h4>
                            </div>
                            <div class="card-body kanban-box" id="task-list-<?php echo e($stage->id); ?>" data-status="<?php echo e($stage->id); ?>">
                                <?php $__currentLoopData = $tasks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $taskDetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="card draggable-item" id="<?php echo e($taskDetail->id); ?>">
                                        <div class="pt-3 ps-3">
                                            <div class="badge-xs badge bg-<?php echo e(\App\Models\ProjectTask::$priority_color[$taskDetail->priority]); ?> p-2 px-3 rounded"><?php echo e(__(\App\Models\ProjectTask::$priority[$taskDetail->priority])); ?></div>
                                        </div>
                                        <div class="card-header border-0 pb-0 position-relative">
                                            <h5>
                                                <a href="#" data-url="<?php echo e(route('projects.tasks.show',[$project->id,$taskDetail->id])); ?>" data-ajax-popup="true" data-size="lg" data-bs-original-title="<?php echo e($taskDetail->name); ?>"><?php echo e($taskDetail->name); ?></a>
                                            </h5>
                                            <div class="card-header-right">
                                                <div class="btn-group card-option">
                                                    <button type="button" class="btn dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-haspopup="true"
                                                            aria-expanded="false">
                                                        <i class="ti ti-dots-vertical"></i>
                                                    </button>

                                                    <div class="dropdown-menu dropdown-menu-end">

                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view project task')): ?>
                                                            <a href="#!" data-size="md" data-url="<?php echo e(route('projects.tasks.show',[$project->id,$taskDetail->id])); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('View')); ?>">
                                                                <i class="ti ti-bookmark"></i>
                                                                <span><?php echo e(__('View')); ?></span>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project task')): ?>
                                                            <a href="#!" data-size="lg" data-url="<?php echo e(route('projects.tasks.edit',[$project->id,$taskDetail->id])); ?>" data-ajax-popup="true" class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit ').$taskDetail->name); ?>">
                                                                <i class="ti ti-pencil"></i>
                                                                <span><?php echo e(__('Edit')); ?></span>
                                                            </a>
                                                        <?php endif; ?>
                                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete project task')): ?>
                                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['projects.tasks.destroy', [$project->id,$taskDetail->id]]]); ?>

                                                            <a href="#!" class="dropdown-item bs-pass-para">
                                                                <i class="ti ti-archive"></i>
                                                                <span> <?php echo e(__('Delete')); ?> </span>
                                                            </a>
                                                            <?php echo Form::close(); ?>

                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card-body">
                                            <div class="d-flex align-items-center justify-content-between mb-2">
                                                <ul class="list-inline mb-0">
                                                    <li class="list-inline-item d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Files')); ?>">
                                                        <i class="f-16 text-primary ti ti-file"></i> <?php echo e(count($taskDetail->taskFiles)); ?>

                                                    </li>
                                                    <li class="list-inline-item d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Task Progress')); ?>">
                                                        <?php if(str_replace('%','',$taskDetail->taskProgress()['percentage']) > 0): ?><span class="text-md"><?php echo e($taskDetail->taskProgress()['percentage']); ?></span><?php endif; ?>
                                                    </li>
                                                </ul>
                                                <div class="user-group">
                                                    <?php if(!empty($taskDetail->end_date) && $taskDetail->end_date != '0000-00-00'): ?><span data-bs-toggle="tooltip" title="<?php echo e(__('End Date')); ?>" <?php if(strtotime($taskDetail->end_date) < time()): ?>class="text-danger"<?php endif; ?>><?php echo e(Utility::getDateFormated($taskDetail->end_date)); ?></span><?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <ul class="list-inline mb-0">

                                                    <li class="list-inline-item d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Comments')); ?>">
                                                        <i class="f-16 text-primary ti ti-message"></i> <?php echo e(count($taskDetail->comments)); ?>

                                                    </li>

                                                    <li class="list-inline-item d-inline-flex align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Task Checklist')); ?>">
                                                        <i class="f-16 text-primary ti ti-list"></i><?php echo e($taskDetail->countTaskChecklist()); ?>

                                                    </li>
                                                </ul>
                                                <div class="user-group">
                                                    <?php $__currentLoopData = $taskDetail->users(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?> alt="image" data-bs-toggle="tooltip" title="<?php echo e((!empty($user)?$user->name:'')); ?>">
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>

                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/project_task/index.blade.php ENDPATH**/ ?>