<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Enseignant</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<style>
    /* style.css */
:root {
    --primary: #4a6fa5;
    --bg: #f4f6f8;
    --white: #ffffff;
    --dark: #2c2c2c;
    --border: #e0e0e0;
    --success: #28a745;
    --danger: #dc3545;
    --warning: #ffc107;
    --info: #17a2b8;
}

/* Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: system-ui, sans-serif;
    background: var(--bg);
    color: var(--dark);
    min-height: 100vh;
}

/* Layout */
.sidebar {
    width: 240px;
    background: var(--white);
    border-right: 1px solid var(--border);
    position: fixed;
    height: 100vh;
}

.sidebar-header {
    padding: 20px;
    background: var(--primary);
    color: white;
    text-align: center;
}

.sidebar-nav {
    padding: 10px;
}

.nav-item {
    list-style: none;
}

.nav-link {
    display: block;
    padding: 12px;
    color: var(--dark);
    text-decoration: none;
    border-radius: 6px;
}

.nav-link:hover,
.nav-link.active {
    background: #eef2f7;
    color: var(--primary);
}

/* Main */
.main-content {
    margin-left: 240px;
    padding: 20px;
}

/* Header */
.header {
    background: var(--white);
    padding: 15px 20px;
    border-radius: 8px;
    border: 1px solid var(--border);
    margin-bottom: 20px;
}

.header h1 {
    font-size: 1.5rem;
}

/* Sections */
.content-section {
    background: var(--white);
    padding: 20px;
    border-radius: 8px;
    border: 1px solid var(--border);
    margin-bottom: 20px;
}

.section-title {
    margin-bottom: 15px;
    font-size: 1.2rem;
    border-bottom: 1px solid var(--border);
    padding-bottom: 8px;
}

/* Buttons */
.btn {
    padding: 10px 16px;
    border-radius: 6px;
    border: none;
    cursor: pointer;
    font-size: 14px;
    background: var(--primary);
    color: white;
}

.btn-success { background: var(--success); }
.btn-danger  { background: var(--danger); }
.btn-warning { background: var(--warning); color: #000; }

/* Forms */
.form-group {
    margin-bottom: 15px;
}

.form-label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
}

.form-control {
    width: 100%;
    padding: 10px;
    border: 1px solid var(--border);
    border-radius: 6px;
}

/* Tables */
.table {
    width: 100%;
    border-collapse: collapse;
    background: var(--white);
}

.table th,
.table td {
    padding: 12px;
    border-bottom: 1px solid var(--border);
}

.table th {
    background: #f0f2f5;
    text-align: left;
}

/* Alerts */
.alert {
    padding: 12px;
    border-radius: 6px;
    margin-bottom: 15px;
}

.alert-success { background: #e6f4ea; color: var(--success); }
.alert-danger  { background: #fbeaea; color: var(--danger); }
.alert-warning { background: #fff4e5; color: #856404; }
.alert-info    { background: #e8f4f8; color: var(--info); }

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        position: relative;
        width: 100%;
        height: auto;
    }

    .main-content {
        margin-left: 0;
    }
}

</style>
<body>
    <div class="auth-container">
        <div class="auth-card fade-in">
            <div class="auth-header">
                <h1>Inscription Enseignant</h1>
                <p>Créez votre compte pour accéder à la plateforme</p>
            </div>
            
            <?php if (!empty($error)): ?>
                <div class="alert <?= $error[0] === 'Inscription réussie' ? 'alert-success' : 'alert-danger' ?>">
                    <?php foreach ($error as $err): ?>
                        <?= htmlspecialchars($err) ?><br>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
            
            <form action="/register" method="POST">
                <div class="form-group">
                    <label class="form-label">Nom complet</label>
                    <input type="text" class="form-control" name="name" placeholder="Jean Martin" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Email professionnel</label>
                    <input type="email" class="form-control" name="email" placeholder="jean.martin@ecole.fr" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" name="password" placeholder="Minimum 6 caractères" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Confirmer le mot de passe</label>
                    <input type="password" class="form-control" name="confirm_password" placeholder="Répétez le mot de passe" required>
                </div>
                
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="terms" required>
                        J'accepte les conditions d'utilisation et la politique de confidentialité
                    </label>
                </div>
                
                <button type="submit" class="btn" style="width: 100%;">Créer mon compte</button>
            </form>
            
            <div class="auth-footer">
                <p>Déjà un compte ? <a href="/">Se connecter</a></p>
                <p>Vous êtes étudiant ? <a href="/student/login">Accès étudiant</a></p>
            </div>
        </div>
    </div>
</body>
</html>
