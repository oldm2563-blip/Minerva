<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Statistiques</title>
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
                    <li class="nav-item"><a href="dashboard.php" class="nav-link">Tableau de bord</a></li>
                    <li class="nav-item"><a href="classes.php" class="nav-link">Mes Classes</a></li>
                    <li class="nav-item"><a href="works.php" class="nav-link">Travaux</a></li>
                    <li class="nav-item"><a href="evaluation.php" class="nav-link">Évaluation</a></li>
                    <li class="nav-item"><a href="attendance.php" class="nav-link">Présences</a></li>
                    <li class="nav-item"><a href="statistics.php" class="nav-link active">Statistiques</a></li>
                    <li class="nav-item"><a href="chat.php" class="nav-link">Chat</a></li>
                    <li class="nav-item"><a href="../Auth/login.php" class="nav-link">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Statistiques</h1>
                <div class="user-info">Bienvenue, Prof. Martin</div>
            </div>

            <div class="content-section">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 class="section-title">Aperçu général</h2>
                    <select class="form-control" style="width: auto;">
                        <option>Ce mois</option>
                        <option>Ce semestre</option>
                        <option>Cette année</option>
                    </select>
                </div>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px; margin-bottom: 30px;">
                    <div style="padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
                        <h3 style="margin-bottom: 10px;">Moyenne générale</h3>
                        <div style="font-size: 36px; font-weight: bold; color: var(--primary-color);">15.2/20</div>
                        <small>+0.5 vs mois dernier</small>
                    </div>
                    
                    <div style="padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
                        <h3 style="margin-bottom: 10px;">Taux de soumission</h3>
                        <div style="font-size: 36px; font-weight: bold; color: var(--success-color);">92%</div>
                        <small>23/25 travaux rendus</small>
                    </div>
                    
                    <div style="padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
                        <h3 style="margin-bottom: 10px;">Taux de présence</h3>
                        <div style="font-size: 36px; font-weight: bold; color: var(--warning-color);">88%</div>
                        <small>Moyenne des classes</small>
                    </div>
                </div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Statistiques par classe</h2>
                
                <table class="table">
                    <thead>
                        <tr>
                            <th>Classe</th>
                            <th>Moyenne</th>
                            <th>Présence</th>
                            <th>Travaux rendus</th>
                            <th>Meilleure note</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>3ème A - Mathématiques</strong><br>
                                <small>4 étudiants</small>
                            </td>
                            <td>
                                <div style="font-weight: bold; color: var(--success-color);">16.5/20</div>
                            </td>
                            <td>92%</td>
                            <td>100%</td>
                            <td>18/20 (Sophie D.)</td>
                        </tr>
                        
                        <tr>
                            <td>
                                <strong>2nde B - Physique</strong><br>
                                <small>2 étudiants</small>
                            </td>
                            <td>
                                <div style="font-weight: bold; color: var(--warning-color);">13.8/20</div>
                            </td>
                            <td>85%</td>
                            <td>83%</td>
                            <td>15/20 (Léa D.)</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="content-section">
                <h2 class="section-title">Évolution des performances</h2>
                
                <div style="background-color: #f8f9fa; padding: 30px; border-radius: 5px; text-align: center;">
                    <p>Graphique d'évolution des moyennes par mois</p>
                    <div style="height: 200px; display: flex; align-items: flex-end; justify-content: center; gap: 20px; margin-top: 30px;">
                        <div style="width: 40px; background-color: var(--primary-color); height: 150px;" title="Nov: 14.5"></div>
                        <div style="width: 40px; background-color: var(--primary-color); height: 160px;" title="Déc: 15.0"></div>
                        <div style="width: 40px; background-color: var(--primary-color); height: 170px;" title="Jan: 15.2"></div>
                    </div>
                    <div style="display: flex; justify-content: center; gap: 20px; margin-top: 10px;">
                        <span>Novembre</span>
                        <span>Décembre</span>
                        <span>Janvier</span>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>