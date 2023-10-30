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

    {{-- proposals --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('proposals.index') }}">
        <i class="bi bi-file-text"></i></i><span>Grant Proposal</span>
      </a>
    </li>

    {{-- log frame --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('log_frames.index') }}">
        <i class="bi bi-kanban"></i><span>Log Frame</span>
      </a>
    </li>

    {{-- action plan --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('action_plans.index') }}">
        <i class="bi bi-calendar-plus"></i><span>Action Plan</span>
      </a>
    </li>

    {{-- agenda --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('agenda.index') }}">
        <i class="bi bi-list-check"></i><span>Agenda List</span>
      </a>
    </li>

    {{-- participant list --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('participant_lists.index') }}">
        <i class="bi bi-person-lines-fill"></i></i><span>Participant List</span>
      </a>
    </li>

    {{-- activity narrative --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('narratives.index') }}">
        <i class="bi bi-file-earmark-text"></i></i><span>Activity Narrative</span>
      </a>
    </li>

    {{-- case study --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('case_studies.index') }}">
        <i class="bi bi-file-earmark-text"></i></i><span>Case Studies</span>
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
        <a href="{{ route('reports.participant_analysis') }}"><i class="bi bi-circle"></i><span>Participant Analysis</span></a>
      </li>
      </ul>
    </li>    
    
    {{-- account settings --}}
    <li class="nav-heading">Account Settings</li>
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
        <li>
          <a href="{{ route('donors.index') }}"><i class="bi bi-circle"></i><span>Donors</span></a>
        </li>
        <li>
          <a href="{{ route('programmes.index') }}"><i class="bi bi-circle"></i><span>Key Programmes</span></a>
        </li>
        <li>
          <a href="{{ route('regions.index') }}"><i class="bi bi-circle"></i><span>Target Regions</span></a>
        </li>
        <li>
          <a href="{{ route('cohorts.index') }}"><i class="bi bi-circle"></i><span>Target Cohorts</span></a>
        </li>
        <li>
          <a href="{{ route('age_groups.index') }}"><i class="bi bi-circle"></i><span>Age Groups</span></a>
        </li>
        <li>
          <a href="{{ route('disabilities.index') }}"><i class="bi bi-circle"></i><span>Disabilities</span></a>
        </li>
      </ul>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('user_profiles.index') }}">
        <i class="bi bi-people"></i><span>User Management</span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link collapsed" href="javascript:">
        <i class="bi bi-gear"></i> <span>Account Settings</span>
      </a>
    </li>
  </ul>
</aside>
