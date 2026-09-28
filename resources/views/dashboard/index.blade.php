@extends('layouts.core')
@section('title', 'Dashboard')

@section('content')

@include('dashboard.style')
<div class="dashboard-wrapper">
    {{-- =========================================================
         MAIN
    ========================================================== --}}
    <main class="dashboard-main">
        <div class="dashboard-content">
            {{-- PAGE HEADER --}}
            <div class="page-header">
                <div class="d-flex align-items-center gap-2">
                    <div>
                        <h1 class="page-title">Dashboard</h1>
                        <div class="page-description">
                            Overview of programmes, funding, activities and impact
                        </div>
                    </div>
                </div>
            </div>


            {{-- =====================================================
                 GLOBAL FILTERS
            ====================================================== --}}

            <div class="dashboard-filters">
                <select class="form-select dashboard-filter" id="filterYear">
                    <option>FY 2026</option>
                    <option>FY 2025</option>
                    <option>FY 2024</option>
                </select>

                <select class="form-select dashboard-filter" id="filterPeriod">
                    <option value="year">This Year</option>
                    <option value="quarter">This Quarter</option>
                    <option value="month">This Month</option>
                </select>

                <select class="form-select dashboard-filter" id="filterProgramme">
                    <option value="">All Programmes</option>
                    @foreach ($dashboardData['programmes'] as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach  
                </select>

                <select class="form-select dashboard-filter" id="filterDonor">
                    <option value="">All Donors</option>
                    @foreach ($dashboardData['donors'] as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach                    
                </select>

                <select class="form-select dashboard-filter" id="filterRegion">
                    <option value="">All Regions</option>
                    @foreach ($dashboardData['regions'] as $id => $name)
                        <option value="{{ $id }}">{{ $name }}</option>
                    @endforeach  
                </select>
            </div>


            {{-- =====================================================
                 KPI CARDS
            ====================================================== --}}

            <div class="row g-3 mb-3">

                {{-- Active Programmes --}}
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="kpi-card">
                        <div class="kpi-top">
                            <div>
                                <div class="kpi-label">Active Programmes</div>
                                <div class="kpi-value" id="kpiProgrammes">
                                    14
                                </div>
                            </div>
                            <div class="kpi-icon icon-green">
                                <i class="bi bi-people-fill"></i>
                            </div>
                        </div>
                        <div class="kpi-footer">
                            <span class="kpi-change">
                                ↑ 20%
                            </span>
                            <a href="#" class="kpi-link">
                                View programmes →
                            </a>
                        </div>
                    </div>
                </div>


                {{-- Active Grants --}}
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="kpi-card">
                        <div class="kpi-top">
                            <div>
                                <div class="kpi-label">Active Grants</div>
                                <div class="kpi-value" id="kpiGrants">
                                    10
                                </div>
                            </div>
                            <div class="kpi-icon icon-blue">
                                <i class="bi bi-award"></i>
                            </div>
                        </div>
                        <div class="kpi-footer">
                            <span class="kpi-change">
                                ↑ 12%
                            </span>
                            <a href="#" class="kpi-link">
                                View grants →
                            </a>
                        </div>
                    </div>
                </div>


                {{-- Grant Value --}}
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="kpi-card">
                        <div class="kpi-top">
                            <div>
                                <div class="kpi-label">Approved Grant Value</div>
                                <div class="kpi-value">
                                    KES 15.4M
                                </div>
                            </div>
                            <div class="kpi-icon icon-purple">
                                <i class="bi bi-stack"></i>
                            </div>
                        </div>
                        <div class="kpi-footer">
                            <span class="kpi-change">
                                ↑ 15%
                            </span>
                            <a href="#" class="kpi-link">
                                View grants →
                            </a>
                        </div>
                    </div>
                </div>


                {{-- Budget --}}
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="kpi-card">
                        <div class="kpi-top">
                            <div class="w-100">
                                <div class="kpi-label">
                                    Budget Utilisation
                                </div>
                                <div class="kpi-value">
                                    15.3%
                                </div>
                                <div class="progress-thin">
                                    <div class="progress-bar bg-success"
                                         style="width:67.8%">
                                    </div>
                                </div>
                            </div>
                            <div class="kpi-icon icon-orange">
                                <i class="bi bi-pie-chart"></i>
                            </div>
                        </div>
                        <div class="kpi-footer">
                            <span class="kpi-subtext">
                                KES 4.9M / KES 32.1M
                            </span>
                            <a href="#" class="kpi-link">
                                View budget →
                            </a>
                        </div>
                    </div>
                </div>


                {{-- Activities --}}
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="kpi-card">
                        <div class="kpi-top">
                            <div>
                                <div class="kpi-label">Activities This Period</div>
                                <div class="kpi-value">
                                    60
                                </div>
                            </div>
                            <div class="kpi-icon icon-red">
                                <i class="bi bi-calendar-event"></i>
                            </div>
                        </div>
                        <div class="kpi-footer">
                            <span class="kpi-subtext">
                                27 completed · 33 pending
                            </span>
                            <a href="#" class="kpi-link">
                                View activities →
                            </a>
                        </div>
                    </div>
                </div>


                {{-- Participants --}}
                <div class="col-xl-2 col-lg-4 col-md-6">
                    <div class="kpi-card">
                        <div class="kpi-top">
                            <div>
                                <div class="kpi-label">Participants Reached</div>
                                <div class="kpi-value">
                                    2,354
                                </div>
                            </div>
                            <div class="kpi-icon icon-cyan">
                                <i class="bi bi-person-fill"></i>
                            </div>
                        </div>
                        <div class="kpi-footer">
                            <span class="kpi-change">
                                ↑ 18%
                            </span>
                            <a href="#" class="kpi-link">
                                View participants →
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            {{-- =====================================================
                 ROW 1
            ====================================================== --}}

            <div class="row g-3 mb-3">
                {{-- GRANT PIPELINE --}}
                <div class="col-xl-4">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <h3 class="dashboard-card-title">
                                Grant Pipeline
                            </h3>
                            <a href="#" class="dashboard-card-link">
                                View all →
                            </a>
                        </div>
                        <div class="dashboard-card-body">
                            <div class="pipeline">
                                <div class="pipeline-row">
                                    <span>Draft</span>
                                    <div class="pipeline-bar">
                                        <div class="pipeline-fill pipeline-draft"
                                             style="width:0%">
                                        </div>
                                    </div>
                                    <strong>0</strong>
                                    <span class="pipeline-value">
                                        KES 0M
                                    </span>
                                </div>
                                <div class="pipeline-row">
                                    <span>Submitted</span>
                                    <div class="pipeline-bar">
                                        <div class="pipeline-fill pipeline-submitted"
                                             style="width:100%">
                                        </div>
                                    </div>
                                    <strong>10</strong>
                                    <span class="pipeline-value">
                                        KES 15.4M
                                    </span>
                                </div>
                                <div class="pipeline-row">
                                    <span>Review</span>
                                    <div class="pipeline-bar">
                                        <div class="pipeline-fill pipeline-review"
                                             style="width:0%">
                                        </div>
                                    </div>
                                    <strong>0</strong>
                                    <span class="pipeline-value">
                                        KES 0M
                                    </span>
                                </div>
                                <div class="pipeline-row">
                                    <span>Approved</span>
                                    <div class="pipeline-bar">
                                        <div class="pipeline-fill pipeline-approved"
                                             style="width:100%">
                                        </div>
                                    </div>
                                    <strong>10</strong>
                                    <span class="pipeline-value">
                                        KES 15.4M
                                    </span>
                                </div>
                                <div class="pipeline-row">
                                    <span>Rejected</span>
                                    <div class="pipeline-bar">
                                        <div class="pipeline-fill pipeline-rejected"
                                             style="width:0%">
                                        </div>
                                    </div>
                                    <strong>0</strong>
                                    <span class="pipeline-value">
                                        KES 0M
                                    </span>
                                </div>
                            </div>
                            <div class="pipeline-total">
                                <strong>Total Pipeline:</strong> KES 15.4M
                                <span class="mx-2">|</span>
                                <strong>Approval Rate:</strong> 100%
                            </div>
                        </div>
                    </div>
                </div>


                {{-- BUDGET VS ACTUAL --}}
                <div class="col-xl-5">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <h3 class="dashboard-card-title">
                                Budget vs Actual
                            </h3>
                            <a href="#" class="dashboard-card-link">
                                View budget details →
                            </a>
                        </div>
                        <div class="dashboard-card-body">
                            <table class="dashboard-table">
                                <thead>
                                    <tr>
                                        <th>Programme</th>
                                        <th>Budget</th>
                                        <th>Spent</th>
                                        <th>Utilisation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Jamii Power</td>
                                        <td>9.9M</td>
                                        <td>4.8M</td>
                                        <td class="utilisation">
                                            <div class="utilisation-row">
                                                <div class="progress">
                                                    <div class="progress-bar bg-success"
                                                         style="width:48%">
                                                    </div>
                                                </div>
                                                <span class="utilisation-value">
                                                    48.4%
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Legal Capacity</td>
                                        <td>0.758M</td>
                                        <td>0M</td>
                                        <td class="utilisation">
                                            <div class="utilisation-row">
                                                <div class="progress">
                                                    <div class="progress-bar bg-success"
                                                         style="width:0%">
                                                    </div>
                                                </div>
                                                <span class="utilisation-value">
                                                    0%
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Effect of climate change on mental health</td>
                                        <td>0.5M</td>
                                        <td>0M</td>
                                        <td class="utilisation">
                                            <div class="utilisation-row">
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning"
                                                         style="width:0%">
                                                    </div>
                                                </div>
                                                <span class="utilisation-value">
                                                    0%
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>SOCIAL INCLUSION FOR PERSONS WITH INTELLECTUAL DISABILITIES IN KENYA</td>
                                        <td>4.2M</td>
                                        <td>0M</td>
                                        <td class="utilisation">
                                            <div class="utilisation-row">
                                                <div class="progress">
                                                    <div class="progress-bar bg-success"
                                                         style="width:0%">
                                                    </div>
                                                </div>
                                                <span class="utilisation-value">
                                                    0%
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Deepening understanding on MH & wellbeing</td>
                                        <td>0.695M</td>
                                        <td>0.12M</td>
                                        <td class="utilisation">
                                            <div class="utilisation-row">
                                                <div class="progress">
                                                    <div class="progress-bar bg-warning"
                                                         style="width:17%">
                                                    </div>
                                                </div>
                                                <span class="utilisation-value">
                                                    17.3%
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                {{-- PROGRAMME PERFORMANCE --}}
                <div class="col-xl-3">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <h3 class="dashboard-card-title">
                                Programme Performance
                            </h3>
                            <a href="#" class="dashboard-card-link">
                                View all →
                            </a>
                        </div>
                        <div class="dashboard-card-body">
                            <div class="radial-grid">
                                <div id="goalChart" class="radial-chart"></div>
                                <div id="outcomeChart" class="radial-chart"></div>
                                <div id="outputChart" class="radial-chart"></div>
                            </div>
                            <table class="indicator-table">
                                <thead>
                                    <tr>
                                        <th>Indicator</th>
                                        <th>Target</th>
                                        <th>Actual</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>2.1.2 Deliver evidence-based advocacy training with a focus on education, employment, and health</td>
                                        <td>562</td>
                                        <td>362</td>
                                        <td>
                                            <span class="text-danger">
                                                ●
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Strenthening of peer support activities for self advocates and families</td>
                                        <td>422</td>
                                        <td>468</td>
                                        <td>
                                            <span class="text-success">
                                                ●
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Strengthening of existing and development of new circles of care and support in Kasarani</td>
                                        <td>399</td>
                                        <td>90</td>
                                        <td>
                                            <span class="text-danger">
                                                ●
                                            </span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            {{-- =====================================================
                 ROW 2
            ====================================================== --}}

            <div class="row g-3 mb-3">
                {{-- ACTIVITY TREND --}}
                <div class="col-xl-5">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <h3 class="dashboard-card-title">
                                Activity Performance Trend
                            </h3>
                            <a href="#" class="dashboard-card-link">
                                View all →
                            </a>
                        </div>
                        <div class="dashboard-card-body">
                            <div class="btn-group btn-group-sm mb-2"
                                 role="group">
                                <button type="button"
                                        class="btn btn-primary chart-toggle"
                                        data-chart="activities">
                                    Activities
                                </button>
                                <button type="button"
                                        class="btn btn-outline-secondary chart-toggle"
                                        data-chart="participants">
                                    Participants
                                </button>
                                <button type="button"
                                        class="btn btn-outline-secondary chart-toggle"
                                        data-chart="completion">
                                    Completion Rate
                                </button>
                            </div>
                            <div id="activityChart"
                                 class="chart-container"></div>
                        </div>
                    </div>
                </div>


                {{-- DONOR PORTFOLIO --}}
                <div class="col-xl-5">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <h3 class="dashboard-card-title">
                                Donor Portfolio
                            </h3>
                            <a href="#" class="dashboard-card-link">
                                View all →
                            </a>
                        </div>
                        <div class="dashboard-card-body">
                            <div class="donor-layout">
                                <div id="donorChart"
                                     class="donor-chart">
                                </div>
                                <div>
                                    <table class="dashboard-table">
                                        <thead>
                                            <tr>
                                                <th>Donor</th>
                                                <th>Grants</th>
                                                <th>Value</th>
                                                <th>Util.</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Women Enabled International</td>
                                                <td>1</td>
                                                <td>0.758M</td>
                                                <td>0%</td>
                                            </tr>
                                            <tr>
                                                <td>Comic Relief</td>
                                                <td>1</td>
                                                <td>0.695M</td>
                                                <td>17.3%</td>
                                            </tr>
                                            <tr>
                                                <td>National Council for Persons with Disabilities</td>
                                                <td>1</td>
                                                <td>0.5M</td>
                                                <td>0%</td>
                                            </tr>
                                            <tr>
                                                <td>LEV</td>
                                                <td>3</td>
                                                <td>5.7M</td>
                                                <td>48%</td>
                                            </tr>
                                            <tr>
                                                <td>Others</td>
                                                <td>4</td>
                                                <td>5.7M</td>
                                                <td>0%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- GRANT EXPIRY --}}
                <div class="col-xl-2">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <h3 class="dashboard-card-title">
                                Grant Expiry Watch
                            </h3>
                            <a href="#" class="dashboard-card-link">
                                View all →
                            </a>
                        </div>
                        <div class="dashboard-card-body">
                            <div class="expiry-item bg-danger-subtle">
                                <div class="expiry-icon expiry-danger">
                                    <i class="bi bi-clock-history"></i>
                                </div>
                                <div>
                                    <div class="expiry-title">
                                        0 grants
                                    </div>
                                    <div class="expiry-description">
                                        expire within 30 days
                                    </div>
                                </div>
                            </div>
                            <div class="expiry-item bg-warning-subtle">
                                <div class="expiry-icon expiry-warning">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div>
                                    <div class="expiry-title">
                                        1 grants
                                    </div>
                                    <div class="expiry-description">
                                        expire within 90 days
                                    </div>
                                </div>
                            </div>
                            <div class="expiry-item bg-success-subtle">
                                <div class="expiry-icon expiry-success">
                                    <i class="bi bi-check-circle"></i>
                                </div>
                                <div>
                                    <div class="expiry-title">
                                        10 grants
                                    </div>
                                    <div class="expiry-description">
                                        active
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- =====================================================
                 ROW 3 - PARTICIPANTS
            ====================================================== --}}

            <div class="row g-3 mb-3">
                {{-- PARTICIPANT REACH --}}
                <div class="col-xl-3">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <h3 class="dashboard-card-title">
                                Participant Reach
                            </h3>
                            <a href="#" class="dashboard-card-link">
                                View all →
                            </a>
                        </div>
                        <div class="dashboard-card-body">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="participant-total">
                                        2,354
                                    </div>
                                    <div class="kpi-subtext">
                                        Total Participants
                                    </div>
                                </div>
                                <div class="participant-change">
                                    ↑ 18% vs last year
                                </div>
                            </div>
                            <div class="demographic-row">
                                <div class="demographic-header">
                                    <span>Female</span>
                                    <strong>1,514</strong>
                                </div>
                                <div class="demographic-progress">
                                    <span style="width:64%;background:#f472b6"></span>
                                </div>
                            </div>
                            <div class="demographic-row">
                                <div class="demographic-header">
                                    <span>Male</span>
                                    <strong>840</strong>
                                </div>
                                <div class="demographic-progress">
                                    <span style="width:36%;background:#3b82f6"></span>
                                </div>
                            </div>
                            <div class="demographic-row">
                                <div class="demographic-header">
                                    <span>Other</span>
                                    <strong>0</strong>
                                </div>
                                <div class="demographic-progress">
                                    <span style="width:2%;background:#8b5cf6"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- AGE DISTRIBUTION --}}
                <div class="col-xl-3">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <h3 class="dashboard-card-title">
                                Age Distribution
                            </h3>
                            <a href="#" class="dashboard-card-link">
                                View all →
                            </a>
                        </div>
                        <div class="dashboard-card-body">
                            <div id="ageChart"
                                 class="chart-container">
                            </div>
                        </div>
                    </div>
                </div>


                {{-- REGIONAL PARTICIPATION --}}
                <div class="col-xl-4">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <h3 class="dashboard-card-title">
                                Regional Participation
                            </h3>
                            <a href="#" class="dashboard-card-link">
                                View all →
                            </a>
                        </div>
                        <div class="dashboard-card-body">
                            {{-- Simplified SVG regional map.
                                 Replace the paths with your final
                                 county/region SVG later. --}}
                            <svg class="kenya-map"
                                 viewBox="0 0 500 300"
                                 xmlns="http://www.w3.org/2000/svg">
                                {{-- Simplified Kenya silhouette --}}
                                <path d="M190 25
                                         L250 35
                                         L300 25
                                         L350 55
                                         L400 70
                                         L425 110
                                         L405 145
                                         L430 180
                                         L400 220
                                         L350 235
                                         L320 270
                                         L270 255
                                         L230 270
                                         L200 235
                                         L155 230
                                         L130 195
                                         L105 175
                                         L120 135
                                         L105 105
                                         L135 80
                                         L160 55 Z"
                                      fill="#eff6ff"
                                      stroke="#bfdbfe"
                                      stroke-width="2"/>
                                {{-- Regions --}}
                                <path class="kenya-region"
                                      d="M190 25 L250 35 L230 105 L175 100 L160 55Z"/>
                                <path class="kenya-region"
                                      d="M250 35 L300 25 L325 75 L290 120 L230 105Z"/>
                                <path class="kenya-region"
                                      d="M300 25 L350 55 L400 70 L375 115 L325 75Z"/>
                                <path class="kenya-region"
                                      d="M230 105 L290 120 L300 180 L240 175 L200 140Z"/>
                                <path class="kenya-region"
                                      d="M290 120 L375 115 L405 145 L380 190 L300 180Z"/>
                                <path class="kenya-region"
                                      d="M200 140 L240 175 L230 230 L155 230 L130 195Z"/>
                                <path class="kenya-region"
                                      d="M240 175 L300 180 L320 230 L270 255 L230 230Z"/>
                                <path class="kenya-region"
                                      d="M300 180 L380 190 L400 220 L350 235 L320 270 L320 230Z"/>
                                <path class="kenya-region"
                                      d="M130 135 L200 140 L155 180 L105 175 L120 135Z"/>
                                {{-- Nairobi --}}
                                <circle class="map-dot"
                                        cx="280"
                                        cy="175"
                                        r="6"/>
                                <text x="286"
                                      y="174"
                                      class="region-label">
                                    Nairobi
                                </text>
                                {{-- Region labels --}}
                                <text x="132" y="125"
                                      class="region-label">
                                    Nakuru
                                </text>
                                <text x="195" y="75"
                                      class="region-label">
                                    Migori
                                </text>
                                <text x="315" y="105"
                                      class="region-label">
                                    Meru
                                </text>
                                <text x="350" y="160"
                                      class="region-label">
                                    Machakos
                                </text>
                                <text x="355" y="215"
                                      class="region-label">
                                    Isiolo
                                </text>
                                <text x="340" y="210"
                                      class="region-label">
                                    Taita Taveta
                                </text>
                                <text x="345" y="200"
                                      class="region-label">
                                    Other Counties
                                </text>
                            </svg>
                            <div class="row text-center mt-1">
                                <div class="col">
                                    <strong class="d-block"
                                            style="font-size:13px">
                                        32%
                                    </strong>
                                    <span class="kpi-subtext">
                                        Nairobi
                                    </span>
                                </div>
                                <div class="col">
                                    <strong class="d-block"
                                            style="font-size:13px">
                                        8.8%
                                    </strong>
                                    <span class="kpi-subtext">
                                        Nakuru
                                    </span>
                                </div>
                                <div class="col">
                                    <strong class="d-block"
                                            style="font-size:13px">
                                        13.8%
                                    </strong>
                                    <span class="kpi-subtext">
                                        Migori
                                    </span>
                                </div>
                                <div class="col">
                                    <strong class="d-block"
                                            style="font-size:13px">
                                        13%
                                    </strong>
                                    <span class="kpi-subtext">
                                        Meru
                                    </span>
                                </div>
                                <div class="col">
                                    <strong class="d-block"
                                            style="font-size:13px">
                                        12.7%
                                    </strong>
                                    <span class="kpi-subtext">
                                        Machakos
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- GENDER --}}
                <div class="col-xl-2">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <h3 class="dashboard-card-title">
                                Gender
                            </h3>
                            <a href="#" class="dashboard-card-link">
                                View →
                            </a>
                        </div>
                        <div class="dashboard-card-body">
                            <div id="genderChart"
                                 style="height:220px">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            {{-- =====================================================
                 ROW 4
            ====================================================== --}}

            <div class="row g-3">

                {{-- ACTIVITIES AT RISK --}}
                <div class="col-xl-5">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <h3 class="dashboard-card-title">
                                <i class="bi bi-exclamation-triangle-fill text-danger me-1"></i>
                                Activities at Risk
                            </h3>
                            <a href="#" class="dashboard-card-link">
                                View all →
                            </a>
                        </div>
                        <div class="dashboard-card-body">
                            <table class="dashboard-table">
                                <thead>
                                    <tr>
                                        <th>Activity</th>
                                        <th>Programme</th>
                                        <th>Planned Date</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Community Health Training</td>
                                        <td>Health</td>
                                        <td>28 Sep 2026</td>
                                        <td>
                                            <span class="status-badge status-danger">
                                                Overdue
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Youth Workshop</td>
                                        <td>Education</td>
                                        <td>30 Sep 2026</td>
                                        <td>
                                            <span class="status-badge status-warning">
                                                At Risk
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Field Visit</td>
                                        <td>WASH</td>
                                        <td>02 Oct 2026</td>
                                        <td>
                                            <span class="status-badge status-success">
                                                Upcoming
                                            </span>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td>Teacher Training</td>
                                        <td>Education</td>
                                        <td>05 Oct 2026</td>
                                        <td>
                                            <span class="status-badge status-success">
                                                Upcoming
                                            </span>
                                        </td>
                                    </tr> --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


                {{-- UPCOMING AGENDA --}}
                <div class="col-xl-4">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <h3 class="dashboard-card-title">
                                <i class="bi bi-calendar-event text-primary me-1"></i>
                                Upcoming Agenda
                            </h3>
                            <a href="#" class="dashboard-card-link">
                                View all →
                            </a>
                        </div>
                        <div class="dashboard-card-body">
                            <div class="agenda-item">
                                <div class="agenda-date">
                                    <span class="agenda-day">26</span>
                                    <span class="agenda-month">Sep</span>
                                </div>
                                <div>
                                    <div class="agenda-title">
                                        Community Health Training
                                    </div>
                                    <div class="agenda-meta">
                                        Nairobi · 10:00 AM - 1:00 PM
                                    </div>
                                </div>
                            </div>
                            <div class="agenda-item">
                                <div class="agenda-date">
                                    <span class="agenda-day">27</span>
                                    <span class="agenda-month">Sep</span>
                                </div>
                                <div>
                                    <div class="agenda-title">
                                        Youth Empowerment Workshop
                                    </div>
                                    <div class="agenda-meta">
                                        Kisumu · 9:00 AM - 12:00 PM
                                    </div>
                                </div>
                            </div>
                            <div class="agenda-item">
                                <div class="agenda-date">
                                    <span class="agenda-day">30</span>
                                    <span class="agenda-month">Sep</span>
                                </div>
                                <div>
                                    <div class="agenda-title">
                                        Donor Monitoring Visit
                                    </div>
                                    <div class="agenda-meta">
                                        Nakuru · 2:00 PM - 5:00 PM
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- MANAGEMENT ATTENTION --}}
                <div class="col-xl-3">
                    <div class="dashboard-card">
                        <div class="dashboard-card-header">
                            <h3 class="dashboard-card-title">
                                <i class="bi bi-bell-fill text-danger me-1"></i>
                                Management Attention
                            </h3>
                            <a href="#" class="dashboard-card-link">
                                View all →
                            </a>
                        </div>
                        <div class="dashboard-card-body">
                            <div class="attention-item">
                                <div class="attention-icon bg-danger-subtle text-danger">
                                    <i class="bi bi-clock"></i>
                                </div>
                                <div>
                                    <span class="attention-number">5</span>
                                    <span class="attention-label">
                                        Overdue activities
                                    </span>
                                </div>
                            </div>
                            <div class="attention-item">
                                <div class="attention-icon bg-danger-subtle text-danger">
                                    <i class="bi bi-calendar-x"></i>
                                </div>
                                <div>
                                    <span class="attention-number">3</span>
                                    <span class="attention-label">
                                        Grants expiring within 30 days
                                    </span>
                                </div>
                            </div>
                            <div class="attention-item">
                                <div class="attention-icon bg-warning-subtle text-warning">
                                    <i class="bi bi-list-check"></i>
                                </div>
                                <div>
                                    <span class="attention-number">12</span>
                                    <span class="attention-label">
                                        Action items overdue
                                    </span>
                                </div>
                            </div>
                            <div class="attention-item">
                                <div class="attention-icon bg-warning-subtle text-warning">
                                    <i class="bi bi-graph-down"></i>
                                </div>
                                <div>
                                    <span class="attention-number">4</span>
                                    <span class="attention-label">
                                        Programmes below target
                                    </span>
                                </div>
                            </div>
                            <div class="attention-item">
                                <div class="attention-icon bg-success-subtle text-success">
                                    <i class="bi bi-calendar-check"></i>
                                </div>
                                <div>
                                    <span class="attention-number">18</span>
                                    <span class="attention-label">
                                        Activities scheduled this week
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>


{{-- =============================================================
     JAVASCRIPT
============================================================== --}}

{{-- Bootstrap Icons --}}
<link rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

{{-- ApexCharts --}}
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

{{-- jQuery --}}
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>

<script>

$(document).ready(function () {

    /*
    |--------------------------------------------------------------------------
    | DEMO DASHBOARD DATA
    |--------------------------------------------------------------------------
    | Replace this object later with Laravel data.
    |
    | Example:
    |
    | const dashboardData = @json($dashboardData);
    |
    | Or load it through AJAX:
    |
    | $.get('{{ route("dashboard.data") }}', filters, function(data) {
    |     updateDashboard(data);
    | });
    |
    */

    const dashboardData = {

        activities: {
            months: [
                'Jan', 'Feb', 'Mar', 'Apr',
                'May', 'Jun', 'Jul', 'Aug',
                'Sep', 'Oct', 'Nov', 'Dec'
            ],

            planned: [
                40, 22, 35, 38,
                42, 45, 39, 36,
                40, 48, 31, 30
            ],

            completed: [
                20, 16, 31, 30,
                39, 36, 24, 27,
                34, 38, 19, 16
            ],

            cancelled: [
                2, 1, 2, 3,
                4, 5, 3, 4,
                5, 6, 3, 2
            ]
        },

        participants: {
            months: [
                'Jan', 'Feb', 'Mar', 'Apr',
                'May', 'Jun', 'Jul', 'Aug',
                'Sep', 'Oct', 'Nov', 'Dec'
            ],

            values: [
                1450, 1700, 2050, 2300,
                2800, 3100, 2900, 2700,
                3200, 3400, 2100, 1880
            ]
        },

        completion: {
            months: [
                'Jan', 'Feb', 'Mar', 'Apr',
                'May', 'Jun', 'Jul', 'Aug',
                'Sep', 'Oct', 'Nov', 'Dec'
            ],

            values: [
                72, 75, 88, 79,
                93, 86, 74, 81,
                85, 90, 78, 76
            ]
        },

        donors: {
            labels: [
                'Donor A',
                'Donor B',
                'Donor C',
                'Donor D',
                'Others'
            ],

            values: [
                18.2,
                12.6,
                8.4,
                4.6,
                4.8
            ]
        },

        age: {
            labels: [
                '0–17',
                '18–35',
                '36+',                
            ],

            values: [
                94,
                1421,
                839,                
            ]
        },

        gender: {
            labels: [
                'Female',
                'Male',
                'Other'
            ],

            values: [
                1514,
                820,
                0
            ]
        }
    };


    /*
    |--------------------------------------------------------------------------
    | RADIAL CHART HELPER
    |--------------------------------------------------------------------------
    */

    function createRadialChart(selector, value, label, color) {

        const options = {
            chart: {
                type: 'radialBar',
                height: 120,
                sparkline: {
                    enabled: true
                }
            },

            series: [value],

            colors: [color],

            plotOptions: {
                radialBar: {

                    hollow: {
                        size: '62%'
                    },

                    track: {
                        background: '#eef2f7'
                    },

                    dataLabels: {

                        name: {
                            show: true,
                            fontSize: '10px',
                            color: '#64748b',
                            offsetY: 27
                        },

                        value: {
                            show: true,
                            fontSize: '18px',
                            fontWeight: 700,
                            color: '#172033',
                            offsetY: -4,
                            formatter: function (val) {
                                return Math.round(val) + '%';
                            }
                        }

                    }
                }
            },

            labels: [label],

            stroke: {
                lineCap: 'round'
            }
        };

        const chart = new ApexCharts(
            document.querySelector(selector),
            options
        );

        chart.render();

        return chart;
    }


    /*
    |--------------------------------------------------------------------------
    | PROGRAMME PERFORMANCE
    |--------------------------------------------------------------------------
    */

    createRadialChart(
        '#goalChart',
        78,
        'Goal Achievement',
        '#22c55e'
    );

    createRadialChart(
        '#outcomeChart',
        72,
        'Outcome Achievement',
        '#3b82f6'
    );

    createRadialChart(
        '#outputChart',
        86,
        'Output Achievement',
        '#7c3aed'
    );


    /*
    |--------------------------------------------------------------------------
    | ACTIVITY CHART
    |--------------------------------------------------------------------------
    */

    let activityChart;

    function renderActivityChart(type) {

        let options = {

            chart: {
                type: type === 'completion' ? 'line' : 'bar',
                height: 260,
                toolbar: {
                    show: false
                },
                fontFamily: 'inherit'
            },

            series: [],

            xaxis: {
                categories: dashboardData.activities.months,
                labels: {
                    style: {
                        fontSize: '10px',
                        colors: '#94a3b8'
                    }
                }
            },

            yaxis: {
                labels: {
                    style: {
                        fontSize: '10px',
                        colors: '#94a3b8'
                    }
                }
            },

            grid: {
                borderColor: '#edf1f5',
                strokeDashArray: 3
            },

            legend: {
                position: 'bottom',
                fontSize: '10px'
            },

            dataLabels: {
                enabled: false
            },

            stroke: {
                curve: 'smooth',
                width: type === 'completion' ? 3 : 2
            },

            plotOptions: {
                bar: {
                    columnWidth: '45%',
                    borderRadius: 3
                }
            },

            tooltip: {
                theme: 'light'
            }
        };


        if (type === 'activities') {

            options.series = [
                {
                    name: 'Planned',
                    data: dashboardData.activities.planned
                },
                {
                    name: 'Completed',
                    data: dashboardData.activities.completed
                },
                {
                    name: 'Cancelled',
                    data: dashboardData.activities.cancelled
                }
            ];

        } else if (type === 'participants') {

            options.series = [
                {
                    name: 'Participants',
                    data: dashboardData.participants.values
                }
            ];

        } else if (type === 'completion') {

            options.series = [
                {
                    name: 'Completion Rate',
                    data: dashboardData.completion.values
                }
            ];

            options.yaxis = {
                min: 0,
                max: 100,
                labels: {
                    formatter: function (value) {
                        return value + '%';
                    }
                }
            };

        }


        if (activityChart) {
            activityChart.destroy();
        }

        activityChart = new ApexCharts(
            document.querySelector('#activityChart'),
            options
        );

        activityChart.render();
    }


    renderActivityChart('activities');


    /*
    |--------------------------------------------------------------------------
    | DONOR DONUT
    |--------------------------------------------------------------------------
    */

    const donorOptions = {

        chart: {
            type: 'donut',
            height: 230
        },

        series: dashboardData.donors.values,

        labels: dashboardData.donors.labels,

        legend: {
            position: 'bottom',
            fontSize: '10px'
        },

        dataLabels: {
            enabled: false
        },

        stroke: {
            width: 2,
            colors: ['#fff']
        },

        plotOptions: {
            pie: {
                donut: {
                    size: '68%',

                    labels: {

                        show: true,

                        total: {
                            show: true,
                            label: 'Total Funding',
                            formatter: function () {
                                return 'KES 48.6M';
                            }
                        }
                    }
                }
            }
        },

        tooltip: {
            y: {
                formatter: function (value) {
                    return 'KES ' + value + 'M';
                }
            }
        }

    };

    const donorChart = new ApexCharts(
        document.querySelector('#donorChart'),
        donorOptions
    );

    donorChart.render();


    /*
    |--------------------------------------------------------------------------
    | AGE DISTRIBUTION
    |--------------------------------------------------------------------------
    */

    const ageOptions = {

        chart: {
            type: 'bar',
            height: 260,
            toolbar: {
                show: false
            }
        },

        series: [
            {
                name: 'Participants',
                data: dashboardData.age.values
            }
        ],

        xaxis: {
            categories: dashboardData.age.labels
        },

        yaxis: {
            max: 35,
            labels: {
                formatter: function (value) {
                    return value + '%';
                }
            }
        },

        plotOptions: {
            bar: {
                borderRadius: 4,
                columnWidth: '48%'
            }
        },

        dataLabels: {
            enabled: true,
            formatter: function (value) {
                return value + '%';
            },
            style: {
                fontSize: '10px'
            }
        },

        grid: {
            borderColor: '#edf1f5',
            strokeDashArray: 3
        },

        legend: {
            show: false
        },

        tooltip: {
            y: {
                formatter: function (value) {
                    return value + '%';
                }
            }
        }

    };

    const ageChart = new ApexCharts(
        document.querySelector('#ageChart'),
        ageOptions
    );

    ageChart.render();


    /*
    |--------------------------------------------------------------------------
    | GENDER DONUT
    |--------------------------------------------------------------------------
    */

    const genderOptions = {
        chart: {
            type: 'donut',
            height: 220
        },
        series: dashboardData.gender.values,
        labels: dashboardData.gender.labels,
        legend: {
            position: 'bottom',
            fontSize: '9px'
        },
        dataLabels: {
            enabled: false
        },
        plotOptions: {
            pie: {
                donut: {
                    size: '66%',
                    labels: {
                        show: true,
                        total: {
                            show: true,
                            label: 'Participants',
                            formatter: function () {
                                return '2,354';
                            }
                        }
                    }
                }
            }
        }
    };

    const genderChart = new ApexCharts(
        document.querySelector('#genderChart'),
        genderOptions
    );

    genderChart.render();


    /*
    |--------------------------------------------------------------------------
    | ACTIVITY CHART SWITCHER
    |--------------------------------------------------------------------------
    */

    $('.chart-toggle').on('click', function () {

        $('.chart-toggle')
            .removeClass('btn-primary')
            .addClass('btn-outline-secondary');

        $(this)
            .removeClass('btn-outline-secondary')
            .addClass('btn-primary');

        renderActivityChart(
            $(this).data('chart')
        );

    });


    /*
    |--------------------------------------------------------------------------
    | GLOBAL FILTERS
    |--------------------------------------------------------------------------
    |
    | CURRENTLY DEMO ONLY.
    |
    | Later:
    |
    | $('.dashboard-filter').on('change', function () {
    |
    |     $.ajax({
    |         url: "{{ route('dashboard.data') }}",
    |         data: {
    |             year: $('#filterYear').val(),
    |             period: $('#filterPeriod').val(),
    |             programme: $('#filterProgramme').val(),
    |             donor: $('#filterDonor').val(),
    |             region: $('#filterRegion').val()
    |         },
    |         success: function (response) {
    |             updateDashboard(response);
    |         }
    |     });
    |
    | });
    |
    */

    $('.dashboard-filter').on('change', function () {

        const filters = {

            year: $('#filterYear').val(),

            period: $('#filterPeriod').val(),

            programme: $('#filterProgramme').val(),

            donor: $('#filterDonor').val(),

            region: $('#filterRegion').val()

        };

        console.log(
            'Dashboard filters:',
            filters
        );

        /*
         * TODO:
         * Replace this console.log with AJAX.
         *
         * Example:
         *
         * $.get("{{ route('dashboard.data') }}", filters,
         * function (response) {
         *     updateDashboard(response);
         * });
         */

    });


    /*
    |--------------------------------------------------------------------------
    | MOBILE SIDEBAR
    |--------------------------------------------------------------------------
    */

    $('#sidebarToggle').on('click', function () {

        $('#dashboardSidebar')
            .toggleClass('show');

    });


    /*
    |--------------------------------------------------------------------------
    | SVG REGION INTERACTION
    |--------------------------------------------------------------------------
    */

    $('.kenya-region').on('click', function () {

        const region = $(this)
            .attr('data-region');

        /*
         * TODO:
         *
         * Apply region filter here.
         *
         * $('#filterRegion').val(region).trigger('change');
         */

        $(this).css(
            'fill',
            '#2563eb'
        );

    });

});

</script>

@endsection