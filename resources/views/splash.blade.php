<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - TaskFlow</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/particles.js/2.0.0/particles.min.js"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Figtree', sans-serif;
            overflow-x: hidden;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }

        #particles-js {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            z-index: 1;
        }

        .scroll-container {
            position: relative;
            z-index: 2;
            height: 500vh;
        }

        .scroll-section {
            position: sticky;
            top: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            overflow: hidden;
        }

        .content-wrapper {
            text-align: center;
            max-width: 1200px;
            width: 100%;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .step {
            position: absolute;
            opacity: 0;
            transition: opacity 0.8s ease;
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }

        .step.active {
            opacity: 1;
        }

        .step-text h1 {
            font-size: clamp(2rem, 5vw, 3.5rem);
            font-weight: 700;
            margin-bottom: 1rem;
            color: #1f2937;
            line-height: 1.2;
        }

        .step-text p {
            font-size: clamp(1rem, 2vw, 1.5rem);
            color: #4b5563;
            margin-bottom: 3rem;
        }

        .visual-container {
            width: 100%;
            max-width: 700px;
            height: 450px;
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Step 1: Messy Cards */
        .messy-cards {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .task-card {
            position: absolute;
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            min-width: 200px;
            transition: all 1.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .task-card.messy {
            transform: rotate(var(--rotate)) translateX(var(--tx)) translateY(var(--ty));
        }

        .task-card.organized {
            transform: rotate(0deg) translateX(0) translateY(var(--organized-y));
            left: 50% !important;
            margin-left: -125px;
            width: 250px;
        }

        .task-card h3 {
            font-size: 1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .task-card .deadline {
            font-size: 0.875rem;
            color: #ef4444;
            font-weight: 500;
        }

        /* Step 3: Calendar */
        .calendar-view {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }

        .calendar-header {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #1f2937;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 0.5rem;
        }

        .calendar-day {
            aspect-ratio: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 8px;
            font-size: 0.875rem;
            color: #6b7280;
        }

        .calendar-day.highlight {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6, #10b981);
            color: white;
            font-weight: 600;
        }

        /* Step 4: Achievement Badge */
        .achievement-badge {
            background: white;
            padding: 3rem;
            border-radius: 50%;
            width: 250px;
            height: 250px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 40px rgba(0,0,0,0.15);
            animation: pulse-glow 2s infinite;
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 10px 40px rgba(59, 130, 246, 0.3); }
            50% { box-shadow: 0 10px 60px rgba(139, 92, 246, 0.5); }
        }

        .achievement-icon {
            font-size: 5rem;
            margin-bottom: 1rem;
        }

        .achievement-text {
            font-size: 1.25rem;
            font-weight: 600;
            color: #1f2937;
        }

        /* Step 5: Call to Action */

        .action-buttons {
            display: flex;
            gap: 1.5rem;
            margin-top: 2rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .btn {
            padding: 1.25rem 3rem;
            border-radius: 12px;
            font-weight: 600;
            font-size: 1.125rem;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            display: inline-block;
        }

        .btn-primary {
            background: linear-gradient(135deg, #3b82f6, #8b5cf6);
            color: white;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
        }

        .btn-secondary {
            background: white;
            color: #3b82f6;
            border: 2px solid #3b82f6;
        }

        .btn-secondary:hover {
            background: #3b82f6;
            color: white;
        }

        @media (max-width: 768px) {
            .step-text h1 {
                font-size: 2rem;
            }
            
            .step-text p {
                font-size: 1rem;
            }

            .visual-container {
                height: 300px;
            }
        }
    </style>
</head>
<body>
    <div id="particles-js"></div>
    
    <div class="scroll-container">
        <div class="scroll-section">
            <div class="content-wrapper">
                <!-- Step 1: Messy Tasks -->
                <div class="step" id="step1">
                    <div class="step-text">
                        <h1>Banyak tugas? Deadline menumpuk?</h1>
                        <p>Tugas kuliah terasa kacau dan berantakan.</p>
                    </div>
                    <div class="visual-container">
                        <div class="messy-cards" id="taskCards">
                            <div class="task-card messy" style="--rotate: -15deg; --tx: -80px; --ty: -40px; top: 20%; left: 15%;">
                                <h3>Revisi Bab 3</h3>
                                <p class="deadline">Deadline: Minggu Ini</p>
                            </div>
                            <div class="task-card messy" style="--rotate: 20deg; --tx: 60px; --ty: 30px; top: 35%; right: 10%;">
                                <h3>Deadline Besok!</h3>
                                <p class="deadline">⚠️ Urgent</p>
                            </div>
                            <div class="task-card messy" style="--rotate: -8deg; --tx: -20px; --ty: 50px; bottom: 25%; left: 25%;">
                                <h3>Tugas Kelompok</h3>
                                <p class="deadline">Belum Mulai</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Organized Flow -->
                <div class="step" id="step2">
                    <div class="step-text">
                        <h1>TaskFlow Mengatur Aliran Kerjamu</h1>
                        <p>Semua tugas terorganisir dengan rapi dalam satu tempat.</p>
                    </div>
                    <div class="visual-container">
                        <div class="messy-cards" id="organizedCards">
                            <div class="task-card organized" style="--organized-y: 0px;">
                                <h3>✓ Revisi Bab 3</h3>
                                <p class="deadline">Selesai</p>
                            </div>
                            <div class="task-card organized" style="--organized-y: 100px;">
                                <h3>□ Deadline Besok!</h3>
                                <p class="deadline">Dalam Progress</p>
                            </div>
                            <div class="task-card organized" style="--organized-y: 200px;">
                                <h3>□ Tugas Kelompok</h3>
                                <p class="deadline">Terjadwal</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Calendar -->
                <div class="step" id="step3">
                    <div class="step-text">
                        <h1>Fokus pada yang Terpenting</h1>
                        <p>Lihat semua deadline dalam satu pandangan.</p>
                    </div>
                    <div class="visual-container">
                        <div class="calendar-view">
                            <div class="calendar-header">November 2025</div>
                            <div class="calendar-grid">
                                <div class="calendar-day">M</div>
                                <div class="calendar-day">T</div>
                                <div class="calendar-day">W</div>
                                <div class="calendar-day">T</div>
                                <div class="calendar-day">F</div>
                                <div class="calendar-day">S</div>
                                <div class="calendar-day">S</div>
                                <div class="calendar-day">1</div>
                                <div class="calendar-day">2</div>
                                <div class="calendar-day highlight">3</div>
                                <div class="calendar-day">4</div>
                                <div class="calendar-day">5</div>
                                <div class="calendar-day">6</div>
                                <div class="calendar-day">7</div>
                                <div class="calendar-day">8</div>
                                <div class="calendar-day">9</div>
                                <div class="calendar-day">10</div>
                                <div class="calendar-day">11</div>
                                <div class="calendar-day highlight">12</div>
                                <div class="calendar-day">13</div>
                                <div class="calendar-day">14</div>
                                <div class="calendar-day">15</div>
                                <div class="calendar-day">16</div>
                                <div class="calendar-day highlight">17</div>
                                <div class="calendar-day">18</div>
                                <div class="calendar-day">19</div>
                                <div class="calendar-day">20</div>
                                <div class="calendar-day">21</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4: Achievement -->
                <div class="step" id="step4">
                    <div class="step-text">
                        <h1>Raih Prestasimu</h1>
                        <p>Selesaikan tugas dan capai targetmu.</p>
                    </div>
                    <div class="visual-container">
                        <div class="achievement-badge">
                            <div class="achievement-icon">🏆</div>
                            <div class="achievement-text">100% Selesai</div>
                        </div>
                    </div>
                </div>

                <!-- Step 5: Call to Action -->
                <div class="step" id="step5">
                    <div class="step-text">
                        <h1>Platform Manajemen Tugas #1 untuk Mahasiswa</h1>
                        <p>Mulai perjalananmu menuju produktivitas yang lebih baik.</p>
                    </div>
                    <div class="action-buttons">
                        <a href="{{ route('register') }}" class="btn btn-primary">Daftar Sekarang</a>
                        <a href="{{ route('login') }}" class="btn btn-secondary">Sudah Punya Akun?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Initialize Particles.js
        particlesJS('particles-js', {
            particles: {
                number: { value: 80, density: { enable: true, value_area: 800 } },
                color: { value: ['#3b82f6', '#8b5cf6', '#10b981'] },
                shape: { type: 'circle' },
                opacity: { value: 0.5, random: false },
                size: { value: 3, random: true },
                line_linked: {
                    enable: true,
                    distance: 150,
                    color: '#3b82f6',
                    opacity: 0.3,
                    width: 1
                },
                move: {
                    enable: true,
                    speed: 2,
                    direction: 'right',
                    random: false,
                    straight: false,
                    out_mode: 'out',
                    bounce: false
                }
            },
            interactivity: {
                detect_on: 'canvas',
                events: {
                    onhover: { enable: true, mode: 'repulse' },
                    onclick: { enable: false },
                    resize: true
                },
                modes: {
                    repulse: { distance: 100, duration: 0.4 }
                }
            },
            retina_detect: true
        });

        // Scrollytelling Logic
        let currentStep = 1;
        const totalSteps = 5;

        function updateSteps() {
            const scrollPercentage = window.scrollY / (document.body.scrollHeight - window.innerHeight);
            const newStep = Math.min(Math.ceil(scrollPercentage * totalSteps) || 1, totalSteps);
            
            if (newStep !== currentStep) {
                document.getElementById(`step${currentStep}`).classList.remove('active');
                currentStep = newStep;
                document.getElementById(`step${currentStep}`).classList.add('active');
                
                // Trigger card animation for step 2
                if (currentStep === 2) {
                    const cards = document.querySelectorAll('#organizedCards .task-card');
                    cards.forEach(card => {
                        card.classList.remove('messy');
                        card.classList.add('organized');
                    });
                }
            }

            // Update particle speed based on scroll
            if (window.pJSDom && window.pJSDom[0]) {
                const baseSpeed = 2;
                const scrollSpeed = Math.min(scrollPercentage * 3, 2);
                window.pJSDom[0].pJS.particles.move.speed = baseSpeed + scrollSpeed;
            }
        }

        // Initialize
        document.getElementById('step1').classList.add('active');
        
        // Scroll listener with throttle
        let ticking = false;
        window.addEventListener('scroll', () => {
            if (!ticking) {
                window.requestAnimationFrame(() => {
                    updateSteps();
                    ticking = false;
                });
                ticking = true;
            }
        });
    </script>
</body>
</html>