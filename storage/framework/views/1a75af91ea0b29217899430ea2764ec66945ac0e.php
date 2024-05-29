<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Account Statement Summary')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <!-- <script src="<?php echo e(asset('js/jspdf.min.js')); ?> "></script>
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/jszip.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/pdfmake.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/vfs_fonts.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/dataTables.buttons.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/buttons.html5.js')); ?>"></script>
    <script type="text/javascript" src="<?php echo e(asset('assets/js/buttons.print.min.js')); ?>"></script> -->
    <script type="text/javascript" src="<?php echo e(asset('js/html2pdf.bundle.min.js')); ?>"></script>

    <script>

        var filename = $('#filename').val();

        function saveAsPDF() {
            var element = document.getElementById('printableArea');
            var opt = {
                margin: 0.3,
                filename: filename,
                image: {type: 'jpeg', quality: 1},
                html2canvas: {scale: 4, dpi: 72, letterRendering: true},
                jsPDF: {unit: 'in', format: 'A4'}
            };
            html2pdf().set(opt).from(element).save();
        }

        $(document).ready(function () {
            var filename = $('#filename').val();
            $('#report-dataTable').DataTable({
                dom: 'lBfrtip',
                buttons: [
                    {
                        extend: 'excel',
                        title: filename
                    },
                    {
                        extend: 'pdf',
                        title: filename
                    },  {
                        extend: 'csv',
                        title: filename
                    }
                ]
            });
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Account Statement Summary')); ?></li>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        
        
        

        <a href="<?php echo e(route('accountstatement.export')); ?>" data-bs-toggle="tooltip" title="<?php echo e(__('Export')); ?>" class="btn btn-sm btn-primary">
            <i class="ti ti-file-export"></i>
        </a>

        <a href="#" class="btn btn-sm btn-primary" onclick="saveAsPDF()"data-bs-toggle="tooltip" title="<?php echo e(__('Download')); ?>" data-original-title="<?php echo e(__('Download')); ?>">
            <span class="btn-inner--icon"><i class="ti ti-download"></i></span>
        </a>

    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="mt-2 " id="multiCollapseExample1">
                <div class="card">
                    <div class="card-body">
                        <?php echo e(Form::open(array('route' => array('report.account.statement'),'method'=>'get','id'=>'report_account'))); ?>

                        <div class="row align-items-center justify-content-end">
                            <div class="col-xl-10">
                                <div class="row">

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('start_month', __('Start Month'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::month('start_month',isset($_GET['start_month'])?$_GET['start_month']:date('Y-m'),array('class'=>'month-btn form-control'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('end_month', __('End Month'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::month('end_month',isset($_GET['end_month'])?$_GET['end_month']:date('Y-m', strtotime("-5 month")),array('class'=>'month-btn form-control'))); ?>

                                        </div>
                                    </div>

                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('account', __('Account'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('account', $account,isset($_GET['account'])?$_GET['account']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                        <div class="btn-box">
                                            <?php echo e(Form::label('type', __('Category'),['class'=>'form-label'])); ?>

                                            <?php echo e(Form::select('type',$types,isset($_GET['type'])?$_GET['type']:'', array('class' => 'form-control select'))); ?>

                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-auto">
                                <div class="row">
                                    <div class="col-auto mt-4">
                                        <a href="#" class="btn btn-sm btn-primary" onclick="document.getElementById('report_account').submit(); return false;" data-bs-toggle="tooltip" title="<?php echo e(__('Apply')); ?>" data-original-title="<?php echo e(__('apply')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                        <a href="<?php echo e(route('report.account.statement')); ?>" class="btn btn-sm btn-danger " data-bs-toggle="tooltip"  title="<?php echo e(__('Reset')); ?>" data-original-title="<?php echo e(__('Reset')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-trash-off text-white-off "></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>
            </div>
        </div>
    </div>

    <div id="printableArea">
        <div class="row mt-3">
            <div class="col">
                <input type="hidden" value="<?php echo e(__('Account Statement').' '.$filter['type'].' '.'Report of'.' '.$filter['startDateRange'].' to '.$filter['endDateRange']); ?>" id="filename">
                <div class="card p-4 mb-4">
                    <h7 class="report-text gray-text mb-0"><?php echo e(__('Report')); ?> :</h7>
                    <h6 class="report-text mb-0"><?php echo e(__('Account Statement Summary')); ?></h6>
                </div>
            </div>
            <?php if($filter['account']!=__('All')): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h7 class="report-text gray-text mb-0"><?php echo e(__('Account')); ?> :</h7>
                        <h6 class="report-text mb-0"><?php echo e($filter['account']); ?></h6>
                    </div>
                </div>
            <?php endif; ?>
            <?php if($filter['type']!=__('All')): ?>
                <div class="col">
                    <div class="card p-4 mb-4">
                        <h7 class="report-text gray-text mb-0"><?php echo e(__('Type')); ?> :</h7>
                        <h6 class="report-text mb-0"><?php echo e($filter['type']); ?></h6>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col">
                <div class="card p-4 mb-4">
                    <h7 class="report-text gray-text mb-0"><?php echo e(__('Duration')); ?> :</h7>
                    <h6 class="report-text mb-0"><?php echo e($filter['startDateRange'].' to '.$filter['endDateRange']); ?></h6>
                </div>
            </div>
        </div>

        <?php if(!empty($reportData['revenueAccounts'])): ?>
            <div class="row">
                <?php $__currentLoopData = $reportData['revenueAccounts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="card p-4 mb-4">
                            <?php if($account->holder_name =='Cash'): ?>
                                <h7 class="report-text gray-text mb-0"><?php echo e($account->holder_name); ?></h7>
                            <?php elseif(empty($account->holder_name)): ?>
                                <h7 class="report-text gray-text mb-0"><?php echo e(__('Stripe / Paypal')); ?></h7>
                            <?php else: ?>
                                <h7 class="report-text gray-text mb-0"><?php echo e($account->holder_name.' - '.$account->bank_name); ?></h7>
                            <?php endif; ?>
                            <h6 class="report-text mb-0"><?php echo e(\Auth::user()->priceFormat($account->total)); ?></h6>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>

        <?php if(!empty($reportData['paymentAccounts'])): ?>
            <div class="row">
                <?php $__currentLoopData = $reportData['paymentAccounts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-xl-3 col-md-6 col-lg-3">
                        <div class="card p-4 mb-4">
                            <?php if($account->holder_name =='Cash'): ?>
                                <h5 class="report-text gray-text mb-0"><?php echo e($account->holder_name); ?></h5>
                            <?php elseif(empty($account->holder_name)): ?>
                                <h5 class="report-text gray-text mb-0"><?php echo e(__('Stripe / Paypal')); ?></h5>
                            <?php else: ?>
                                <h5 class="report-text gray-text mb-0"><?php echo e($account->holder_name.' - '.$account->bank_name); ?></h5>
                            <?php endif; ?>
                            <h5 class="report-text mb-0"><?php echo e(\Auth::user()->priceFormat($account->total)); ?></h5>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th><?php echo e(__('Date')); ?></th>
                                <th><?php echo e(__('Amount')); ?></th>
                                <th><?php echo e(__('Description')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if(!empty($reportData['revenues'])): ?>
                                <?php $__currentLoopData = $reportData['revenues']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $revenue): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="font-style">
                                        <td><?php echo e(Auth::user()->dateFormat($revenue->date)); ?></td>
                                        <td><?php echo e(Auth::user()->priceFormat($revenue->amount)); ?></td>
                                        <td><?php echo e($revenue->description); ?> </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <?php if(!empty($reportData['payments'])): ?>
                                <?php $__currentLoopData = $reportData['payments']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payments): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr class="font-style">
                                        <td><?php echo e(Auth::user()->dateFormat($payments->date)); ?></td>
                                        <td><?php echo e(Auth::user()->priceFormat($payments->amount)); ?></td>
                                        <td><?php echo e(!empty($payments->description)?$payments->description:'-'); ?> </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/report/statement_report.blade.php ENDPATH**/ ?>