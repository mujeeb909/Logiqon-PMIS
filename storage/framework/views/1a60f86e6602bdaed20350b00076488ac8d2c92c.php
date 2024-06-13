<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Form Builder')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).ready(function() {
            $('.cp_link').on('click', function() {
                var value = $(this).attr('data-link');
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(value).select();
                document.execCommand("copy");
                $temp.remove();
                show_toastr('success', '<?php echo e(__('Link Copy on Clipboard')); ?>')
            });
        });

        $(document).ready(function() {
            $('.iframe_link').on('click', function() {
                var value = $(this).attr('data-link');
                var $temp = $("<input>");
                $("body").append($temp);
                $temp.val(value).select();
                document.execCommand("copy");
                $temp.remove();
                show_toastr('success', '<?php echo e(__('Link Copy on Clipboard')); ?>')
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e($project->project_name); ?></li>
    <li class="breadcrumb-item"><?php echo e(__('Survey')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                                <tr>
                                    <th><?php echo e(__('Name')); ?></th>
                                    <th><?php echo e(__('Response')); ?></th>
                                    <th><?php echo e(__('Project')); ?></th>
                                    <?php if(\Auth::user()->type == 'company'): ?>
                                        <th class="text-end" width="200px"><?php echo e(__('Action')); ?></th>
                                    <?php endif; ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $forms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $form): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($form->name); ?></td>
                                        <td>
                                            <?php echo e($form->response->count()); ?>

                                        </td>
                                        <td><?php echo e($project->project_name); ?></td>
                                        <?php if(
                                            \Auth::user()->type == 'company' ||
                                                \Auth::user()->type == 'Director' ||
                                                \Auth::user()->type == 'Project Managers' ||
                                                \Auth::user()->type == 'Provisional Supervisor' ||
                                                \Auth::user()->type == 'Social Mobilizer'): ?>
                                            <td class="text-end">


                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center cp_link"
                                                        data-link="<iframe src='<?php echo e(url('/form/' . $form->code)); ?>' title='<?php echo e($form->name); ?>'></iframe>"
                                                        data-bs-toggle="tooltip"
                                                        title="<?php echo e(__('Click to copy iframe link')); ?>"><i
                                                            class="ti ti-frame text-white"></i></a>
                                                </div>

                                                


                                                <div class="action-btn bg-primary ms-2">
                                                    <a href="#"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center cp_link"
                                                        data-link="<?php echo e(url('/form/' . $form->code)); ?>"
                                                        data-bs-toggle="tooltip" title="<?php echo e(__('Click to copy link')); ?>"><i
                                                            class="ti ti-copy text-white"></i></a>
                                                </div>

                                                
                                                <div class="action-btn bg-secondary ms-2">
                                                    <a href="<?php echo e(route('form_builder.show', $form->id)); ?>"
                                                        class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                        data-bs-toggle="tooltip" title="<?php echo e(__('Form field')); ?>"><i
                                                            class="ti ti-table text-white"></i></a>
                                                </div>
                                                

                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view form response')): ?>
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="<?php echo e(route('form.response', $form->id)); ?>"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('View Response')); ?>"><i
                                                                class="ti ti-eye text-white"></i></a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit form builder')): ?>
                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#"
                                                            class="mx-3 btn btn-sm d-inline-flex align-items-center"
                                                            data-url="<?php echo e(route('form_builder.edit', $form->id)); ?>"
                                                            data-ajax-popup="true" data-size="md" data-bs-toggle="tooltip"
                                                            title="<?php echo e(__('Edit')); ?>"
                                                            data-title="<?php echo e(__('Form Builder Edit')); ?>">
                                                            <i class="ti ti-pencil text-white"></i>
                                                        </a>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete form builder')): ?>
                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open([
                                                            'method' => 'DELETE',
                                                            'route' => ['form_builder.destroy', $form->id],
                                                            'id' => 'delete-form-' . $form->id,
                                                        ]); ?>

                                                        <a href="#"
                                                            class="mx-3 btn btn-sm  align-items-center bs-pass-para"
                                                            data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i
                                                                class="ti ti-trash text-white"></i></a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                <?php endif; ?>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\PMIS\resources\views/form_builder/index_project_survey.blade.php ENDPATH**/ ?>