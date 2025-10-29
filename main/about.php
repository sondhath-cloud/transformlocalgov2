<?php require_once 'api/track-visitor.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - TransformLocalGov</title>
    <link rel="icon" type="image/png" href="assets/images/TLGLogo.png">
    <link rel="stylesheet" href="styles.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css'>
    
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;800&display=swap");
        
        /* Team Section Container - Isolated Styling */
        .team-section-container {
          background: #ffffff;
          min-height: 100vh;
        }
        
        .team-section-container * {
          margin: 0;
          padding: 0;
          box-sizing: border-box;
        }

        .team-section-container img {
          max-width: 100%;
          display: block;
        }

        .team-section-container ul {
          list-style-type: none;
        }
        .team-section-container ul i {
          color: #333;
          font-size: clamp(0.9rem, 0.825rem + 0.3vw, 1.2rem);
        }
        .team-section-container ul i:hover {
          color: #F39C3D;
        }

        .team-section-container section {
          font-family: "Poppins", sans-serif;
          font-weight: 300;
          font-style: normal;
          padding-block: min(20vh, 6rem);
          text-align: center;
          width: calc(min(90rem, 90%));
          margin-inline: auto;
        }
        .team-section-container section span,
        .team-section-container section p,
        .team-section-container section h2,
        .team-section-container section h3 {
          letter-spacing: 0.035rem;
        }
        .team-section-container section p {
          font-size: 1.4rem;
          line-height: 1.6;
          opacity: 0.95;
          color: #a3a3a3;
          max-width: 800px;
          margin: 0 auto;
        }
        .team-section-container section .bg-watermark {
          color: #f5f5f5;
          font-size: clamp(6rem, 1.3333rem + 14.9333vw, 20rem);
          font-weight: 800;
          position: absolute;
          z-index: -1;
          left: 50%;
          transform: translatex(-50%) translatey(-15%);
          user-select: none;
          letter-spacing: 0.5rem;
        }
        .team-section-container section span {
          text-transform: uppercase;
          display: block;
          font-size: 1.2rem;
          color: #a3a3a3;
        }
        .team-section-container section h2 {
          font-size: 4rem;
          font-weight: 800;
          margin-top: -0.625rem;
          margin-bottom: 2rem;
          line-height: 1.1;
          color: #333;
        }
        .team-section-container section .cards {
          margin-top: 7rem;
          display: grid;
          grid-template-columns: repeat(auto-fit, minmax(min(18rem, 100%), 1fr));
          gap: 2rem;
        }
        @media screen and (min-width: 51rem) {
          .team-section-container section .cards {
            gap: 0;
            padding-bottom: 2.5rem;
          }
        }
        .team-section-container section .cards .card {
          position: relative;
          cursor: pointer;
          min-height: 500px;
          overflow: hidden;
        }
        .team-section-container section .cards .card h3,
        .team-section-container section .cards .card p {
          text-transform: capitalize;
        }
        .team-section-container section .cards .card h3 {
          font-size: clamp(1rem, 0.9167rem + 0.2667vw, 1.25rem);
          font-weight: 400;
          color: #f6f6f6;
          margin-bottom: 0.5rem;
          line-height: 1.3;
        }
        .team-section-container section .cards .card p {
          font-size: clamp(0.85rem, 0.75rem + 0.32vw, 1.15rem);
          letter-spacing: 0.12rem;
          font-weight: 300;
          max-width: 100%;
          line-height: 1.4;
        }
        .team-section-container section .cards .card::before {
          position: absolute;
          content: "";
          width: 5rem;
          height: 6.25rem;
          z-index: 0;
          transition: 0.3s ease-in-out;
          background: #F39C3D;
          background: -webkit-linear-gradient(to left, #F5B05C, #F39C3D);
          background: linear-gradient(to left, #F5B05C, #F39C3D);
          top: -0.375rem;
          left: -0.375rem;
        }
        .team-section-container section .cards .card::after {
          position: absolute;
          inset: 0;
          content: "";
          width: 100%;
          height: 100%;
          background: #232526;
          background: -webkit-linear-gradient(to bottom, rgba(65, 67, 69, 0.2), rgba(8, 8, 8, 0.9));
          background: linear-gradient(to bottom, rgba(65, 67, 69, 0.2), rgba(8, 8, 8, 0.9));
        }
        .team-section-container section .cards .card img {
          filter: grayscale(100%) brightness(1.25);
          transition: 0.5s ease;
          width: 100%;
          height: 100%;
          object-fit: cover;
          object-position: center top;
        }
        .team-section-container section .cards .card-content {
          position: absolute;
          bottom: 0;
          z-index: 99;
          left: 0;
          color: #fff;
          width: 100%;
          padding: 2.5rem 1.25rem 1.875rem;
          text-align: center;
          min-height: 30%;
        }
        .team-section-container section .cards .card-content ul {
          display: flex;
          align-items: center;
          justify-content: center;
          gap: 0.625rem;
          margin-top: 1.25rem;
        }
        .team-section-container section .cards .card:hover img {
          filter: grayscale(0%) brightness(1.25);
        }
        .team-section-container section .cards .card:hover::before {
          transform: scale(1.03);
        }
        .team-section-container section .cards .card:nth-child(1)::before {
          top: -0.375rem;
          left: -0.375rem;
        }
        @media screen and (min-width: 31.25rem) {
          .team-section-container section .cards .card:nth-child(2) {
            transform: translatey(15%);
          }
        }
        .team-section-container section .cards .card:nth-child(2)::before {
          bottom: -0.375rem;
          left: -0.375rem;
          top: auto;
        }
        .team-section-container section .cards .card:nth-child(3)::before {
          top: -0.375rem;
          left: -0.375rem;
        }

        /* Bio Modal Styles */
        .bio-modal {
          display: none;
          position: fixed;
          z-index: 1000;
          left: 0;
          top: 0;
          width: 100%;
          height: 100%;
          background-color: rgba(0, 0, 0, 0.8);
          backdrop-filter: blur(5px);
        }

        .bio-modal-content {
          background-color: #ffffff;
          padding: 2rem;
          border-radius: 15px;
          width: 90%;
          max-width: 600px;
          position: absolute;
          border: 2px solid #F39C3D;
          box-shadow: 0 10px 30px rgba(243, 156, 61, 0.3);
          top: 50%;
          left: 50%;
          transform: translate(-50%, -50%);
        }

        .bio-modal-header {
          display: flex;
          justify-content: space-between;
          align-items: center;
          margin-bottom: 1.5rem;
        }

        .bio-modal h2 {
          color: #333;
          font-size: 2rem;
          margin: 0;
        }

        .bio-modal p {
          color: #a3a3a3;
          font-size: 1rem;
          margin: 0;
        }

        .close {
          color: #F39C3D;
          font-size: 2rem;
          font-weight: bold;
          cursor: pointer;
          transition: color 0.3s ease;
        }

        .close:hover {
          color: #F5B05C;
        }

        .bio-text {
          color: #333;
          line-height: 1.6;
          font-size: 1.1rem;
          margin-bottom: 1.5rem;
        }

        .expertise-tags {
          display: flex;
          flex-wrap: wrap;
          gap: 0.5rem;
          margin-top: 1rem;
        }

        .expertise-tag {
          background: linear-gradient(to left, #F5B05C, #F39C3D);
          color: #fff;
          padding: 0.5rem 1rem;
          border-radius: 20px;
          font-size: 0.9rem;
          font-weight: 500;
        }

        @media (max-width: 768px) {
          .bio-modal-content {
            padding: 1.5rem;
            width: 95%;
            max-height: 90vh; /* Prevent modal from being too tall */
            overflow-y: auto; /* Make it scrollable if needed */
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
          }
          
          .bio-modal h2 {
            font-size: 1.5rem;
          }
          
          .bio-text {
            font-size: 1rem;
          }
          
          .team-section-container section .cards .card {
            min-height: 450px;
          }
          
          .team-section-container section .cards .card-content {
            padding: 2rem 1rem 1.5rem;
            min-height: 25%;
          }
        }
        
        @media (max-width: 480px) {
          .bio-modal-content {
            padding: 1.25rem;
            width: 92%; /* Slightly smaller for tiny screens */
            max-height: 85vh;
          }
          
          .bio-modal h2 {
            font-size: 1.3rem;
          }
          
          .bio-modal-header {
            margin-bottom: 1rem;
          }
          
          .bio-text {
            font-size: 0.95rem;
          }
          
          .expertise-tag {
            font-size: 0.85rem;
            padding: 0.4rem 0.8rem;
          }
          
          .team-section-container section .cards .card {
            min-height: 400px;
          }
          
          .team-section-container section .cards .card-content {
            padding: 1.5rem 0.75rem 1.25rem;
            min-height: 28%;
          }
          
          .team-section-container section .cards .card h3 {
            font-size: clamp(0.9rem, 0.8167rem + 0.2667vw, 1rem);
          }
          
          .team-section-container section .cards .card p {
            font-size: clamp(0.75rem, 0.65rem + 0.32vw, 0.95rem);
          }
        }

        /* Black navigation text */
        .navbar .nav-link {
          color: black !important;
        }
        
        .navbar .logo-text {
          color: black !important;
        }
        
        .navbar .hamburger .bar {
          background-color: black !important;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="index.html" style="text-decoration: none; color: inherit; display: flex; align-items: center; gap: 12px;">
                    <img src="assets/images/TLGLogo.png" alt="TransformLocalGov Logo" style="height: 40px; width: auto;">
                </a>
            </div>
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="facilitation.html" class="nav-link">Facilitation</a>
                </li>
                <li class="nav-item">
                    <a href="digital-adoption.html" class="nav-link no-break">Digital Adoption</a>
                </li>
                <li class="nav-item">
                    <a href="custom-tools.html" class="nav-link">Web/Apps</a>
                </li>
                <li class="nav-item">
                    <a href="services.html" class="nav-link">Services</a>
                </li>
                <li class="nav-item">
                    <a href="resources.html" class="nav-link">Resources</a>
                </li>
                <li class="nav-item">
                    <a href="about.html" class="nav-link active">About</a>
                </li>
                <li class="nav-item">
                    <a href="connect.html" class="nav-link">Contact</a>
                </li>
            </ul>
            <div class="hamburger">
                <span class="bar"></span>
                <span class="bar"></span>
                <span class="bar"></span>
            </div>
        </div>
    </nav>

    <!-- Team Section Container -->
    <div class="team-section-container">
        <section>
            <span>meet our</span>
            <h2>Team</h2>
            <p>Our experienced team of consultants brings decades of combined expertise in organizational transformation, digital adoption, and change management to help local governments thrive.</p>
            <span class="bg-watermark">team</span>
            <div class="cards">
                <div class="card" onclick="openBioModal('hibah')">
                    <img src="assets/images/hibahalt.jpg" alt="Hibah Salah">
                    <div class="card-content">
                        <h3>hibah salah</h3>
                        <p>senior consultant</p>
                    </div>
                </div>
                <div class="card" onclick="openBioModal('sondra')">
                    <img src="assets/images/sondra3.png" alt="Sondra Hathaway">
                    <div class="card-content">
                        <h3>sondra hathaway</h3>
                        <p>founder and principal consultant</p>
                    </div>
                </div>
                <div class="card" onclick="openBioModal('skyler')">
                    <img src="assets/images/Skylerbio.jpg" alt="Skyler Pivonka">
                    <div class="card-content">
                        <h3>skyler pivonka</h3>
                        <p>associate consultant</p>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Logo Slider Section -->
    <div class="hero-logo-slider">
        <div class="logos-container">
            <div class="logo-slider-container">
                <div class="slider">
                    <div class="logos">
                        <img src="assets/logos/cityofamarillo-logo-1024x647.png" alt="Amarillo, TX">
                        <img src="assets/logos/AvondaleAZ.png" alt="Avondale, AZ">
                        <img src="assets/logos/BaltimoreMD.png" alt="Baltimore, MD">
                        <img src="assets/logos/BoulderCounty.png" alt="Boulder County">
                        <img src="assets/logos/CedarParkTX.png" alt="Cedar Park, TX">
                        <img src="assets/logos/City-of-Plano-Logo-with-Tagline.png" alt="City of Plano">
                        <img src="assets/logos/cityofphoenix.png" alt="City of Phoenix">
                        <img src="assets/logos/CromwellCT.png" alt="Cromwell, CT">
                        <img src="assets/logos/DanversMA.png" alt="Danvers, MA">
                        <img src="assets/logos/ennis.png" alt="Ennis">
                        <img src="assets/logos/ErieCO.png" alt="Erie, CO">
                        <img src="assets/logos/FriscoTX.png" alt="Frisco, TX">
                        <img src="assets/logos/GilbertAZ.png" alt="Gilbert, AZ">
                        <img src="assets/logos/GoldenCO.png" alt="Golden, CO">
                        <img src="assets/logos/GY-logo-Letterhead.webp" alt="GY">
                        <img src="assets/logos/JohnsonCountyCO.jpeg" alt="Johnson County, CO">
                        <img src="assets/logos/LaCrosseCountyWI.png" alt="La Crosse County, WI">
                        <img src="assets/logos/LakeElsinoreCA.png" alt="Lake Elsinore, CA">
                        <img src="assets/logos/LoudounCountyVA.png" alt="Loudoun County, VA">
                        <img src="assets/logos/LouisvilleKY.png" alt="Louisville, KY">
                        <img src="assets/logos/MarionCountyOR.png" alt="Marion County, OR">
                        <img src="assets/logos/MebaneSC.png" alt="Mebane, SC">
                        <img src="assets/logos/MonroeCountyFL.png" alt="Monroe County, FL">
                        <img src="assets/logos/OmahaNE.png" alt="Omaha, NE">
                        <img src="assets/logos/PalmdaleCA.png" alt="Palmdale, CA">
                        <img src="assets/logos/PeoriaIL.png" alt="Peoria, IL">
                        <img src="assets/logos/Seal_of_Cleveland,_Ohio.png" alt="Cleveland, OH">
                        <img src="assets/logos/Seal_of_Nashville,_Tennessee.png" alt="Nashville, TN">
                        <img src="assets/logos/WashingtonCountyVA.png" alt="Washington County, VA">
                        <img src="assets/logos/WheatRidgeCO.png" alt="Wheat Ridge, CO">
                        <img src="assets/logos/YamhillCountyOR.png" alt="Yamhill County, OR">
                        <!-- Duplicate for seamless loop -->
                        <img src="assets/logos/cityofamarillo-logo-1024x647.png" alt="Amarillo, TX">
                        <img src="assets/logos/AvondaleAZ.png" alt="Avondale, AZ">
                        <img src="assets/logos/BaltimoreMD.png" alt="Baltimore, MD">
                        <img src="assets/logos/BoulderCounty.png" alt="Boulder County">
                        <img src="assets/logos/CedarParkTX.png" alt="Cedar Park, TX">
                        <img src="assets/logos/City-of-Plano-Logo-with-Tagline.png" alt="City of Plano">
                        <img src="assets/logos/cityofphoenix.png" alt="City of Phoenix">
                        <img src="assets/logos/CromwellCT.png" alt="Cromwell, CT">
                        <img src="assets/logos/DanversMA.png" alt="Danvers, MA">
                        <img src="assets/logos/ennis.png" alt="Ennis">
                        <img src="assets/logos/ErieCO.png" alt="Erie, CO">
                        <img src="assets/logos/FriscoTX.png" alt="Frisco, TX">
                        <img src="assets/logos/GilbertAZ.png" alt="Gilbert, AZ">
                        <img src="assets/logos/GoldenCO.png" alt="Golden, CO">
                        <img src="assets/logos/GY-logo-Letterhead.webp" alt="GY">
                        <img src="assets/logos/JohnsonCountyCO.jpeg" alt="Johnson County, CO">
                        <img src="assets/logos/LaCrosseCountyWI.png" alt="La Crosse County, WI">
                        <img src="assets/logos/LakeElsinoreCA.png" alt="Lake Elsinore, CA">
                        <img src="assets/logos/LoudounCountyVA.png" alt="Loudoun County, VA">
                        <img src="assets/logos/LouisvilleKY.png" alt="Louisville, KY">
                        <img src="assets/logos/MarionCountyOR.png" alt="Marion County, OR">
                        <img src="assets/logos/MebaneSC.png" alt="Mebane, SC">
                        <img src="assets/logos/MonroeCountyFL.png" alt="Monroe County, FL">
                        <img src="assets/logos/OmahaNE.png" alt="Omaha, NE">
                        <img src="assets/logos/PalmdaleCA.png" alt="Palmdale, CA">
                        <img src="assets/logos/PeoriaIL.png" alt="Peoria, IL">
                        <img src="assets/logos/Seal_of_Cleveland,_Ohio.png" alt="Cleveland, OH">
                        <img src="assets/logos/Seal_of_Nashville,_Tennessee.png" alt="Nashville, TN">
                        <img src="assets/logos/WashingtonCountyVA.png" alt="Washington County, VA">
                        <img src="assets/logos/WheatRidgeCO.png" alt="Wheat Ridge, CO">
                        <img src="assets/logos/YamhillCountyOR.png" alt="Yamhill County, OR">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Logo Slider CSS -->
    <style>
        .hero-logo-slider {
            background: #ffffff;
            padding: 3rem 0;
            overflow: hidden;
            margin: 2rem 0;
            display: block; /* Show by default on larger screens */
        }

        .logos-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .logo-slider-container {
            position: relative;
            width: 100%;
        }

        .slider {
            overflow: hidden;
            width: 100%;
        }

        .logos {
            display: flex;
            animation: slide 30s linear infinite;
            gap: 6rem; /* Increased again for more spacing */
        }

        .logos img {
            height: 120px !important; /* Increased again for larger logos */
            width: auto !important;
            object-fit: contain;
            flex-shrink: 0;
            opacity: 1;
        }

        /* Make specific logos have transparent backgrounds */
        .logos img[alt*="Avondale"],
        .logos img[alt*="Phoenix"] {
            background: transparent !important;
            mix-blend-mode: multiply;
        }

        @keyframes slide {
            0% {
                transform: translateX(0);
            }
            100% {
                transform: translateX(-50%);
            }
        }

        /* Responsive adjustments */
        @media (max-width: 1024px) {
            .hero-logo-slider {
                display: none; /* Hide slider on tablets and smaller */
            }
        }

        @media (max-width: 768px) {
            .hero-logo-slider {
                display: none; /* Hide slider on mobile devices */
            }
        }

        @media (max-width: 480px) {
            .hero-logo-slider {
                display: none; /* Hide slider on small mobile devices */
            }
        }
    </style>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-text">
                    <p>© 2025 TransformLocalGov. All rights reserved.</p>
                    <p>Email: hello@transformlocalgov.com | Phone: 01-602-380-7231</p>
                </div>
                <div class="social-links">
                    <a href="https://www.linkedin.com/in/sondrahathaway/" target="_blank" rel="noopener noreferrer" class="social-link">LinkedIn</a>
                    <a href="https://github.com/sondhath-cloud" target="_blank" rel="noopener noreferrer" class="social-link">GitHub</a>
                    <a href="https://www.youtube.com/@transformlocalgov" target="_blank" rel="noopener noreferrer" class="social-link">YouTube</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bio Modals -->
    <div id="sondraModal" class="bio-modal">
        <div class="bio-modal-content">
            <div class="bio-modal-header">
                <div>
                    <h2>Sondra Hathaway</h2>
                    <p>Founder and Principal Consultant</p>
                </div>
                <span class="close" onclick="closeBioModal('sondra')">×</span>
            </div>
            <div class="bio-text">
                With over 20 years of experience in organizational development, Sondra leads organizations through change to successfully transform. Sondra holds degrees in business administration, psychology, and sociology. She is a certified Manager of Quality and Organizational Excellence and Prosci Change Practitioner.
            </div>
            <div class="expertise-tags">
                <span class="expertise-tag">Change Management</span>
                <span class="expertise-tag">Strategic Planning</span>
                <span class="expertise-tag">Digital Adoption</span>
                <span class="expertise-tag">Organizational Development</span>
                <span class="expertise-tag">Process Improvement</span>
            </div>
        </div>
    </div>

    <div id="hibahModal" class="bio-modal">
        <div class="bio-modal-content">
            <div class="bio-modal-header">
                <div>
                    <h2>Hibah Salah</h2>
                    <p>Senior Consultant</p>
                </div>
                <span class="close" onclick="closeBioModal('hibah')">×</span>
            </div>
            <div class="bio-text">
                Hibah Salah is a dedicated Senior Consultant at TransformLocalGov, specializing in data analysis, system implementation, and stakeholder engagement. With a strong background in public administration and a keen eye for detail, Hibah helps clients navigate complex data environments and optimize their digital tools for maximum impact.
            </div>
            <div class="expertise-tags">
                <span class="expertise-tag">Data Analysis</span>
                <span class="expertise-tag">System Implementation</span>
                <span class="expertise-tag">Stakeholder Engagement</span>
                <span class="expertise-tag">Business Process Mapping</span>
                <span class="expertise-tag">User Training</span>
            </div>
        </div>
    </div>

    <div id="skylerModal" class="bio-modal">
        <div class="bio-modal-content">
            <div class="bio-modal-header">
                <div>
                    <h2>Skyler Pivonka</h2>
                    <p>Associate Consultant</p>
                </div>
                <span class="close" onclick="closeBioModal('skyler')">×</span>
            </div>
            <div class="bio-text">
                Skyler Pivonka is an enthusiastic Associate Consultant at TransformLocalGov, bringing fresh perspectives and a passion for technology-driven solutions. Skyler supports project teams in various capacities, including research, content development, and client support, ensuring smooth project execution and client satisfaction.
            </div>
            <div class="expertise-tags">
                <span class="expertise-tag">Research and Analysis</span>
                <span class="expertise-tag">Content Development</span>
                <span class="expertise-tag">Client Support</span>
                <span class="expertise-tag">Technology Adoption</span>
                <span class="expertise-tag">Communication</span>
            </div>
        </div>
    </div>

    <script>
        function openBioModal(member) {
            document.getElementById(member + 'Modal').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent background scrolling
        }

        function closeBioModal(member) {
            document.getElementById(member + 'Modal').style.display = 'none';
            document.body.style.overflow = 'auto'; // Restore scrolling
        }

        // Close modal when clicking outside of it
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.bio-modal');
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            });
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                const modals = document.querySelectorAll('.bio-modal');
                modals.forEach(modal => {
                    if (modal.style.display === 'block') {
                        modal.style.display = 'none';
                        document.body.style.overflow = 'auto';
                    }
                });
            }
        });
    </script>
</body>
</html>