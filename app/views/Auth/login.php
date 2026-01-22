<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="../../../css/style.css">
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <div class="auth-header">
                <h1>Connexion</h1>
                <p>Accédez à votre espace personnel</p>
            </div>
            
            <form action="../teacher/dashboard.php" method="POST">
                <div class="form-group">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="votre@email.com" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" placeholder="Votre mot de passe" required>
                </div>
                
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="remember">
                        Se souvenir de moi
                    </label>
                </div>
                
                <button type="submit" class="btn" style="width: 100%;">Se connecter</button>
            </form>
            
            <div class="auth-footer">
                <p>Pas encore de compte ? <a href="register.php">Créer un compte enseignant</a></p>
                <p>Problème de connexion ? <a href="#">Mot de passe oublié</a></p>
            </div>
        </div>
    </div>
</body>
</html>