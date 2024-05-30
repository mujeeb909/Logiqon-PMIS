<div class="card sticky-top" style="top:30px">
    <div class="list-group list-group-flush" id="useradd-sidenav">
        <a href="<?php echo e(route('pipelines.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'pipelines.index' ) ? ' active' : ''); ?>"><?php echo e(__('Pipeline')); ?> <div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('lead_stages.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'lead_stages.index' ) ? 'active' : ''); ?>"><?php echo e(__('Lead Stages')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('stages.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'stages.index' ) ? ' active' : ''); ?>"><?php echo e(__('Deal Stages')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('sources.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'sources.index' ) ? 'active' : ''); ?>   "><?php echo e(__('Sources')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('labels.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'labels.index' ) ? 'active' : ''); ?>   "><?php echo e(__('Labels')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

        <a href="<?php echo e(route('contractType.index')); ?>" class="list-group-item list-group-item-action border-0 <?php echo e((Request::route()->getName() == 'contractType.index' ) ? 'active' : ''); ?>   "><?php echo e(__('Contract Type')); ?><div class="float-end"><i class="ti ti-chevron-right"></i></div></a>

    </div>
</div>
<?php /**PATH C:\xampp\htdocs\PMIS\resources\views/layouts/crm_setup.blade.php ENDPATH**/ ?>