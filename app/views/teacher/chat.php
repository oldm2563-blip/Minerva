<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat de Classe</title>
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
                    <li class="nav-item"><a href="statistics.php" class="nav-link">Statistiques</a></li>
                    <li class="nav-item"><a href="chat.php" class="nav-link active">Chat</a></li>
                    <li class="nav-item"><a href="../Auth/login.php" class="nav-link">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="header">
                <h1>Chat de Classe</h1>
                <div class="user-info">Bienvenue, Prof. Martin</div>
            </div>

            <div class="content-section">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 class="section-title">Conversation - 3ème A Mathématiques</h2>
                    <select class="form-control" style="width: auto;">
                        <option>3ème A - Mathématiques</option>
                        <option>2nde B - Physique</option>
                    </select>
                </div>

                <div class="chat-container">
                    <!-- Messages reçus -->
                    <div class="chat-messages">
                        <!-- Message 1 -->
                        <div class="message received">
                            <div class="message-header">
                                Sophie Dubois
                                <span class="message-time">09:15</span>
                            </div>
                            <div class="message-content">
                                Bonjour ! Est-ce qu'on peut avoir une extension pour l'exercice 5 ?
                            </div>
                        </div>
                        
                        <!-- Message 2 -->
                        <div class="message received">
                            <div class="message-header">
                                Lucas Bernard
                                <span class="message-time">09:22</span>
                            </div>
                            <div class="message-content">
                                Merci professeur !
                            </div>
                        </div>
                        
                        <!-- Message envoyé 1 -->
                        <div class="message sent">
                            <div class="message-header">
                                Vous
                                <span class="message-time">09:00</span>
                            </div>
                            <div class="message-content">
                                Bonjour à tous ! N'oubliez pas de rendre vos exercices pour vendredi.
                            </div>
                        </div>
                        
                        <!-- Message envoyé 2 -->
                        <div class="message sent">
                            <div class="message-header">
                                Vous
                                <span class="message-time">09:20</span>
                            </div>
                            <div class="message-content">
                                Oui Sophie, vous avez jusqu'à lundi pour l'exercice 5.
                            </div>
                        </div>
                    </div>
                    
                    <!-- Input pour envoyer un message -->
                    <div class="chat-input">
                        <form style="display: flex; gap: 10px;">
                            <textarea placeholder="Tapez votre message..." style="flex: 1;"></textarea>
                            <button type="submit" class="btn" style="align-self: flex-end;">Envoyer</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="content-section">
                <h2 class="section-title">Participants en ligne</h2>
                
                <div style="display: flex; gap: 20px; flex-wrap: wrap;">
                    <div style="padding: 10px 15px; background-color: #f8f9fa; border-radius: 4px;">
                        <strong>Sophie Dubois</strong>
                        <div style="color: var(--success-color); font-size: 12px;">En ligne</div>
                    </div>
                    
                    <div style="padding: 10px 15px; background-color: #f8f9fa; border-radius: 4px;">
                        <strong>Lucas Bernard</strong>
                        <div style="color: var(--success-color); font-size: 12px;">En ligne</div>
                    </div>
                    
                    <div style="padding: 10px 15px; background-color: #f8f9fa; border-radius: 4px;">
                        <strong>Emma Martin</strong>
                        <div style="color: #6c757d; font-size: 12px;">Hors ligne</div>
                    </div>
                    
                    <div style="padding: 10px 15px; background-color: #f8f9fa; border-radius: 4px;">
                        <strong>Thomas Petit</strong>
                        <div style="color: var(--success-color); font-size: 12px;">En ligne</div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>