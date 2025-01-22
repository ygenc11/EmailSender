<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            background-color: #ffffff;
            border-right: 1px solid #e9ecef;
            height: 100vh;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .sidebar .nav-link {
            display: flex;
            align-items: center;
            color: #495057;
            padding: 12px 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
        }
        .sidebar .nav-link svg {
            margin-right: 10px;
            width: 20px;
            height: 20px;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            background-color: #007bff;
            color: white;
        }
        .content {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-lg-2 col-md-3 sidebar">
                <ul class="nav flex-column">
                    <!-- Emails -->
                    <li class="nav-item">
                        <a class="nav-link {{ \Request::route()->getName() === 'mailableList' || \Request::route()->getName() === 'viewMailable' ? 'active' : '' }}" href="{{ route('mailableList') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" enable-background="new 0 0 14 14" viewBox="0 0 14 14">
                                <path d="M7,9L5.268,7.484l-4.952,4.245C0.496,11.896,0.739,12,1.007,12h11.986 c0.267,0,0.509-0.104,0.688-0.271L8.732,7.484L7,9z"/>
                                <path d="M13.684,2.271C13.504,2.103,13.262,2,12.993,2H1.007C0.74,2,0.498,2.104,0.318,2.273L7,8 L13.684,2.271z"/>
                            </svg>
                            Emails
                        </a>
                    </li>
                    <!-- Templates -->
                    <li class="nav-item">
                        <a class="nav-link {{ \Request::route()->getName() === 'templateList' || \Request::route()->getName() === 'newTemplate' ? 'active' : '' }}" href="{{ route('templateList') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 307 306">
                                <path d="M0 13C0 5.82029 5.82361 0 13.0033 0C54.3837 0 81.2128 0 125.859 0H128C135.18 0 141 5.8203 141 13V153C141 160.18 135.18 166 128 166H13C5.8203 166 0 160.18 0 153V13Z"/>
                            </svg>
                            Templates
                        </a>
                    </li>
                    <!-- Mailing Lists -->
                    <li class="nav-item">
                        <a class="nav-link {{ \Request::route()->getName() === 'mailingList' ? 'active' : '' }}" href="{{ route('mailingList') }}">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor">
                                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2H0zM0 5h16v7a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V5zm8 4a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
                            </svg>
                            Mailing Lists
                        </a>
                    </li>
                </ul>
            </div>
            <!-- Main Content -->
            <div class="col-lg-10 col-md-9 content">
                <h1>Welcome to Your Laravel App</h1>
                <p>This is your starting point. Use the sidebar to navigate through the features of your app.</p>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
