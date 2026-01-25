<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Travaux</title>
    <link rel="stylesheet" href="/testmineva/css/style.css">
    <style>
        /* Reset and Base Styles */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

:root {
    --primary-color: #4a6fa5;
    --secondary-color: #6a8cc5;
    --light-color: #f8f9fa;
    --dark-color: #343a40;
    --border-color: #dee2e6;
    --success-color: #28a745;
    --warning-color: #ffc107;
    --danger-color: #dc3545;
    --info-color: #17a2b8;
}

body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f7fa;
    color: #333;
    line-height: 1.6;
}

/* Layout */
.app-container {
    display: flex;
    min-height: 100vh;
}

/* Sidebar */
.sidebar {
    width: 250px;
    background-color: white;
    border-right: 1px solid var(--border-color);
    position: fixed;
    height: 100vh;
    overflow-y: auto;
    z-index: 1000;
}

.sidebar-header {
    padding: 20px;
    background-color: var(--primary-color);
    color: white;
}

.sidebar-header h1 {
    font-size: 1.5rem;
    font-weight: 600;
}

.sidebar-nav {
    padding: 20px 0;
}

.nav-item {
    list-style: none;
}

.nav-link {
    display: block;
    padding: 12px 20px;
    color: var(--dark-color);
    text-decoration: none;
    border-left: 3px solid transparent;
    transition: all 0.3s ease;
}

.nav-link:hover {
    background-color: var(--light-color);
    border-left-color: var(--primary-color);
}

.nav-link.active {
    background-color: #e9ecef;
    border-left-color: var(--primary-color);
    font-weight: 600;
    color: var(--primary-color);
}

/* Main Content */
.main-content {
    flex: 1;
    margin-left: 250px;
    padding: 20px;
}

/* Header */
.header {
    background-color: white;
    padding: 15px 20px;
    margin-bottom: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.header h1 {
    color: var(--dark-color);
    margin-bottom: 5px;
    font-size: 1.8rem;
}

.user-info {
    color: var(--primary-color);
    font-weight: 500;
}

/* Content Sections */
.content-section {
    background-color: white;
    padding: 25px;
    margin-bottom: 30px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.section-title {
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid var(--border-color);
    color: var(--dark-color);
    font-size: 1.4rem;
}

/* Buttons */
.btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: var(--primary-color);
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    text-decoration: none;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.3s ease;
    text-align: center;
}

.btn:hover {
    background-color: var(--secondary-color);
    transform: translateY(-1px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
}

.btn-secondary {
    background-color: #6c757d;
}

.btn-secondary:hover {
    background-color: #5a6268;
}

.btn-success {
    background-color: var(--success-color);
}

.btn-success:hover {
    background-color: #218838;
}

.btn-danger {
    background-color: var(--danger-color);
}

.btn-danger:hover {
    background-color: #c82333;
}

.btn-warning {
    background-color: var(--warning-color);
    color: #212529;
}

.btn-warning:hover {
    background-color: #e0a800;
}

.btn-info {
    background-color: var(--info-color);
}

.btn-info:hover {
    background-color: #138496;
}

/* Forms */
.form-group {
    margin-bottom: 20px;
}

.form-label {
    display: block;
    margin-bottom: 8px;
    font-weight: 500;
    color: var(--dark-color);
}

.form-control {
    width: 100%;
    padding: 12px;
    border: 2px solid var(--border-color);
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.3s ease;
}

.form-control:focus {
    outline: none;
    border-color: var(--primary-color);
    box-shadow: 0 0 0 3px rgba(74, 111, 165, 0.1);
}

.form-row {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
}

.form-row .form-group {
    flex: 1;
}

.form-actions {
    display: flex;
    gap: 10px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 1px solid var(--border-color);
}

/* Tables */
.table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: white;
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.table th,
.table td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid var(--border-color);
}

.table th {
    background-color: var(--light-color);
    font-weight: 600;
    color: var(--dark-color);
    border-bottom: 2px solid var(--border-color);
}

.table tr:hover {
    background-color: #f8f9fa;
}

.table tr:last-child td {
    border-bottom: none;
}

/* Cards */
.card {
    background-color: white;
    border: 1px solid var(--border-color);
    border-radius: 8px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

.card-header {
    margin-bottom: 15px;
    padding-bottom: 10px;
    border-bottom: 1px solid var(--border-color);
}

.card-title {
    font-size: 1.2rem;
    color: var(--dark-color);
    font-weight: 600;
}

/* Alerts */
.alert {
    padding: 12px 16px;
    border-radius: 6px;
    margin-bottom: 20px;
    border-left: 4px solid;
}

.alert-danger {
    background-color: #f8d7da;
    border-color: var(--danger-color);
    color: #721c24;
}

.alert-success {
    background-color: #d4edda;
    border-color: var(--success-color);
    color: #155724;
}

.alert-warning {
    background-color: #fff3cd;
    border-color: var(--warning-color);
    color: #856404;
}

.alert-info {
    background-color: #d1ecf1;
    border-color: var(--info-color);
    color: #0c5460;
}

/* Badges */
.badge {
    display: inline-block;
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 600;
}

.badge-primary {
    background-color: #e3f2fd;
    color: var(--primary-color);
}

.badge-success {
    background-color: #d4edda;
    color: var(--success-color);
}

.badge-warning {
    background-color: #fff3cd;
    color: #856404;
}

.badge-danger {
    background-color: #f8d7da;
    color: var(--danger-color);
}

/* Auth Pages */
.auth-container {
    display: flex;
    min-height: 100vh;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

.auth-card {
    background-color: white;
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    width: 100%;
    max-width: 400px;
    backdrop-filter: blur(10px);
}

.auth-header {
    text-align: center;
    margin-bottom: 30px;
}

.auth-header h1 {
    color: var(--primary-color);
    margin-bottom: 10px;
    font-size: 2rem;
}

.auth-header p {
    color: #6c757d;
    font-size: 1rem;
}

.auth-footer {
    text-align: center;
    margin-top: 20px;
    color: #6c757d;
}

.auth-footer a {
    color: var(--primary-color);
    text-decoration: none;
}

.auth-footer a:hover {
    text-decoration: underline;
}

/* Statistics Cards */
.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 30px;
}

.stats-card {
    background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    color: white;
    padding: 25px;
    border-radius: 12px;
    text-align: center;
    box-shadow: 0 8px 25px rgba(0,0,0,0.15);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stats-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.2);
}

.stats-card h3 {
    font-size: 1rem;
    margin-bottom: 10px;
    opacity: 0.9;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.stats-card .stats-number {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 5px;
}

.stats-card .stats-label {
    font-size: 0.9rem;
    opacity: 0.8;
}

/* Responsive */
@media (max-width: 768px) {
    .sidebar {
        width: 100%;
        position: relative;
        height: auto;
    }
    
    .main-content {
        margin-left: 0;
    }
    
    .app-container {
        flex-direction: column;
    }
    
    .auth-card {
        margin: 20px;
        padding: 30px;
    }
    
    .form-row {
        flex-direction: column;
        gap: 0;
    }
    
    .stats-grid {
        grid-template-columns: 1fr;
    }
}

/* Animations */
@keyframes fadeIn {
    from { 
        opacity: 0; 
        transform: translateY(20px); 
    }
    to { 
        opacity: 1; 
        transform: translateY(0); 
    }
}

.fade-in {
    animation: fadeIn 0.5s ease-out;
}

/* Loading States */
.loading {
    opacity: 0.6;
    pointer-events: none;
}

.spinner {
    display: inline-block;
    width: 20px;
    height: 20px;
    border: 2px solid #f3f3f3;
    border-top: 2px solid var(--primary-color);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* Checkbox styling */
.form-group label input[type="checkbox"] {
    margin-right: 8px;
}

.form-group label {
    display: flex;
    align-items: center;
    font-size: 14px;
    color: #666;
}

/* Select styling */
select.form-control {
    cursor: pointer;
}

/* Textarea styling */
textarea.form-control {
    resize: vertical;
    min-height: 100px;
}

/* File input styling */
input[type="file"] {
    border: 2px dashed var(--border-color);
    padding: 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.3s ease;
}

input[type="file"]:hover {
    border-color: var(--primary-color);
}

        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }
        
        .modal-content {
            background-color: white;
            margin: 5% auto;
            padding: 30px;
            border-radius: 10px;
            width: 90%;
            max-width: 800px;
            max-height: 90vh;
            overflow-y: auto;
        }
        
        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .modal-header h2 {
            margin: 0;
            color: var(--dark-color);
        }
        
        .close-modal {
            background: none;
            border: none;
            font-size: 28px;
            cursor: pointer;
            color: #666;
        }
        
        .modal-footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid var(--border-color);
            text-align: right;
        }
        
        .work-actions {
            display: flex;
            gap: 10px;
            margin-top: 15px;
        }
        
        .work-action-btn {
            padding: 8px 15px;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
        }
        
        .work-action-btn:hover {
            background-color: var(--secondary-color);
        }
        
        .students-container {
            max-height: 200px;
            overflow-y: auto;
            border: 1px solid var(--border-color);
            border-radius: 5px;
            padding: 15px;
            margin-top: 10px;
        }
        
        .student-checkbox {
            display: flex;
            align-items: center;
            padding: 8px;
            border-bottom: 1px solid #eee;
        }
        
        .student-checkbox:last-child {
            border-bottom: none;
        }
        
        .student-checkbox input {
            margin-right: 10px;
        }
        
        .work-type {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .work-type.exercice {
            background-color: #e3f2fd;
            color: #1976d2;
        }
        
        .work-type.lecon {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .work-type.document {
            background-color: #d4edda;
            color: #155724;
        }
        
        .work-type.projet {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .file-upload {
            border: 2px dashed #ddd;
            padding: 20px;
            text-align: center;
            border-radius: 5px;
            margin-top: 10px;
            cursor: pointer;
        }
        
        .file-upload:hover {
            border-color: var(--primary-color);
        }
        
        .selected-files {
            margin-top: 10px;
        }
        
        .file-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 5px;
            background-color: #f8f9fa;
            margin-bottom: 5px;
            border-radius: 3px;
        }
    </style>
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
                    <li class="nav-item"><a href="/teacher" class="nav-link">Tableau de bord</a></li>
                    <li class="nav-item"><a href="/teacher/classes" class="nav-link">Mes Classes</a></li>
                    <li class="nav-item"><a href="/teacher/works" class="nav-link active">Travaux</a></li>
                    <li class="nav-item"><a href="/teacher/evaluation" class="nav-link">Évaluation</a></li>
                    <li class="nav-item"><a href="/teacher/attendance" class="nav-link">Présences</a></li>
                    <li class="nav-item"><a href="/teacher/statistics" class="nav-link">Statistiques</a></li>
                    <li class="nav-item"><a href="/teacher/chat" class="nav-link">Chat</a></li>
                    <li class="nav-item"><a href="/logout" class="nav-link">Déconnexion</a></li>
                </ul>
            </nav>
        </aside>

        <main class="main-content">
            <div class="header">
                <h1>Gestion des Travaux</h1>
                <div class="user-info">Bienvenue, Prof. Martin</div>
            </div>

            <div class="content-section">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                    <h2 class="section-title">Travaux assignés</h2>
                    <button onclick="showCreateWorkModal()" class="btn">Créer un travail</button>
                </div>

                <!-- TEST FORM - DIRECT SUBMISSION -->
                <div class="card" style="margin-bottom: 20px; background-color: #fff3cd;">
                    <h3>TEST DIRECT - Création de travail</h3>
                    <form action="/teacher/create-work" method="POST" style="margin-top: 10px;">
                        <div style="display: flex; gap: 10px; align-items: end;">
                            <div style="flex: 1;">
                                <label>Titre:</label>
                                <input type="text" name="title" value="Test Work" required style="width: 100%; padding: 5px;">
                            </div>
                            <div style="flex: 1;">
                                <label>Description:</label>
                                <input type="text" name="description" value="Test Description" required style="width: 100%; padding: 5px;">
                            </div>
                            <div style="flex: 1;">
                                <label>Classe:</label>
                                <select name="class_id" required style="width: 100%; padding: 5px;">
                                    <?php
                                    $db = \app\core\Database::getInstance();
                                    $stmt = $db->prepare("SELECT * FROM classes WHERE teacher_id = ?");
                                    $stmt->execute([$_SESSION['id'] ?? 0]);
                                    $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                    
                                    foreach($classes as $class):
                                    ?>
                                        <option value="<?php echo $class['id']; ?>"><?php echo htmlspecialchars($class['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-success">CRÉER</button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php
                $db = \app\core\Database::getInstance();
                $stmt = $db->prepare("
                    SELECT w.*, c.name as class_name,
                           COUNT(cs.student_id) as student_count
                    FROM works w
                    JOIN classes c ON w.class_id = c.id
                    LEFT JOIN class_students cs ON w.class_id = cs.class_id
                    WHERE c.teacher_id = ?
                    GROUP BY w.id
                    ORDER BY w.created_at DESC
                ");
                $stmt->execute([$_SESSION['id'] ?? 0]);
                $works = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                if(!empty($works)):
                    foreach($works as $work):
                ?>
                    <div class="card">
                        <div class="card-header">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <div>
                                    <h3 class="card-title"><?php echo htmlspecialchars($work['title']); ?></h3>
                                </div>
                                <div class="work-actions">
                                    <button onclick="assignWork(<?php echo $work['id']; ?>)" class="work-action-btn">Assigner</button>
                                    <button onclick="editWork(<?php echo $work['id']; ?>)" class="work-action-btn">Modifier</button>
                                    <button onclick="deleteWork(<?php echo $work['id']; ?>)" class="work-action-btn" style="background-color: var(--danger-color);">Supprimer</button>
                                </div>
                            </div>
                        </div>
                        
                        <div style="margin: 15px 0;">
                            <p><?php echo htmlspecialchars($work['description']); ?></p>
                            
                            <div style="display: flex; gap: 20px; margin-top: 15px; flex-wrap: wrap;">
                                <div>
                                    <strong>Date d'assignation :</strong> <?php echo date('d/m/Y', strtotime($work['created_at'])); ?>
                                </div>
                                <div>
                                    <strong>Étudiants :</strong> <?php echo $work['student_count']; ?>
                                </div>
                                <div>
                                    <strong>Statut :</strong> <span style="color: var(--success-color); font-weight: bold;">Actif</span>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--border-color);">
                            <h4 style="margin-bottom: 10px;">Assigné à :</h4>
                            <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                                <?php
                                $stmt = $db->prepare("
                                    SELECT u.name 
                                    FROM users u 
                                    JOIN class_students cs ON u.id = cs.student_id 
                                    WHERE cs.class_id = ? AND u.role = 'student'
                                ");
                                $stmt->execute([$work['class_id']]);
                                $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                foreach($students as $student):
                                ?>
                                    <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">
                                        <?php echo htmlspecialchars($student['name']); ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                <?php 
                    endforeach;
                else:
                ?>
                    <div class="card">
                        <p style="text-align: center; color: #6c757d;">Aucun travail créé. Cliquez sur "Créer un travail" pour commencer.</p>
                    </div>
                <?php endif; ?>
            </div>
        </main>
    </div>

    <div id="createWorkModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Créer un nouveau travail</h2>
                <button class="close-modal" onclick="closeModal('createWorkModal')">×</button>
            </div>
            
            <form id="createWorkForm" action="/teacher/create-work" method="POST" onsubmit="console.log('Form submitted!', new FormData(this)); return true;">
                <div class="form-group">
                    <label class="form-label">Titre du travail *</label>
                    <input type="text" class="form-control" name="title" placeholder="Ex: Exercices sur les équations" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description *</label>
                    <textarea class="form-control" name="description" rows="4" placeholder="Description détaillée du travail..." required></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Classe *</label>
                    <select class="form-control" name="class_id" required>
                        <option value="">Sélectionner une classe</option>
                        <?php
                        $db = \app\core\Database::getInstance();
                        $stmt = $db->prepare("SELECT * FROM classes WHERE teacher_id = ?");
                        $stmt->execute([$_SESSION['id'] ?? 0]);
                        $classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
                        
                        foreach($classes as $class):
                        ?>
                            <option value="<?php echo $class['id']; ?>"><?php echo htmlspecialchars($class['name']); ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="form-row" style="display: flex; gap: 15px;">
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label">Date limite</label>
                        <input type="datetime-local" class="form-control" name="due_date">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Fichiers joints (optionnel)</label>
                    <div class="file-upload">
                        <p>Cliquez pour ajouter des fichiers</p>
                        <p style="font-size: 12px; color: #666;">Formats acceptés: PDF, DOC, DOCX, JPG, PNG, ZIP (max 10MB)</p>
                    </div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn" onclick="console.log('Submit button clicked!');">Créer le travail</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('createWorkModal')">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <div id="assignWorkModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2 id="assignWorkTitle">Assigner le travail</h2>
                <button class="close-modal" onclick="closeModal('assignWorkModal')">×</button>
            </div>
            
            <form id="assignWorkForm">
                <input type="hidden" id="assignWorkId">
                
                <div class="form-group">
                    <label class="form-label">Sélectionner une classe *</label>
                    <select class="form-control" id="assignClass" required onchange="loadStudentsForClass()">
                        <option value="">Sélectionner une classe</option>
                        <option value="1">Mathématiques - 3ème A</option>
                        <option value="2">Physique - 2nde B</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Sélectionner les étudiants *</label>
                    <div id="studentsList" class="students-container">
                        <p style="color: #666; text-align: center;">Sélectionnez d'abord une classe</p>
                    </div>
                    <div style="margin-top: 10px;">
                        <button type="button" class="btn btn-sm" onclick="selectAllStudents()">Tout sélectionner</button>
                        <button type="button" class="btn btn-sm" onclick="deselectAllStudents()">Tout désélectionner</button>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Date limite d'assignation</label>
                    <input type="datetime-local" class="form-control" id="assignDeadline">
                </div>
                
                <div class="form-group">
                    <label class="form-label">Message aux étudiants (optionnel)</label>
                    <textarea class="form-control" id="assignMessage" rows="3" placeholder="Message accompagnant l'assignation..."></textarea>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn">Assigner le travail</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('assignWorkModal')">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <div id="editWorkModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Modifier le travail</h2>
                <button class="close-modal" onclick="closeModal('editWorkModal')">×</button>
            </div>
            
            <form id="editWorkForm">
                <input type="hidden" id="editWorkId">
                
                <div class="form-group">
                    <label class="form-label">Titre du travail *</label>
                    <input type="text" class="form-control" id="editWorkTitle" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description *</label>
                    <textarea class="form-control" id="editWorkDescription" rows="4" required></textarea>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Date d'assignation</label>
                    <input type="date" class="form-control" id="editWorkAssignDate">
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn">Enregistrer</button>
                    <button type="button" class="btn btn-secondary" onclick="closeModal('editWorkModal')">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        let currentWorkId = null;
        let selectedFiles = [];

        function showCreateWorkModal() {
            document.getElementById('createWorkModal').style.display = 'block';
        }
        
        function assignWork(workId) {
            currentWorkId = workId;
            
            const works = {
                1: "Exercices sur les équations du second degré",
                2: "Leçon sur les fonctions"
            };
            
            document.getElementById('assignWorkId').value = workId;
            document.getElementById('assignWorkTitle').textContent = `Assigner : ${works[workId] || 'Travail'}`;
            document.getElementById('assignWorkModal').style.display = 'block';
        }
        
        function editWork(workId) {
            currentWorkId = workId;
            
            const works = {
                1: {
                    title: "Exercices sur les équations du second degré",
                    description: "Résoudre les exercices 1 à 10 du manuel page 45",
                    assignDate: "2026-01-18"
                },
                2: {
                    title: "Leçon sur les fonctions",
                    description: "Lire et comprendre le chapitre 3 sur les fonctions linéaires",
                    assignDate: "2026-01-20"
                }
            };
            
            const work = works[workId];
            if (work) {
                document.getElementById('editWorkId').value = workId;
                document.getElementById('editWorkTitle').value = work.title;
                document.getElementById('editWorkDescription').value = work.description;
                document.getElementById('editWorkAssignDate').value = work.assignDate;
                document.getElementById('editWorkModal').style.display = 'block';
            }
        }
        
        function deleteWork(workId) {
            if (confirm(`Êtes-vous sûr de vouloir supprimer ce travail ?\n\nToutes les soumissions associées seront également supprimées.\nCette action est irréversible.`)) {
                alert(`Travail ${workId} supprimé avec succès !`);
                setTimeout(() => {
                    location.reload();
                }, 1000);
            }
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
        
        function loadStudentsForClass() {
            const classId = document.getElementById('assignClass').value;
            
            const studentsByClass = {
                1: [
                    { id: 1, name: "Sophie Dubois", email: "sophie.dubois@school.com" },
                    { id: 2, name: "Lucas Bernard", email: "lucas.bernard@school.com" },
                    { id: 3, name: "Emma Martin", email: "emma.martin@school.com" },
                    { id: 4, name: "Thomas Petit", email: "thomas.petit@school.com" }
                ],
                2: [
                    { id: 5, name: "Léa Durand", email: "lea.durand@school.com" },
                    { id: 6, name: "Hugo Moreau", email: "hugo.moreau@school.com" }
                ]
            };
            
            const studentsContainer = document.getElementById('studentsList');
            
            if (!classId) {
                studentsContainer.innerHTML = '<p style="color: #666; text-align: center;">Sélectionnez d\'abord une classe</p>';
                return;
            }
            
            const students = studentsByClass[classId] || [];
            
            let html = '';
            if (students.length > 0) {
                students.forEach(student => {
                    html += `
                        <div class="student-checkbox">
                            <input type="checkbox" id="student_${student.id}" value="${student.id}">
                            <label for="student_${student.id}">
                                <strong>${student.name}</strong><br>
                                <small>${student.email}</small>
                            </label>
                        </div>
                    `;
                });
            } else {
                html = '<p style="color: #666; text-align: center;">Aucun étudiant dans cette classe</p>';
            }
            
            studentsContainer.innerHTML = html;
        }
        
        function selectAllStudents() {
            const checkboxes = document.querySelectorAll('#studentsList input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = true;
            });
        }
        
        function deselectAllStudents() {
            const checkboxes = document.querySelectorAll('#studentsList input[type="checkbox"]');
            checkboxes.forEach(checkbox => {
                checkbox.checked = false;
            });
        }
        
        function displaySelectedFiles() {
            const filesInput = document.getElementById('workFiles');
            const filesContainer = document.getElementById('selectedFiles');
            
            selectedFiles = Array.from(filesInput.files);
            
            let html = '';
            if (selectedFiles.length > 0) {
                html += '<h4>Fichiers sélectionnés :</h4>';
                selectedFiles.forEach((file, index) => {
                    html += `
                        <div class="file-item">
                            <span>${file.name} (${formatFileSize(file.size)})</span>
                            <button type="button" onclick="removeFile(${index})" style="background: none; border: none; color: red; cursor: pointer;">×</button>
                        </div>
                    `;
                });
            }
            
            filesContainer.innerHTML = html;
        }
        
        function removeFile(index) {
            selectedFiles.splice(index, 1);
            displaySelectedFiles();
        }
        
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
        
        document.getElementById('createWorkForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const title = document.getElementById('workTitle').value;
            const description = document.getElementById('workDescription').value;
            
            if (!title || !description) {
                alert('Veuillez remplir tous les champs obligatoires !');
                return;
            }
            
            alert(`Travail créé avec succès !\n\n"${title}"\n\nVoulez-vous maintenant assigner ce travail à des étudiants ?`);
            
            this.reset();
            selectedFiles = [];
            document.getElementById('selectedFiles').innerHTML = '';
            
            closeModal('createWorkModal');
            
            setTimeout(() => {
                location.reload();
            }, 2000);
        });
        
        document.getElementById('assignWorkForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const classId = document.getElementById('assignClass').value;
            const selectedStudents = document.querySelectorAll('#studentsList input[type="checkbox"]:checked');
            
            if (!classId) {
                alert('Veuillez sélectionner une classe !');
                return;
            }
            
            if (selectedStudents.length === 0) {
                alert('Veuillez sélectionner au moins un étudiant !');
                return;
            }
            
            const studentNames = Array.from(selectedStudents).map(checkbox => {
                const label = checkbox.nextElementSibling;
                return label.querySelector('strong').textContent;
            });
            
            alert(`Travail assigné avec succès à ${studentNames.length} étudiant(s) !\n\nÉtudiants : ${studentNames.join(', ')}`);
            
            this.reset();
            document.getElementById('studentsList').innerHTML = '<p style="color: #666; text-align: center;">Sélectionnez d\'abord une classe</p>';
            
            closeModal('assignWorkModal');
            
            setTimeout(() => {
                location.reload();
            }, 1000);
        });
        
        document.getElementById('editWorkForm').addEventListener('submit', function(e) {
            e.preventDefault();
            
            const workId = document.getElementById('editWorkId').value;
            const title = document.getElementById('editWorkTitle').value;
            
            alert(`Travail ${workId} modifié avec succès !\n\n"${title}"`);
            
            closeModal('editWorkModal');
            
            setTimeout(() => {
                location.reload();
            }, 1000);
        });
        
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                if (event.target == modal) {
                    modal.style.display = 'none';
                }
            });
        }
        
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = document.querySelectorAll('.modal');
                modals.forEach(modal => {
                    if (modal.style.display === 'block') {
                        modal.style.display = 'none';
                    }
                });
            }
        });
        
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            const assignDate = document.getElementById('workAssignDate');
            if (assignDate) {
                assignDate.value = today;
            }
            
            const editAssignDate = document.getElementById('editWorkAssignDate');
            if (editAssignDate) {
                editAssignDate.value = today;
            }
        });
    </script>
</body>
</html>