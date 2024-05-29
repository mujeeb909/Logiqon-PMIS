<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Tracker')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Tracker')); ?></li>
<?php $__env->stopSection(); ?>



<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(url('css/swiper.min.css')); ?>">

    <link rel="stylesheet" href="<?php echo e(url('css/swiper.min.css')); ?>">


    <style>
        .product-thumbs .swiper-slide img {
        border:2px solid transparent;
        object-fit: cover;
        cursor: pointer;
        }
        .product-thumbs .swiper-slide-active img {
        border-color: #bc4f38;
        }

        .product-slider .swiper-button-next:after,
        .product-slider .swiper-button-prev:after {
            font-size: 20px;
            color: #000;
            font-weight: bold;
        }
        .modal-dialog.modal-md {
            background-color: #fff !important;
        }

        .no-image{
            min-height: 300px;
            align-items: center;
            display: flex;
            justify-content: center;
        }
    </style>
<?php $__env->stopPush(); ?>


<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body table-border-style mt-2">
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>

                                <th> <?php echo e(__('Title')); ?></th>
                                <th> <?php echo e(__('Task')); ?></th>
                                 <th> <?php echo e(__('Project')); ?></th>
                                <th> <?php echo e(__('Start Time')); ?></th>
                                <th> <?php echo e(__('End Time')); ?></th>
                                <th><?php echo e(__('Total Time')); ?></th>
                                <th><?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>

                            <?php $__currentLoopData = $treckers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $trecker): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                <?php
                                    $total_name = Utility::second_to_time($trecker->total_time);

                                ?>
                                <tr>
                                    <td><?php echo e($trecker->name); ?></td>
                                    <td><?php echo e($trecker->project_task); ?></td>
                                    <td><?php echo e($trecker->project_name); ?></td>
                                    <td><?php echo e(date("H:i:s",strtotime($trecker->start_time))); ?></td>
                                    <td><?php echo e(date("H:i:s",strtotime($trecker->end_time))); ?></td>
                                    <td><?php echo e($total_name); ?></td>
                                    <td>
                                        <img alt="Image placeholder" src="<?php echo e(asset('assets/images/gallery.png')); ?>" class="avatar view-images rounded-circle avatar-sm"
                                             data-bs-toggle="tooltip" title="<?php echo e(__('View Screenshot images')); ?>" data-original-title="<?php echo e(__('View Screenshot images')); ?>" style="height: 25px;width:24px;margin-right:10px;cursor: pointer;" data-id="<?php echo e($trecker->id); ?>" id="track-images-<?php echo e($trecker->id); ?>">
                                        <div class="action-btn bg-danger ms-2">
                                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['tracker.destroy', $trecker->id],'id'=>'delete-form-'.$trecker->id]); ?>


                                            <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').' | '.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($trecker->id); ?>').submit();">
                                                <i class="ti ti-trash text-white"></i>
                                            </a>
                                            <?php echo Form::close(); ?>

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

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg ss_modale " role="document">
          <div class="modal-content image_sider_div">

          </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>

<script src="<?php echo e(url('js/swiper.min.js')); ?>"></script>


<script type="text/javascript">

    function init_slider(){
            if($(".product-left").length){
                    var productSlider = new Swiper('.product-slider', {
                        spaceBetween: 0,
                        centeredSlides: false,
                        loop:false,
                        direction: 'horizontal',
                        loopedSlides: 5,
                        navigation: {
                            nextEl: ".swiper-button-next",
                            prevEl: ".swiper-button-prev",
                        },
                        resizeObserver:true,
                    });
                var productThumbs = new Swiper('.product-thumbs', {
                    spaceBetween: 0,
                    centeredSlides: true,
                    loop: false,
                    slideToClickedSlide: true,
                    direction: 'horizontal',
                    slidesPerView: 7,
                    loopedSlides: 5,
                });
                productSlider.controller.control = productThumbs;
                productThumbs.controller.control = productSlider;
            }
        }

    $(document).on('click', '.view-images', function () {

            var p_url = "<?php echo e(route('tracker.image.view')); ?>";
            var data = {
                'id': $(this).attr('data-id')
            };
            postAjax(p_url, data, function (res) {
                $('.image_sider_div').html(res);
                $('#exampleModalCenter').modal('show');
                setTimeout(function(){
                    var total = $('.product-left').find('.product-slider').length
                    if(total > 0){
                        init_slider();
                    }

                },200);

            });
            });

    // ============================ Remove Track Image ===============================//
    $(document).on("click", '.track-image-remove', function () {
            var rid = $(this).attr('data-pid');
            $('.confirm_yes').addClass('image_remove');
            $('.confirm_yes').attr('image_id', rid);
            $('#cModal').modal('show');
            var total = $('.product-left').find('.swiper-slide').length
            });

    function removeImage(id){
        var p_url = "<?php echo e(route('tracker.image.remove')); ?>";
        var data = {id: id};
        deleteAjax(p_url, data, function (res) {
            if(res.flag){
                $('#slide-thum-'+id).remove();
                $('#slide-'+id).remove();
                setTimeout(function(){
                    var total = $('.product-left').find('.swiper-slide').length
                    if(total > 0){
                        init_slider();
                    }else{
                        $('.product-left').html('<div class="no-image"><h5 class="text-muted">Images Not Available .</h5></div>');
                    }
                },200);
            }
            $('#cModal').modal('hide');
            show_toastr('error',res.msg,'error');
        });
    }
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ninthsoft/public_html/erp.ninthsoft.com/resources/views/time_trackers/index.blade.php ENDPATH**/ ?>