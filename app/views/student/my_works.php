<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Travaux - Étudiant</title>
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
                    <li class="nav-item"><a href="/student/classes" class="nav-link">Mes Classes</a></li>
                    <li class="nav-item"><a href="/student/works" class="nav-link active">Mes Travaux</a></li>
                    <li class="nav-item"><a href="/student/grades" class="nav-link">Mes Notes</a></li>
                    <li class="nav-item"><a href="/student/chat" class="nav-link">Chat</a></li>
                    <li class="nav-item"><a href="/logout" class="nav-link">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Mes Travaux</h1>
                <div class="user-info">Bienvenue, <?= htmlspecialchars($_SESSION['name'] ?? 'Étudiant') ?></div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Travaux à rendre</h2>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Travail</th>
                                <th>Matière</th>
                                <th>Date limite</th>
                                <th>Reste</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($works) && !empty($works)): ?>
                                <?php foreach ($works as $work): ?>
                                    <?php if ($work['status'] === 'pending'): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($work['title'] ?? '') ?></strong></td>
                                            <td><?= htmlspecialchars($work['class_name'] ?? '') ?></td>
                                            <td><?= date('d/m/Y', strtotime($work['due_date'] ?? '')) ?></td>
                                            <td>
                                                <?php 
                                                $days_left = floor((strtotime($work['due_date']) - time()) / (60 * 60 * 24));
                                                if ($days_left < 0) {
                                                    echo '<span class="badge badge-danger">En retard</span>';
                                                } elseif ($days_left <= 2) {
                                                    echo '<span class="badge badge-warning">' . $days_left . ' jours</span>';
                                                } else {
                                                    echo '<span class="badge badge-success">' . $days_left . ' jours</span>';
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" onclick="showSubmitForm(<?= $work['id'] ?>)">Soumettre</button>
                                                <button class="btn btn-sm btn-secondary">Voir détails</button>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px;">
                                        <div class="alert alert-info" style="margin-bottom: 0;">
                                            Aucun travail en attente. Vous êtes à jour !
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Submit Form (Hidden by default) -->
            <div id="submitForm" class="content-section" style="display: none;">
                <h2 class="section-title">Soumettre un travail</h2>
                
                <form action="/student/submit" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="work_id" id="work_id">
                    
                    <div class="form-group">
                        <label class="form-label">Description de votre travail</label>
                        <textarea class="form-control" name="description" placeholder="Décrivez brièvement votre travail..." rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label">Fichier (PDF, DOC, DOCX)</label>
                        <input type="file" class="form-control" name="file" accept=".pdf,.doc,.docx" required>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn">Envoyer le travail</button>
                        <button type="button" class="btn btn-secondary" onclick="hideSubmitForm()">Annuler</button>
                    </div>
                </form>
            </div>

            <div class="content-section">
                <h2 class="section-title">Travaux rendus</h2>
                
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Travail</th>
                                <th>Matière</th>
                                <th>Date de soumission</th>
                                <th>Statut</th>
                                <th>Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (isset($works) && !empty($works)): ?>
                                <?php foreach ($works as $work): ?>
                                    <?php if ($work['status'] === 'submitted'): ?>
                                        <tr>
                                            <td><strong><?= htmlspecialchars($work['title'] ?? '') ?></strong></td>
                                            <td><?= htmlspecialchars($work['class_name'] ?? '') ?></td>
                                            <td><?= date('d/m/Y H:i', strtotime($work['submitted_at'] ?? '')) ?></td>
                                            <td><span class="badge badge-success">Soumis</span></td>
                                            <td><em>En attente d'évaluation</em></td>
                                        </tr>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" style="text-align: center; padding: 40px;">
                                        <div class="alert alert-info" style="margin-bottom: 0;">
                                            Aucun travail rendu pour le moment.
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

    <script>
        function showSubmitForm(workId) {
            const form = document.getElementById('submitForm');
            form.style.display = 'block';
            form.scrollIntoView({ behavior: 'smooth' });
            
            document.getElementById('work_id').value = workId;
        }

        function hideSubmitForm() {
            document.getElementById('submitForm').style.display = 'none';
        }
    </script>
</body>
</html>
