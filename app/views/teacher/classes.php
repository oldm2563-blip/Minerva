<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Classes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../css/style.css">

    <style>
        /* Small local helpers */
        .hidden {
            display: none;
        }

        .form-box {
            margin-bottom: 30px;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            padding: 20px;
            background-color: #fff;
        }

        .student-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 15px;
        }

        .student-card {
            background-color: #f8f9fa;
            padding: 12px;
            border-radius: 4px;
        }
    </style>
</head>
<body>

<div class="app-container">

    <!-- SIDEBAR -->
    <aside class="sidebar">
    <div class="sidebar-header">
        <h1>Espace Enseignant</h1>
    </div>

    <nav class="sidebar-nav">
        <ul>
            <li class="nav-item">
                <a href="dashboard2.php" class="nav-link">Tableau de bord</a>
            </li>

            <li class="nav-item">
                <a href="classes.php" class="nav-link active">Mes Classes</a>
            </li>

            <li class="nav-item">
                <a href="works.php" class="nav-link">Travaux</a>
            </li>

            <li class="nav-item">
                <a href="evaluation.php" class="nav-link">Évaluation</a>
            </li>

            <li class="nav-item">
                <a href="attendance.php" class="nav-link">Présences</a>
            </li>

            <li class="nav-item">
                <a href="statistics.php" class="nav-link">Statistiques</a>
            </li>

            <li class="nav-item">
                <a href="chat.php" class="nav-link">Chat</a>
            </li>

            <li class="nav-item">
                <a href="../Auth/login.php" class="nav-link">Déconnexion</a>
            </li>
        </ul>
    </nav>
</aside>


    <!-- MAIN -->
    <main class="main-content">

        <header class="header">
            <h1>Gestion des classes</h1>
            <div class="user-info">Bienvenue, Professeur</div>
        </header>

        <!-- ACTION BUTTONS -->
        <section class="content-section">
            <button class="btn" onclick="toggleForm('classForm')">Créer une classe</button>
            <button class="btn btn-secondary" onclick="toggleForm('studentForm')">Créer un étudiant</button>
        </section>

        <!-- CREATE CLASS FORM -->
        <section id="classForm" class="content-section hidden">
            <div class="form-box">
                <h2 class="section-title">Nouvelle classe</h2>

                <form method="post" action="create_class.php">
                    <div class="form-group">
                        <label class="form-label">Nom de la classe</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <button type="submit" class="btn">Créer</button>
                    <button type="button" class="btn btn-secondary" onclick="toggleForm('classForm')">
                        Annuler
                    </button>
                </form>
            </div>
        </section>

        <!-- CREATE STUDENT FORM -->
        <section id="studentForm" class="content-section hidden">
            <div class="form-box">
                <h2 class="section-title">Nouvel étudiant</h2>

                <form method="post" action="create_student.php">
                    <div class="form-group">
                        <label class="form-label">Nom complet</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label">Classe</label>
                        <select name="class_id" class="form-control" required>
                            <option value="">Sélectionner une classe</option>
                            <!-- PHP loop here -->
                        </select>
                    </div>

                    <button type="submit" class="btn">Créer</button>
                    <button type="button" class="btn btn-secondary" onclick="toggleForm('studentForm')">
                        Annuler
                    </button>
                </form>
            </div>
        </section>

        <!-- CLASSES LIST -->
        <section class="content-section">

            <h2 class="section-title">Mes classes</h2>

            <!-- CLASS CARD (PHP LOOP) -->
            <div class="card">

                <div class="card-header">
                    <h3 class="card-title">Nom de la classe</h3>
                    <span class="badge badge-primary">0 étudiants</span>
                </div>

                <div class="student-list">

                    <!-- STUDENT ITEM -->
                    <div class="student-card">
                        <strong>Nom étudiant</strong><br>
                        <small>email@ecole.com</small>
                    </div>

                </div>

            </div>

        </section>

    </main>
</div>

<!-- SIMPLE, SAFE JS -->
<script>
    function toggleForm(id) {
        const el = document.getElementById(id);
        el.classList.toggle('hidden');
        el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }
</script>

</body>
</html>
