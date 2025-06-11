<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un utilisateur - Toolzy</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        /* Styles personnalisés pour le formulaire */
        .toolzy-form-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
        }
        
        .toolzy-form-card {
            background-color: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 30px;
            border: 1px solid rgba(0, 0, 0, 0.05);
        }
        
        .form-section-header {
            display: flex;
            align-items: center;
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eaeaea;
        }
        
        .form-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            background: linear-gradient(135deg, #4776E6, #8E54E9);
        }
        
        .form-icon i {
            color: white;
            font-size: 1.5rem;
        }
        
        .form-header-text h3 {
            font-weight: 600;
            margin-bottom: 5px;
            color: #333;
        }
        
        .form-header-text p {
            color: #777;
            margin-bottom: 0;
            font-size: 0.9rem;
        }
        
        .form-label {
            display: flex;
            align-items: center;
            font-weight: 500;
            margin-bottom: 8px;
            color: #444;
        }
        
        .form-label i {
            margin-right: 8px;
            color: #4776E6;
            width: 20px;
            text-align: center;
        }
        
        .form-control {
            border-radius: 12px;
            padding: 12px 15px;
            border: 1px solid #dee2e6;
            transition: all 0.3s;
        }
        
        .form-control:focus {
            border-color: #4776E6;
            box-shadow: 0 0 0 0.25rem rgba(71, 118, 230, 0.1);
        }
        
        .password-container {
            position: relative;
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #777;
            cursor: pointer;
            z-index: 5;
        }
        
        .password-strength {
            margin-top: 8px;
            display: none;
        }
        
        .strength-indicators {
            display: flex;
            gap: 5px;
            margin-right: 10px;
        }
        
        .strength-indicator {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background-color: #e9ecef;
        }
        
        .strength-text {
            font-size: 0.85rem;
            font-weight: 500;
        }
        
        .password-match {
            display: none;
            padding: 12px 15px;
            border-radius: 10px;
            margin-top: 15px;
        }
        
        .password-match i {
            margin-right: 8px;
        }
        
        .btn-toolzy {
            background: linear-gradient(135deg, #4776E6, #8E54E9);
            border: none;
            border-radius: 12px;
            padding: 12px 20px;
            color: white;
            font-weight: 600;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-toolzy:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(71, 118, 230, 0.3);
        }
        
        .btn-toolzy:disabled {
            opacity: 0.65;
            transform: none;
            box-shadow: none;
        }
        
        .btn-reset {
            background-color: #f8f9fa;
            border: 1px solid #eaeaea;
            border-radius: 12px;
            padding: 12px 20px;
            color: #444;
            font-weight: 500;
            transition: all 0.3s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .btn-reset:hover {
            background-color: #e9ecef;
        }
        
        .form-actions {
            padding-top: 25px;
            margin-top: 25px;
            border-top: 1px solid #eaeaea;
        }
        
        /* Animations */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { 
                opacity: 0;
                transform: translateY(20px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-slide-up {
            animation: slideUp 0.5s ease-out forwards;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="toolzy-form-container">
            <div class="toolzy-form-card animate-slide-up">
                <form id="userForm">
                    <!-- Section informations personnelles -->
                    <div class="form-section-header">
                        <div class="form-icon">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="form-header-text">
                            <h3>Informations personnelles</h3>
                            <p>Remplissez tous les champs requis</p>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-user"></i>
                                Nom
                                <span class="text-danger ms-1">*</span>
                            </label>
                            <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrez le nom de famille" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-user"></i>
                                Prénom
                                <span class="text-danger ms-1">*</span>
                            </label>
                            <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrez le prénom" required>
                        </div>
                        
                        <div class="col-12 mb-3">
                            <label class="form-label">
                                <i class="fas fa-envelope"></i>
                                Adresse e-mail
                                <span class="text-danger ms-1">*</span>
                            </label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="exemple@toolzy.com" required>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-lock"></i>
                                Mot de passe
                                <span class="text-danger ms-1">*</span>
                            </label>
                            <div class="password-container">
                                <input type="password" id="password" name="password" class="form-control" placeholder="••••••••" required
                                       oninput="checkPasswordStrength(); checkPasswordMatch();">
                                <button type="button" class="password-toggle" onclick="togglePassword('password', 'togglePasswordIcon')">
                                    <i id="togglePasswordIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                            <div class="password-strength d-flex align-items-center mt-2" id="passwordStrength">
                                <div class="strength-indicators">
                                    <div class="strength-indicator" id="strength1"></div>
                                    <div class="strength-indicator" id="strength2"></div>
                                    <div class="strength-indicator" id="strength3"></div>
                                    <div class="strength-indicator" id="strength4"></div>
                                </div>
                                <span class="strength-text" id="strengthText"></span>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="form-label">
                                <i class="fas fa-lock"></i>
                                Confirmer le mot de passe
                                <span class="text-danger ms-1">*</span>
                            </label>
                            <div class="password-container">
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" 
                                       placeholder="••••••••" required oninput="checkPasswordMatch()">
                                <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'togglePasswordConfirmIcon')">
                                    <i id="togglePasswordConfirmIcon" class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="password-match" id="passwordMatch">
                                <i id="matchIcon" class="fas"></i>
                                <span id="matchText"></span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Section informations professionnelles -->
                    <div class="form-section-header mt-5">
                        <div class="form-icon" style="background: linear-gradient(135deg, #8E54E9, #FF6B8B);">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <div class="form-header-text">
                            <h3>Informations professionnelles</h3>
                            <p>Définissez le rôle et les responsabilités</p>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-shield-alt"></i>
                                Rôle
                                <span class="text-danger ms-1">*</span>
                            </label>
                            <select id="role" name="role" class="form-select" required>
                                <option value="">Sélectionnez un rôle</option>
                                <option value="admin">🔴 Administrateur</option>
                                <option value="gestionnaire">🟠 Gestionnaire</option>
                                <option value="employe">🟢 Employé</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-id-badge"></i>
                                Poste
                                <span class="text-danger ms-1">*</span>
                            </label>
                            <select id="poste" name="poste" class="form-select" required>
                                <option value="">Sélectionnez un poste</option>
                                <option value="Technicien">💻 Technicien</option>
                                <option value="Superviseur">👨‍💼 Superviseur</option>
                                <option value="Chef de projet">🎯 Chef de projet</option>
                                <option value="Analyste">📊 Analyste</option>
                                <option value="Développeur">⚡ Développeur</option>
                            </select>
                        </div>
                        
                        <div class="col-md-4 mb-3">
                            <label class="form-label">
                                <i class="fas fa-building"></i>
                                Service
                                <span class="text-danger ms-1">*</span>
                            </label>
                            <select id="service" name="service" class="form-select" required>
                                <option value="">Sélectionnez un service</option>
                                <option value="Informatique">🔵 Informatique</option>
                                <option value="Maintenance">🟡 Maintenance</option>
                                <option value="Réseaux">🟣 Réseaux</option>
                                <option value="Support">🟢 Support</option>
                                <option value="Sécurité">🔒 Sécurité</option>
                            </select>
                        </div>
                    </div>
                    
                    <!-- Actions -->
                    <div class="form-actions">
                        <div class="d-grid gap-3 d-md-flex">
                            <button type="submit" id="submitBtn" class="btn btn-toolzy flex-grow-1" disabled>
                                <i class="fas fa-user-plus"></i>
                                Créer l'utilisateur
                            </button>
                            <button type="button" onclick="resetForm()" class="btn btn-reset flex-grow-1">
                                <i class="fas fa-redo"></i>
                                Réinitialiser
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Toggle password visibility
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }

        // Check password strength
        function checkPasswordStrength() {
            const password = document.getElementById('password').value;
            const strengthDiv = document.getElementById('passwordStrength');
            const strengthText = document.getElementById('strengthText');
            const indicators = ['strength1', 'strength2', 'strength3', 'strength4'];
            
            if (password.length === 0) {
                strengthDiv.style.display = 'none';
                return;
            }
            
            strengthDiv.style.display = 'flex';
            
            let strength = 0;
            if (password.length >= 8) strength++;
            if (/[a-z]/.test(password)) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password) || /[^A-Za-z0-9]/.test(password)) strength++;
            
            // Reset all indicators
            indicators.forEach(id => {
                const indicator = document.getElementById(id);
                indicator.style.backgroundColor = '#e9ecef';
            });
            
            // Set active indicators and text
            for (let i = 0; i < strength; i++) {
                const indicator = document.getElementById(indicators[i]);
                if (strength <= 1) {
                    indicator.style.backgroundColor = '#dc3545';
                    strengthText.textContent = 'Faible';
                    strengthText.className = 'strength-text text-danger';
                } else if (strength <= 2) {
                    indicator.style.backgroundColor = '#ffc107';
                    strengthText.textContent = 'Moyen';
                    strengthText.className = 'strength-text text-warning';
                } else {
                    indicator.style.backgroundColor = '#198754';
                    strengthText.textContent = 'Fort';
                    strengthText.className = 'strength-text text-success';
                }
            }
        }

        // Check password match
        function checkPasswordMatch() {
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            const matchDiv = document.getElementById('passwordMatch');
            const matchIcon = document.getElementById('matchIcon');
            const matchText = document.getElementById('matchText');
            
            if (password && confirmPassword) {
                matchDiv.style.display = 'block';
                
                if (password === confirmPassword) {
                    matchDiv.className = 'password-match d-block border border-success bg-success bg-opacity-10 text-success';
                    matchIcon.className = 'fas fa-check-circle';
                    matchText.textContent = 'Les mots de passe correspondent';
                } else {
                    matchDiv.className = 'password-match d-block border border-danger bg-danger bg-opacity-10 text-danger';
                    matchIcon.className = 'fas fa-times-circle';
                    matchText.textContent = 'Les mots de passe ne correspondent pas';
                }
            } else {
                matchDiv.style.display = 'none';
            }
            
            validateForm();
        }

        // Validate form
        function validateForm() {
            const form = document.getElementById('userForm');
            const submitBtn = document.getElementById('submitBtn');
            const requiredFields = form.querySelectorAll('[required]');
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            
            let allValid = true;
            
            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    allValid = false;
                }
            });
            
            if (password !== confirmPassword || !password) {
                allValid = false;
            }
            
            submitBtn.disabled = !allValid;
        }

        // Reset form
        function resetForm() {
            document.getElementById('userForm').reset();
            document.getElementById('passwordStrength').style.display = 'none';
            document.getElementById('passwordMatch').style.display = 'none';
            document.getElementById('submitBtn').disabled = true;
            
            // Reset password visibility
            ['password', 'password_confirmation'].forEach((id, index) => {
                document.getElementById(id).type = 'password';
                const iconId = index === 0 ? 'togglePasswordIcon' : 'togglePasswordConfirmIcon';
                document.getElementById(iconId).className = 'fas fa-eye';
            });
        }

        // Initialize form validation
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('userForm');
            const inputs = form.querySelectorAll('input, select');
            
            inputs.forEach(input => {
                input.addEventListener('input', validateForm);
                input.addEventListener('change', validateForm);
            });
            
            // Form submission
            form.addEventListener('submit', function(e) {
                e.preventDefault();
                
                // Simuler une soumission réussie
                alert('Utilisateur créé avec succès !');
                resetForm();
            });
        });
    </script>
</body>
</html>