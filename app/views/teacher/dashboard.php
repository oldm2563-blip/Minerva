<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Enseignant</title>
    <link rel="stylesheet" href="/testmineva/css/style.css">
</head>
<style>
    /* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --primary-color: #4a6fa5;
    --secondary-color: #6a8cc5;
    --light-color: #f8f9fa;
    --dark-color: #343a40;
    --border-color: #dee2e6;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fa;
    color: #333;
    line-height: 1.6;
}

/* Layout */
.app-container {
    display: flex;
    min-height: 100vh;
}

/* Sidebar */
.sidebar {
    width: 250px;
    background-color: white;
    border-right: 1px solid var(--border-color);
    position: fixed;
    height: 100vh;
    overflow-y: auto;
    z-index: 1000;
}

.sidebar-header {
    padding: 20px;
    background-color: var(--primary-color);
    color: white;
}

.sidebar-header h1 {
    font-size: 1.5rem;
    font-weight: 600;
}

.sidebar-nav {
    padding: 20px 0;
}

.nav-item {
    list-style: none;
}

.nav-link {
    display: block;
    padding: 12px 20px;
    color: var(--dark-color);
    text-decoration: none;
    border-left: 3px solid transparent;
    transition: all 0.3s ease;
}

.nav-link:hover {
    background-color: var(--light-color);
    border-left-color: var(--primary-color);
}

.nav-link.active {
    background-color: #e9ecef;
    border-left-color: var(--primary-color);
    font-weight: 600;
    color: var(--primary-color);
}

/* Main Content */
.main-content {
    flex: 1;
    margin-left: 250px;
    padding: 20px;
}

/* Header */
.header {
    background-color: white;
    padding: 15px 20px;
    margin-bottom: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.header h1 {
    color: var(--dark-color);
    margin-bottom: 5px;
    font-size: 1.8rem;
}

.user-info {
    color: var(--primary-color);
    font-weight: 500;
}

/* Content Sections */
.content-section {
    background-color: white;
    padding: 25px;
    margin-bottom: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.section-title {
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--border-color);
    color: var(--dark-color);
    font-size: 1.4rem;
}

/* Buttons */
.btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    text-align: center;
}

.btn:hover {
    background-color: var(--secondary-color);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.btn-secondary {
    background-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

.btn-success {
    background-color: var(--success-color);
}

.btn-success:hover {
    background-color: #218838;
}

.btn-danger {
    background-color: var(--danger-color);
}

.btn-danger:hover {
    background-color: #c82333;
}

.btn-warning {
    background-color: var(--warning-color);
    color: #212529;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-info {
    background-color: var(--info-color);
}

.btn-info:hover {
    background-color: #138496;
}

/* Forms */
.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: var(--dark-color);
}

.form-control {
    width: 100%;
    padding: 12px;
    border: 2px solid var(--border-color);
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(74, 111, 165, 0.1);
}

.form-row {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
}

.form-row .form-group {
    flex: 1;
}

.form-actions {
    display: flex;
    gap: 10px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid var(--border-color);
}

/* Tables */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.table th,
.table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.table th {
    background-color: var(--light-color);
    font-weight: 600;
    color: var(--dark-color);
    border-bottom: 2px solid var(--border-color);
}

.table tr:hover {
    background-color: #f8f9fa;
}

.table tr:last-child td {
    border-bottom: none;
}

/* Cards */
.card {
    background-color: white;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.card-header {
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--border-color);
}

.card-title {
    font-size: 1.2rem;
    color: var(--dark-color);
    font-weight: 600;
}

/* Alerts */
.alert {
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 20px;
    border-left: 4px solid;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: var(--danger-color);
    color: #721c24;
}

.alert-success {
    background-color: #d4edda;
    border-color: var(--success-color);
    color: #155724;
}

.alert-warning {
    background-color: #fff3cd;
    border-color: var(--warning-color);
    color: #856404;
}

.alert-info {
    background-color: #d1ecf1;
    border-color: var(--info-color);
    color: #0c5460;
}

/* Badges */
.badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
}

.badge-primary {
    background-color: #e3f2fd;
    color: var(--primary-color);
}

.badge-success {
    background-color: #d4edda;
    color: var(--success-color);
}

.badge-warning {
    background-color: #fff3cd;
    color: #856404;
}

.badge-danger {
    background-color: #f8d7da;
    color: var(--danger-color);
}

/* Auth Pages */
.auth-container {
    display: flex;
    min-height: 100vh;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.auth-card {
    background-color: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    backdrop-filter: blur(10px);
}

.auth-header {
    text-align: center;
    margin-bottom: 30px;
}

.auth-header h1 {
    color: var(--primary-color);
    margin-bottom: 10px;
    font-size: 2rem;
}

.auth-header p {
    color: #6c757d;
    font-size: 1rem;
}

.auth-footer {
    text-align: center;
    margin-top: 20px;
    color: #6c757d;
}

.auth-footer a {
    color: var(--primary-color);
    text-decoration: none;
}

.auth-footer a:hover {
    text-decoration: underline;
}

/* Statistics Cards */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stats-card {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 25px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}

.stats-card h3 {
    font-size: 1rem;
    margin-bottom: 10px;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.stats-card .stats-number {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 5px;
}

.stats-card .stats-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        position: relative;
        height: auto;
    }
    
    .main-content {
        margin-left: 0;
    }
    
    .app-container {
        flex-direction: column;
    }
    
    .auth-card {
        margin: 20px;
        padding: 30px;
    }
    
    .form-row {
        flex-direction: column;
        gap: 0;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}

/* Animations */
@keyframes fadeIn {
    from { 
        opacity: 0; 
        transform: translateY(20px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

.fade-in {
    animation: fadeIn 0.5s ease-out;
}

/* Loading States */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid #f3f3f3;
    border-top: 2px solid var(--primary-color);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Checkbox styling */
.form-group label input[type="checkbox"] {
    margin-right: 8px;
}

.form-group label {
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #666;
}

/* Select styling */
select.form-control {
    cursor: pointer;
}

/* Textarea styling */
textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

/* File input styling */
input[type="file"] {
    border: 2px dashed var(--border-color);
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.3s ease;
}

input[type="file"]:hover {
    border-color: var(--primary-color);
}

</style>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1>Espace Enseignant</h1>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li class="nav-item"><a href="/teacher" class="nav-link active">Tableau de bord</a></li>
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
                <h1>Tableau de bord</h1>
                <div class="user-info">Bienvenue, Prof. Martin</div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Aperçu</h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
                    <div class="card">
                        <h3>Classes</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--primary-color);">
                            <?php 
                            $db = \app\core\Database::getInstance();
                            $classStmt = $db->prepare("SELECT COUNT(*) FROM classes WHERE teacher_id = ?");
                            $classStmt->execute([$_SESSION['id'] ?? 0]);
                            echo $classStmt->fetchColumn(); 
                            ?>
                        </p>
                    </div>
                    
                    <div class="card">
                        <h3>Étudiants</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--primary-color);">
                            <?php echo $statistics['total_students'] ?? 0; ?>
                        </p>
                    </div>
                    
                    <div class="card">
                        <h3>Moyenne générale</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--primary-color);">
                            <?php echo $statistics['average_grade'] ?? 0; ?>/20
                        </p>
                    </div>
                    
                    <div class="card">
                        <h3>À évaluer</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--primary-color);">
                            <?php echo $statistics['pending_assignments'] ?? 0; ?>
                        </p>
                    </div>
                </div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Dernières activités</h2>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Activité</th>
                            <th>Classe</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>21/01/2026</td>
                            <td>Lucas Bernard a soumis un travail</td>
                            <td>3ème A</td>
                        </tr>
                        <tr>
                            <td>20/01/2026</td>
                            <td>Création d'un nouveau travail</td>
                            <td>3ème A</td>
                        </tr>
                        <tr>
                            <td>19/01/2026</td>
                            <td>Évaluation du travail de Sophie Dubois</td>
                            <td>3ème A</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>