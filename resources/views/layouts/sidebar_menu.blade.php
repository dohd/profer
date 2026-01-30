<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <!-- End Dashboard Nav -->

    <li class="nav-heading">Program Management</li>

    {{-- Family Member List --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('memberlists.index') }}">
        <i class="bi bi-person-lines-fill"></i></i><span>DF Member List</span>
      </a>
    </li>  

    {{-- Programs --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('regions.index') }}"><i class="bi bi-file-text"></i></i><span>Programs</span></a>
    </li>

    {{-- Study Materials --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('narratives.index') }}">
        <i class="bi bi-archive-fill"></i></i><span>Study Materials</span>
      </a>
    </li>

    {{-- Testimonials --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('case_studies.index') }}">
        <i class="bi bi-card-list"></i></i><span>Bible Study Testimonials</span>
      </a>
    </li> 

    <!-- <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('donors.index') }}"><i class="bi bi-file-earmark-text"></i><span>Donors</span></a>
    </li> -->

    <hr>






    <!-- @canany(['view-proposal', 'view-budgeting', 'view-log-frame', 'view-action-plan', 'view-agenda', 'view-attendance', 'view-activity-narrative', 'view-case-study'])
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

      
    @endcanany -->

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
        <!-- <li>
          <a href="{{ route('reports.narrative_report') }}"><i class="bi bi-circle"></i><span>Narrative Report</span></a>
        </li> -->
        <!-- <li>
          <a href="{{ route('reports.beneficiary_list') }}"><i class="bi bi-circle"></i><span>Rightholder List</span></a>
        </li> -->
        {{-- <li>
          <a href="{{ route('reports.monthly_meetings') }}"><i class="bi bi-circle"></i><span>External Meetings</span></a>
        </li> --}}
        <li>
          <a href="{{ route('reports.participant_analysis') }}"><i class="bi bi-circle"></i><span>Member List Analysis</span></a>
        </li>
      </ul>
    </li>    
    
    {{-- account settings --}}
    <li class="nav-heading">Account Settings</li>
    {{-- Age group --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('age_groups.index') }}"><i class="bi bi-kanban"></i><span>Age Groups</span></a>
    </li>
    {{-- Family Zones --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('dfzones.index') }}"><i class="bi bi-list-check"></i><span>Family Zones</span></a>
    </li>
    {{-- DF Names --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('dfnames.index') }}">
        <i class="bi bi-card-heading"></i><span>DF Names</span>
      </a>
    </li>
    {{-- Ministries --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('ministries.index') }}">
        <i class="bi bi-list-check"></i><span>Ministries</span>
      </a>
    </li>
    {{-- Departments --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('departments.index') }}">
        <i class="bi bi-back"></i><span>Departments</span>
      </a>
    </li>

    <!-- @canany(['view-donor', 'view-programme', 'view-region', 'view-cohort', 'view-age-group', 'view-disability'])
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
         
        </ul>
      </li>
    @endcanany   -->


    {{-- prefixes --}}
    <!-- @can('view-code-prefix')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('prefixes.index') }}">
          <i class="bi bi-asterisk"></i><span>Code Prefixes</span>
        </a>
      </li>
    @endcan -->
    
    {{-- roles & permissions --}}
    <!-- @can('view-role')
      <li class="nav-item">
        <a class="nav-link collapsed" href="{{ route('roles.index') }}">
          <i class="bi bi-shield-check"></i><span>Roles & Rights</span>
        </a>
      </li>
    @endcan -->

    {{-- user management --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('user_profiles.index') }}">
        <i class="bi bi-people"></i><span>User Management</span>
      </a>
    </li>
    @can('view-user')
    @endcan
  </ul>
</aside>
