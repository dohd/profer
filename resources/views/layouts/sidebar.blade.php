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

    {{-- donor --}}
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#donor-nav"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-journal-text"></i><span>Donor</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="donor-nav"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ route('donors.create') }}"><i class="bi bi-circle"></i><span>Create Donor</span></a>
        </li>
        <li>
          <a href="{{ route('donors.index') }}"><i class="bi bi-circle"></i><span>Manage Donor</span></a>
        </li>
      </ul>
    </li>

    {{-- programme --}}
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#programme-nav"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-journal-text"></i><span>Programme</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="programme-nav"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ route('programmes.create') }}"><i class="bi bi-circle"></i><span>Create Programme</span></a>
        </li>
        <li>
          <a href="{{ route('programmes.index') }}"><i class="bi bi-circle"></i><span>Manage Programmes</span></a>
        </li>
      </ul>
    </li>

    {{-- region --}}
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#region-nav"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-journal-text"></i><span>Target Region</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="region-nav"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ route('regions.create') }}"><i class="bi bi-circle"></i><span>Create Region</span></a>
        </li>
        <li>
          <a href="{{ route('regions.index') }}"><i class="bi bi-circle"></i><span>Manage Regions</span></a>
        </li>
      </ul>
    </li>

    {{-- target cohort --}}
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#cohort-nav"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-journal-text"></i><span>Target Cohort</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="cohort-nav"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ route('cohorts.create') }}"><i class="bi bi-circle"></i><span>Create Cohort</span></a>
        </li>
        <li>
          <a href="{{ route('cohorts.index') }}"><i class="bi bi-circle"></i><span>Manage Cohorts</span></a>
        </li>
      </ul>
    </li>

    {{-- disabiliy --}}
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#disability-nav"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-journal-text"></i><span>Disability</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="disability-nav"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ route('disabilities.create') }}"><i class="bi bi-circle"></i><span>Create Disability</span></a>
        </li>
        <li>
          <a href="{{ route('disabilities.index') }}"><i class="bi bi-circle"></i><span>Manage Disabilities</span></a>
        </li>
      </ul>
    </li>

    {{-- age group --}}
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#agegroup-nav"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-journal-text"></i><span>Age Group</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="agegroup-nav"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ route('age_groups.create') }}"><i class="bi bi-circle"></i><span>Create Age Group</span></a>
        </li>
        <li>
          <a href="{{ route('age_groups.index') }}"><i class="bi bi-circle"></i><span>Manage Age Groups</span></a>
        </li>
      </ul>
    </li>


    <li class="nav-heading">Project Management</li>

    {{-- proposal --}}
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#proposals-nav"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-menu-button-wide"></i><span>Grant Proposal</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="proposals-nav"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ route('proposals.create') }}"><i class="bi bi-circle"></i><span>Create Proposal</span></a>
        </li>
        <li>
          <a href="{{ route('proposals.index') }}"><i class="bi bi-circle"></i><span>Manage Proposals</span></a>
        </li>
      </ul>
    </li>

    {{-- log frame --}}
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#logframe-nav"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-menu-button-wide"></i><span>Log Frame</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="logframe-nav"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ '#' }}"><i class="bi bi-circle"></i><span>Create Log Frame</span></a>
        </li>
        <li>
          <a href="{{ '#' }}"><i class="bi bi-circle"></i><span>Manage Log Frames</span></a>
        </li>
      </ul>
    </li>

    {{-- action plan --}}
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#action-plan-nav"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-journal-text"></i><span>Action Plan</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="action-plan-nav"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ route('action_plans.create') }}"><i class="bi bi-circle"></i><span>Create Plan</span></a>
        </li>
        <li>
          <a href="{{ route('action_plans.index') }}"><i class="bi bi-circle"></i><span>Manage Plans</span></a>
        </li>
      </ul>
    </li>

    {{-- activity implementation --}}
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#act-implementation-nav"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-journal-text"></i><span>Implementation</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="act-implementation-nav"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ route('participants.create') }}"><i class="bi bi-circle"></i><span>Create Participant</span></a>
        </li>
        <li>
          <a href="{{ route('participants.index') }}"><i class="bi bi-circle"></i><span>Manage Participants</span></a>
        </li>
      </ul>
    </li>

    {{-- activity narrative --}}
    <li class="nav-item">
      <a
        class="nav-link collapsed"
        data-bs-target="#act-narrative-nav"
        data-bs-toggle="collapse"
        href="#"
      >
        <i class="bi bi-journal-text"></i><span>Activity Narrative</span
        ><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul
        id="act-narrative-nav"
        class="nav-content collapse"
        data-bs-parent="#sidebar-nav"
      >
        <li>
          <a href="{{ route('action_plans.create') }}"><i class="bi bi-circle"></i><span>Create Narrative</span></a>
        </li>
        <li>
          <a href="{{ route('action_plans.index') }}"><i class="bi bi-circle"></i><span>Manage Narratives</span></a>
        </li>
      </ul>
    </li>
    <!-- End Forms Nav -->

    <li class="nav-heading">Pages</li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('user_profiles.index') }}">
        <i class="bi bi-person"></i>
        <span>Profile</span>
      </a>
    </li>
    <!-- End Profile Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('register') }}">
        <i class="bi bi-card-list"></i>
        <span>Register</span>
      </a>
    </li>
    <!-- End Register Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('login') }}">
        <i class="bi bi-box-arrow-in-right"></i>
        <span>Login</span>
      </a>
    </li>
    <!-- End Login Page Nav -->

    <li class="nav-item">
      <a class="nav-link collapsed" href="{{ route('error_404') }}">
        <i class="bi bi-dash-circle"></i>
        <span>Error 404</span>
      </a>
    </li>
    <!-- End Error 404 Page Nav -->
  </ul>
</aside>
