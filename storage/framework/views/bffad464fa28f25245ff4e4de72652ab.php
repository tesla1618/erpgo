<?php
    $logo=\App\Models\Utility::get_file('uploads/logo/');

    $company_logo=Utility::getValByName('company_logo_dark');
    $company_logos=Utility::getValByName('company_logo_light');
    $setting = \App\Models\Utility::settings();
    $emailTemplate     = \App\Models\EmailTemplate::first();
    $lang= Auth::user()->lang;
    $show_dashboard = \App\Models\User::show_dashboard();
?>



<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <nav class="dash-sidebar light-sidebar transprent-bg">
<?php else: ?>
    <nav class="dash-sidebar light-sidebar">
<?php endif; ?>
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="#" class="b-brand">
                <?php if($setting['cust_darklayout'] && $setting['cust_darklayout'] == 'on' ): ?>

                    <img src="<?php echo e($logo . '/' . (isset($company_logos) && !empty($company_logos) ? $company_logos : 'logo-dark.png')); ?>"
                         alt="<?php echo e(config('app.name', 'ERPGo')); ?>" class="logo logo-lg">
                <?php else: ?>

                    <img src="<?php echo e($logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png')); ?>"
                         alt="<?php echo e(config('app.name', 'ERPGo')); ?>" class="logo logo-lg">
                <?php endif; ?>
            </a>
        </div>
        <div class="navbar-content">
            <?php if(\Auth::user()->type != 'client'): ?>
                <ul class="dash-navbar">

                    <!--------------------- Start Dashboard ----------------------------------->

                    <?php if( Gate::check('show hrm dashboard') || Gate::check('show project dashboard') || Gate::check('show account dashboard') || Gate::check('show crm dashboard')): ?>
                        <li class="dash-item dash-hasmenu
                             <?php echo e(( Request::segment(1) == null ||Request::segment(1) == 'account-dashboard' || Request::segment(1) == 'income report'
                                || Request::segment(1) == 'report'  || Request::segment(1) == 'reports-monthly-cashflow' || Request::segment(1) == 'reports-quarterly-cashflow' || Request::segment(1) == 'reports-payroll' || Request::segment(1) == 'reports-leave' ||
                                 Request::segment(1) == 'reports-monthly-attendance'|| Request::segment(1) == 'reports-lead' || Request::segment(1) == 'reports-deal'
                                 || Request::segment(1) == 'pos-dashboard'|| Request::segment(1) == 'reports-warehouse' || Request::segment(1) == 'reports-daily-purchase'
                                || Request::segment(1) == 'reports-monthly-purchase' || Request::segment(1) == 'reports-daily-pos' ||Request::segment(1) == 'reports-monthly-pos' ||Request::segment(1) == 'reports-pos-vs-purchase') ?'active dash-trigger':''); ?>">
                            <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-home"></i></span><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                                <span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                            <ul class="dash-submenu">
                                <?php if($show_dashboard == 1 && Gate::check('show account dashboard')): ?>
                                    <li class="dash-item dash-hasmenu <?php echo e(( Request::segment(1) == null   || Request::segment(1) == 'report' || Request::segment(1) == 'reports-monthly-cashflow' || Request::segment(1) == 'reports-quarterly-cashflow') ? ' active dash-trigger' : ''); ?>">
                                        <a class="dash-link" href="#"><?php echo e(__('Agents ')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show account dashboard')): ?>
                                                <li class="dash-item <?php echo e(( Request::segment(1) == null || Request::segment(1) == 'account-dashboard') ? ' active' : ''); ?>">
                                                    <a class="dash-link" href="<?php echo e(route('dashboard')); ?>"><?php echo e(__(' Overview')); ?></a>
                                                </li>
                                            <?php endif; ?>
                                                
                                        </ul>
                                    </li>
                                <?php endif; ?>

                                <?php if($show_dashboard== 1): ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('show hrm dashboard')): ?>
                                            <li class="dash-item dash-hasmenu">
                                                <a class="dash-link" href="#"><?php echo e(__('Vendors ')); ?><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                                <ul class="dash-submenu">
                                                    <li class="dash-item <?php echo e((\Request::route()->getName()=='hrm.dashboard') ? ' active' : ''); ?>">
                                                        <a class="dash-link" href="<?php echo e(route('hrm.dashboard')); ?>"><?php echo e(__(' Overview')); ?></a>
                                                    </li>
                                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage report')): ?>
                                                      
                                                    <?php endif; ?>
                                                </ul>
                                            </li>
                                        <?php endif; ?>
                                <?php endif; ?>

                                

                            </ul>
                        </li
                    <?php endif; ?>
<!--  -->
                    <!--------------------- End Dashboard --------------------------------- -->




                   

                        <!--------------------- End Account ----------------------------------->

                        <!--------------------- Start CRM ----------------------------------->

                        <?php if($show_dashboard == 1): ?>
                        <?php if( Gate::check('manage lead') || Gate::check('manage deal') || Gate::check('manage form builder') || Gate::check('manage contract')): ?>
                            <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'deals' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'contract') ?' active dash-trigger':''); ?>">
                                <a href="#!" class="dash-link"
                                ><span class="dash-micon"><i class="ti ti-layers-difference"></i></span
                                    ><span class="dash-mtext"><?php echo e(__('Agents')); ?></span
                                    ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                    ></a>
                                <ul class="dash-submenu <?php echo e((Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'deals' || Request::segment(1) == 'pipelines')?'show':''); ?>">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage lead')): ?>
                                        <li class="dash-item <?php echo e((Request::route()->getName() == 'leads.list' || Request::route()->getName() == 'leads.index' || Request::route()->getName() == 'leads.show') ? ' active' : ''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('leads.index')); ?>"><?php echo e(__('Work Permit Visa')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage deal')): ?>
                                        <li class="dash-item <?php echo e((Request::route()->getName() == 'deals.list' || Request::route()->getName() == 'deals.index' || Request::route()->getName() == 'deals.show') ? ' active' : ''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('deals.index')); ?>"><?php echo e(__('Student Visa')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage form builder')): ?>
                                        <li class="dash-item <?php echo e((Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response')?'active open':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('form_builder.index')); ?>"><?php echo e(__('Business Visa')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(\Auth::user()->type=='company' || \Auth::user()->type=='client'): ?>
                                        <li class="dash-item  <?php echo e((Request::segment(1) == 'contract')?'active':''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('contract.index')); ?>"><?php echo e(__('Tourist Visa')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if(\Auth::user()->type=='company' || \Auth::user()->type=='client'): ?>
                                        <li class="dash-item  <?php echo e((Request::segment(1) == 'contract2')?'active':''); ?>">
                                            <a class="dash-link" href="#"><?php echo e(__('Others')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                        <!--------------------- End CRM ----------------------------------->

                        <!--------------------- Start Project ----------------------------------->

                        <?php if($show_dashboard == 1): ?>
                        <?php if( Gate::check('manage project')): ?>
                            <li class="dash-item dash-hasmenu <?php echo e(( Request::segment(1) == 'project' || Request::segment(1) == 'bugs-report' || Request::segment(1) == 'bugstatus' || Request::segment(1) == 'project-task-stages' || Request::segment(1) == 'calendar' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' || Request::segment(1) == 'project' || Request::segment(1) == 'projects' || Request::segment(1) == 'project_report')
                            ? 'active dash-trigger' : ''); ?>">
                                <a href="#!" class="dash-link"
                                ><span class="dash-micon"><i class="ti ti-share"></i></span
                                    ><span class="dash-mtext"><?php echo e(__('Vendors')); ?></span
                                    ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                    ></a>
                                <ul class="dash-submenu">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project')): ?>
                                        <li class="dash-item  <?php echo e(Request::segment(1) == 'project' || Request::route()->getName() == 'projects.list' || Request::route()->getName() == 'projects.list' ||Request::route()->getName() == 'projects.index' || Request::route()->getName() == 'projects.show' || request()->is('projects/*') ? 'active' : ''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('projects.index')); ?>"><?php echo e(__('Work Permit Visa')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project task')): ?>
                                        <li class="dash-item <?php echo e((request()->is('taskboard*') ? 'active' : '')); ?>">
                                            <a class="dash-link" href="<?php echo e(route('taskBoard.view', 'list')); ?>"><?php echo e(__('Student Visa')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage timesheet')): ?>
                                        <li class="dash-item <?php echo e((request()->is('timesheet-list*') ? 'active' : '')); ?>">
                                            <a class="dash-link" href="<?php echo e(route('timesheet.list')); ?>"><?php echo e(__('Business Visa')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage bug report')): ?>
                                        <li class="dash-item <?php echo e((request()->is('bugs-report*') ? 'active' : '')); ?>">
                                            <a class="dash-link" href="<?php echo e(route('bugs.view','list')); ?>"><?php echo e(__('Tourist Visa')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage project task')): ?>
                                        <li class="dash-item <?php echo e((request()->is('calendar*') ? 'active' : '')); ?>">
                                            <a class="dash-link" href="<?php echo e(route('task.calendar',['all'])); ?>"><?php echo e(__('Others')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    
                                    <?php if(Gate::check('manage project task stage') || Gate::check('manage bug status')): ?>
                                       
                                    <?php endif; ?>
                                </ul>
                            </li>
                        <?php endif; ?>
                    <?php endif; ?>

                        <!--------------------- End Project ----------------------------------->



                       
                       
                        <!--------------------- Start POs System ----------------------------------->

                        <?php if( Gate::check('manage warehouse') ||  Gate::check('manage purchase')  || Gate::check('manage pos') || Gate::check('manage print settings')): ?>
                            <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'warehouse' || Request::segment(1) == 'purchase' || Request::route()->getName() == 'pos.barcode' || Request::route()->getName() == 'pos.print' || Request::route()->getName() == 'pos.show')?' active dash-trigger':''); ?>">
                                <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-layers-difference"></i></span><span class="dash-mtext"><?php echo e(__('Clients')); ?></span><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                <ul class="dash-submenu <?php echo e((Request::segment(1) == 'warehouse' || Request::segment(1) == 'purchase' || Request::route()->getName() == 'pos.barcode' || Request::route()->getName() == 'pos.print' || Request::route()->getName() == 'pos.show')?'show':''); ?>">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage warehouse')): ?>
                                        <li class="dash-item <?php echo e((Request::route()->getName() == 'warehouse.index' || Request::route()->getName() == 'warehouse.show') ? ' active' : ''); ?>"><a class="dash-link" href="<?php echo e(route('warehouse.index')); ?>"><?php echo e(__('Work Permit Visa')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage purchase')): ?>
                                        <li class="dash-item <?php echo e((Request::route()->getName() == 'purchase.index' || Request::route()->getName() == 'purchase.create' || Request::route()->getName() == 'purchase.edit' || Request::route()->getName() == 'purchase.show') ? ' active' : ''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('purchase.index')); ?>"><?php echo e(__('Student Visa')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage quotation')): ?>
                                    <li
                                        class="dash-item <?php echo e(Request::route()->getName() == 'quotation.index' || Request::route()->getName() == 'quotations.create' || Request::route()->getName() == 'quotation.edit' || Request::route()->getName() == 'quotation.show' ? ' active' : ''); ?>">
                                        <a class="dash-link" href="<?php echo e(route('quotation.index')); ?>"><?php echo e(__('Business Visa')); ?></a>
                                    </li>
                                <?php endif; ?>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage pos')): ?>
                                        <li class="dash-item <?php echo e((Request::route()->getName() == 'pos.index' ) ? ' active' : ''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('pos.index')); ?>"><?php echo e(__(' Tourist Visa')); ?></a>
                                        </li>

                                        <li class="dash-item <?php echo e((Request::route()->getName() == 'pos.report' || Request::route()->getName() == 'pos.show') ? ' active' : ''); ?>">
                                            <a class="dash-link" href="<?php echo e(route('pos.report')); ?>"><?php echo e(__('Others')); ?></a>
                                        </li>
                                    <?php endif; ?>
                                       
                                    
                                    

                                </ul>
                            </li>
                        <?php endif; ?>

                        <!--------------------- End POs System ----------------------------------->

                        



                        <!--------------------- Start System Setup ----------------------------------->

                        <!-- <?php if(Gate::check('manage company settings')): ?>
                            <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'settings') ? ' active' : ''); ?>">
                                <a href="<?php echo e(route('settings')); ?>" class="dash-link">
                                    <span class="dash-micon"><i class="ti ti-settings"></i></span><span class="dash-mtext"><?php echo e(__('Settings')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?> -->




                        <!--------------------- End System Setup ----------------------------------->

                </ul>
            <?php endif; ?>
            <?php if((\Auth::user()->type == 'client')): ?>
                <ul class="dash-navbar">
                    <?php if(Gate::check('manage client dashboard')): ?>

                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'dashboard') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('client.dashboard.view')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-home"></i></span><span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                            </a>
                        </li>

                    <?php endif; ?>

                    <?php if(Gate::check('manage deal')): ?>
                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'deals') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('deals.index')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-rocket"></i></span><span class="dash-mtext"><?php echo e(__('Deals')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                        <?php if(Gate::check('manage contract')): ?>
                            <li class="dash-item dash-hasmenu <?php echo e((Request::route()->getName() == 'contract.index' || Request::route()->getName() == 'contract.show')?'active':''); ?>">
                                <a href="<?php echo e(route('contract.index')); ?>" class="dash-link">
                                    <span class="dash-micon"><i class="ti ti-rocket"></i></span><span class="dash-mtext"><?php echo e(__('Contract')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>


                    <?php if(Gate::check('manage project')): ?>
                        <li class="dash-item dash-hasmenu  <?php echo e((Request::segment(1) == 'projects') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('projects.index')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-share"></i></span><span class="dash-mtext"><?php echo e(__('Project')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                        <?php if(Gate::check('manage project')): ?>

                            <li class="dash-item  <?php echo e((Request::route()->getName() == 'project_report.index' || Request::route()->getName() == 'project_report.show') ? 'active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('project_report.index')); ?>">
                                    <span class="dash-micon"><i class="ti ti-chart-line"></i></span><span class="dash-mtext"><?php echo e(__('Project Report')); ?></span>
                                </a>
                            </li>
                        <?php endif; ?>

                    <?php if(Gate::check('manage project task')): ?>
                        <li class="dash-item dash-hasmenu  <?php echo e((Request::segment(1) == 'taskboard') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('taskBoard.view', 'list')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-list-check"></i></span><span class="dash-mtext"><?php echo e(__('Tasks')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(Gate::check('manage bug report')): ?>
                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'bugs-report') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('bugs.view','list')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-bug"></i></span><span class="dash-mtext"><?php echo e(__('Bugs')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(Gate::check('manage timesheet')): ?>
                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'timesheet-list') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('timesheet.list')); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-clock"></i></span><span class="dash-mtext"><?php echo e(__('Timesheet')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if(Gate::check('manage project task')): ?>
                        <li class="dash-item dash-hasmenu <?php echo e((Request::segment(1) == 'calendar') ? ' active' : ''); ?>">
                            <a href="<?php echo e(route('task.calendar',['all'])); ?>" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-calendar"></i></span><span class="dash-mtext"><?php echo e(__('Task Calender')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>

                    <li class="dash-item dash-hasmenu">
                        <a href="<?php echo e(route('support.index')); ?>" class="dash-link <?php echo e((Request::segment(1) == 'support')?'active':''); ?>">
                            <span class="dash-micon"><i class="ti ti-headphones"></i></span><span class="dash-mtext"><?php echo e(__('Support')); ?></span>
                        </a>
                    </li>



                </ul>
            <?php endif; ?>

                
        </div>
    </div>
</nav>
<?php /**PATH /home/tesla/Desktop/ERP/main-file/resources/views/partials/admin/menu.blade.php ENDPATH**/ ?>