<?php $__env->startSection('page-title'); ?>
    <?php echo e(ucwords($project->project_name)); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        (function() {
            var options = {
                chart: {
                    type: 'area',
                    height: 60,
                    sparkline: {
                        enabled: true,
                    },
                },
                colors: ["#ffa21d"],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                series: [{
                    name: 'Bandwidth',
                    data: <?php echo e(json_encode(array_map('intval', $project_data['timesheet_chart']['chart']))); ?>

                }],

                tooltip: {
                    followCursor: false,
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function(seriesName) {
                                return ''
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            }
            var chart = new ApexCharts(document.querySelector("#timesheet_chart"), options);
            chart.render();
        })();

        (function() {
            var options = {
                chart: {
                    type: 'area',
                    height: 60,
                    sparkline: {
                        enabled: true,
                    },
                },
                colors: ["#ffa21d"],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: 'smooth',
                    width: 2,
                },
                series: [{
                    name: 'Bandwidth',
                    data: <?php echo e(json_encode($project_data['task_chart']['chart'])); ?>

                }],

                tooltip: {
                    followCursor: false,
                    fixed: {
                        enabled: false
                    },
                    x: {
                        show: false
                    },
                    y: {
                        title: {
                            formatter: function(seriesName) {
                                return ''
                            }
                        }
                    },
                    marker: {
                        show: false
                    }
                }
            }
            var chart = new ApexCharts(document.querySelector("#task_chart"), options);
            chart.render();
        })();

        $(document).ready(function() {
            loadProjectUser();
            $(document).on('click', '.invite_usr', function() {
                var project_id = $('#project_id').val();
                var user_id = $(this).attr('data-id');

                $.ajax({
                    url: '<?php echo e(route('invite.project.user.member')); ?>',
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        'project_id': project_id,
                        'user_id': user_id,
                        "_token": "<?php echo e(csrf_token()); ?>"
                    },
                    success: function(data) {
                        if (data.code == '200') {
                            show_toastr(data.status, data.success, 'success')
                            setInterval('location.reload()', 5000);
                            loadProjectUser();
                        } else if (data.code == '404') {
                            show_toastr(data.status, data.errors, 'error')
                        }
                    }
                });
            });
        });

        function loadProjectUser() {
            var mainEle = $('#project_users');
            var project_id = '<?php echo e($project->id); ?>';

            $.ajax({
                url: '<?php echo e(route('project.user')); ?>',
                data: {
                    project_id: project_id
                },
                beforeSend: function() {
                    $('#project_users').html(
                        '<tr><th colspan="2" class="h6 text-center pt-5"><?php echo e(__('Loading...')); ?></th></tr>');
                },
                success: function(data) {
                    mainEle.html(data.html);
                    $('[id^=fire-modal]').remove();
                    // loadConfirm();
                }
            });
        }
    </script>

    
    <script>
        function copyToClipboard(element) {

            var copyText = element.id;
            document.addEventListener('copy', function(e) {
                e.clipboardData.setData('text/plain', copyText);
                e.preventDefault();
            }, true);

            document.execCommand('copy');
            show_toastr('success', 'Url copied to clipboard', 'success');
        }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('projects.index')); ?>"><?php echo e(__('Project')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(ucwords($project->project_name)); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('share project')): ?>
            <a href="#" class="btn btn-sm btn-primary" data-ajax-popup="true" data-size="md"
                data-title="<?php echo e(__('Shared Project Settings')); ?>"
                data-url="<?php echo e(route('projects.copylink.setting.create', [$project->id])); ?>" data-toggle="tooltip"
                title="<?php echo e(__('Shared project settings')); ?>">
                <i class="ti ti-settings text-white"></i>
            </a>
            <?php $projectID= Crypt::encrypt($project->id); ?>
            <a href="#" id="<?php echo e(route('projects.link', \Illuminate\Support\Facades\Crypt::encrypt($project->id))); ?>"
                class="btn btn-sm btn-primary btn-icon m-1" onclick="copyToClipboard(this)" data-bs-toggle="tooltip"
                title="<?php echo e(__('Click to copy link')); ?>">
                <i class="ti ti-link text-white"></i>
            </a>
        <?php endif; ?>
        
        
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
            <a href="#" data-size="lg" data-url="<?php echo e(route('edit.status', $project->id)); ?>" data-ajax-popup="true"
                data-bs-toggle="tooltip" title="<?php echo e(__('Update Status')); ?>" class="btn btn-sm btn-primary">
                Update Status
            </a>
            <a href="#" data-size="lg" data-url="<?php echo e(route('projects.edit', $project->id)); ?>" data-ajax-popup="true"
                data-bs-toggle="tooltip" title="<?php echo e(__('Edit Project')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-pencil"></i>
            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
            <a href="#" data-size="lg" data-url="<?php echo e(route('projects.destroy', $project->id)); ?>"
                title="<?php echo e(__('Delete Project')); ?>" class="btn btn-sm btn-danger"
                onclick="confirmDelete(event, <?php echo e($project->id); ?>)">
                <i class="ti ti-trash"></i>
            </a>
        <?php endif; ?>


    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-warning">
                                    <i class="ti ti-list"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted h6"><?php echo e(__('Total Survey')); ?></small>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e($surveys->count()); ?></h4>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center justify-content-between">
                        <div class="col-auto mb-3 mb-sm-0">
                            <div class="d-flex align-items-center">
                                <div class="theme-avtar bg-danger">
                                    <i class="ti ti-report-money"></i>
                                </div>
                                <div class="ms-3">
                                    <small class="text-muted"><?php echo e(__('Total')); ?></small>
                                    <h6 class="m-0"><?php echo e(__('Survey Responses')); ?></h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto text-end">
                            <h4 class="m-0"><?php echo e($survey_count); ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-lg-4 col-md-6"></div>
        <div class="col-lg-6 col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div class="avatar me-3">
                            <img <?php echo e($project->img_image); ?> alt="" class="img-user wid-45 rounded-circle">
                        </div>
                        <div class="d-block  align-items-center justify-content-between w-100">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="mb-1"> <?php echo e($project->project_name); ?></h5>
                                <p class="mb-0 text-sm">
                                <div class="progress-wrapper">
                                    <span class="progress-percentage"><small
                                            class="font-weight-bold"><?php echo e(__('Completed:')); ?> :
                                        </small><?php echo e($project->project_progress()['percentage']); ?></span>
                                    <div class="progress progress-xs mt-2">
                                        <div class="progress-bar bg-info" role="progressbar"
                                            aria-valuenow="<?php echo e($project->project_progress()['percentage']); ?>"
                                            aria-valuemin="0" aria-valuemax="100"
                                            style="width: <?php echo e($project->project_progress()['percentage']); ?>;"></div>
                                    </div>
                                </div>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-10">
                            <h4 class="mt-3 mb-1"></h4>
                            <p> <?php echo e($project->description); ?></p>
                        </div>
                    </div>
                    <div class="card bg-primary mb-0">
                        <div class="card-body">
                            <div class="d-block d-sm-flex align-items-center justify-content-between">
                                <div class="row align-items-center">
                                    <span class="text-white text-sm"><?php echo e(__('Start Date')); ?></span>
                                    <h5 class="text-white text-nowrap">
                                        <?php echo e(Utility::getDateFormated($project->start_date)); ?></h5>
                                </div>
                                <div class="row align-items-center">
                                    <span class="text-white text-sm"><?php echo e(__('End Date')); ?></span>
                                    <h5 class="text-white text-nowrap"><?php echo e(Utility::getDateFormated($project->end_date)); ?>

                                    </h5>
                                </div>

                            </div>
                            <div class="row">
                                <span class="text-white text-sm"><?php echo e(__('Client')); ?></span>
                                <h5 class="text-white text-nowrap">
                                    <?php echo e(!empty($project->client) ? $project->client->name : '-'); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-4">
            <div class="card">
                <div class="card-header">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create milestone')): ?>
                        <div class="d-flex align-items-center justify-content-between">
                            <h5><?php echo e(__('Recent Survey')); ?> (<?php echo e($surveys->count()); ?>)</h5>

                            <div class="float-end">

                                <a href="<?php echo e(route('pro.survey.show', $project->id)); ?>" class="btn btn-sm btn-primary">
                                    View All

                                </a>
                                <a href="#" data-size="md" data-url="<?php echo e(route('createSurvey', $project->id)); ?>"
                                    data-ajax-popup="true" data-bs-toggle="tooltip" title=""
                                    class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Create New Survey')); ?>">
                                    <i class="ti ti-plus"></i>

                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php if($surveys->count() > 0): ?>
                            <?php $__currentLoopData = $surveys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $survey): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item px-0">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-sm-auto mb-3 mb-sm-0">
                                            <div class="d-flex align-items-center">
                                                <div class="div">

                                                    <h6 class="m-0"><?php echo e($survey->name); ?>


                                                    </h6>


                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-auto text-sm-end d-flex align-items-center">

                                            
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['survey.delete', $survey->id]]); ?>

                                                <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para"
                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i
                                                        class="ti ti-trash text-white"></i></a>
                                                <?php echo Form::close(); ?>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="py-5">
                                <h6 class="h6 text-center"><?php echo e(__('No Survey Found.')); ?></h6>
                            </div>
                        <?php endif; ?>



                    </ul>

                </div>
            </div>

        </div>
        
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center justify-content-between">
                        <h5><?php echo e(__('Add Members')); ?></h5>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                            <div class="float-end">
                                <a href="#" data-size="lg"
                                    data-url="<?php echo e(route('invite.project.member.view', $project->id)); ?>" data-ajax-popup="true"
                                    data-bs-toggle="tooltip" title="" class="btn btn-sm btn-primary"
                                    data-bs-original-title="<?php echo e(__('Add Member')); ?>">
                                    <i class="ti ti-plus"></i>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush list" id="project_users">
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <div class="card-header">
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create milestone')): ?>
                        <div class="d-flex align-items-center justify-content-between">
                            <h5><?php echo e(__('Milestones')); ?> (<?php echo e(count($project->milestones)); ?>)</h5>

                            <div class="float-end">
                                <a href="#" data-size="md" data-url="<?php echo e(route('project.milestone', $project->id)); ?>"
                                    data-ajax-popup="true" data-bs-toggle="tooltip" title=""
                                    class="btn btn-sm btn-primary" data-bs-original-title="<?php echo e(__('Create New Milestone')); ?>">
                                    <i class="ti ti-plus"></i>
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>

                </div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">
                        <?php if($project->milestones->count() > 0): ?>
                            <?php $__currentLoopData = $project->milestones; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $milestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="list-group-item px-0">
                                    <div class="row align-items-center justify-content-between">
                                        <div class="col-sm-auto mb-3 mb-sm-0">
                                            <div class="d-flex align-items-center">
                                                <div class="div">
                                                    <h6 class="m-0"><?php echo e($milestone->title); ?>

                                                        <span
                                                            class="badge-xs badge bg-<?php echo e(\App\Models\Project::$status_color[$milestone->status]); ?> p-2 px-3 rounded"><?php echo e(__(\App\Models\Project::$project_status[$milestone->status])); ?></span>
                                                    </h6>
                                                    <small
                                                        class="text-muted"><?php echo e($milestone->tasks->count() . ' ' . __('Tasks')); ?></small>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-auto text-sm-end d-flex align-items-center">
                                            <div class="action-btn bg-warning ms-2">
                                                <a href="#" data-size="md"
                                                    data-url="<?php echo e(route('project.milestone.show', $milestone->id)); ?>"
                                                    data-ajax-popup="true" data-bs-toggle="tooltip"
                                                    title="<?php echo e(__('View')); ?>" class="btn btn-sm">
                                                    <i class="ti ti-eye text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-info ms-2">
                                                <a href="#" data-size="md"
                                                    data-url="<?php echo e(route('project.milestone.edit', $milestone->id)); ?>"
                                                    data-ajax-popup="true" data-bs-toggle="tooltip"
                                                    title="<?php echo e(__('Edit')); ?>" class="btn btn-sm">
                                                    <i class="ti ti-pencil text-white"></i>
                                                </a>
                                            </div>
                                            <div class="action-btn bg-danger ms-2">
                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['project.milestone.destroy', $milestone->id]]); ?>

                                                <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                    data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i
                                                        class="ti ti-trash text-white"></i></a>

                                                <?php echo Form::close(); ?>

                                            </div>
                                        </div>
                                    </div>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php else: ?>
                            <div class="py-5">
                                <h6 class="h6 text-center"><?php echo e(__('No Milestone Found.')); ?></h6>
                            </div>
                        <?php endif; ?>
                    </ul>

                </div>
            </div>
        </div>
        
        
    </div>
    <script>
        function confirmDelete(event, projectId) {
            event.preventDefault();

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "<?php echo e(route('delete.project')); ?>",
                        type: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            projectId: projectId
                        },
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    'Your project has been deleted.',
                                    'success'
                                ).then(() => {
                                    window.location.href = response.redirect_url;
                                });
                            } else {
                                Swal.fire(
                                    'Failed!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr) {
                            Swal.fire(
                                'Error!',
                                'Failed to delete project. Please try again.',
                                'error'
                            );
                        }
                    });
                }
            });
        }
    </script>





<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/projects/view.blade.php ENDPATH**/ ?>