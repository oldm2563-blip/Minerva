<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Classes - Étudiant</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<style>
    /* style.css */
:root {
    --primary: #4a6fa5;
    --bg: #f4f6f8;
    --white: #ffffff;
    --dark: #2c2c2c;
    --border: #e0e0e0;
    --success: #28a745;
    --danger: #dc3545;
    --warning: #ffc107;
    --info: #17a2b8;
}

/* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: system-ui, sans-serif;
    background: var(--bg);
    color: var(--dark);
    min-height: 100vh;
}

/* Layout */
.sidebar {
    width: 240px;
    background: var(--white);
    border-right: 1px solid var(--border);
    position: fixed;
    height: 100vh;
}

.sidebar-header {
    padding: 20px;
    background: var(--primary);
    color: white;
    text-align: center;
}

.sidebar-nav {
    padding: 10px;
}

.nav-item {
    list-style: none;
}

.nav-link {
    display: block;
    padding: 12px;
    color: var(--dark);
    text-decoration: none;
    border-radius: 6px;
}

.nav-link:hover,
.nav-link.active {
    background: #eef2f7;
    color: var(--primary);
}

/* Main */
.main-content {
    margin-left: 240px;
    padding: 20px;
}

/* Header */
.header {
    background: var(--white);
    padding: 15px 20px;
    border-radius: 8px;
    border: 1px solid var(--border);
    margin-bottom: 20px;
}

.header h1 {
    font-size: 1.5rem;
}

/* Sections */
.content-section {
    background: var(--white);
    padding: 20px;
    border-radius: 8px;
    border: 1px solid var(--border);
    margin-bottom: 20px;
}

.section-title {
    margin-bottom: 15px;
    font-size: 1.2rem;
    border-bottom: 1px solid var(--border);
    padding-bottom: 8px;
}

/* Buttons */
.btn {
    padding: 10px 16px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    background: var(--primary);
    color: white;
}

.btn-success { background: var(--success); }
.btn-danger  { background: var(--danger); }
.btn-warning { background: var(--warning); color: #000; }

/* Forms */
.form-group {
    margin-bottom: 15px;
}

.form-label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid var(--border);
    border-radius: 6px;
}

/* Tables */
.table {
    width: 100%;
    border-collapse: collapse;
    background: var(--white);
}

.table th,
.table td {
    padding: 12px;
    border-bottom: 1px solid var(--border);
}

.table th {
    background: #f0f2f5;
    text-align: left;
}

/* Alerts */
.alert {
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 15px;
}

.alert-success { background: #e6f4ea; color: var(--success); }
.alert-danger  { background: #fbeaea; color: var(--danger); }
.alert-warning { background: #fff4e5; color: #856404; }
.alert-info    { background: #e8f4f8; color: var(--info); }

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        position: relative;
        width: 100%;
        height: auto;
    }

    .main-content {
        margin-left: 0;
    }
}

</style>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1>Espace Étudiant</h1>
                <p><?= htmlspecialchars($_SESSION['name'] ?? 'Étudiant') ?></p>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li class="nav-item"><a href="/student" class="nav-link">Tableau de bord</a></li>
                    <li class="nav-item"><a href="/student/classes" class="nav-link active">Mes Classes</a></li>
                    <li class="nav-item"><a href="/student/works" class="nav-link">Mes Travaux</a></li>
                    <li class="nav-item"><a href="/student/grades" class="nav-link">Mes Notes</a></li>
                    <li class="nav-item"><a href="/student/chat" class="nav-link">Chat</a></li>
                    <li class="nav-item"><a href="/logout" class="nav-link">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Mes Classes</h1>
                <div class="user-info">Bienvenue, <?= htmlspecialchars($_SESSION['name'] ?? 'Étudiant') ?></div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Mes classes</h2>
                
                <div class="grid grid-2">
                    <?php if (isset($classes) && !empty($classes)): ?>
                        <?php foreach ($classes as $class): ?>
                            <div class="card">
                                <h3><?= htmlspecialchars($class['name'] ?? '') ?></h3>
                                <p><strong>Enseignant:</strong> <?= htmlspecialchars($class['teacher_name'] ?? '') ?></p>
                                <p><strong>Email enseignant:</strong> <?= htmlspecialchars($class['teacher_email'] ?? '') ?></p>
                                <p><strong>Effectif:</strong> <?= htmlspecialchars($class['student_count'] ?? 0) ?> étudiants</p>
                                <div style="margin-top: 15px;">
                                    <a href="/student/chat" class="btn btn-sm">Accéder au chat</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="card" style="grid-column: 1 / -1;">
                            <div style="text-align: center; padding: 40px;">
                                <div class="alert alert-info" style="margin-bottom: 0;">
                                    Vous n'êtes inscrit à aucune classe pour le moment.
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </main>
    </div>
</body>
</html>
