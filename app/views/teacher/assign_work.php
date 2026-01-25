<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigner un travail - Minerva</title>
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
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="header-content">
                <div class="logo">
                    <h1>Minerva</h1>
                </div>
                <nav class="nav">
                    <ul>
                        <li><a href="/teacher" class="nav-link">Tableau de bord</a></li>
                        <li><a href="/teacher/classes" class="nav-link">Mes Classes</a></li>
                        <li><a href="/teacher/works" class="nav-link">Travaux</a></li>
                        <li><a href="/teacher/evaluation" class="nav-link">Évaluation</a></li>
                        <li><a href="/teacher/attendance" class="nav-link">Présences</a></li>
                        <li><a href="/teacher/statistics" class="nav-link">Statistiques</a></li>
                        <li><a href="/teacher/chat" class="nav-link">Chat</a></li>
                    </ul>
                </nav>
                <div class="user-menu">
                    <span><?= htmlspecialchars($_SESSION['name'] ?? 'Professeur') ?></span>
                    <a href="/logout" class="btn btn-secondary">Déconnexion</a>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Assigner un travail</h1>
                <div class="user-info">Bienvenue, <?= htmlspecialchars($_SESSION['name'] ?? 'Professeur') ?></div>
            </div>

            <div class="content-section">
                <?php if (isset($error) && !empty($error)): ?>
                    <div class="alert alert-danger">
                        <?php foreach ($error as $err): ?>
                            <?= htmlspecialchars($err) ?><br>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                
                <?php if (isset($success)): ?>
                    <div class="alert alert-success">
                        <?= htmlspecialchars($success) ?>
                    </div>
                <?php endif; ?>
                
                <form action="/teacher/assignwork" method="POST">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Travail</label>
                            <select class="form-control" name="work_id" required>
                                <option value="">Sélectionnez un travail</option>
                                <?php if (isset($works) && !empty($works)): ?>
                                    <?php foreach ($works as $work): ?>
                                        <option value="<?= $work['id'] ?? '' ?>">
                                            <?= htmlspecialchars($work['title'] ?? '') ?> - <?= htmlspecialchars($work['class_name'] ?? '') ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Étudiants</label>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="selectAll" onchange="toggleAllStudents()">
                                            Assigner
                                        </th>
                                        <th>Étudiant</th>
                                        <th>Email</th>
                                        <th>Classe</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($students) && !empty($students)): ?>
                                        <?php foreach ($students as $student): ?>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="students[]" value="<?= $student['id'] ?? '' ?>">
                                                </td>
                                                <td><?= htmlspecialchars($student['name'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($student['email'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($student['class_name'] ?? '') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4" style="text-align: center; padding: 40px;">
                                                <div class="alert alert-info" style="margin-bottom: 0;">
                                                    Aucun étudiant disponible.
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn">Assigner le travail</button>
                        <a href="/teacher/works" class="btn btn-secondary" style="text-decoration: none;">Annuler</a>
                    </div>
                </form>
            </div>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2026 Minerva. Tous droits réservés.</p>
        </footer>
    </div>

    <script>
        function toggleAllStudents() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('input[name="students[]"]');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        }
    </script>
</body>
</html>
