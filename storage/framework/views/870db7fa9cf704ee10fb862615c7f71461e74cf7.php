<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Settings')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Print-Settings')); ?></li>
<?php $__env->stopSection(); ?>
<?php
    $logo=\App\Models\Utility::get_file('uploads/logo');
    $company_logo=Utility::getValByName('company_logo');
    $company_favicon=Utility::getValByName('company_favicon');
    $lang=Utility::getValByName('default_language');
?>
<?php $__env->startPush('script-page'); ?>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300
        })
    </script>
    <script>
        $(document).on("change", "select[name='invoice_template'], input[name='invoice_color']", function () {
            var template = $("select[name='invoice_template']").val();
            var color = $("input[name='invoice_color']:checked").val();
            $('#invoice_frame').attr('src', '<?php echo e(url('/invoices/preview')); ?>/' + template + '/' + color);
        });

        $(document).on("change", "select[name='proposal_template'], input[name='proposal_color']", function () {
            var template = $("select[name='proposal_template']").val();
            var color = $("input[name='proposal_color']:checked").val();
            $('#proposal_frame').attr('src', '<?php echo e(url('/proposal/preview')); ?>/' + template + '/' + color);
        });

        $(document).on("change", "select[name='bill_template'], input[name='bill_color']", function () {
            var template = $("select[name='bill_template']").val();
            var color = $("input[name='bill_color']:checked").val();
            $('#bill_frame').attr('src', '<?php echo e(url('/bill/preview')); ?>/' + template + '/' + color);
        });

        document.getElementById('proposal_logo').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('proposal_image').src = src
        }
        document.getElementById('invoice_logo').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('invoice_image').src = src
        }
        document.getElementById('bill_logo').onchange = function () {
            var src = URL.createObjectURL(this.files[0])
            document.getElementById('bill_image').src = src
        }
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-sm-12 mt-4">
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-proposal-tab" data-bs-toggle="pill" href="#pills-proposal" role="tab" aria-controls="pills-proposal" aria-selected="true"><?php echo e(__('Proposal Print Setting')); ?></a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-invoice-tab" data-bs-toggle="pill" href="#pills-invoice" role="tab" aria-controls="pills-invoice" aria-selected="false"><?php echo e(__('Invoice Print Setting')); ?></a>

                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-bill-tab" data-bs-toggle="pill" href="#pills-bill" role="tab" aria-controls="pills-bill" aria-selected="false"><?php echo e(__('Bill Print Setting')); ?></a>

                    </li>
                </ul>



                <div class="tab-content" id="pills-tabContent">

                    <!--Proposal Print Setting-->
                    <div class="tab-pane fade show active" id="pills-proposal" role="tabpanel" aria-labelledby="pills-proposal-tab">

                        <div   class="bg-none">
                            <div class="row company-setting">
                                <div class="col-md-3">
                                    <div class="card-header card-body">
                                        <h5></h5>
                                        <form id="setting-form" method="post" action="<?php echo e(route('proposal.template.setting')); ?>" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group">
                                                <label for="address" class="col-form-label"><?php echo e(__('Proposal Template')); ?></label>
                                                <select class="form-control select2" name="proposal_template">
                                                    <?php $__currentLoopData = App\Models\Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($key); ?>" <?php echo e((isset($settings['proposal_template']) && $settings['proposal_template'] == $key) ? 'selected' : ''); ?>><?php echo e($template); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('Color Input')); ?></label>
                                                <div class="row gutters-xs">
                                                    <?php $__currentLoopData = App\Models\Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-auto">
                                                            <label class="colorinput">
                                                                <input name="proposal_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php echo e((isset($settings['proposal_color']) && $settings['proposal_color'] == $color) ? 'checked' : ''); ?>>
                                                                <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('Proposal Logo')); ?></label>
                                                <div class="choose-files">
                                                    <label for="proposal_logo">
                                                        <div class=" bg-primary proposal_logo_update"> <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>
                                                        <input type="file" class="form-control file" name="proposal_logo" id="proposal_logo" data-filename="proposal_logo_update">
                                                        <img id="proposal_image" class="mt-2" style="width:25%;"/>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2 text-end">
                                                <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-print-invoice  btn-primary m-r-10">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <?php if(isset($settings['proposal_template']) && isset($settings['proposal_color'])): ?>
                                        <iframe id="proposal_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('proposal.preview',[$settings['proposal_template'],$settings['proposal_color']])); ?>"></iframe>
                                    <?php else: ?>
                                        <iframe id="proposal_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('proposal.preview',['template1','fffff'])); ?>"></iframe>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!--Invoice Setting-->
                    <div class="tab-pane fade" id="pills-invoice" role="tabpanel" aria-labelledby="pills-invoice-tab">

                        <div class="bg-none">
                            <div class="row company-setting">
                                <div class="col-md-3">
                                    <div class="card-header card-body">
                                        <h5></h5>
                                        <form id="setting-form" method="post" action="<?php echo e(route('template.setting')); ?>" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group">
                                                <label for="address" class="col-form-label"><?php echo e(__('Invoice Template')); ?></label>
                                                <select class="form-control select2" name="invoice_template">
                                                    <?php $__currentLoopData = Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($key); ?>" <?php echo e((isset($settings['invoice_template']) && $settings['invoice_template'] == $key) ? 'selected' : ''); ?>><?php echo e($template); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('Color Input')); ?></label>
                                                <div class="row gutters-xs">
                                                    <?php $__currentLoopData = Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-auto">
                                                            <label class="colorinput">
                                                                <input name="invoice_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php echo e((isset($settings['invoice_color']) && $settings['invoice_color'] == $color) ? 'checked' : ''); ?>>
                                                                <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('Invoice Logo')); ?></label>
                                                <div class="choose-files">
                                                    <label for="invoice_logo">
                                                        <div class=" bg-primary invoice_logo_update"> <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>
                                                        <input type="file" class="form-control file" name="invoice_logo" id="invoice_logo" data-filename="invoice_logo_update">
                                                        <img id="invoice_image" class="mt-2" style="width:25%;"/>

                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2 text-end">
                                                <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-print-invoice  btn-primary m-r-10">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <?php if(isset($settings['invoice_template']) && isset($settings['invoice_color'])): ?>
                                        <iframe id="invoice_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('invoice.preview',[$settings['invoice_template'],$settings['invoice_color']])); ?>"></iframe>
                                    <?php else: ?>
                                        <iframe id="invoice_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('invoice.preview',['template1','fffff'])); ?>"></iframe>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                    </div>

                    <!--Bill Setting-->
                    <div class="tab-pane fade" id="pills-bill" role="tabpanel" aria-labelledby="pills-bill-tab">

                        <div class="bg-none">
                            <div class="row company-setting">
                                <div class="col-md-3">
                                    <div class="card-header card-body">
                                        <h5></h5>
                                        <form id="setting-form" method="post" action="<?php echo e(route('bill.template.setting')); ?>" enctype="multipart/form-data">
                                            <?php echo csrf_field(); ?>
                                            <div class="form-group">
                                                <label for="address" class="form-label"><?php echo e(__('Bill Template')); ?></label>
                                                <select class="form-control" name="bill_template">
                                                    <?php $__currentLoopData = App\Models\Utility::templateData()['templates']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($key); ?>" <?php echo e((isset($settings['bill_template']) && $settings['bill_template'] == $key) ? 'selected' : ''); ?>><?php echo e($template); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('Color Input')); ?></label>
                                                <div class="row gutters-xs">
                                                    <?php $__currentLoopData = Utility::templateData()['colors']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $color): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <div class="col-auto">
                                                            <label class="colorinput">
                                                                <input name="bill_color" type="radio" value="<?php echo e($color); ?>" class="colorinput-input" <?php echo e((isset($settings['bill_color']) && $settings['bill_color'] == $color) ? 'checked' : ''); ?>>
                                                                <span class="colorinput-color" style="background: #<?php echo e($color); ?>"></span>
                                                            </label>
                                                        </div>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-form-label"><?php echo e(__('Bill Logo')); ?></label>
                                                <div class="choose-files">
                                                    <label for="bill_logo">
                                                        <div class=" bg-primary bill_logo_update"> <i class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?></div>
                                                        <input type="file" class="form-control file" name="bill_logo" id="bill_logo" data-filename="bill_logo_update">
                                                        <img id="bill_image" class="mt-2" style="width:25%;"/>

                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group mt-2 text-end">
                                                <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-print-invoice  btn-primary m-r-10">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <?php if(isset($settings['bill_template']) && isset($settings['bill_color'])): ?>
                                        <iframe id="bill_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('bill.preview',[$settings['bill_template'],$settings['bill_color']])); ?>"></iframe>
                                    <?php else: ?>
                                        <iframe id="bill_frame" class="w-100 h-100" frameborder="0" src="<?php echo e(route('bill.preview',['template1','fffff'])); ?>"></iframe>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>




            </div>

        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/settings/print.blade.php ENDPATH**/ ?>