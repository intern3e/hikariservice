<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hikari Denki - ผู้เชี่ยวชาญด้านระบบไฟฟ้า</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', 'Sarabun', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            overflow-x: hidden;
        }

        /* Header */
        header {
            background: rgba(255, 255, 255, 0.98);
            padding: 1.5rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 20px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }

        header.scrolled {
            padding: 1rem 0;
            background: rgba(255, 255, 255, 1);
        }

        nav {
            max-width: 1400px;
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 3rem;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 700;
            color: #0047AB;
            display: flex;
            align-items: center;
            gap: 0.8rem;
        }

        .logo-circle {
            width: 45px;
            height: 45px;
            background: linear-gradient(135deg, #0047AB, #0066FF);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 1.5rem;
        }

        nav ul {
            list-style: none;
            display: flex;
            gap: 2.5rem;
            align-items: center;
        }

        nav a {
            color: #333;
            text-decoration: none;
            font-weight: 500;
            font-size: 1rem;
            transition: color 0.3s;
            position: relative;
        }

        nav a:hover {
            color: #0047AB;
        }

        nav a::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: #0047AB;
            transition: width 0.3s;
        }

        nav a:hover::after {
            width: 100%;
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            overflow: hidden;
            background: linear-gradient(135deg, #0047AB 0%, #0066FF 100%);
        }

        .hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 800"><defs><pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse"><path d="M 40 0 L 0 0 0 40" fill="none" stroke="rgba(255,255,255,0.05)" stroke-width="1"/></pattern></defs><rect width="1200" height="800" fill="url(%23grid)"/></svg>');
            opacity: 0.5;
        }

        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            padding: 0 2rem;
            animation: fadeInUp 1s ease;
        }

        .hero h1 {
            font-size: 4rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.2;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        }

        .hero p {
            font-size: 1.4rem;
            margin-bottom: 3rem;
            opacity: 0.95;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
            line-height: 1.8;
        }

        .cta-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn-primary {
            background: white;
            color: #0047AB;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(255,255,255,0.3);
        }

        .btn-secondary {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-secondary:hover {
            background: white;
            color: #0047AB;
        }

        /* Section Styles */
        section {
            padding: 100px 3rem;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-header h2 {
            font-size: 3rem;
            color: #0047AB;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .section-header p {
            font-size: 1.2rem;
            color: #666;
            max-width: 700px;
            margin: 0 auto;
        }

        /* Services Grid */
        .services-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2.5rem;
        }

        .service-card {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            transition: all 0.4s ease;
            border: 1px solid #f0f0f0;
            position: relative;
            overflow: hidden;
        }

        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 5px;
            height: 0;
            background: linear-gradient(135deg, #0047AB, #0066FF);
            transition: height 0.4s ease;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 60px rgba(0,71,171,0.15);
        }

        .service-card:hover::before {
            height: 100%;
        }

        .service-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #0047AB, #0066FF);
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: white;
        }

        .service-card h3 {
            font-size: 1.6rem;
            color: #0047AB;
            margin-bottom: 1rem;
            font-weight: 600;
        }

        .service-card p {
            color: #666;
            line-height: 1.8;
            font-size: 1.05rem;
        }

        /* Partners Section */
        .partners-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
        }

        .partners-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            margin-top: 3rem;
        }

        .partner-card {
            background: white;
            padding: 2.5rem;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 140px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
            transition: all 0.3s ease;
        }

        .partner-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(0,0,0,0.12);
        }

        .partner-card .partner-name {
            font-size: 1.8rem;
            font-weight: 700;
            text-align: center;
            line-height: 1.3;
        }

        /* About Section */
        .about-section {
            background: white;
        }

        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: center;
        }

        .about-image {
            position: relative;
        }

        .about-image img {
            width: 100%;
            height: auto;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,71,171,0.2);
        }

        .about-text h3 {
            font-size: 2.5rem;
            color: #0047AB;
            margin-bottom: 2rem;
            font-weight: 700;
        }

        .about-text p {
            font-size: 1.15rem;
            color: #555;
            margin-bottom: 1.5rem;
            line-height: 1.9;
        }

        /* Contact Section */
        .contact-section {
            background: linear-gradient(135deg, #0047AB 0%, #0066FF 100%);
            color: white;
        }

        .contact-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 5rem;
            align-items: start;
        }

        .contact-info h2 {
            font-size: 3rem;
            margin-bottom: 2rem;
            font-weight: 700;
        }

        .contact-item {
            display: flex;
            align-items: start;
            gap: 1.5rem;
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: rgba(255,255,255,0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
        }

        .contact-icon {
            width: 50px;
            height: 50px;
            background: white;
            color: #0047AB;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .contact-item-content h4 {
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
            font-weight: 600;
        }

        .contact-item-content p {
            opacity: 0.95;
            font-size: 1.05rem;
        }

        .contact-form {
            background: white;
            padding: 3rem;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.2);
        }

        .contact-form h3 {
            color: #0047AB;
            font-size: 2rem;
            margin-bottom: 2rem;
            font-weight: 700;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            color: #0047AB;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 1rem;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            font-family: inherit;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #0047AB;
            box-shadow: 0 0 0 3px rgba(0,71,171,0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 140px;
        }

        .submit-btn {
            width: 100%;
            background: linear-gradient(135deg, #0047AB 0%, #0066FF 100%);
            color: white;
            padding: 1.2rem;
            border: none;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(0,71,171,0.3);
        }

        /* Footer */
        footer {
            background: #1a1a1a;
            color: white;
            padding: 4rem 3rem 2rem;
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 4rem;
            margin-bottom: 3rem;
        }

        .footer-section h3 {
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }

        .footer-section p,
        .footer-section a {
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            display: block;
            margin-bottom: 0.8rem;
            transition: color 0.3s;
        }

        .footer-section a:hover {
            color: white;
        }

        .footer-bottom {
            max-width: 1400px;
            margin: 0 auto;
            padding-top: 2rem;
            border-top: 1px solid rgba(255,255,255,0.1);
            text-align: center;
            color: rgba(255,255,255,0.6);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(40px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in {
            animation: fadeInUp 0.8s ease forwards;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .hero h1 {
                font-size: 3rem;
            }
            
            .about-content,
            .contact-container {
                grid-template-columns: 1fr;
            }

            .footer-content {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            nav {
                padding: 0 1.5rem;
            }

            nav ul {
                gap: 1rem;
                font-size: 0.9rem;
            }

            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1.1rem;
            }

            section {
                padding: 60px 1.5rem;
            }

            .section-header h2 {
                font-size: 2rem;
            }

            .services-grid {
                grid-template-columns: 1fr;
            }

            .partners-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 1.5rem;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
        }
    </style>
</head>
<body>
    <header id="header">
        <nav>
            <div class="logo">
                <div class="logo-circle">H</div>
                <span>Hikari Denki</span>
            </div>
            <ul>
                <li><a href="#home">หน้าแรก</a></li>
                <li><a href="#services">บริการ</a></li>
                <li><a href="#partners">Partners</a></li>
                <li><a href="#about">เกี่ยวกับเรา</a></li>
                <li><a href="#contact">ติดต่อเรา</a></li>
            </ul>
        </nav>
    </header>

    <section id="home" class="hero">
        <div class="hero-content">
            <h1>ผู้เชี่ยวชาญด้านระบบไฟฟ้า<br>และความปลอดภัย</h1>
            <p>มอบโซลูชันด้านระบบไฟฟ้าและระบบป้องกันอัคคีภัยที่เชื่อถือได้ เพื่อขับเคลื่อนธุรกิจของคุณให้เติบโตอย่างปลอดภัยและยั่งยืน พร้อมบริการครบวงจรจากทีมผู้เชี่ยวชาญมากกว่า 10 ปี</p>
            <div class="cta-buttons">
                <a href="#contact" class="btn btn-primary">ติดต่อเราเลย</a>
                <a href="#services" class="btn btn-secondary">ดูบริการของเรา</a>
            </div>
        </div>
    </section>

    <section id="services">
        <div class="container">
            <div class="section-header fade-in">
                <h2>บริการของเรา</h2>
                <p>โซลูชันครบวงจรด้านระบบไฟฟ้าและความปลอดภัย ที่ตอบโจทย์ทุกความต้องการของธุรกิจคุณ</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon">🔋</div>
                    <h3>บริการเปลี่ยนแบตเตอรี่ UPS</h3>
                    <p>ตรวจเช็คระบบเครื่องสำรองไฟฟ้า บริการเปลี่ยนแบตเตอรี่ UPS ทุกยี่ห้อ ด้วยทีมช่างมืออาชีพ พร้อมรับประกันคุณภาพและบริการหลังการขาย</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">📋</div>
                    <h3>ออกเอกสารรับรอง Report Test</h3>
                    <p>ทดสอบและรายงานผลการทำงานของระบบอย่างละเอียด ออกเอกสารรับรองมาตรฐาน พร้อมรายงานการทดสอบระบบไฟฟ้าและระบบป้องกันอัคคีภัย</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">🔥</div>
                    <h3>ตรวจสอบระบบ Fire Alarm</h3>
                    <p>ตรวจสอบและบำรุงรักษาระบบแจ้งเหตุเพลิงไหม้ในอาคาร โดยผู้เชี่ยวชาญ ให้ทำงานได้อย่างมีประสิทธิภาพตามมาตรฐานสากล</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">🚨</div>
                    <h3>จำหน่ายอุปกรณ์ Fire Alarm</h3>
                    <p>จำหน่ายอุปกรณ์ระบบแจ้งเหตุเพลิงไหม้และระบบไฟฉุกเฉิน ครบวงจร ตู้ควบคุม เครื่องตรวจจับควัน สัญญาณเตือน จากแบรนด์ชั้นนำระดับสากล</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">💡</div>
                    <h3>จำหน่ายอุปกรณ์ไฟฟ้า</h3>
                    <p>จำหน่าย แบตเตอรี่, UPS, Emergency Light, Exit Sign รูปแบบต่างๆ ตามมาตรฐานสากล สินค้าคุณภาพ พร้อมให้คำปรึกษาเลือกสินค้าที่เหมาะสม</p>
                </div>

                <div class="service-card">
                    <div class="service-icon">🛠️</div>
                    <h3>ให้คำปรึกษาและบริการหลังการขาย</h3>
                    <p>ทีมงานมืออาชีพพร้อมให้คำปรึกษาฟรี แนะนำระบบที่เหมาะสมกับความต้องการ พร้อมบริการหลังการขายและรับประกันอย่างต่อเนื่อง</p>
                </div>
            </div>
        </div>
    </section>

    <section id="partners" class="partners-section">
        <div class="container">
            <div class="section-header">
                <h2>Our Partners</h2>
                <p>ความร่วมมือกับแบรนด์ชั้นนำระดับโลก เพื่อมอบโซลูชันที่ดีที่สุดให้กับคุณ</p>
            </div>
            <div class="partners-grid">
                <div class="partner-card">
                    <div class="partner-name" style="color: #e74c3c;">APC<br><span style="font-size: 0.7rem;">by Schneider Electric</span></div>
                </div>
                <div class="partner-card">
                    <div class="partner-name" style="color: #c0392b;">NOTIFIER<br><span style="font-size: 0.7rem;">FIRE SYSTEMS</span></div>
                </div>
                <div class="partner-card">
                    <div class="partner-name" style="color: #27ae60;">EATON<br><span style="font-size: 0.7rem;">Powering Business</span></div>
                </div>
                <div class="partner-card">
                    <div class="partner-name" style="color: #e67e22;">CyberPower</div>
                </div>
                <div class="partner-card">
                    <div class="partner-name" style="color: #e74c3c;">SUNNY</div>
                </div>
                <div class="partner-card">
                    <div class="partner-name" style="color: #2980b9;">DYNO<br><span style="font-size: 0.7rem;">ELECTRIC</span></div>
                </div>
                <div class="partner-card">
                    <div class="partner-name" style="color: #f39c12;">MAX BRIGHT<br><span style="font-size: 0.7rem;">EMERGENCY LIGHT</span></div>
                </div>
                <div class="partner-card">
                    <div class="partner-name" style="color: #3498db;">DELIGHT</div>
                </div>
                <div class="partner-card">
                    <div class="partner-name" style="color: #27ae60;">Schneider<br><span style="font-size: 0.8rem;">Electric</span></div>
                </div>
            </div>
        </div>
    </section>

    <section id="about" class="about-section">
        <div class="container">
            <div class="about-content">
                <div class="about-text">
                    <h3>เกี่ยวกับ Hikari Denki</h3>
                    <p>
                        เราคือผู้ให้บริการโซลูชันด้านระบบไฟฟ้าและระบบป้องกันอัคคีภัยที่มีความเชี่ยวชาญในระดับสากล มุ่งมั่นมอบบริการที่มีคุณภาพสูงสุด เพื่อความปลอดภัยและประสิทธิภาพสูงสุดของธุรกิจคุณ
                    </p>
                    <p>
                        ด้วยทีมงานมืออาชีพที่มีประสบการณ์มากกว่า 10 ปี เราพร้อมให้บริการครบวงจรตั้งแต่การให้คำปรึกษา ออกแบบ ติดตั้ง จนถึงการบำรุงรักษาระบบ เพื่อให้มั่นใจว่าระบบของคุณจะทำงานได้อย่างมีประสิทธิภาพและปลอดภัยสูงสุด
                    </p>
                    <p>
                        เรานำเข้าและจัดจำหน่ายสินค้าจากแบรนด์ชั้นนำระดับโลก พร้อมให้การรับประกันและบริการหลังการขายที่ครบวงจร เพราะความพึงพอใจและความปลอดภัยของคุณคือความสำเร็จของเรา
                    </p>
                </div>
       <div class="about-image">
    <img src="{{ asset('storage/HikariDenkiUpdate.png') }}" alt="Hikari Denki">
</div>
   
            </div>
        </div>
    </section>

    <section id="contact" class="contact-section">
        <div class="container">
            <div class="contact-container">
                <div class="contact-info">
                    <h2>ติดต่อเรา</h2>
                    <p style="font-size: 1.2rem; margin-bottom: 2rem;">พร้อมให้คำปรึกษาและตอบทุกคำถามของคุณ</p>
                    
                    <div class="contact-item">
                        <div class="contact-icon">📞</div>
                        <div class="contact-item-content">
                            <h4>โทรศัพท์</h4>
                            <p>085-2060720</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">💬</div>
                        <div class="contact-item-content">
                            <h4>Line ID</h4>
                            <p>@hikaridenki</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">✉️</div>
                        <div class="contact-item-content">
                            <h4>Email</h4>
                            <p>info@hikaripower.com</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">🌐</div>
                        <div class="contact-item-content">
                            <h4>Website</h4>
                            <p>www.hikaripower.com</p>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">📍</div>
                        <div class="contact-item-content">
                            <h4>ที่อยู่</h4>
                            <p>บ. ฮิคาริ เดคิ จำกัด<br>39/7 วุฒากาศ ตลาดพลู<br>ธนบุรี กรุงเทพฯ 10600</p>
                        </div>
                    </div>
                </div>

                <div class="contact-form">
                    <h3>ส่งข้อความถึงเรา</h3>
                    <form onsubmit="handleSubmit(event)">
                        <div class="form-group">
                            <label for="name">ชื่อ-นามสกุล</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">อีเมล</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">เบอร์โทรศัพท์</label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        <div class="form-group">
                            <label for="message">ข้อความ</label>
                            <textarea id="message" name="message" required></textarea>
                        </div>
                        <button type="submit" class="submit-btn">ส่งข้อความ</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>Hikari Denki</h3>
                <p>ผู้เชี่ยวชาญด้านระบบไฟฟ้าและระบบป้องกันอัคคีภัย</p>
                <p>มาตรฐานสากล มากกว่า 10 ปีแห่งประสบการณ์</p>
            </div>
            <div class="footer-section">
                <h3>บริการ</h3>
                <a href="#services">เปลี่ยนแบตเตอรี่ UPS</a>
                <a href="#services">ตรวจสอบระบบ Fire Alarm</a>
                <a href="#services">ออกเอกสารรับรอง</a>
                <a href="#services">จำหน่ายอุปกรณ์</a>
                <a href="#services">ให้คำปรึกษา</a>
            </div>
            <div class="footer-section">
                <h3>เมนู</h3>
                <a href="#home">หน้าแรก</a>
                <a href="#services">บริการ</a>
                <a href="#partners">Partners</a>
                <a href="#about">เกี่ยวกับเรา</a>
                <a href="#contact">ติดต่อเรา</a>
            </div>
            <div class="footer-section">
                <h3>ติดต่อเรา</h3>
                <p>📞 085-2060720</p>
                <p>💬 @hikaridenki</p>
                <p>✉️ info@hikaripower.com</p>
                <p>🌐 www.hikaripower.com</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Hikari Denki. All rights reserved. | Empowering Businesses with Safe & Reliable Energy Solutions</p>
        </div>
    </footer>

    <script>
        // Smooth scrolling
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.getElementById('header');
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Form submission
        function handleSubmit(e) {
            e.preventDefault();
            alert('ขอบคุณที่ติดต่อเรา! เราจะติดต่อกลับโดยเร็วที่สุด');
            e.target.reset();
        }

        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Observe all service cards
        document.querySelectorAll('.service-card, .partner-card').forEach(card => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(30px)';
            card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(card);
        });
    </script>
</body>
</html>