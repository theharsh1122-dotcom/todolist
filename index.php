<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Todo List - Manage Your Tasks</title>

    <link rel="stylesheet" href="assets/css/index.css">
</head>

<body>

    <nav class="navbar">

        <div class="logo">
            ✓ TodoList
        </div>

        <div class="nav-links">
            <a href="auth/login.php">Login</a>
            <a href="auth/register.php" class="nav-register">Register</a>
        </div>

    </nav>


    <section class="hero">

        <div class="hero-content">

            <div class="badge">
                ✨ Simple • Fast • Organized
            </div>

            <h1>
                Organize Your
                <span>Day.</span>
            </h1>

            <p>
                Stay organized, manage your daily tasks and
                get things done with a simple and powerful
                Todo List application.
            </p>

            <div class="hero-buttons">

                <a href="auth/login.php" class="primary-btn">
                    Get Started →
                </a>

                <a href="auth/register.php" class="secondary-btn">
                    Create Account
                </a>

            </div>

        </div>


        <div class="todo-preview">

            <div class="preview-header">
                <div>
                    <h2>My Tasks</h2>
                    <p>Today's tasks</p>
                </div>

                <div class="check-icon">
                    ✓
                </div>
            </div>

            <div class="task completed">
                <span class="task-check">✓</span>
                <span>Complete project work</span>
            </div>

            <div class="task">
                <span class="task-circle"></span>
                <span>Study PHP & MySQL</span>
            </div>

            <div class="task">
                <span class="task-circle"></span>
                <span>Complete daily workout</span>
            </div>

            <div class="task">
                <span class="task-circle"></span>
                <span>Plan tomorrow's tasks</span>
            </div>

        </div>

    </section>


    <section class="features">

        <div class="feature-card">
            <div class="feature-icon">📝</div>
            <h3>Create Tasks</h3>
            <p>
                Easily add and organize your daily tasks.
            </p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">✓</div>
            <h3>Track Progress</h3>
            <p>
                Mark tasks as completed and track your progress.
            </p>
        </div>

        <div class="feature-card">
            <div class="feature-icon">⚡</div>
            <h3>Stay Productive</h3>
            <p>
                Keep everything organized and get more done.
            </p>
        </div>

    </section>

</body>

</html>