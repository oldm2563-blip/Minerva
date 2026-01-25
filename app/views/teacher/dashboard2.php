<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Enseignant</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1>Espace Enseignant</h1>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li class="nav-item"><a href="dashboard2.php" class="nav-link active">Tableau de bord</a></li>
                    <li class="nav-item"><a href="classes.php" class="nav-link">Mes Classes</a></li>
                    <li class="nav-item"><a href="works.php" class="nav-link">Travaux</a></li>
                    <li class="nav-item"><a href="evaluation.php" class="nav-link">Évaluation</a></li>
                    <li class="nav-item"><a href="attendance.php" class="nav-link">Présences</a></li>
                    <li class="nav-item"><a href="statistics.php" class="nav-link">Statistiques</a></li>
                    <li class="nav-item"><a href="chat.php" class="nav-link">Chat</a></li>
                    <li class="nav-item"><a href="../Auth/login.php" class="nav-link">Déconnexion</a></li>
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
                        <p style="font-size: 24px; font-weight: bold; color: var(--primary-color);">2</p>
                    </div>
                    
                    <div class="card">
                        <h3>Étudiants</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--primary-color);">6</p>
                    </div>
                    
                    <div class="card">
                        <h3>Travaux actifs</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--primary-color);">3</p>
                    </div>
                    
                    <div class="card">
                        <h3>À évaluer</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--primary-color);">1</p>
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