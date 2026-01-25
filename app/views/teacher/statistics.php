<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques - Enseignant</title>
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
                    <li class="nav-item"><a href="/teacher/statistics" class="nav-link active">Statistiques</a></li>
                    <li class="nav-item"><a href="/teacher/chat" class="nav-link">Chat</a></li>
                    <li class="nav-item"><a href="/logout" class="nav-link">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Statistiques</h1>
                <div class="user-info">Bienvenue, <?= htmlspecialchars($_SESSION['name'] ?? 'Professeur') ?></div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Vue d'ensemble</h2>
                
                <div class="grid grid-4">
                    <div class="card text-center">
                        <h3>Total Étudiants</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--primary-color);"><?= htmlspecialchars($overall_stats['total_students'] ?? 0) ?></p>
                    </div>
                    <div class="card text-center">
                        <h3>Taux de présence</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--primary-color);"><?= htmlspecialchars($overall_stats['avg_attendance'] ?? 0) ?>%</p>
                    </div>
                    <div class="card text-center">
                        <h3>Travaux rendus</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--success-color);"><?= htmlspecialchars($overall_stats['completion_rate'] ?? 0) ?>%</p>
                    </div>
                    <div class="card text-center">
                        <h3>Classes</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--info-color);"><?= count($class_stats ?? []) ?></p>
                    </div>
                </div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Statistiques par classe</h2>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Classe</th>
                                <th>Nombre d'étudiants</th>
                                <th>Moyenne</th>
                                <th>Taux de présence</th>
                                <th>Taux de rendu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($class_stats) && !empty($class_stats)): ?>
                                <?php foreach ($class_stats as $class): ?>
                                    <tr>
                                        <td><strong><?= htmlspecialchars($class['name'] ?? '') ?></strong></td>
                                        <td><?= htmlspecialchars($class['student_count'] ?? 0) ?></td>
                                        <td>
                                            <?php 
                                            $avg_grade = $class['avg_grade'] ?? 0;
                                            $badge_color = ($avg_grade >= 15) ? 'success' : (($avg_grade >= 12) ? 'warning' : 'danger');
                                            ?>
                                            <span class="badge badge-<?= $badge_color ?>"><?= $avg_grade > 0 ? htmlspecialchars($avg_grade) . '/20' : 'N/A' ?></span>
                                        </td>
                                        <td>
                                            <?php 
                                            $attendance_rate = $class['attendance_rate'] ?? 0;
                                            $badge_color = ($attendance_rate >= 90) ? 'success' : (($attendance_rate >= 80) ? 'warning' : 'danger');
                                            ?>
                                            <span class="badge badge-<?= $badge_color ?>"><?= $attendance_rate > 0 ? htmlspecialchars($attendance_rate) . '%' : 'N/A' ?></span>
                                        </td>
                                        <td>
                                            <?php 
                                            $submission_rate = $class['submission_rate'] ?? 0;
                                            $badge_color = ($submission_rate >= 90) ? 'success' : (($submission_rate >= 80) ? 'warning' : 'danger');
                                            ?>
                                            <span class="badge badge-<?= $badge_color ?>"><?= $submission_rate > 0 ? htmlspecialchars($submission_rate) . '%' : 'N/A' ?></span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px;">
                                        <div class="alert alert-info" style="margin-bottom: 0;">
                                            Aucune statistique de classe disponible. Les données apparaîtront ici une fois que vous aurez des étudiants et des activités.
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Top des étudiants</h2>
                
                <div class="grid grid-2">
                    <div class="card">
                        <h3>Meilleures moyennes</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Étudiant</th>
                                    <th>Classe</th>
                                    <th>Moyenne</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (isset($top_students) && !empty($top_students)): ?>
                                    <?php foreach ($top_students as $student): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($student['name'] ?? '') ?></td>
                                            <td><?= htmlspecialchars($student['class_name'] ?? '') ?></td>
                                            <td><strong><?= number_format($student['avg_grade'] ?? 0, 1) ?>/20</strong></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" style="text-align: center; padding: 20px;">
                                            <div class="alert alert-info" style="margin-bottom: 0;">
                                                Aucune donnée disponible. Les moyennes apparaîtront ici une fois que vous aurez évalué des travaux.
                                            </div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="card">
                        <h3>Statistiques générales</h3>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Métrique</th>
                                    <th>Valeur</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Total Étudiants</td>
                                    <td><strong><?= htmlspecialchars($overall_stats['total_students'] ?? 0) ?></strong></td>
                                </tr>
                                <tr>
                                    <td>Taux de Présence Moyen</td>
                                    <td><strong><?= htmlspecialchars($overall_stats['avg_attendance'] ?? 0) ?>%</strong></td>
                                </tr>
                                <tr>
                                    <td>Taux de Rendu des Travaux</td>
                                    <td><strong><?= htmlspecialchars($overall_stats['completion_rate'] ?? 0) ?>%</strong></td>
                                </tr>
                                <tr>
                                    <td>Nombre de Classes</td>
                                    <td><strong><?= count($class_stats ?? []) ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </main>
    </div>
</body>
</html>
