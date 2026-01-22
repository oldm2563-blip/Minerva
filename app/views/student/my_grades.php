<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes Notes - Étudiant</title>
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
                    <li class="nav-item"><a href="my_works.php" class="nav-link">Mes Travaux</a></li>
                    <li class="nav-item"><a href="my_grades.php" class="nav-link active">Mes Notes</a></li>
                    <li class="nav-item"><a href="student_chat.php" class="nav-link">Chat</a></li>
                    <li class="nav-item"><a href="../Auth/login.php" class="nav-link">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Mes Notes</h1>
                <div class="user-info">Bienvenue, Sophie Dubois</div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Résumé</h2>
                
                <div style="text-align: center; padding: 30px; background-color: #f8f9fa; border-radius: 5px; margin-bottom: 30px;">
                    <h3 style="margin-bottom: 10px;">Moyenne générale</h3>
                    <div style="font-size: 48px; font-weight: bold; color: var(--success-color);">16.5/20</div>
                    <p>Meilleure note: 18/20 - Plus faible note: 15/20</p>
                </div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Détails des notes</h2>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Matière</th>
                            <th>Travail</th>
                            <th>Note</th>
                            <th>Commentaire</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>Mathématiques</strong><br>
                                <small>Prof. Martin</small>
                            </td>
                            <td>Exercices équations second degré</td>
                            <td>
                                <div style="font-weight: bold; color: var(--success-color);">18/20</div>
                            </td>
                            <td>Excellent travail !</td>
                            <td>19/01/2026</td>
                        </tr>
                        
                        <tr>
                            <td>
                                <strong>Physique</strong><br>
                                <small>Prof. Durand</small>
                            </td>
                            <td>TP Électricité</td>
                            <td>
                                <div style="font-weight: bold; color: var(--warning-color);">15/20</div>
                            </td>
                            <td>Bon travail, mais manque de précision</td>
                            <td>10/01/2026</td>
                        </tr>
                        
                        <tr>
                            <td>
                                <strong>Mathématiques</strong><br>
                                <small>Prof. Martin</small>
                            </td>
                            <td>Devoir Géométrie</td>
                            <td>
                                <div style="font-weight: bold; color: var(--success-color);">16.5/20</div>
                            </td>
                            <td>Très bon raisonnement</td>
                            <td>05/01/2026</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>