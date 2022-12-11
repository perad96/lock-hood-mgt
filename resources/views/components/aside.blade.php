<div class="sidebar" data-color="white" data-active-color="danger">
{{--    <div class="logo bg-dark">--}}
{{--        <a href="#" class="simple-text logo-mini">--}}
{{--            <div class="logo-image-small">--}}
{{--                <img src="{{asset('theme/img/logo-small.png')}}">--}}
{{--            </div>--}}
{{--        </a>--}}
{{--        <a href="#" class="simple-text logo-normal text-light">--}}
{{--            AAA--}}
{{--        </a>--}}
{{--    </div>--}}
    <div class="logo bg-dark p-5">
        <a href="#">
                <img src="{{asset('theme/img/logo-white.png')}}">
        </a>
    </div>
    <div class="sidebar-wrapper bg-dark">
        <ul class="nav">

            @if(Auth::user()->role === 'ADMIN')
                <li class="{{ (request()->is('admin')) ? 'active' : '' }}">
                    <a href="{{url('admin')}}">
                        <i class="nc-icon nc-bank"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
{{--                <li class="{{ (request()->is('admin/batch/*')) ? 'active' : '' }}">--}}
{{--                    <a href="{{url('admin/batch/all')}}">--}}
{{--                        <i class="nc-icon nc-badge"></i>--}}
{{--                        <p>Batches</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (request()->is('admin/courses/*')) ? 'active' : '' }}">--}}
{{--                    <a href="{{url('admin/courses/all')}}">--}}
{{--                        <i class="nc-icon nc-trophy"></i>--}}
{{--                        <p>Courses</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (request()->is('admin/lecturers/*'))  ? 'active' : '' }}">--}}
{{--                    <a href="{{url('admin/lecturers/all')}}">--}}
{{--                        <i class="nc-icon nc-single-02"></i>--}}
{{--                        <p>Lecturers</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (request()->is('admin/students/*'))  ? 'active' : '' }}">--}}
{{--                    <a href="{{url('admin/students/all')}}">--}}
{{--                        <i class="nc-icon nc-hat-3"></i>--}}
{{--                        <p>Students</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (request()->is('admin/guardians/*'))  ? 'active' : '' }}">--}}
{{--                    <a href="{{url('admin/guardians/all')}}">--}}
{{--                        <i class="fa fa-shield"></i>--}}
{{--                        <p>Guardians</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (request()->is('admin/system-users/*'))  ? 'active' : '' }}">--}}
{{--                    <a href="{{url('admin/system-users/all')}}">--}}
{{--                        <i class="nc-icon nc-circle-10"></i>--}}
{{--                        <p>Users</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
            @elseif(Auth::user()->role === 'FINANCE')
                <li class="{{ (request()->is('finance')) ? 'active' : '' }}">
                    <a href="{{url('finance')}}">
                        <i class="nc-icon nc-bank"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
{{--            @elseif(Auth::user()->role === 'EXAM')--}}
{{--                <li class="{{ (request()->is('examination-dep')) ? 'active' : '' }}">--}}
{{--                    <a href="{{url('examination-dep')}}">--}}
{{--                        <i class="nc-icon nc-bank"></i>--}}
{{--                        <p>Dashboard</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (request()->is('examination-dep/classes'))  ? 'active' : '' }}">--}}
{{--                    <a href="{{url('examination-dep/classes')}}">--}}
{{--                        <i class="nc-icon nc-bullet-list-67"></i>--}}
{{--                        <p>All Exams</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @elseif(Auth::user()->role === 'STUDENT')--}}
{{--                <li class="{{ (request()->is('student')) ? 'active' : '' }}">--}}
{{--                    <a href="{{url('student')}}">--}}
{{--                        <i class="nc-icon nc-bank"></i>--}}
{{--                        <p>Dashboard</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (request()->is('student/info'))  ? 'active' : '' }}">--}}
{{--                    <a href="{{url('student/info')}}">--}}
{{--                        <i class="nc-icon nc-hat-3"></i>--}}
{{--                        <p>My Info</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (request()->is('student/classes'))  ? 'active' : '' }}">--}}
{{--                    <a href="{{url('student/classes')}}">--}}
{{--                        <i class="nc-icon nc-bullet-list-67"></i>--}}
{{--                        <p>My Lectures</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (request()->is('student/exam-results'))  ? 'active' : '' }}">--}}
{{--                    <a href="{{url('student/exam-results')}}">--}}
{{--                        <i class="nc-icon nc-diamond"></i>--}}
{{--                        <p>Exam Results</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @elseif(Auth::user()->role === 'GUARDIAN')--}}
{{--                <li class="{{ (request()->is('guardian')) ? 'active' : '' }}">--}}
{{--                    <a href="{{url('guardian')}}">--}}
{{--                        <i class="nc-icon nc-bank"></i>--}}
{{--                        <p>Dashboard</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (request()->is('guardian/info'))  ? 'active' : '' }}">--}}
{{--                    <a href="{{url('guardian/info')}}">--}}
{{--                        <i class="nc-icon nc-hat-3"></i>--}}
{{--                        <p>Info</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            @elseif(Auth::user()->role === 'LECTURER')--}}
{{--                <li class="{{ (request()->is('lecturer')) ? 'active' : '' }}">--}}
{{--                    <a href="{{url('lecturer')}}">--}}
{{--                        <i class="nc-icon nc-bank"></i>--}}
{{--                        <p>Dashboard</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (request()->is('lecturer/info'))  ? 'active' : '' }}">--}}
{{--                    <a href="{{url('lecturer/info')}}">--}}
{{--                        <i class="fa fa-address-card-o"></i>--}}
{{--                        <p>My Info</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="{{ (request()->is('lecturer/classes'))  ? 'active' : '' }}">--}}
{{--                    <a href="{{url('lecturer/classes')}}">--}}
{{--                        <i class="nc-icon nc-bullet-list-67"></i>--}}
{{--                        <p>My Lectures</p>--}}
{{--                    </a>--}}
{{--                </li>--}}
            @endif
        </ul>
    </div>
</div>
