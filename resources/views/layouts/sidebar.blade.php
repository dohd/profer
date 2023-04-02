<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link" href="{{ route('home') }}">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>
    <!-- End Dashboard Nav -->

    <li class="nav-heading">Key Indicators</li>

    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#key-indicator"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-tag"></i><span>Key Indicators</span
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

    <li class="nav-heading">Project Management</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('proposals.index') }}">
        <i class="bi bi-journal-text"></i></i><span>Grant Proposals</span>
      </a>
    </li>

    {{-- projects --}}
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#project-nav"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-kanban"></i><span>Projects</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="project-nav"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ route('proposals.index') }}"><i class="bi bi-circle"></i><span>Manage Projects</span></a>
        </li>
        <li>
          <a href="{{ route('log_frames.index') }}"><i class="bi bi-circle"></i><span>Project Log Frame</span></a>
        </li>
      </ul>
    </li>

    {{-- action plan --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('action_plans.index') }}">
        <i class="bi bi-calendar-event"></i><span>Action Plan</span>
      </a>
    </li>

    {{-- participant list --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('participant_lists.index') }}">
        <i class="bi bi-clipboard-data"></i></i><span>Participant List</span>
      </a>
    </li>

    {{-- activity narrative --}}
    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('narratives.index') }}">
        <i class="bi bi-journal-text"></i></i><span>Activity Narrative</span>
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
        <i class="bi bi-card-list"></i><span>Reports</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="report"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
      <li>
        <a href="{{ route('reports.narrative_indicator') }}"><i class="bi bi-circle"></i><span>Narrative Report</span></a>
      </li>
      <li>
        <a href="{{ route('reports.participant_analysis') }}"><i class="bi bi-circle"></i><span>Activity Report</span></a>
      </li>
      </ul>
    </li>

    {{-- user management --}}
    <li class="nav-heading">User Management</li>
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#user-management"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-people"></i><span>User Management</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="user-management"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ '#' }}"><i class="bi bi-circle"></i><span>Roles & Rights</span></a>
        </li>
        <li>
          <a href="{{ '#' }}"><i class="bi bi-circle"></i><span>Users</span></a>
        </li>
      </ul>
    </li>
  </ul>
</aside>
