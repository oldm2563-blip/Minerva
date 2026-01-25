<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Travaux</title>
    <link rel="stylesheet" href="../../../css/style.css">
    <style>
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
                    <li class="nav-item"><a href="dashboard2.php" class="nav-link">Tableau de bord</a></li>
                    <li class="nav-item"><a href="classes.php" class="nav-link">Mes Classes</a></li>
                    <li class="nav-item"><a href="works.php" class="nav-link active">Travaux</a></li>
                    <li class="nav-item"><a href="evaluation.php" class="nav-link">Évaluation</a></li>
                    <li class="nav-item"><a href="attendance.php" class="nav-link">Présences</a></li>
                    <li class="nav-item"><a href="statistics.php" class="nav-link">Statistiques</a></li>
                    <li class="nav-item"><a href="chat.php" class="nav-link">Chat</a></li>
                    <li class="nav-item"><a href="../Auth/login.php" class="nav-link">Déconnexion</a></li>
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

                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h3 class="card-title">Exercices sur les équations du second degré</h3>
                            </div>
                            <div class="work-actions">
                                <button onclick="assignWork(1)" class="work-action-btn">Assigner</button>
                                <button onclick="editWork(1)" class="work-action-btn">Modifier</button>
                                <button onclick="deleteWork(1)" class="work-action-btn" style="background-color: var(--danger-color);">Supprimer</button>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin: 15px 0;">
                        <p>Résoudre les exercices 1 à 10 du manuel page 45</p>
                        
                        <div style="display: flex; gap: 20px; margin-top: 15px; flex-wrap: wrap;">
                            <div>
                                <strong>Date d'assignation :</strong> 18/01/2026
                            </div>
                            <div>
                                <strong>Étudiants :</strong> 4
                            </div>
                            <div>
                                <strong>Statut :</strong> <span style="color: var(--success-color); font-weight: bold;">Actif</span>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--border-color);">
                        <h4 style="margin-bottom: 10px;">Assigné à :</h4>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">Sophie Dubois</span>
                            <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">Lucas Bernard</span>
                            <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">Emma Martin</span>
                            <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">Thomas Petit</span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div>
                                <h3 class="card-title">Leçon sur les fonctions</h3>
                            </div>
                            <div class="work-actions">
                                <button onclick="assignWork(2)" class="work-action-btn">Assigner</button>
                                <button onclick="editWork(2)" class="work-action-btn">Modifier</button>
                                <button onclick="deleteWork(2)" class="work-action-btn" style="background-color: var(--danger-color);">Supprimer</button>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin: 15px 0;">
                        <p>Lire et comprendre le chapitre 3 sur les fonctions linéaires</p>
                        
                        <div style="display: flex; gap: 20px; margin-top: 15px; flex-wrap: wrap;">
                            <div>
                                <strong>Date d'assignation :</strong> 20/01/2026
                            </div>
                            <div>
                                <strong>Étudiants :</strong> 4
                            </div>
                            <div>
                                <strong>Statut :</strong> <span style="color: var(--warning-color); font-weight: bold;">En attente</span>
                            </div>
                        </div>
                    </div>
                    
                    <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid var(--border-color);">
                        <h4 style="margin-bottom: 10px;">Assigné à :</h4>
                        <div style="display: flex; gap: 10px; flex-wrap: wrap;">
                            <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">Sophie Dubois</span>
                            <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">Lucas Bernard</span>
                            <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">Emma Martin</span>
                            <span style="background-color: #f8f9fa; padding: 5px 10px; border-radius: 4px;">Thomas Petit</span>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <div id="createWorkModal" class="modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Créer un nouveau travail</h2>
                <button class="close-modal" onclick="closeModal('createWorkModal')">×</button>
            </div>
            
            <form id="createWorkForm">
                <div class="form-group">
                    <label class="form-label">Titre du travail *</label>
                    <input type="text" class="form-control" id="workTitle" placeholder="Ex: Exercices sur les équations" required>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Description *</label>
                    <textarea class="form-control" id="workDescription" rows="4" placeholder="Description détaillée du travail..." required></textarea>
                </div>
                
                <div class="form-row" style="display: flex; gap: 15px;">
                    <div class="form-group" style="flex: 1;">
                        <label class="form-label">Date d'assignation</label>
                        <input type="date" class="form-control" id="workAssignDate">
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="form-label">Fichiers joints (optionnel)</label>
                    <div class="file-upload" onclick="document.getElementById('workFiles').click()">
                        <p>Cliquez pour ajouter des fichiers</p>
                        <p style="font-size: 12px; color: #666;">Formats acceptés: PDF, DOC, DOCX, JPG, PNG, ZIP (max 10MB)</p>
                    </div>
                    <input type="file" id="workFiles" multiple style="display: none;" onchange="displaySelectedFiles()">
                    <div id="selectedFiles" class="selected-files"></div>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn">Créer le travail</button>
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