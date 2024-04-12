<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <!-- End Dashboard Nav -->

    <li class="nav-heading">Programme Management</li>
    @canany(['view-proposal', 'view-budgeting', 'view-log-frame', 'view-action-plan', 'view-agenda', 'view-attendance', 'view-activity-narrative', 'view-case-study'])
      {{-- proposals --}}
      @can('view-proposal')
        <li class="nav-item">
          <a class="nav-link collapsed" href="{{ route('proposals.index') }}">
            <i class="bi bi-file-text"></i></i><span>Grant Proposal</span>
          </a>
        </li>
      @endcan

      {{-- project budget --}}
      @can('view-budgeting')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('budgets.index') }}">
          <i class="bi bi-cash-stack"></i></i><span>Budgeting</span>
        </a>
      </li>
      @endcan

      {{-- log frame --}}
      @can('view-log-frame')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('log_frames.index') }}">
          <i class="bi bi-kanban"></i><span>Log Frame</span>
        </a>
      </li>
      @endcan

      {{-- action plan --}}
      @can('view-action-plan')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('action_plans.index') }}">
          <i class="bi bi-calendar-plus"></i><span>Action Plan</span>
        </a>
      </li>
      @endcan

      {{-- agenda --}}
      @can('view-agenda')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('agenda.index') }}">
          <i class="bi bi-list-check"></i><span>Agenda</span>
        </a>
      </li>
      @endcan

      {{-- attendance --}}
      @can('view-attendance')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('attendances.index') }}">
          <i class="bi bi-person-lines-fill"></i></i><span>Attendance</span>
        </a>
      </li>
      @endcan

      {{-- activity narrative --}}
      @can('view-activity-narrative')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('narratives.index') }}">
          <i class="bi bi-file-text"></i></i><span>Activity Narrative</span>
        </a>
      </li>
      @endcan

      {{-- case study --}}
      @can('view-case-study')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('case_studies.index') }}">
          <i class="bi bi-file-earmark-text"></i></i><span>Case Study</span>
        </a>
      </li>
      @endcan
    @endcanany

    {{-- file imports --}}
    <li class="nav-heading">Imports</li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('file_imports.index') }}">
        <i class="bi bi-upload"></i><span>File Import</span>
      </a>
    </li>

    {{-- reports --}}
    <li class="nav-heading">Reports</li>
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#report"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-table"></i><span>Reports</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="report"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ route('reports.narrative_report') }}"><i class="bi bi-circle"></i><span>Narrative Report</span></a>
        </li>
        <li>
          <a href="{{ route('reports.beneficiary_list') }}"><i class="bi bi-circle"></i><span>Rightholder List</span></a>
        </li>
        {{-- <li>
          <a href="{{ route('reports.monthly_meetings') }}"><i class="bi bi-circle"></i><span>External Meetings</span></a>
        </li> --}}
        <li>
          <a href="{{ route('reports.participant_analysis') }}"><i class="bi bi-circle"></i><span>Participant Analysis</span></a>
        </li>
      </ul>
    </li>    
    
    {{-- account settings --}}
    <li class="nav-heading">Account Settings</li>
    @canany(['view-donor', 'view-programme', 'view-region', 'view-cohort', 'view-age-group', 'view-disability'])
      <li class="nav-item">
        <a
          class="nav-link collapsed"
          data-bs-target="#key-indicator"
          data-bs-toggle="collapse"
          href="#"
        >
          <i class="bi bi-tag"></i><span>Key Parameters</span
          ><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul
          id="key-indicator"
          class="nav-content collapse"
          data-bs-parent="#sidebar-nav"
        >
          @can('view-donor')
            <li>
              <a href="{{ route('donors.index') }}"><i class="bi bi-circle"></i><span>Donors</span></a>
            </li>
          @endcan
          @can('view-programme')
            <li>
              <a href="{{ route('programmes.index') }}"><i class="bi bi-circle"></i><span>Key Programmes</span></a>
            </li>
          @endcan
          @can('view-region')
            <li>
              <a href="{{ route('regions.index') }}"><i class="bi bi-circle"></i><span>Target Regions</span></a>
            </li>
          @endcan
          @can('view-cohort')
            <li>
              <a href="{{ route('cohorts.index') }}"><i class="bi bi-circle"></i><span>Target Cohorts</span></a>
            </li>
          @endcan
          @can('view-age-group')
            <li>
              <a href="{{ route('age_groups.index') }}"><i class="bi bi-circle"></i><span>Age Groups</span></a>
            </li>
          @endcan
          @can('view-disability')
            <li>
              <a href="{{ route('disabilities.index') }}"><i class="bi bi-circle"></i><span>Disabilities</span></a>
            </li>
          @endcan
        </ul>
      </li>
    @endcanany  

    {{-- deadlines --}}
    @can('view-deadline')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('deadlines.index') }}">
          <i class="bi bi-calendar-x"></i><span>Manage Deadlines</span>
        </a>
      </li>
    @endcan

    {{-- prefixes --}}
    @can('view-code-prefix')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('prefixes.index') }}">
          <i class="bi bi-asterisk"></i><span>Code Prefixes</span>
        </a>
      </li>
    @endcan
    
    {{-- roles & permissions --}}
    @can('view-role')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('roles.index') }}">
          <i class="bi bi-shield-check"></i><span>Roles & Rights</span>
        </a>
      </li>
    @endcan

    {{-- user management --}}
    @can('view-user')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('user_profiles.index') }}">
          <i class="bi bi-people"></i><span>User Management</span>
        </a>
      </li>
    @endcan
  </ul>
</aside>
