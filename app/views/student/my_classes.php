<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Classes - Étudiant</title>
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
                    <li class="nav-item"><a href="my_classes.php" class="nav-link active">Mes Classes</a></li>
                    <li class="nav-item"><a href="my_works.php" class="nav-link">Mes Travaux</a></li>
                    <li class="nav-item"><a href="my_grades.php" class="nav-link">Mes Notes</a></li>
                    <li class="nav-item"><a href="student_chat.php" class="nav-link">Chat</a></li>
                    <li class="nav-item"><a href="../Auth/login.php" class="nav-link">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Mes Classes</h1>
                <div class="user-info">Bienvenue, Sophie Dubois</div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Mes inscriptions</h2>
                
                <!-- Classe 1 -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Mathématiques - 3ème A</h3>
                        <span>Prof. Martin</span>
                    </div>
                    
                    <div style="margin: 15px 0;">
                        <div style="display: flex; gap: 20px; margin-bottom: 15px; flex-wrap: wrap;">
                            <div>
                                <strong>Horaires :</strong> Lundi 14h-16h, Mercredi 10h-12h
                            </div>
                            <div>
                                <strong>Salle :</strong> Bâtiment A - Salle 203
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--border-color);">
                        <h4 style="margin-bottom: 10px;">Camarades de classe :</h4>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">Lucas Bernard</span>
                            <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">Emma Martin</span>
                            <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">Thomas Petit</span>
                        </div>
                    </div>
                </div>

                <!-- Classe 2 -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Physique - 2nde B</h3>
                        <span>Prof. Durand</span>
                    </div>
                    
                    <div style="margin: 15px 0;">
                        <div style="display: flex; gap: 20px; margin-bottom: 15px; flex-wrap: wrap;">
                            <div>
                                <strong>Horaires :</strong> Mardi 9h-11h, Jeudi 14h-16h
                            </div>
                            <div>
                                <strong>Salle :</strong> Bâtiment B - Salle 105
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--border-color);">
                        <h4 style="margin-bottom: 10px;">Camarades de classe :</h4>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">Léa Durand</span>
                            <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">Hugo Moreau</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>