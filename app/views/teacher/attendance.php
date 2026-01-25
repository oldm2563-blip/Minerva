<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Présences - Enseignant</title>
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
                    <li class="nav-item"><a href="/teacher/attendance" class="nav-link active">Présences</a></li>
                    <li class="nav-item"><a href="/teacher/statistics" class="nav-link">Statistiques</a></li>
                    <li class="nav-item"><a href="/teacher/chat" class="nav-link">Chat</a></li>
                    <li class="nav-item"><a href="/logout" class="nav-link">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Gestion des présences</h1>
                <div class="user-info">Bienvenue, <?= htmlspecialchars($_SESSION['name'] ?? 'Professeur') ?></div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Faire l'appel</h2>
                
                <form action="/teacher/attendance" method="GET">
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Classe</label>
                            <select class="form-control" name="class_id" required onchange="this.form.submit()">
                                <option value="">Sélectionnez une classe</option>
                                <?php if (isset($classes) && !empty($classes)): ?>
                                    <?php foreach ($classes as $class): ?>
                                        <option value="<?= $class['id'] ?? '' ?>" <?= (isset($_GET['class_id']) && $_GET['class_id'] == $class['id']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($class['name'] ?? '') ?>
                                        </option>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" value="<?= date('Y-m-d') ?>" required>
                        </div>
                    </div>
                </form>
                
                <?php if (isset($students) && !empty($students)): ?>
                <form action="/teacher/attendance" method="POST">
                    <input type="hidden" name="class_id" value="<?= $_GET['class_id'] ?? '' ?>">
                    <input type="hidden" name="date" value="<?= $_GET['date'] ?? date('Y-m-d') ?>">
                    
                    <div class="form-group">
                        <label class="form-label">Liste des étudiants</label>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>
                                            <input type="checkbox" id="selectAll" onchange="toggleAllStudents()">
                                            Présent
                                        </th>
                                        <th>Étudiant</th>
                                        <th>Statut</th>
                                    </tr>
                                </thead>
                                <tbody>
                            <?php if (isset($students) && !empty($students)): ?>
                                <?php foreach ($students as $student): ?>
                                    <tr>
                                        <td>
                                            <input type="checkbox" name="attendance[<?= $student['id'] ?? '' ?>]" value="present" 
                                                   <?= ($student['status'] ?? 'absent') === 'present' ? 'checked' : '' ?>
                                                   onchange="updateAttendanceStatus(this)">
                                        </td>
                                        <td><?= htmlspecialchars($student['name'] ?? '') ?></td>
                                        <td>
                                            <span class="badge badge-<?= ($student['status'] ?? 'absent') === 'present' ? 'success' : 'danger' ?>">
                                                <?= ($student['status'] ?? 'absent') === 'present' ? 'Présent' : 'Absent' ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="3" style="text-align: center; padding: 40px;">
                                        <div class="alert alert-info" style="margin-bottom: 0;">
                                            Veuillez sélectionner une classe pour voir la liste des étudiants.
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn">Enregistrer la présence</button>
                        <a href="/teacher" class="btn btn-secondary" style="text-decoration: none;">Annuler</a>
                    </div>
                </form>
                <?php else: ?>
                    <div class="alert alert-info">
                        Veuillez sélectionner une classe pour faire l'appel.
                    </div>
                <?php endif; ?>
            </div>

            <div class="content-section">
                <h2 class="section-title">Historique des présences</h2>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Classe</th>
                                <th>Présents</th>
                                <th>Absents</th>
                                <th>Taux de présence</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($history) && !empty($history)): ?>
                                <?php foreach ($history as $record): ?>
                                    <tr>
                                        <td><?= date('d/m/Y', strtotime($record['date'] ?? '')) ?></td>
                                        <td><?= htmlspecialchars($record['class_name'] ?? '') ?></td>
                                        <td><?= htmlspecialchars($record['presents'] ?? 0) ?></td>
                                        <td><?= htmlspecialchars($record['absents'] ?? 0) ?></td>
                                        <td>
                                            <span class="badge badge-<?= ($record['attendance_rate'] ?? 0) >= 90 ? 'success' : (($record['attendance_rate'] ?? 0) >= 80 ? 'warning' : 'danger') ?>">
                                                <?= htmlspecialchars($record['attendance_rate'] ?? 0) ?>%
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px;">
                                        <div class="alert alert-info" style="margin-bottom: 0;">
                                            Aucun historique de présence. Les appels enregistrés apparaîtront ici.
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Statistiques de présence</h2>
                
                <div class="grid grid-3">
                    <div class="card text-center">
                        <h3>Taux moyen de présence</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--success-color);">88%</p>
                    </div>
                    <div class="card text-center">
                        <h3>Total d'appels ce mois</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--primary-color);">42</p>
                    </div>
                    <div class="card text-center">
                        <h3>Étudiants les plus assidus</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--primary-color);">3</p>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        function toggleAllStudents() {
            const selectAll = document.getElementById('selectAll');
            const checkboxes = document.querySelectorAll('input[name^="attendance"]');
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = selectAll.checked;
                updateStatusBadge(checkbox);
            });
        }

        function updateStatusBadge(checkbox) {
            const row = checkbox.closest('tr');
            const badge = row.querySelector('.badge');
            
            if (checkbox.checked) {
                badge.className = 'badge badge-success';
                badge.textContent = 'Présent';
            } else {
                badge.className = 'badge badge-danger';
                badge.textContent = 'Absent';
            }
        }

        // Add event listeners to all checkboxes
        document.querySelectorAll('input[name^="attendance"]').forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateStatusBadge(this);
            });
        });
    </script>
</body>
</html>
