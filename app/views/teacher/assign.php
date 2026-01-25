<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assigner des étudiants - Enseignant</title>
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
                <h1>Espace Enseignant</h1>
                <p><?= htmlspecialchars($_SESSION['name'] ?? 'Professeur') ?></p>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li class="nav-item"><a href="/teacher" class="nav-link">Tableau de bord</a></li>
                    <li class="nav-item"><a href="/teacher/classes" class="nav-link">Mes Classes</a></li>
                    <li class="nav-item"><a href="/teacher/works" class="nav-link">Travaux</a></li>
                    <li class="nav-item"><a href="/teacher/evaluation" class="nav-link">Évaluation</a></li>
                    <li class="nav-item"><a href="/teacher/attendance" class="nav-link">Présences</a></li>
                    <li class="nav-item"><a href="/teacher/statistics" class="nav-link">Statistiques</a></li>
                    <li class="nav-item"><a href="/teacher/chat" class="nav-link">Chat</a></li>
                    <li class="nav-item"><a href="/logout" class="nav-link">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Assigner des étudiants</h1>
                <div class="user-info">Bienvenue, <?= htmlspecialchars($_SESSION['name'] ?? 'Professeur') ?></div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Assigner des étudiants à une classe</h2>
                
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
                
                <form action="/teacher/assign" method="POST">
                    <div class="form-group">
                        <label class="form-label">Sélectionnez une classe</label>
                        <select class="form-control" name="class_id" required>
                            <option value="">Sélectionnez une classe</option>
                            <?php if (isset($classes) && !empty($classes)): ?>
                                <?php foreach ($classes as $class): ?>
                                    <option value="<?= $class['id'] ?? '' ?>">
                                        <?= htmlspecialchars($class['name'] ?? '') ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Sélectionnez les étudiants à assigner</label>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="selectAllStudents" onchange="toggleAllStudents()">
                                            Sélectionner
                                        </th>
                                        <th>Nom</th>
                                        <th>Email</th>
                                        <th>Classe actuelle</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (isset($students) && !empty($students)): ?>
                                        <?php foreach ($students as $student): ?>
                                            <tr>
                                                <td><input type="checkbox" name="students[]" value="<?= $student['id'] ?? '' ?>"></td>
                                                <td><?= htmlspecialchars($student['name'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($student['email'] ?? '') ?></td>
                                                <td><?= htmlspecialchars($student['current_class'] ?? 'Non assigné') ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="4">Aucun étudiant disponible</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn">Assigner les étudiants</button>
                        <a href="/teacher/classes" class="btn btn-secondary" style="text-decoration: none;">Annuler</a>
                    </div>
                </form>
            </div>

            <div class="content-section">
                <h2 class="section-title">Assignations récentes</h2>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Étudiant</th>
                                <th>Classe</th>
                                <th>Date d'assignation</th>
                                <th>Assigné par</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Sophie Dubois</td>
                                <td>3ème A</td>
                                <td>20/01/2026</td>
                                <td><?= htmlspecialchars($_SESSION['name'] ?? 'Professeur') ?></td>
                            </tr>
                            <tr>
                                <td>Lucas Bernard</td>
                                <td>3ème B</td>
                                <td>19/01/2026</td>
                                <td><?= htmlspecialchars($_SESSION['name'] ?? 'Professeur') ?></td>
                            </tr>
                            <tr>
                                <td>Marie Martin</td>
                                <td>3ème A</td>
                                <td>18/01/2026</td>
                                <td><?= htmlspecialchars($_SESSION['name'] ?? 'Professeur') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleAllStudents() {
            const selectAll = document.getElementById('selectAllStudents');
            const checkboxes = document.querySelectorAll('input[name="students[]"]');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
            });
        }
    </script>
</body>
</html>
