<style>
    :root {
        --sidebar-width: 245px;
        --primary: #2563eb;
        --primary-dark: #1e3a8a;
        --text: #172033;
        --muted: #6b7280;
        --border: #e8edf3;
        --bg: #f5f7fb;
        --card: #ffffff;
        --success: #16a34a;
        --warning: #f59e0b;
        --danger: #ef4444;
        --info: #0ea5e9;
        --purple: #7c3aed;
    }

    body {
        background: var(--bg);
        color: var(--text);
        font-family: Inter, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
    }

    .dashboard-wrapper {
        min-height: 100vh;
    }

    /* =========================
       SIDEBAR
    ========================= */

    .dashboard-sidebar {
        width: var(--sidebar-width);
        min-height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
        bottom: 0;
        background: #10233f;
        color: #fff;
        z-index: 1030;
        overflow-y: auto;
    }

    .brand-area {
        height: 76px;
        display: flex;
        align-items: center;
        padding: 0 20px;
        border-bottom: 1px solid rgba(255,255,255,.08);
    }

    .brand-icon {
        width: 38px;
        height: 38px;
        border-radius: 10px;
        background: #16a34a;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        margin-right: 10px;
    }

    .brand-name {
        font-size: 17px;
        font-weight: 700;
        line-height: 1.1;
    }

    .brand-subtitle {
        font-size: 10px;
        color: rgba(255,255,255,.6);
        margin-top: 3px;
    }

    .sidebar-menu {
        padding: 18px 10px;
    }

    .sidebar-label {
        color: rgba(255,255,255,.38);
        text-transform: uppercase;
        font-size: 10px;
        font-weight: 700;
        letter-spacing: .08em;
        padding: 12px 14px 7px;
    }

    .sidebar-menu a {
        color: rgba(255,255,255,.72);
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 11px 14px;
        margin-bottom: 3px;
        border-radius: 8px;
        font-size: 13px;
        transition: .2s;
    }

    .sidebar-menu a:hover {
        color: #fff;
        background: rgba(255,255,255,.07);
    }

    .sidebar-menu a.active {
        background: #2563eb;
        color: #fff;
        box-shadow: 0 5px 15px rgba(37,99,235,.25);
    }

    .sidebar-menu i {
        width: 18px;
        text-align: center;
        font-size: 15px;
    }

    .sidebar-divider {
        border-top: 1px solid rgba(255,255,255,.08);
        margin: 16px 10px;
    }

    /* =========================
       MAIN
    ========================= */

    .dashboard-main {
        min-height: 100vh;
    }

    .dashboard-content {
        padding: 25px;
    }

    .page-header {
        margin-bottom: 22px;
    }

    .page-title {
        font-size: 25px;
        font-weight: 700;
        margin: 0;
    }

    .page-description {
        color: var(--muted);
        font-size: 13px;
        margin-top: 4px;
    }

    /* =========================
       TOP BAR
    ========================= */

    .top-bar {
        background: #fff;
        border-bottom: 1px solid var(--border);
        padding: 13px 25px;
        display: flex;
        justify-content: flex-end;
        align-items: center;
        gap: 15px;
    }

    .notification {
        width: 38px;
        height: 38px;
        border: 1px solid var(--border);
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        color: #526070;
    }

    .notification-badge {
        position: absolute;
        top: -4px;
        right: -4px;
        width: 17px;
        height: 17px;
        font-size: 9px;
        background: var(--danger);
        color: #fff;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .user-profile {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .user-avatar {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #dbeafe;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--primary);
        font-weight: 700;
        font-size: 13px;
    }

    .user-name {
        font-size: 12px;
        font-weight: 700;
    }

    .user-role {
        color: var(--muted);
        font-size: 10px;
    }

    /* =========================
       FILTERS
    ========================= */

    .dashboard-filters {
        display: grid;
        grid-template-columns: repeat(5, minmax(130px, 1fr));
        gap: 10px;
        margin-bottom: 22px;
    }

    .dashboard-filters .form-select {
        height: 40px;
        font-size: 12px;
        border-color: var(--border);
        border-radius: 7px;
        box-shadow: none;
    }

    .dashboard-filters .form-select:focus {
        border-color: #93c5fd;
        box-shadow: 0 0 0 3px rgba(37,99,235,.08);
    }

    /* =========================
       KPI CARDS
    ========================= */

    .kpi-card {
        background: var(--card);
        border: 1px solid var(--border);
        border-radius: 11px;
        padding: 17px;
        height: 100%;
        position: relative;
        overflow: hidden;
        transition: .2s;
    }

    .kpi-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 20px rgba(15,23,42,.06);
    }

    .kpi-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
    }

    .kpi-icon {
        width: 39px;
        height: 39px;
        border-radius: 9px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
    }

    .icon-green {
        background: #dcfce7;
        color: #16a34a;
    }

    .icon-blue {
        background: #dbeafe;
        color: #2563eb;
    }

    .icon-purple {
        background: #ede9fe;
        color: #7c3aed;
    }

    .icon-orange {
        background: #ffedd5;
        color: #ea580c;
    }

    .icon-red {
        background: #fee2e2;
        color: #dc2626;
    }

    .icon-cyan {
        background: #cffafe;
        color: #0891b2;
    }

    .kpi-label {
        font-size: 11px;
        color: var(--muted);
        font-weight: 600;
        margin-top: 1px;
    }

    .kpi-value {
        font-size: 24px;
        font-weight: 750;
        margin-top: 5px;
        letter-spacing: -.5px;
    }

    .kpi-footer {
        margin-top: 9px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .kpi-change {
        font-size: 10px;
        color: var(--success);
        font-weight: 600;
    }

    .kpi-link {
        font-size: 10px;
        color: var(--primary);
        text-decoration: none;
        font-weight: 600;
    }

    .kpi-subtext {
        color: var(--muted);
        font-size: 10px;
    }

    .progress-thin {
        height: 6px;
        background: #edf1f5;
        border-radius: 10px;
        overflow: hidden;
        margin-top: 10px;
    }

    .progress-thin .progress-bar {
        border-radius: 10px;
    }

    /* =========================
       CARDS
    ========================= */

    .dashboard-card {
        background: #fff;
        border: 1px solid var(--border);
        border-radius: 11px;
        height: 100%;
        overflow: hidden;
    }

    .dashboard-card-header {
        padding: 16px 18px 8px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .dashboard-card-title {
        font-size: 14px;
        font-weight: 700;
        margin: 0;
    }

    .dashboard-card-link {
        color: var(--primary);
        font-size: 10px;
        text-decoration: none;
        font-weight: 600;
    }

    .dashboard-card-body {
        padding: 8px 18px 17px;
    }

    .chart-container {
        min-height: 260px;
    }

    /* =========================
       TABLES
    ========================= */

    .dashboard-table {
        width: 100%;
        font-size: 11px;
    }

    .dashboard-table th {
        color: #7b8491;
        font-weight: 600;
        padding: 8px 6px;
        border-bottom: 1px solid var(--border);
        white-space: nowrap;
    }

    .dashboard-table td {
        padding: 10px 6px;
        border-bottom: 1px solid #f0f2f5;
        vertical-align: middle;
    }

    .dashboard-table tbody tr:last-child td {
        border-bottom: 0;
    }

    .utilisation {
        min-width: 100px;
    }

    .utilisation-row {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .utilisation .progress {
        height: 6px;
        flex: 1;
        background: #edf1f5;
    }

    .utilisation-value {
        font-weight: 600;
        font-size: 10px;
        width: 28px;
        text-align: right;
    }

    /* =========================
       STATUS BADGES
    ========================= */

    .status-badge {
        padding: 4px 8px;
        border-radius: 20px;
        font-size: 9px;
        font-weight: 700;
        white-space: nowrap;
    }

    .status-success {
        background: #dcfce7;
        color: #15803d;
    }

    .status-warning {
        background: #fef3c7;
        color: #b45309;
    }

    .status-danger {
        background: #fee2e2;
        color: #b91c1c;
    }

    .status-info {
        background: #e0f2fe;
        color: #0369a1;
    }

    /* =========================
       GRANT PIPELINE
    ========================= */

    .pipeline {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .pipeline-row {
        display: grid;
        grid-template-columns: 80px 1fr 30px 75px;
        align-items: center;
        gap: 8px;
        font-size: 10px;
    }

    .pipeline-bar {
        height: 21px;
        border-radius: 4px;
        position: relative;
        overflow: hidden;
        background: #eef2f7;
    }

    .pipeline-fill {
        height: 100%;
        border-radius: 4px;
    }

    .pipeline-draft {
        background: #3b82f6;
    }

    .pipeline-submitted {
        background: #38bdf8;
    }

    .pipeline-review {
        background: #f59e0b;
    }

    .pipeline-approved {
        background: #22c55e;
    }

    .pipeline-rejected {
        background: #ef4444;
    }

    .pipeline-total {
        margin-top: 12px;
        padding: 10px;
        background: #f8fafc;
        border-radius: 7px;
        font-size: 10px;
        color: #64748b;
    }

    /* =========================
       PROGRAMME PERFORMANCE
    ========================= */

    .radial-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 5px;
    }

    .radial-chart {
        height: 120px;
    }

    .indicator-table {
        width: 100%;
        font-size: 10px;
    }

    .indicator-table th {
        color: #8993a1;
        padding: 4px;
        font-weight: 600;
    }

    .indicator-table td {
        padding: 6px 4px;
        border-top: 1px solid #f0f2f5;
    }

    /* =========================
       DONOR PORTFOLIO
    ========================= */

    .donor-layout {
        display: grid;
        grid-template-columns: 45% 55%;
        align-items: center;
    }

    .donor-chart {
        height: 230px;
    }

    /* =========================
       PARTICIPANT REACH
    ========================= */

    .participant-total {
        font-size: 27px;
        font-weight: 750;
    }

    .participant-change {
        font-size: 9px;
        color: var(--success);
        background: #ecfdf5;
        padding: 5px 8px;
        border-radius: 20px;
    }

    .demographic-row {
        margin-top: 13px;
    }

    .demographic-header {
        display: flex;
        justify-content: space-between;
        font-size: 10px;
        margin-bottom: 5px;
    }

    .demographic-progress {
        height: 7px;
        background: #edf1f5;
        border-radius: 20px;
        overflow: hidden;
    }

    .demographic-progress span {
        height: 100%;
        display: block;
        border-radius: 20px;
    }

    /* =========================
       GRANT EXPIRY
    ========================= */

    .expiry-item {
        display: flex;
        align-items: center;
        gap: 11px;
        padding: 10px;
        border-radius: 8px;
        margin-bottom: 9px;
    }

    .expiry-item:last-child {
        margin-bottom: 0;
    }

    .expiry-icon {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .expiry-danger {
        background: #fee2e2;
        color: #dc2626;
    }

    .expiry-warning {
        background: #fef3c7;
        color: #d97706;
    }

    .expiry-success {
        background: #dcfce7;
        color: #16a34a;
    }

    .expiry-title {
        font-size: 11px;
        font-weight: 700;
    }

    .expiry-description {
        font-size: 9px;
        color: var(--muted);
        margin-top: 2px;
    }

    /* =========================
       SVG MAP
    ========================= */

    .kenya-map {
        width: 100%;
        height: 235px;
    }

    .kenya-region {
        fill: #dbeafe;
        stroke: #fff;
        stroke-width: 1.5;
        transition: .2s;
        cursor: pointer;
    }

    .kenya-region:hover {
        fill: #2563eb;
    }

    .region-label {
        font-size: 9px;
        fill: #334155;
        font-weight: 600;
    }

    .region-value {
        font-size: 9px;
        fill: #2563eb;
        font-weight: 700;
    }

    .map-dot {
        fill: #2563eb;
        stroke: #fff;
        stroke-width: 2;
    }

    /* =========================
       RISK / AGENDA
    ========================= */

    .risk-row {
        padding: 8px 0;
        border-bottom: 1px solid #f0f2f5;
        display: grid;
        grid-template-columns: 1fr auto;
        gap: 10px;
        align-items: center;
    }

    .risk-row:last-child {
        border-bottom: 0;
    }

    .risk-title {
        font-size: 10px;
        font-weight: 600;
    }

    .risk-meta {
        color: var(--muted);
        font-size: 9px;
        margin-top: 2px;
    }

    .agenda-item {
        display: flex;
        gap: 10px;
        padding: 9px 0;
        border-bottom: 1px solid #f0f2f5;
    }

    .agenda-item:last-child {
        border-bottom: 0;
    }

    .agenda-date {
        width: 40px;
        height: 42px;
        border-radius: 7px;
        background: #eff6ff;
        color: #2563eb;
        text-align: center;
        padding-top: 5px;
        flex-shrink: 0;
    }

    .agenda-day {
        display: block;
        font-size: 15px;
        font-weight: 700;
        line-height: 15px;
    }

    .agenda-month {
        font-size: 8px;
        text-transform: uppercase;
        font-weight: 700;
    }

    .agenda-title {
        font-size: 10px;
        font-weight: 700;
    }

    .agenda-meta {
        font-size: 9px;
        color: var(--muted);
        margin-top: 4px;
    }

    /* =========================
       MANAGEMENT ATTENTION
    ========================= */

    .attention-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 7px 0;
    }

    .attention-icon {
        width: 25px;
        height: 25px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
    }

    .attention-number {
        font-size: 15px;
        font-weight: 750;
        margin-right: 4px;
    }

    .attention-label {
        font-size: 10px;
        color: #64748b;
    }

    /* =========================
       MOBILE
    ========================= */

    .sidebar-toggle {
        display: none;
    }

    @media(max-width: 1199px) {
        .dashboard-filters {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    @media(max-width: 991px) {
        .dashboard-sidebar {
            transform: translateX(-100%);
            transition: .25s;
        }

        .dashboard-sidebar.show {
            transform: translateX(0);
        }

        .sidebar-toggle {
            display: inline-flex;
            width: 38px;
            height: 38px;
            border: 1px solid var(--border);
            background: #fff;
            border-radius: 8px;
            align-items: center;
            justify-content: center;
        }

        .dashboard-content {
            padding: 18px;
        }

        .dashboard-filters {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media(max-width: 575px) {
        .dashboard-filters {
            grid-template-columns: 1fr;
        }

        .dashboard-content {
            padding: 13px;
        }

        .top-bar {
            padding: 10px 13px;
        }

        .user-profile .user-details {
            display: none;
        }

        .radial-grid {
            grid-template-columns: 1fr;
        }

        .donor-layout {
            grid-template-columns: 1fr;
        }

        .pipeline-row {
            grid-template-columns: 65px 1fr 25px;
        }

        .pipeline-row .pipeline-value {
            display: none;
        }
    }
</style>