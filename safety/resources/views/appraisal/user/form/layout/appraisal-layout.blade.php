<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Medical Appraisal Guide (MAG) Model Appraisal Form')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @stack('styles')
    @include('appraisal.user.form.layout.appraisal-css')
</head>

<body>
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="header-left">
                <h1>Medical Appraisal Guide (MAG)</h1>
                <h2>Model Appraisal Form</h2>
                <p class="version">Version 4.2 (updated 2016)</p>
            </div>
            <div class="header-right">
                <div class="nhs-logo">NHS</div>
                <div class="england-text">England</div>
                <h3 class="welcome">Welcome!</h3>
            </div>
        </header>

        <!-- Main Content Wrapper -->
        <div class="main-content">
            <!-- Navigation Menu -->
            <nav class="nav-menu">
                <div class="nav-item {{ request()->routeIs('appraisal.user.contents') ? 'active' : '' }}">
                    <span class="nav-number">1</span>
                    <a href="{{ route('appraisal.user.index') }}" class="nav-link">Contents</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.instructions') ? 'active' : '' }}">
                    <span class="nav-number">2</span>
                    <a href="{{ route('appraisal.user.instructions') }}" class="nav-link">Instructions for using this
                        form</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.personal-details') ? 'active' : '' }}">
                    <span class="nav-number">3</span>
                    <a href="{{ route('appraisal.user.personal-details') }}" class="nav-link">Personal details</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.scope-of-work') ? 'active' : '' }}">
                    <span class="nav-number">4</span>
                    <a href="{{ route('appraisal.user.scope-of-work') }}" class="nav-link">Scope of work</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.annual-appraisals') ? 'active' : '' }}">
                    <span class="nav-number">5</span>
                    <a href="{{ route('appraisal.user.annual-appraisals') }}" class="nav-link">Record of annual
                        appraisals</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.development-plans') ? 'active' : '' }}">
                    <span class="nav-number">6</span>
                    <a href="{{ route('appraisal.user.development-plans') }}" class="nav-link">Personal development
                        plans and their review</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.cpd') ? 'active' : '' }}">
                    <span class="nav-number">7</span>
                    <a href="{{ route('appraisal.user.cpd') }}" class="nav-link">Continuing professional development
                        (CPD)</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.quality-improvement') ? 'active' : '' }}">
                    <span class="nav-number">8</span>
                    <a href="{{ route('appraisal.user.quality-improvement') }}" class="nav-link">Quality improvement
                        activity</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.significant-events') ? 'active' : '' }}">
                    <span class="nav-number">9</span>
                    <a href="{{ route('appraisal.user.significant-events') }}" class="nav-link">Significant events</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.feedback') ? 'active' : '' }}">
                    <span class="nav-number">10</span>
                    <a href="{{ route('appraisal.user.feedback') }}" class="nav-link">Feedback from colleagues and
                        patients</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.complaints') ? 'active' : '' }}">
                    <span class="nav-number">11</span>
                    <a href="{{ route('appraisal.user.complaints') }}" class="nav-link">Review of complaints and
                        compliments</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.achievements') ? 'active' : '' }}">
                    <span class="nav-number">12</span>
                    <a href="{{ route('appraisal.user.achievements') }}" class="nav-link">Achievements, challenges and
                        aspirations</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.probity') ? 'active' : '' }}">
                    <span class="nav-number">13</span>
                    <a href="{{ route('appraisal.user.probity') }}" class="nav-link">Probity and health statements</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.additional-info') ? 'active' : '' }}">
                    <span class="nav-number">14</span>
                    <a href="{{ route('appraisal.user.additional-info') }}" class="nav-link">Additional information</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.supporting-info') ? 'active' : '' }}">
                    <span class="nav-number">15</span>
                    <a href="{{ route('appraisal.user.supporting-info') }}" class="nav-link">Supporting information</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.gmc-domains') ? 'active' : '' }}">
                    <span class="nav-number">16</span>
                    <a href="{{ route('appraisal.user.gmc-domains') }}" class="nav-link">Review of GMC Good Medical
                        Practice domains</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.checklist') ? 'active' : '' }}">
                    <span class="nav-number">17</span>
                    <a href="{{ route('appraisal.user.checklist') }}" class="nav-link">Appraisal checklist</a>
                </div>
                <div
                    class="nav-item highlighted {{ request()->routeIs('appraisal.user.development-plan') ? 'active' : '' }}">
                    <span class="nav-number">18</span>
                    <a href="{{ route('appraisal.user.development-plan') }}" class="nav-link">The agreed personal
                        development plan</a>
                </div>
                <div class="nav-item highlighted {{ request()->routeIs('appraisal.user.summary') ? 'active' : '' }}">
                    <span class="nav-number">19</span>
                    <a href="{{ route('appraisal.user.summary') }}" class="nav-link">Summary of the appraisal
                        discussion</a>
                </div>
                <div class="nav-item highlighted {{ request()->routeIs('appraisal.user.outputs') ? 'active' : '' }}">
                    <span class="nav-number">20</span>
                    <a href="{{ route('appraisal.user.outputs') }}" class="nav-link">Appraisal outputs</a>
                </div>
                <div class="nav-item {{ request()->routeIs('appraisal.user.completion') ? 'active' : '' }}">
                    <span class="nav-number">21</span>
                    <a href="{{ route('appraisal.user.completion') }}" class="nav-link">Completion - save, lockdown
                        and print</a>
                </div>
            </nav>

            <!-- Content Area -->
            <main class="content-area">
                @yield('content')
            </main>
        </div>
    </div>

    @stack('scripts')

    <script>
        // Toggle help text visibility
        function toggleHelp(helpId) {
            const helpElement = document.getElementById(helpId);
            if (
                helpElement.style.display === "none" ||
                helpElement.style.display === ""
            ) {
                helpElement.style.display = "block";
            } else {
                helpElement.style.display = "none";
            }
        }

    </script>
</body>

</html>
