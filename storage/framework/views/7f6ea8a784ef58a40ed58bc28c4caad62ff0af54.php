<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Employee Salary')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Employee Salary')); ?></li>
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
                                <th><?php echo e(__('Employee Id')); ?></th>
                                <th><?php echo e(__('Name')); ?></th>
                                <th><?php echo e(__('Payroll Type')); ?></th>
                                <th><?php echo e(__('Salary')); ?></th>
                                <th><?php echo e(__('Net Salary')); ?></th>
                                <th width="200px"><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="Id">
                                        <a href="<?php echo e(route('setsalary.show',$employee->id)); ?>" class="btn btn-outline-primary" data-toggle="tooltip" data-original-title="<?php echo e(__('View')); ?>">
                                            <?php echo e(\Auth::user()->employeeIdFormat($employee->employee_id)); ?>

                                        </a>
                                    </td>
                                    <td><?php echo e($employee->name); ?></td>
                                    <td><?php echo e($employee->salary_type()); ?></td>
                                    <td><?php echo e(\Auth::user()->priceFormat($employee->salary)); ?></td>
                                    <td><?php echo e(!empty($employee->get_net_salary()) ?\Auth::user()->priceFormat($employee->get_net_salary()):''); ?></td>
                                    <td>
                                    <div class="action-btn bg-success ms-2">
                                        <a href="<?php echo e(route('setsalary.show',$employee->id)); ?>" class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="<?php echo e(__('Set Salary')); ?>" data-original-title="<?php echo e(__('View')); ?>">
                                            <i class="ti ti-eye text-white"></i>
                                        </a>
                                    </div>
                                    </td>
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



<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/setsalary/index.blade.php ENDPATH**/ ?>