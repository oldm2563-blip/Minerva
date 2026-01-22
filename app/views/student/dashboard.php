<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - Étudiant</title>
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
                    <li class="nav-item"><a href="dashboard.php" class="nav-link active">Tableau de bord</a></li>
                    <li class="nav-item"><a href="my_classes.php" class="nav-link">Mes Classes</a></li>
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
                <h1>Tableau de bord</h1>
                <div class="user-info">Bienvenue, Sophie Dubois</div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Aperçu</h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
                    <div class="card">
                        <h3>Moyenne générale</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--success-color);">16.5/20</p>
                    </div>
                    
                    <div class="card">
                        <h3>Travaux à rendre</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--warning-color);">2</p>
                    </div>
                    
                    <div class="card">
                        <h3>Présence</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--primary-color);">92%</p>
                    </div>
                    
                    <div class="card">
                        <h3>Dernière note</h3>
                        <p style="font-size: 24px; font-weight: bold; color: var(--success-color);">18/20</p>
                    </div>
                </div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Travaux à rendre prochainement</h2>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Travail</th>
                            <th>Matière</th>
                            <th>Date limite</th>
                            <th>Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Exercices équations second degré</td>
                            <td>Mathématiques</td>
                            <td>25/01/2026</td>
                            <td><span class="badge badge-warning">À rendre</span></td>
                        </tr>
                        <tr>
                            <td>TP Mécanique des fluides</td>
                            <td>Physique</td>
                            <td>28/01/2026</td>
                            <td><span class="badge badge-warning">À rendre</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>