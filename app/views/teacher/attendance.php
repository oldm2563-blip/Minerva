<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Présences</title>
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
                    <li class="nav-item"><a href="attendance.php" class="nav-link active">Présences</a></li>
                    <li class="nav-item"><a href="statistics.php" class="nav-link">Statistiques</a></li>
                    <li class="nav-item"><a href="chat.php" class="nav-link">Chat</a></li>
                    <li class="nav-item"><a href="../Auth/login.php" class="nav-link">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Gestion des Présences</h1>
                <div class="user-info">Bienvenue, Prof. Martin</div>
            </div>

            <div class="content-section">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 class="section-title">Prise de présence - 21/01/2026</h2>
                    <div>
                        <select class="form-control" style="display: inline-block; width: auto;">
                            <option>3ème A - Mathématiques</option>
                            <option>2nde B - Physique</option>
                        </select>
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Statut</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <strong>Sophie Dubois</strong><br>
                                <small>sophie.dubois@school.com</small>
                            </td>
                            <td>
                                <select class="form-control" style="width: 150px;">
                                    <option value="present" selected>Présent</option>
                                    <option value="absent">Absent</option>
                                    <option value="late">Retard</option>
                                </select>
                            </td>
                           
                        </tr>
                        
                        <tr>
                            <td>
                                <strong>Lucas Bernard</strong><br>
                                <small>lucas.bernard@school.com</small>
                            </td>
                            <td>
                                <select class="form-control" style="width: 150px;">
                                    <option value="present">Présent</option>
                                    <option value="absent" selected>Absent</option>
                                    <option value="late">Retard</option>
                                </select>
                            </td>
                           
                        </tr>
                        
                        <tr>
                            <td>
                                <strong>Emma Martin</strong><br>
                                <small>emma.martin@school.com</small>
                            </td>
                            <td>
                                <select class="form-control" style="width: 150px;">
                                    <option value="present" selected>Présent</option>
                                    <option value="absent">Absent</option>
                                    <option value="late">Retard</option>
                                </select>
                            </td>
                           
                        </tr>
                        
                        <tr>
                            <td>
                                <strong>Thomas Petit</strong><br>
                                <small>thomas.petit@school.com</small>
                            </td>
                            <td>
                                <select class="form-control" style="width: 150px;">
                                    <option value="present">Présent</option>
                                    <option value="absent">Absent</option>
                                    <option value="late" selected>Retard</option>
                                </select>
                            </td>
                           
                        </tr>
                    </tbody>
                </table>
                
                <div style="text-align: right; margin-top: 20px;">
                    <button class="btn btn-success">Enregistrer la présence</button>
                </div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Statistiques de présence</h2>
                
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin-bottom: 30px;">
                    <div style="text-align: center; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
                        <h3>Taux de présence</h3>
                        <div style="font-size: 32px; font-weight: bold; color: var(--success-color);">85%</div>
                    </div>
                    
                    <div style="text-align: center; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
                        <h3>Absences</h3>
                        <div style="font-size: 32px; font-weight: bold; color: var(--danger-color);">3</div>
                    </div>
                    
                    <div style="text-align: center; padding: 20px; background-color: #f8f9fa; border-radius: 5px;">
                        <h3>Retards</h3>
                        <div style="font-size: 32px; font-weight: bold; color: var(--warning-color);">5</div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>