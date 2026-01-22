<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Enseignant</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Création de compte enseignant</h1>
                <p>Créez votre compte d'enseignant</p>
            </div>
            
            <form action="#" method="POST">
                <div class="form-row" style="display: flex; gap: 15px;">
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label">Prénom</label>
                        <input type="text" class="form-control" name="first_name" required>
                    </div>
                    
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label">Nom</label>
                        <input type="text" class="form-control" name="last_name" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email professionnel</label>
                    <input type="email" class="form-control" name="email" placeholder="enseignant@ecole.com" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" name="confirm_password" required>
                </div>
                
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="terms" required>
                        J'accepte les conditions d'utilisation
                    </label>
                </div>
                
                <div style="display: flex; gap: 10px;">
                    <button type="submit" class="btn" style="flex: 1;">Créer le compte</button>
                    <a href="login.php" class="btn btn-secondary" style="flex: 1;">Annuler</a>
                </div>
            </form>
            
            <div class="auth-footer">
                <p>Déjà un compte ? <a href="login.php">Se connecter</a></p>
                <p style="font-size: 12px; color: #6c757d;">* Les comptes étudiants sont créés par les enseignants depuis leur espace.</p>
            </div>
        </div>
    </div>
</body>
</html>