<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Travaux - Étudiant</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
    <div class="app-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h1>Espace Étudiant</h1>
            </div>
            
            <nav class="sidebar-nav">
                <ul>
                    <li class="nav-item"><a href="dashboard.php" class="nav-link">Tableau de bord</a></li>
                    <li class="nav-item"><a href="my_classes.php" class="nav-link">Mes Classes</a></li>
                    <li class="nav-item"><a href="my_works.php" class="nav-link active">Mes Travaux</a></li>
                    <li class="nav-item"><a href="my_grades.php" class="nav-link">Mes Notes</a></li>
                    <li class="nav-item"><a href="student_chat.php" class="nav-link">Chat</a></li>
                    <li class="nav-item"><a href="../Auth/login.php" class="nav-link">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Mes Travaux</h1>
                <div class="user-info">Bienvenue, Sophie Dubois</div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Travaux assignés</h2>
                
                <!-- Travail 1 -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Exercices sur les équations du second degré</h3>
                        <span class="badge badge-warning">À rendre</span>
                    </div>
                    
                    <div style="margin: 15px 0;">
                        <p>Résoudre les exercices 1 à 10 du manuel page 45</p>
                        
                        <div style="display: flex; gap: 20px; margin-top: 15px; flex-wrap: wrap;">
                            <div>
                                <strong>Matière :</strong> Mathématiques
                            </div>
                            <div>
                                <strong>Professeur :</strong> Prof. Martin
                            </div>
                            <div>
                                <strong>Date limite :</strong> 25/01/2026
                            </div>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button class="btn">Soumettre</button>
                        <button class="btn btn-secondary">Voir détails</button>
                    </div>
                </div>

                <!-- Travail 2 -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Leçon sur les fonctions</h3>
                        <span class="badge badge-primary">En cours</span>
                    </div>
                    
                    <div style="margin: 15px 0;">
                        <p>Lire et comprendre le chapitre 3 sur les fonctions linéaires</p>
                        
                        <div style="display: flex; gap: 20px; margin-top: 15px; flex-wrap: wrap;">
                            <div>
                                <strong>Matière :</strong> Mathématiques
                            </div>
                            <div>
                                <strong>Professeur :</strong> Prof. Martin
                            </div>
                            <div>
                                <strong>Date limite :</strong> Non définie
                            </div>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 10px;">
                        <button class="btn">Marquer comme terminé</button>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>