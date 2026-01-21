    <div class="d-flex flex-grow-1">

        <!-- Sidebar -->
        <div class="d-none d-lg-block bg-light shadow-sm" style="width: 220px;">
            <ul class="nav flex-column pt-3">
                <li class="nav-item"><a class="nav-link active" href="#">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="#">My Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Certificates</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Messages</a></li>
                <li class="nav-item"><a class="nav-link" href="#">Settings</a></li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1 p-4">
            <div class="row g-4">

                <!-- Profile Card -->
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h4 class="card-title">Welcome, {{ auth()->user()->name }} 👋</h4>
                            <p class="card-text text-muted">Your profile overview and quick actions.</p>
                            <a href="#" class="btn btn-primary btn-sm">Edit Profile</a>
                        </div>
                    </div>
                </div>

                <!-- Enrolled Courses Card -->
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">Enrolled Courses</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Laravel Basics
                                    <span class="badge bg-primary rounded-pill">80%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    React JS Intro
                                    <span class="badge bg-success rounded-pill">45%</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    Python Data Science
                                    <span class="badge bg-warning text-dark rounded-pill">20%</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Recommended Courses Card -->
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">Recommended Courses</h5>
                            <p class="text-muted">Based on your interests and activity.</p>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Advanced Laravel</li>
                                <li class="list-group-item">Vue JS Deep Dive</li>
                                <li class="list-group-item">Data Structures in Python</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Notifications Card -->
                <div class="col-12 col-lg-6">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <h5 class="card-title">Notifications</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item">Your course "React JS Intro" is updated.</li>
                                <li class="list-group-item">New certificate available for Laravel Basics.</li>
                                <li class="list-group-item">Message from instructor: "Please check your project."</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
