<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Report')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Employee Report')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('home')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Employee Report')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Filter Data -->
    <div class="col-sm-12">
        <div class=" mt-2 " id="multiCollapseExample1">
            <div class="card">
                <div class="card-body">
                    <form id="new" action="<?php echo e(route('filter.employee.attendance',Crypt::encrypt($id))); ?>" method="GET">
                        <?php echo csrf_field(); ?>
                        <div class="row align-items-center justify-content-end">

                            <div class="col-xl-10">
                                <div class="row">
                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 date">
                                        <div class="btn-box">
                                            <label class="form-label" for="custom_date"><?php echo e(__('Date From')); ?></label>
                                            <input class="form-control month-btn" name="date_from" type="date"
                                                   id="custom_date"/>
                                        </div>
                                    </div>


                                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12 date">
                                        <div class="btn-box">
                                            <label class="form-label" for="date_from"><?php echo e(__('Date To')); ?></label>
                                            <input class="form-control month-btn" name="date_to" type="date"
                                                   id="date_from"/>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="col-auto mt-4">
                                <div class="row">
                                    <div class="col-auto">
                                        <a href="#" class="btn btn-sm btn-primary"
                                           onclick="document.getElementById('new').submit(); return false;">
                                            <span class="btn-inner--icon"><i class="ti ti-search"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


    <!-- View Employee Attendance Data -->
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header card-body table-border-style">

                <div class="table-responsive">
                    <h4 class="h4" style="margin-left: 25px;margin-top: 15px;">
                        <div>ID : <?php echo e($employee->id); ?></div>
                    </h4>
                    <h4 class="h4" style="margin-left: 25px;margin-top: 15px;">
                        <div>Name : <?php echo e($employee->name); ?></div>
                    </h4>
                    <table class="table" id="pc-dt-simple">
                        <thead>
                        <tr>
                            
                            <th><?php echo e(__('DAY')); ?></th>
                            
                            <th><?php echo e(__('Date')); ?></th>
                            
                            <th><?php echo e(__('Clock In')); ?></th>
                            <th><?php echo e(__('Clock Out')); ?></th>
                            <th><?php echo e(__('W.Hours')); ?></th>
                            <th><?php echo e(__('Late')); ?></th>
                            <th><?php echo e(__('Early Leave')); ?></th>
                            
                            <th><?php echo e(__('Permission')); ?></th>
                            <th><?php echo e(__('Missing')); ?></th>
                            <th><?php echo e(__('Penalty')); ?></th>
                            
                            
                            
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(isset($attendanceEmployee)): ?>
                            <?php $__currentLoopData = $attendanceEmployee; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e(\Carbon\Carbon::parse($attendance->date)->dayName); ?></td>
                                    
                                    
                                    
                                    <td><?php echo e(\Auth::user()->dateFormat($attendance->date)); ?></td>
                                    
                                    <td><?php echo e($attendance->clock_in != '00:00:00' ? \Auth::user()->timeFormat($attendance->clock_in) : '00:00'); ?>

                                    </td>
                                    <td><?php echo e($attendance->clock_out != '00:00:00' ? \Auth::user()->timeFormat($attendance->clock_out) : '00:00'); ?>

                                    </td>
                                    <!-- Total Working Hours-->
                                    <td>
                                        <?php echo e($attendance->clock_out != '00:00:00' ?
                                            gmdate('H:i',strtotime($attendance->clock_out) - strtotime($attendance->clock_in)): '00:00'); ?>

                                    </td>
                                    <td><?php echo e($attendance->late); ?></td>
                                    <td><?php echo e($attendance->early_leaving); ?></td>
                                    
                                    <td><span style="margin-left: 25px">
                                            <?php if(isset($permission[$key])): ?>
                                                <?php echo e($permission[$key]); ?>

                                            <?php else: ?>
                                                0
                                            <?php endif; ?>
                                        </span></td>
                                    <td>
                                        <?php if(isset($permission[$key])): ?>
                                            <?php if($permission[$key] == 'Approved'): ?>
                                                0
                                            <?php else: ?>
                                                <?php echo e($missing[$key]); ?>

                                            <?php endif; ?>
                                        <?php else: ?>
                                            <?php echo e($missing[$key]); ?>

                                        <?php endif; ?>
                                        <!-- View Missing Based On Permission -->
                                        
                                        
                                        
                                        
                                        

                                        <!-- View Missing Based On Permission -->

                                        
                                        
                                        
                                    </td>
                                    <td>
                                        <?php if(isset($permission[$key])): ?>
                                            <?php if($permission[$key] == 'Approved'): ?>
                                                0
                                            <?php else: ?>
                                                <?php if($penalty[$key] == 0 ): ?>
                                                    0
                                                <?php endif; ?>
                                                <?php if($penalty[$key] == 0.25 ): ?>
                                                    ¼  DAY
                                                <?php endif; ?>
                                                <?php if($penalty[$key] == 0.5 ): ?>
                                                    ½ DAY
                                                <?php endif; ?>
                                                <?php if($penalty[$key] == 1 ): ?>
                                                    1 DAY
                                                <?php endif; ?>
                                            <?php endif; ?>

                                        <?php else: ?>
                                            <?php if($penalty[$key] == 0 ): ?>
                                                0
                                            <?php endif; ?>
                                            <?php if($penalty[$key] == 0.25 ): ?>
                                                ¼  DAY
                                            <?php endif; ?>
                                            <?php if($penalty[$key] == 0.5 ): ?>
                                                ½ DAY
                                            <?php endif; ?>
                                            <?php if($penalty[$key] == 1 ): ?>
                                                1 DAY
                                            <?php endif; ?>
                                        <?php endif; ?>


                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                        
                                    </td>

                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                        

                        <tr>
                            <td>Grand Total : <?php echo e($grand_total); ?></td>
                            
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.custom', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\q-sale xampp\htdocs\hr\resources\views/attendance/report.blade.php ENDPATH**/ ?>