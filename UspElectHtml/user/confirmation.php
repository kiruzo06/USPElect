<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>USP Voting System - Confirmation</title>
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

        /* Confirmation Section */
        .confirmation-section {
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

        /* Selected Candidates Container */
        .selected-candidates {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .position-section {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            padding: 40px;
            padding-left: 300px;
            padding-right: 300px;
            margin-bottom: 30px;
        }

        .position-title {
            font-size: 18px;
            font-weight: 700;
            color: darkgreen;
            margin-bottom: 5px;
            border-bottom: 1px solid darkgreen;
        }

        .selected-candidate {
         background-color: rgb(58, 153, 58);
            border-radius: 10px;
            padding: 50px;
            text-align: center;
            transition: transform 0.3s, box-shadow 0.3s;
            justify-content: center;
            display:flex;
            flex-direction: column;
            align-items: center;
        }

        .candidate-image {
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

        .candidate-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .candidate-info {
            flex-grow: 1;
        }

        .candidate-name {
            font-weight: 600;
            color: #ffffffff;
            margin-bottom: 5px;
        }


        .change-btn {
            background-color: lightgreen;
            border: 0px;
            color: green;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s;
        }

        .change-btn:hover {
            background-color: darkgreen;
            color: white;
        }

        /* Submit Button */
        .submit-container {
            text-align: center;
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 20px;
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

        .back-btn {
            background-color: #f0f0f0;
            color: #333;
            border: none;
            border-radius: 30px;
            padding: 14px 40px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .back-btn:hover {
            background-color: #e0e0e0;
        }

        /* Responsive Design */
        @media (max-width: 600px) {
            .confirmation-section {
                padding: 15px;
            }
            
            .container {
                padding: 0 5px;
            }
            
            .modal-buttons{
                height: 40px;
            }
            
            .selected-candidate {
                flex-direction: column;
                text-align: center;
            }
            
            .candidate-image {
                margin-right: 0;
                margin-bottom: 10px;
            }
            
            .submit-container {
                flex-direction: column;
                gap: 10px;
            }
            
            .submit-btn, .back-btn {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
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
        <h1>USP VOTING SYSTEM - CONFIRMATION</h1>
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
            <a href="#" class="nav-item">
                <span class="material-icons">how_to_vote</span>
                Vote Now
            </a>
            <a href="#" class="nav-item active">
                <span class="material-icons">check_circle</span>
                Confirmation
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
        <!-- Confirmation Section -->
        <section class="confirmation-section">
            <h2 class="section-title">CONFIRM YOUR VOTES</h2>
            <p style="margin-bottom: 25px; text-align: center; color: #555;">
                Please review your selections before submitting your votes. You can change your selections if needed.
            </p>
            
            <div class="selected-candidates">
                <!-- Prime Minister Selection -->
                  <h3 class="position-title">PRIME MINISTER</h3>
                <div class="position-section">
                   
                    <div class="selected-candidate">
                        <div class="candidate-image">
                            <img src="../assets/coco.png" alt="DE LA CRUZ, JUAN">
                        </div>
                        <div class="candidate-info">
                            <div class="candidate-name">DE LA CRUZ, JUAN</div>
                        </div>
                        <button class="change-btn">Change Selection</button>
                    </div>
                </div>
                
                <!-- Executive Prime Minister Selection -->
                <h3 class="position-title">EXECUTIVE PRIME MINISTER</h3>
                <div class="position-section">
                    <div class="selected-candidate">
                        <div class="candidate-image">
                            <span class="material-icons">person</span>
                        </div>
                        <div class="candidate-info">
                            <div class="candidate-name">SMITH, JOHN</div>
                        </div>
                        <button class="change-btn">Change Selection</button>
                    </div>
                </div>
                
                <!-- Secretary General Selection -->
                <h3 class="position-title">SECRETARY GENERAL</h3>
                <div class="position-section">
                    <div class="selected-candidate">
                        <div class="candidate-image">
                            <span class="material-icons">person</span>
                        </div>
                        <div class="candidate-info">
                            <div class="candidate-name">WILLIAMS, DAVID</div>
                        </div>
                        <button class="change-btn">Change Selection</button>
                    </div>
                </div>
                
                <!-- Treasurer Selection -->
                 <h3 class="position-title">TREASURER</h3>
                <div class="position-section">
                    <div class="selected-candidate">
                        <div class="candidate-image">
                            <span class="material-icons">person</span>
                        </div>
                        <div class="candidate-info">
                            <div class="candidate-name">WILLIAMS, DAVID</div>
                        </div>
                        <button class="change-btn">Change Selection</button>
                    </div>
                </div>
                
                <!-- Auditor Selection -->
                <h3 class="position-title">AUDITOR</h3>
                <div class="position-section">
                    <div class="selected-candidate">
                        <div class="candidate-image">
                            <span class="material-icons">person</span>
                        </div>
                        <div class="candidate-info">
                            <div class="candidate-name">WILLIAMS, DAVID</div>
                        </div>
                        <button class="change-btn">Change Selection</button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Submit Buttons -->
        <div class="submit-container">
            <button class="back-btn" id="backBtn">BACK TO VOTING</button>
            <button class="submit-btn" id="submitVotes">CONFIRM & SUBMIT VOTES</button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuIcon = document.getElementById('menuIcon');
            const closeIcon = document.getElementById('closeIcon');
            const drawer = document.getElementById('drawer');
            const overlay = document.getElementById('overlay');
            const submitBtn = document.getElementById('submitVotes');
            const backBtn = document.getElementById('backBtn');

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
                // Show success message
                alert('Your votes have been submitted successfully! Thank you for voting.');
                
                // In a real application, you would send the data to a server here
                console.log('Votes submitted successfully');
                
                // Redirect to a thank you page or dashboard
                setTimeout(() => {
                    window.location.href = "dashboard.html";
                }, 1500);
            });
            
            // Back to voting button
            backBtn.addEventListener('click', function() {
                // In a real application, this would go back to the voting page
                window.location.href = "./votepage.php";
            });
            
            // Change selection buttons
            const changeButtons = document.querySelectorAll('.change-btn');
            changeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // In a real application, this would navigate back to the voting page
                    // with the specific position highlighted
                    window.location.href = "./votepage.php";
                });
            });
        });
    </script>
</body>
</html>