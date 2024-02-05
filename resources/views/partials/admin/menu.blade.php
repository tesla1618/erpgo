@php
    $logo=\App\Models\Utility::get_file('uploads/logo/');

    $company_logo=Utility::getValByName('company_logo_dark');
    $company_logos=Utility::getValByName('company_logo_light');
    $setting = \App\Models\Utility::settings();
    $emailTemplate     = \App\Models\EmailTemplate::first();
    $lang= Auth::user()->lang;
    $show_dashboard = \App\Models\User::show_dashboard();
@endphp

{{--<nav class="dash-sidebar light-sidebar {{(isset($mode_setting['cust_theme_bg']) && $mode_setting['cust_theme_bg'] == 'on')?'transprent-bg':''}}">--}}

@if (isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on')
    <nav class="dash-sidebar light-sidebar transprent-bg">
@else
    <nav class="dash-sidebar light-sidebar">
@endif
    <div class="navbar-wrapper">
        <div class="m-header main-logo">
            <a href="#" class="b-brand">
                @if($setting['cust_darklayout'] && $setting['cust_darklayout'] == 'on' )

                    <img src="{{ $logo . '/' . (isset($company_logos) && !empty($company_logos) ? $company_logos : 'logo-dark.png') }}"
                         alt="{{ config('app.name', 'ERPGo') }}" class="logo logo-lg">
                @else

                    <img src="{{ $logo . '/' . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') }}"
                         alt="{{ config('app.name', 'ERPGo') }}" class="logo logo-lg">
                @endif
            </a>
        </div>
        <div class="navbar-content">
            @if(\Auth::user()->type != 'client')
                <ul class="dash-navbar">

                    <!--------------------- Start Dashboard ----------------------------------->

                    @if( Gate::check('show hrm dashboard') || Gate::check('show project dashboard') || Gate::check('show account dashboard') || Gate::check('show crm dashboard'))
                        <li class="dash-item dash-hasmenu
                             {{ ( Request::segment(1) == null ||Request::segment(1) == 'account-dashboard' || Request::segment(1) == 'income report'
                                || Request::segment(1) == 'report'  || Request::segment(1) == 'reports-monthly-cashflow' || Request::segment(1) == 'reports-quarterly-cashflow' || Request::segment(1) == 'reports-payroll' || Request::segment(1) == 'reports-leave' ||
                                 Request::segment(1) == 'reports-monthly-attendance'|| Request::segment(1) == 'reports-lead' || Request::segment(1) == 'reports-deal'
                                 || Request::segment(1) == 'pos-dashboard'|| Request::segment(1) == 'reports-warehouse' || Request::segment(1) == 'reports-daily-purchase'
                                || Request::segment(1) == 'reports-monthly-purchase' || Request::segment(1) == 'reports-daily-pos' ||Request::segment(1) == 'reports-monthly-pos' ||Request::segment(1) == 'reports-pos-vs-purchase') ?'active dash-trigger':''}}">
                            <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-home"></i></span><span class="dash-mtext">{{__('Dashboard')}}</span>
                                <span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                            <ul class="dash-submenu">
                                @if($show_dashboard == 1 && Gate::check('show account dashboard'))
                                    <li class="dash-item dash-hasmenu {{ ( Request::segment(1) == null   || Request::segment(1) == 'report' || Request::segment(1) == 'reports-monthly-cashflow' || Request::segment(1) == 'reports-quarterly-cashflow') ? ' active dash-trigger' : ''}}">
                                        <a class="dash-link" href="#">{{__('Agents ')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                        <ul class="dash-submenu">
                                            @can('show account dashboard')
                                                <li class="dash-item {{ ( Request::segment(1) == null || Request::segment(1) == 'account-dashboard') ? ' active' : '' }}">
                                                    <a class="dash-link" href="{{route('dashboard')}}">{{__(' Overview')}}</a>
                                                </li>
                                            @endcan
                                                
                                        </ul>
                                    </li>
                                @endif

                                @if($show_dashboard== 1)
                                        @can('show hrm dashboard')
                                            <li class="dash-item dash-hasmenu">
                                                <a class="dash-link" href="#">{{__('Vendors ')}}<span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                                <ul class="dash-submenu">
                                                    <li class="dash-item {{ (\Request::route()->getName()=='hrm.dashboard') ? ' active' : '' }}">
                                                        <a class="dash-link" href="{{route('hrm.dashboard')}}">{{__(' Overview')}}</a>
                                                    </li>
                                                    @can('manage report')
                                                      
                                                    @endcan
                                                </ul>
                                            </li>
                                        @endcan
                                @endif

                                

                            </ul>
                        </li
                    @endif
<!--  -->
                    <!--------------------- End Dashboard --------------------------------- -->




                   

                        <!--------------------- End Account ----------------------------------->

                        <!--------------------- Start CRM ----------------------------------->

                        @if($show_dashboard == 1)
                        @if( Gate::check('manage lead') || Gate::check('manage deal') || Gate::check('manage form builder') || Gate::check('manage contract'))
                            <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'pipelines' || Request::segment(1) == 'deals' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'contract') ?' active dash-trigger':''}}">
                                <a href="#!" class="dash-link"
                                ><span class="dash-micon"><i class="ti ti-layers-difference"></i></span
                                    ><span class="dash-mtext">{{__('Agents')}}</span
                                    ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                    ></a>
                                <ul class="dash-submenu {{ (Request::segment(1) == 'stages' || Request::segment(1) == 'labels' || Request::segment(1) == 'sources' || Request::segment(1) == 'lead_stages' || Request::segment(1) == 'leads'  || Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response' || Request::segment(1) == 'deals' || Request::segment(1) == 'pipelines')?'show':''}}">
                                    @can('manage lead')
                                        <li class="dash-item {{ (Request::route()->getName() == 'leads.list' || Request::route()->getName() == 'leads.index' || Request::route()->getName() == 'leads.show') ? ' active' : '' }}">
                                            <a class="dash-link" href="{{ route('leads.index') }}">{{__('Work Permit Visa')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage deal')
                                        <li class="dash-item {{ (Request::route()->getName() == 'deals.list' || Request::route()->getName() == 'deals.index' || Request::route()->getName() == 'deals.show') ? ' active' : '' }}">
                                            <a class="dash-link" href="{{route('deals.index')}}">{{__('Student Visa')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage form builder')
                                        <li class="dash-item {{ (Request::segment(1) == 'form_builder' || Request::segment(1) == 'form_response')?'active open':''}}">
                                            <a class="dash-link" href="{{route('form_builder.index')}}">{{__('Business Visa')}}</a>
                                        </li>
                                    @endcan
                                    @if(\Auth::user()->type=='company' || \Auth::user()->type=='client')
                                        <li class="dash-item  {{ (Request::segment(1) == 'contract')?'active':''}}">
                                            <a class="dash-link" href="{{route('contract.index')}}">{{__('Tourist Visa')}}</a>
                                        </li>
                                    @endif
                                    @if(\Auth::user()->type=='company' || \Auth::user()->type=='client')
                                        <li class="dash-item  {{ (Request::segment(1) == 'contract2')?'active':''}}">
                                            <a class="dash-link" href="#">{{__('Others')}}</a>
                                        </li>
                                    @endif
                                    
                                </ul>
                            </li>
                        @endif
                    @endif

                        <!--------------------- End CRM ----------------------------------->

                        <!--------------------- Start Project ----------------------------------->

                        @if($show_dashboard == 1)
                        @if( Gate::check('manage project'))
                            <li class="dash-item dash-hasmenu {{ ( Request::segment(1) == 'project' || Request::segment(1) == 'bugs-report' || Request::segment(1) == 'bugstatus' || Request::segment(1) == 'project-task-stages' || Request::segment(1) == 'calendar' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' || Request::segment(1) == 'timesheet-list' || Request::segment(1) == 'taskboard' || Request::segment(1) == 'project' || Request::segment(1) == 'projects' || Request::segment(1) == 'project_report')
                            ? 'active dash-trigger' : ''}}">
                                <a href="#!" class="dash-link"
                                ><span class="dash-micon"><i class="ti ti-share"></i></span
                                    ><span class="dash-mtext">{{__('Vendors')}}</span
                                    ><span class="dash-arrow"><i data-feather="chevron-right"></i></span
                                    ></a>
                                <ul class="dash-submenu">
                                    @can('manage project')
                                        <li class="dash-item  {{Request::segment(1) == 'project' || Request::route()->getName() == 'projects.list' || Request::route()->getName() == 'projects.list' ||Request::route()->getName() == 'projects.index' || Request::route()->getName() == 'projects.show' || request()->is('projects/*') ? 'active' : ''}}">
                                            <a class="dash-link" href="{{route('projects.index')}}">{{__('Work Permit Visa')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage project task')
                                        <li class="dash-item {{ (request()->is('taskboard*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{ route('taskBoard.view', 'list') }}">{{__('Student Visa')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage timesheet')
                                        <li class="dash-item {{ (request()->is('timesheet-list*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{route('timesheet.list')}}">{{__('Business Visa')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage bug report')
                                        <li class="dash-item {{ (request()->is('bugs-report*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{route('bugs.view','list')}}">{{__('Tourist Visa')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage project task')
                                        <li class="dash-item {{ (request()->is('calendar*') ? 'active' : '')}}">
                                            <a class="dash-link" href="{{ route('task.calendar',['all']) }}">{{__('Others')}}</a>
                                        </li>
                                    @endcan
                                    
                                    @if(Gate::check('manage project task stage') || Gate::check('manage bug status'))
                                       
                                    @endif
                                </ul>
                            </li>
                        @endif
                    @endif

                        <!--------------------- End Project ----------------------------------->



                       
                       
                        <!--------------------- Start POs System ----------------------------------->

                        @if( Gate::check('manage warehouse') ||  Gate::check('manage purchase')  || Gate::check('manage pos') || Gate::check('manage print settings'))
                            <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'warehouse' || Request::segment(1) == 'purchase' || Request::route()->getName() == 'pos.barcode' || Request::route()->getName() == 'pos.print' || Request::route()->getName() == 'pos.show')?' active dash-trigger':''}}">
                                <a href="#!" class="dash-link"><span class="dash-micon"><i class="ti ti-layers-difference"></i></span><span class="dash-mtext">{{__('Clients')}}</span><span class="dash-arrow"><i data-feather="chevron-right"></i></span></a>
                                <ul class="dash-submenu {{ (Request::segment(1) == 'warehouse' || Request::segment(1) == 'purchase' || Request::route()->getName() == 'pos.barcode' || Request::route()->getName() == 'pos.print' || Request::route()->getName() == 'pos.show')?'show':''}}">
                                    @can('manage warehouse')
                                        <li class="dash-item {{ (Request::route()->getName() == 'warehouse.index' || Request::route()->getName() == 'warehouse.show') ? ' active' : '' }}"><a class="dash-link" href="{{ route('warehouse.index') }}">{{__('Work Permit Visa')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage purchase')
                                        <li class="dash-item {{ (Request::route()->getName() == 'purchase.index' || Request::route()->getName() == 'purchase.create' || Request::route()->getName() == 'purchase.edit' || Request::route()->getName() == 'purchase.show') ? ' active' : '' }}">
                                            <a class="dash-link" href="{{ route('purchase.index') }}">{{__('Student Visa')}}</a>
                                        </li>
                                    @endcan
                                    @can('manage quotation')
                                    <li
                                        class="dash-item {{ Request::route()->getName() == 'quotation.index' || Request::route()->getName() == 'quotations.create' || Request::route()->getName() == 'quotation.edit' || Request::route()->getName() == 'quotation.show' ? ' active' : '' }}">
                                        <a class="dash-link" href="{{ route('quotation.index') }}">{{ __('Business Visa') }}</a>
                                    </li>
                                @endcan
                                    @can('manage pos')
                                        <li class="dash-item {{ (Request::route()->getName() == 'pos.index' ) ? ' active' : '' }}">
                                            <a class="dash-link" href="{{ route('pos.index') }}">{{__(' Tourist Visa')}}</a>
                                        </li>

                                        <li class="dash-item {{ (Request::route()->getName() == 'pos.report' || Request::route()->getName() == 'pos.show') ? ' active' : '' }}">
                                            <a class="dash-link" href="{{ route('pos.report') }}">{{__('Others')}}</a>
                                        </li>
                                    @endcan
                                       
                                    
                                    

                                </ul>
                            </li>
                        @endif

                        <!--------------------- End POs System ----------------------------------->

                        



                        <!--------------------- Start System Setup ----------------------------------->

                        <!-- @if(Gate::check('manage company settings'))
                            <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'settings') ? ' active' : '' }}">
                                <a href="{{ route('settings') }}" class="dash-link">
                                    <span class="dash-micon"><i class="ti ti-settings"></i></span><span class="dash-mtext">{{__('Settings')}}</span>
                                </a>
                            </li>
                        @endif -->




                        <!--------------------- End System Setup ----------------------------------->

                </ul>
            @endif
            @if((\Auth::user()->type == 'client'))
                <ul class="dash-navbar">
                    @if(Gate::check('manage client dashboard'))

                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'dashboard') ? ' active' : '' }}">
                            <a href="{{ route('client.dashboard.view') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-home"></i></span><span class="dash-mtext">{{__('Dashboard')}}</span>
                            </a>
                        </li>

                    @endif

                    @if(Gate::check('manage deal'))
                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'deals') ? ' active' : '' }}">
                            <a href="{{ route('deals.index') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-rocket"></i></span><span class="dash-mtext">{{__('Deals')}}</span>
                            </a>
                        </li>
                    @endif
                        @if(Gate::check('manage contract'))
                            <li class="dash-item dash-hasmenu {{ (Request::route()->getName() == 'contract.index' || Request::route()->getName() == 'contract.show')?'active':''}}">
                                <a href="{{ route('contract.index') }}" class="dash-link">
                                    <span class="dash-micon"><i class="ti ti-rocket"></i></span><span class="dash-mtext">{{__('Contract')}}</span>
                                </a>
                            </li>
                        @endif


                    @if(Gate::check('manage project'))
                        <li class="dash-item dash-hasmenu  {{ (Request::segment(1) == 'projects') ? ' active' : '' }}">
                            <a href="{{ route('projects.index') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-share"></i></span><span class="dash-mtext">{{__('Project')}}</span>
                            </a>
                        </li>
                    @endif

                        @if(Gate::check('manage project'))

                            <li class="dash-item  {{(Request::route()->getName() == 'project_report.index' || Request::route()->getName() == 'project_report.show') ? 'active' : ''}}">
                                <a class="dash-link" href="{{route('project_report.index') }}">
                                    <span class="dash-micon"><i class="ti ti-chart-line"></i></span><span class="dash-mtext">{{__('Project Report')}}</span>
                                </a>
                            </li>
                        @endif

                    @if(Gate::check('manage project task'))
                        <li class="dash-item dash-hasmenu  {{ (Request::segment(1) == 'taskboard') ? ' active' : '' }}">
                            <a href="{{ route('taskBoard.view', 'list') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-list-check"></i></span><span class="dash-mtext">{{__('Tasks')}}</span>
                            </a>
                        </li>
                    @endif

                    @if(Gate::check('manage bug report'))
                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'bugs-report') ? ' active' : '' }}">
                            <a href="{{ route('bugs.view','list') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-bug"></i></span><span class="dash-mtext">{{__('Bugs')}}</span>
                            </a>
                        </li>
                    @endif

                    @if(Gate::check('manage timesheet'))
                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'timesheet-list') ? ' active' : '' }}">
                            <a href="{{ route('timesheet.list') }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-clock"></i></span><span class="dash-mtext">{{__('Timesheet')}}</span>
                            </a>
                        </li>
                    @endif

                    @if(Gate::check('manage project task'))
                        <li class="dash-item dash-hasmenu {{ (Request::segment(1) == 'calendar') ? ' active' : '' }}">
                            <a href="{{ route('task.calendar',['all']) }}" class="dash-link">
                                <span class="dash-micon"><i class="ti ti-calendar"></i></span><span class="dash-mtext">{{__('Task Calender')}}</span>
                            </a>
                        </li>
                    @endif

                    <li class="dash-item dash-hasmenu">
                        <a href="{{route('support.index')}}" class="dash-link {{ (Request::segment(1) == 'support')?'active':''}}">
                            <span class="dash-micon"><i class="ti ti-headphones"></i></span><span class="dash-mtext">{{__('Support')}}</span>
                        </a>
                    </li>



                </ul>
            @endif

                
        </div>
    </div>
</nav>
