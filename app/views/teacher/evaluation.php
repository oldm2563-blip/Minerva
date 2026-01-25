<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Évaluation des Travaux</title>
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
                    <li class="nav-item"><a href="dashboard2.php" class="nav-link">Tableau de bord</a></li>
                    <li class="nav-item"><a href="classes.php" class="nav-link">Mes Classes</a></li>
                    <li class="nav-item"><a href="works.php" class="nav-link">Travaux</a></li>
                    <li class="nav-item"><a href="evaluation.php" class="nav-link active">Évaluation</a></li>
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
                <h1>Évaluation des Travaux</h1>
                <div class="user-info">Bienvenue, Prof. Martin</div>
            </div>

            <div class="content-section">
                <!-- À évaluer -->
                <h2 class="section-title">À évaluer (1)</h2>
                
                <div class="card">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                        <div>
                            <h3 style="margin-bottom: 5px;">Lucas Bernard</h3>
                            <p style="color: #6c757d; margin-bottom: 10px;">Exercices sur les équations du second degré</p>
                            <p>Voici mes réponses aux exercices.</p>
                        </div>
                        <span class="badge badge-warning">À évaluer</span>
                    </div>
                    
                    <div style="margin: 15px 0; padding: 10px; background-color: #f8f9fa; border-radius: 4px;">
                        <small>Soumis le 21/01/2026 à 10:15</small>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button class="btn btn-success">Évaluer</button>
                        <button class="btn btn-secondary">Télécharger</button>
                    </div>
                </div>

                <!-- Évalués -->
                <h2 class="section-title" style="margin-top: 40px;">Évalués (1)</h2>
                
                <div class="card">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 15px;">
                        <div>
                            <h3 style="margin-bottom: 5px;">Sophie Dubois</h3>
                            <p style="color: #6c757d; margin-bottom: 10px;">Exercices sur les équations du second degré</p>
                            <p style="font-style: italic;">Excellent travail !</p>
                        </div>
                        <div style="text-align: center;">
                            <div style="font-size: 24px; font-weight: bold; color: var(--success-color);">18/20</div>
                            <small>Évalué le 19/01/2026</small>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button class="btn">Modifier</button>
                        <button class="btn btn-secondary">Voir détails</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>