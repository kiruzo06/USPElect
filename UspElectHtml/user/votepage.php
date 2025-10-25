<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USP Voting System</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            background: linear-gradient(to bottom, #c9f1c9ff, #f6fff6ff , #c9f1c9ff );
            color: #333;
            line-height: 1.6;
            transition: margin-left 0.3s;
        }

        /* Navigation */
        .navbar {
            background-color: green;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
            display: flex;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .navbar .material-icons {
            color: #ffffff;
            margin-right: 10px;
            font-size: 24px;
            cursor: pointer;
        }

        .navbar h1 {
            font-size: 20px;
            font-weight: 600;
            color: #ffffff;
        }

        /* Drawer */
        .drawer {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 200;
            top: 0;
            left: 0;
            background-color: #fff;
            overflow-x: hidden;
            transition: 0.3s;
            box-shadow: 2px 0 10px rgba(0, 0, 0, 0.1);
        }

        .drawer.open {
            width: 280px;
        }

        .drawer-header {
            background-color: green;
            padding: 20px;
            display: flex;
            align-items: center;
            color: white;
        }

        .drawer-header .material-icons {
            margin-right: 15px;
            cursor: pointer;
        }

        .drawer-profile {
            display: flex;
            align-items: center;
            padding: 20px;
            border-bottom: 1px solid #e2e8f0;
        }


        .profile-image {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
            color: #718096;
        }

        .profile-info h3 {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .profile-info p {
            font-size: 14px;
            color: #718096;
        }

        .drawer-nav {
            padding: 20px 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            padding: 12px 20px;
            color: #4a5568;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .nav-item:hover {
            background-color: #f7fafc;
        }

        .nav-item.active {
            background-color: #6ad17bff;
            color: green;
            border-left: 4px solid green;
        }

        .nav-item .material-icons {
            margin-right: 15px;
            font-size: 20px;
        }

         /* Modal background (hidden by default) */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        display: none; /* hidden */
        justify-content: center;
        align-items: center;
        z-index: 1000;
    }

    /* Modal box */
    .modal {
        color: darkgreen;
        background: white;
        padding: 20px;
        border-radius: 10px;
        width: 300px;
        text-align: center;
        box-shadow: 0 0 15px rgba(0,0,0,0.2);
    }

    .modal h2 {
        margin-bottom: 20px;
        font-size: 18px;
    }

    .modal-buttons {
        display: flex;
        justify-content: space-around;
    }

    .btn {
        padding: 8px 20px;
        border: none;
        border-radius: 15px;
        cursor: pointer;
        font-weight: bold;
    }

    .btn-yes {
        background-color: darkgreen;
        color: white;
    }

    .btn-no {
        background-color: #da392d;
        color: white;
    }

    .btn-yes:hover {
        background-color: rgb(0, 59, 0);
    }

    .btn-no:hover {
        background-color: #9b2118;
    }

        /* Overlay */
        .overlay {
            display: none;
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 150;
        }

        .overlay.active {
            display: block;
        }

        /* Main Container */
        .container {
            max-width: 1000px;
            margin: 30px auto;
            padding: 10px auto;
            transition: margin-left 0.3s;
        }

        /* Voting Sections */
        .voting-section {
            background-color: lightgreen;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 40px;
            margin-bottom: 30px;
        }

        .section-title {
            font-size: 22px;
            font-weight: 600;
            color: rgba(6, 66, 19, 1);
            margin-bottom: 25px;
            padding-bottom: 10px;
            border-bottom: 1px solid #003b14;
        }

        /* Candidates Grid */
        .candidates-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(220px, max-content));
            gap: 25px;
            justify-content: center;
            align-items:stretch;
        }

        /* Candidate Card */
        .candidate-card {
            background-color: rgb(58, 153, 58);
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            justify-content: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .candidate-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
        }

        .image-placeholder img {
            width: 145px;
            height: 145px;
            background-color: #e2e8f0;
            border-radius: 8px;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #718096;
            overflow: hidden;
            object-fit: contain;
        }

        .candidate-name {
            font-weight: 600;
            color: rgb(255, 255, 255);
            margin-bottom: 15px;
            font-size: 16px;

        }

        .vote-option {
            display: flex;
            flex-direction: column;
            align-items: center;
           
        }

        .vote-label {
            display: flex;
            align-items: center;
            cursor: pointer;
            margin-top: 5px;
            color: rgb(255, 255, 255);  
            accent-color: green;
        }

        .vote-label input {
            margin-right: 8px;
            cursor: pointer;
        }

        /* Divider */
        .divider {
            height: 1px;
            background-color: #e2e8f0;
            margin: 30px 0;
        }

        /* Submit Button */
        .submit-container {
            text-align: center;
            margin-top: 30px;
        }

        .submit-btn {
            background-color: green;
            color: white;
            border: none;
            border-radius: 30px;
            padding: 14px 40px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .submit-btn:hover {
            background-color: darkgreen;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .candidates-grid {
                grid-template-columns: repeat(auto-fill, minmax(160px, max-content));
                gap: 5px;
            }
            
            .voting-section {
                padding: 15px;
            }
            
            .container {
                padding: 0 5px;
            }
            .modal-buttons{
                height: 40px;

            }
            .candidate-name{
                font-size: 15px;
            }
            .vote-label{
                transform: scale(1.3);
            }
        }

        @media (max-width: 480px) {
            .candidates-grid {
                grid-template-columns: 1fr 1fr;
            }
            
            .navbar {
                padding: 15px 20px;
            }
            
            .navbar h1 {
                font-size: 18px;
            }
            
            .drawer.open {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <span class="material-icons" id="menuIcon">menu</span>
        <h1>USP VOTING SYSTEM</h1>
    </nav>

    <!-- Drawer -->
    <div class="drawer" id="drawer">
        <div class="drawer-header">
            <span class="material-icons" id="closeIcon">close</span>
            <h2>Navigation</h2>
        </div>
        <div class="drawer-profile">
            <div class="profile-image">
                <span class="material-icons">person</span>
            </div>
            <div class="profile-info">
                <h3>John Voter</h3>
                <p>Voter ID: USP2023001</p>
            </div>
        </div>
        <div class="drawer-nav">
            <a href="#" class="nav-item">
                <span class="material-icons">dashboard</span>
                Dashboard
            </a>
            <a href="#" class="nav-item active">
                <span class="material-icons">how_to_vote</span>
                Vote Now
            </a>
            <a href="#" class="nav-item">
                <span class="material-icons">history</span>
                Voting History
            </a>
            <a href="#" class="nav-item">
                <span class="material-icons">info</span>
                Election Info
            </a>
            <a href="#" class="nav-item">
                <span class="material-icons">help</span>
                Help & Support
            </a>
            <a href="#" class="nav-item">
                <span class="material-icons">settings</span>
                Settings
            </a>
            <a href="#" class="nav-item" id="logoutLink">
                <span class="material-icons">logout</span>
                Logout
            </a>

        <!-- Modal -->
        <div class="modal-overlay" id="logoutModal">
            <div class="modal">
                <h2>Are you sure you want to logout?</h2>
                <div class="modal-buttons">
                    <button class="btn btn-yes" id="confirmLogout">Yes</button>
                    <button class="btn btn-no" id="cancelLogout">No</button>
                </div>
            </div>
        </div>

        </div>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Main Content -->
    <div class="container" id="mainContent">
        <!-- Prime Minister Section -->
        <section class="voting-section">
            <h2 class="section-title">PRIME MINISTER</h2>
            <div class="candidates-grid">
                <!-- Candidate 1 -->
                <div class="candidate-card">
                    <div class="image-placeholder">
                        <img src="../assets/coco.png">
                    </div>
                    <div class="candidate-name">DE LA CRUZ, JUAN</div>
                    <div class="vote-option">
                        <label class="vote-label">
                            <input type="radio" name="prime-minister" value="DE LA CRUZ, JUAN">
                            VOTE
                        </label>
                    </div>
                </div>

                <!-- Candidate 2 -->
                <div class="candidate-card">
                    <div class="image-placeholder">
                         <img src="../assets/ponchi.png">
                    </div>
                    <div class="candidate-name">Ponchi</div>
                    <div class="vote-option">
                        <label class="vote-label">
                            <input type="radio" name="prime-minister" value="Ponchi">
                            VOTE
                        </label>
                    </div>
                </div>

                <!-- Candidate 3 -->
                <div class="candidate-card">
                    <div class="image-placeholder">
                       <img src="../assets/eyy.jpg">
                    </div>
                    <div class="candidate-name">GONZALEZ, MARIA</div>
                    <div class="vote-option">
                        <label class="vote-label">
                            <input type="radio" name="prime-minister" value="GONZALEZ, MARIA">
                            VOTE
                        </label>
                    </div>
                </div>
            </div>
        </section>

        <!-- Divider -->
        <div class="divider"></div>

        <!-- Executive Prime Minister Section -->
        <section class="voting-section">
            <h2 class="section-title">EXECUTIVE PRIME MINISTER</h2>
            <div class="candidates-grid">
                <!-- Candidate 1 -->
                <div class="candidate-card">
                    <div class="image-placeholder">
                      <span class="material-icons">person</span>
                    </div>
                    <div class="candidate-name">SMITH, JOHN</div>
                    <div class="vote-option">
                        <label class="vote-label">
                            <input type="radio" name="executive-prime-minister" value="SMITH, JOHN">
                            VOTE
                        </label>
                    </div>
                </div>
                

                <!-- Candidate 2 -->
                <div class="candidate-card">
                    <div class="image-placeholder">
                        <span class="material-icons">person</span>
                    </div>
                    <div class="candidate-name">JOHNSON, LISA</div>
                    <div class="vote-option">
                        <label class="vote-label">
                            <input type="radio" name="executive-prime-minister" value="JOHNSON, LISA">
                            VOTE
                        </label>
                    </div>
                </div>
            </div>
        </section>

         <!-- Divider -->
        <div class="divider"></div>

         <section class="voting-section">
            <h2 class="section-title">SECRETARY GENERAL</h2>
            <div class="candidates-grid">
                <!-- Candidate 1 -->
                <div class="candidate-card">
                    <div class="image-placeholder">
                        <span class="material-icons">person</span>
                    </div>
                    <div class="candidate-name">WILLIAMS, DAVID</div>
                    <div class="vote-option">
                        <label class="vote-label">
                            <input type="radio" name="secretary-general" value="WILLIAMS, DAVID">
                            VOTE
                        </label>
                    </div>
                </div>

                <!-- Candidate 2 -->
                <div class="candidate-card">
                    <div class="image-placeholder">
                        <span class="material-icons">person</span>
                    </div>
                    <div class="candidate-name">JOHNSON, LISA</div>
                    <div class="vote-option">
                        <label class="vote-label">
                            <input type="radio" name="secretary-general" value="JOHNSON, LISA">
                            VOTE
                        </label>
                    </div>
                </div>
            </div>
        </section>

         <!-- Divider -->
        <div class="divider"></div>

         <section class="voting-section">
            <h2 class="section-title">TREASURER</h2>
            <div class="candidates-grid">
                <!-- Candidate 1 -->
                <div class="candidate-card">
                    <div class="image-placeholder">
                        <span class="material-icons">person</span>
                    </div>
                    <div class="candidate-name">WILLIAMS, DAVID</div>
                    <div class="vote-option">
                        <label class="vote-label">
                            <input type="radio" name="treasurer" value="WILLIAMS, DAVID">
                            VOTE
                        </label>
                    </div>
                </div>

                <!-- Candidate 2 -->
                <div class="candidate-card">
                    <div class="image-placeholder">
                        <span class="material-icons">person</span>
                    </div>
                    <div class="candidate-name">JOHNSON, LISA</div>
                    <div class="vote-option">
                        <label class="vote-label">
                            <input type="radio" name="treasurer" value="JOHNSON, LISA">
                            VOTE
                        </label>
                    </div>
                </div>
            </div>
        </section>

         <!-- Divider -->
        <div class="divider"></div>

         <section class="voting-section">
            <h2 class="section-title">AUDITOR</h2>
            <div class="candidates-grid">
                <!-- Candidate 1 -->
                <div class="candidate-card">
                    <div class="image-placeholder">
                        <span class="material-icons">person</span>
                    </div>
                    <div class="candidate-name">WILLIAMS, DAVID</div>
                    <div class="vote-option">
                        <label class="vote-label">
                            <input type="radio" name="auditor" value="WILLIAMS, DAVID">
                            VOTE
                        </label>
                    </div>
                </div>

                <!-- Candidate 2 -->
                <div class="candidate-card">
                    <div class="image-placeholder">
                        <span class="material-icons">person</span>
                    </div>
                    <div class="candidate-name">JOHNSON, LISA</div>
                    <div class="vote-option">
                        <label class="vote-label">
                            <input type="radio" name="auditor" value="JOHNSON, LISA">
                            VOTE
                        </label>
                    </div>
                </div>
            </div>
        </section>

        <!-- Submit Button -->
        <div class="submit-container">
            <button class="submit-btn" id="submitVotes">SUBMIT VOTES</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuIcon = document.getElementById('menuIcon');
            const closeIcon = document.getElementById('closeIcon');
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('overlay');
            const submitBtn = document.getElementById('submitVotes');

            // Open drawer
            menuIcon.addEventListener('click', function() {
                drawer.classList.add('open');
                overlay.classList.add('active');
                document.body.style.overflow = 'hidden';
            });


            //Modal
            const logoutLink = document.getElementById('logoutLink');
            const logoutModal = document.getElementById('logoutModal');
            const cancelLogout = document.getElementById('cancelLogout');
            const confirmLogout = document.getElementById('confirmLogout');

            // Show modal when logout is clicked
            logoutLink.addEventListener('click', (e) => {
                e.preventDefault();
                logoutModal.style.display = 'flex';
            });

            // Hide modal when clicking "No"
            cancelLogout.addEventListener('click', () => {
                logoutModal.style.display = 'none';
            });

            // Simulate logout action when clicking "Yes"
            confirmLogout.addEventListener('click', () => {
                logoutModal.style.display = 'none';
               window.location.href = "../index.php";

            });

            // Close drawer
            function closeDrawer() {
                drawer.classList.remove('open');
                overlay.classList.remove('active');
                document.body.style.overflow = 'auto';
            }
            
            closeIcon.addEventListener('click', closeDrawer);
            overlay.addEventListener('click', closeDrawer);

            // Submit votes
            submitBtn.addEventListener('click', function() {
                // Check if at least one candidate is selected in each section
                const primeMinisterSelected = document.querySelector('input[name="prime-minister"]:checked');
                const executivePrimeMinisterSelected = document.querySelector('input[name="executive-prime-minister"]:checked');
                const secretaryGeneralSelected = document.querySelector('input[name="secretary-general"]:checked');
                const treasurerSelected = document.querySelector('input[name="treasurer"]:checked');
                const auditorSelected = document.querySelector('input[name="auditor"]:checked');
                
                if (!primeMinisterSelected || !executivePrimeMinisterSelected || !secretaryGeneralSelected || !treasurerSelected || !auditorSelected) {
                    alert('Please select one candidate for each position before submitting.');
                    return;
                }

                 window.location.href = "./confirmation.php";
                
                // In a real application, you would send the data to a server here
                console.log('Prime Minister vote:', primeMinisterSelected.value);
                console.log('Executive Prime Minister vote:', executivePrimeMinisterSelected.value);
                console.log('Secretary General vote:', secretaryGeneralSelected.value);
                console.log('Treasurer vote:', treasurerSelected.value);
                console.log('Auditor vote:', auditorSelected.value);
            });
        });
    </script>
</body>
</html>