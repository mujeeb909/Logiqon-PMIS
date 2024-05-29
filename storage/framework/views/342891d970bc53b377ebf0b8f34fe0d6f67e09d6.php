<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Invoices')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        function copyToClipboard(element) {

            var copyText = element.id;
            document.addEventListener('copy', function (e) {
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
    <li class="breadcrumb-item"><?php echo e(__('Invoice')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
        
        

        <a href="<?php echo e(route('invoice.export')); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>">
            <i class="ti ti-file-export"></i>
        </a>

        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create invoice')): ?>
            <a href="<?php echo e(route('invoice.create', 0)); ?>" class="btn btn-sm btn-primary" data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>



<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">

                            <?php echo e(Form::open(['route' => ['invoice.index'], 'method' => 'GET', 'id' => 'customer_submit'])); ?>




                        <div class="row d-flex align-items-center justify-content-end">
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                <div class="btn-box">
                                    <?php echo e(Form::label('issue_date', __('Issue Date'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::date('issue_date', isset($_GET['issue_date'])?$_GET['issue_date']:'', array('class' => 'form-control month-btn','id'=>'pc-daterangepicker-1'))); ?>



                                </div>
                            </div>

                                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 mr-2">
                                    <div class="btn-box">
                                        <?php echo e(Form::label('customer', __('Customer'),['class'=>'form-label'])); ?>

                                        <?php echo e(Form::select('customer', $customer, isset($_GET['customer']) ? $_GET['customer'] : '', ['class' => 'form-control select'])); ?>

                                    </div>
                                </div>

                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="btn-box">
                                    <?php echo e(Form::label('status', __('Status'),['class'=>'form-label'])); ?>

                                    <?php echo e(Form::select('status', [''=>'Select Status'] + $status,isset($_GET['status'])?$_GET['status']:'', array('class' => 'form-control select'))); ?>


                                </div>
                            </div>
                            <div class="col-auto float-end ms-2 mt-4">

                                <a href="#" class="btn btn-sm btn-primary"
                                   onclick="document.getElementById('customer_submit').submit(); return false;"
                                   data-toggle="tooltip" data-original-title="<?php echo e(__('apply')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                </a>

                                <a href="<?php echo e(route('invoice.index')); ?>" class="btn btn-sm btn-danger" data-toggle="tooltip"
                                   data-original-title="<?php echo e(__('Reset')); ?>">
                                    <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off"></i></span>
                                </a>
                            </div>

                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Invoice')); ?></th>



                                <th><?php echo e(__('Issue Date')); ?></th>
                                <th><?php echo e(__('Due Date')); ?></th>
                                <th><?php echo e(__('Due Amount')); ?></th>
                                <th><?php echo e(__('Status')); ?></th>
                                <?php if(Gate::check('edit invoice') || Gate::check('delete invoice') || Gate::check('show invoice')): ?>
                                    <th><?php echo e(__('Action')); ?></th>
                                <?php endif; ?>
                                
                            </tr>
                            </thead>

                            <tbody>
                            <?php $__currentLoopData = $invoices; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $invoice): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="Id">



                                            <a href="<?php echo e(route('invoice.show', \Crypt::encrypt($invoice->id))); ?>" class="btn btn-outline-primary"><?php echo e(AUth::user()->invoiceNumberFormat($invoice->invoice_id)); ?></a>

                                    </td>



                                    <td><?php echo e(Auth::user()->dateFormat($invoice->issue_date)); ?></td>
                                    <td>
                                        <?php if($invoice->due_date < date('Y-m-d')): ?>
                                            <p class="text-danger">
                                                <?php echo e(\Auth::user()->dateFormat($invoice->due_date)); ?></p>
                                        <?php else: ?>
                                            <?php echo e(\Auth::user()->dateFormat($invoice->due_date)); ?>

                                        <?php endif; ?>
                                    </td>
                                    <td><?php echo e(\Auth::user()->priceFormat($invoice->getDue())); ?></td>
                                    <td>
                                        <?php if($invoice->status == 0): ?>
                                            <span
                                                class="status_badge badge bg-secondary p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 1): ?>
                                            <span
                                                class="status_badge badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 2): ?>
                                            <span
                                                class="status_badge badge bg-danger p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 3): ?>
                                            <span
                                                class="status_badge badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php elseif($invoice->status == 4): ?>
                                            <span
                                                class="status_badge badge bg-primary p-2 px-3 rounded"><?php echo e(__(\App\Models\Invoice::$statues[$invoice->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                    <?php if(Gate::check('edit invoice') || Gate::check('delete invoice') || Gate::check('show invoice')): ?>
                                        <td class="Action">
                                                <span>
                                                <?php $invoiceID= Crypt::encrypt($invoice->id); ?>

                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('copy invoice')): ?>
                                                        <div class="action-btn bg-warning ms-2">
                                                            <a href="#" id="<?php echo e(route('invoice.link.copy',[$invoiceID])); ?>" class="mx-3 btn btn-sm align-items-center"
                                                               onclick="copyToClipboard(this)" data-bs-toggle="tooltip" data-original-title="<?php echo e(__('Click to copy')); ?>"><i class="ti ti-link text-white"></i></a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('duplicate invoice')): ?>
                                                        <div class="action-btn bg-success ms-2">
                                                           <?php echo Form::open(['method' => 'get', 'route' => ['invoice.duplicate', $invoice->id], 'id' => 'duplicate-form-' . $invoice->id]); ?>


                                                            <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-toggle="tooltip"
                                                               data-original-title="<?php echo e(__('Duplicate')); ?>" data-bs-toggle="tooltip" title="Duplicate Invoice"
                                                               data-original-title="<?php echo e(__('Delete')); ?>"
                                                               data-confirm="You want to confirm this action. Press Yes to continue or Cancel to go back"
                                                               data-confirm-yes="document.getElementById('duplicate-form-<?php echo e($invoice->id); ?>').submit();">
                                                                <i class="ti ti-copy text-white"></i>
                                                                <?php echo Form::open(['method' => 'get', 'route' => ['invoice.duplicate', $invoice->id], 'id' => 'duplicate-form-' . $invoice->id]); ?>

                                                                <?php echo Form::close(); ?>

                                                            </a>
                                                        </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show invoice')): ?>









                                                            <div class="action-btn bg-info ms-2">
                                                                    <a href="<?php echo e(route('invoice.show', \Crypt::encrypt($invoice->id))); ?>"
                                                                       class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="Show "
                                                                       data-original-title="<?php echo e(__('Detail')); ?>">
                                                                        <i class="ti ti-eye text-white"></i>
                                                                    </a>
                                                                </div>

                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit invoice')): ?>
                                                        <div class="action-btn bg-primary ms-2">
                                                                <a href="<?php echo e(route('invoice.edit', \Crypt::encrypt($invoice->id))); ?>"
                                                                   class="mx-3 btn btn-sm align-items-center" data-bs-toggle="tooltip" title="Edit "
                                                                   data-original-title="<?php echo e(__('Edit')); ?>">
                                                                    <i class="ti ti-pencil text-white"></i>
                                                                </a>
                                                            </div>
                                                    <?php endif; ?>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete invoice')): ?>
                                                        <div class="action-btn bg-danger ms-2">
                                                                <?php echo Form::open(['method' => 'DELETE', 'route' => ['invoice.destroy', $invoice->id], 'id' => 'delete-form-' . $invoice->id]); ?>

                                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para " data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"
                                                                       data-original-title="<?php echo e(__('Delete')); ?>"
                                                                       data-confirm="<?php echo e(__('Are You Sure?') . '|' . __('This action can not be undone. Do you want to continue?')); ?>"
                                                                       data-confirm-yes="document.getElementById('delete-form-<?php echo e($invoice->id); ?>').submit();">
                                                                        <i class="ti ti-trash text-white"></i>
                                                                    </a>
                                                                <?php echo Form::close(); ?>

                                                            </div>
                                                    <?php endif; ?>
                                                </span>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/invoice/index.blade.php ENDPATH**/ ?>