<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DermaScan - Pakistani Dermatologists</title>
    <link rel="stylesheet" href="{{asset('frontend/css/doctorlist.css')}}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <header>
        <a href="{{url('/')}}" style="text-decoration: none;"><div class="logo">DERMASCAN</div></a>         <nav>
            <ul>
                <li><a href="{{route('getcheck')}}">Get checked</a></li>
                <li><a href="{{route('aboutus')}}">About us</a></li>
                <li><a href="{{route('skinguide')}}">Skin Guide</a></li>
                <li><a href="{{route('research')}}">Research</a></li>
                <li><a href="{{route('contactus')}}">contact us</a></li>
                <li><a href="{{route('pharmacy')}}"><i class="fas fa-capsules" style="margin-right: 7px;"></i>Pharmacy</a></li>
                <li><a href="{{route('login')}}" class="button2"><i class="fas fa-user"></i></a></li>
            </ul>
        </nav>
    </header>
    <main>
        <h1>Meet Our  Dermatologists</h1>
        <p class="subtitle">Expert care from board-certified professionals in Pakistan.</p>
        <section class="doctors">
            <!-- Section 1: Prof. Dr. Ikram Ullah Khan -->
            <article class="doctor-profile">
                <div class="doctor-image">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/020/non_2x/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png" alt="Prof. Dr. Ikram Ullah Khan">
                    <span class="badge"><i class="fas fa-user-md"></i></span>
                </div>
                <div class="doctor-details">
                    <div class="doctor-name">
                        <h2>Prof. Dr. Ikram Ullah Khan</h2>
                        <p class="title">Dermatologist</p>
                    </div>
                    <div class="doctor-info">
                        <p>Prof. Dr. Ikram Ullah Khan is a renowned dermatologist in Islamabad, celebrated for introducing laser technology to Pakistan. He holds MRCP (UK) and FRCP (Edin), the highest postgraduate qualifications in dermatology, and serves as a consultant at PIMS Hospital, Islamabad.</p>
                    </div>
                </div>
            </article>
            <!-- Section 2: Dr. Nusrat Ali Shaikh -->
            <article class="doctor-profile">
                <div class="doctor-image">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/061/non_2x/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png" alt="Dr. Nusrat Ali Shaikh">
                    <span class="badge"><i class="fas fa-user-md"></i></span>
                </div>
                <div class="doctor-details">
                    <div class="doctor-name">
                        <h2>Dr. Nusrat Ali Shaikh</h2>
                        <p class="title">Dermatologist</p>
                    </div>
                    <div class="doctor-info">
                        <p>Dr. Nusrat Ali Shaikh is a pioneer of dermatology in Pakistan. Graduating from KEMC in 1948, he specialized in dermatology with an MRCP from Edinburgh in 1955, significantly contributing to the field’s foundation in the country.</p>
                    </div>
                </div>
            </article>
            <!-- Section 3: Prof. Syed Ghulam Shabbir -->
            <article class="doctor-profile">
                <div class="doctor-image">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/043/non_2x/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png" alt="Prof. Syed Ghulam Shabbir">
                    <span class="badge"><i class="fas fa-user-md"></i></span>
                </div>
                <div class="doctor-details">
                    <div class="doctor-name">
                        <h2>Dr. Syed Ghulam Shabbir</h2>
                        <p class="title">Dermatologist</p>
                    </div>
                    <div class="doctor-info">
                        <p>Dr. Syed Ghulam Shabbir, a distinguished dermatologist, graduated from KEMC in 1948. He earned his MRCP from Edinburgh in 1957, specializing in dermatology, and has played a key role in advancing the specialty in Pakistan.</p>
                    </div>
                </div>
            </article>
            <!-- Section 4: Brig. Dr. Syed Muhammad Jaffer -->
            <article class="doctor-profile">
                <div class="doctor-image">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/182/non_2x/an-pakistani-male-doctor-on-isolated-transparent-background-png.png" alt="Brig. Dr. Syed Muhammad Jaffer">
                    <span class="badge"><i class="fas fa-user-md"></i></span>
                </div>
                <div class="doctor-details">
                    <div class="doctor-name">
                        <h2>Dr. Syed Muhammad Jaffer</h2>
                        <p class="title">Dermatologist</p>
                    </div>
                    <div class="doctor-info">
                        <p>Dr. Syed Muhammad Jaffer is a respected military dermatologist and former Vice President of the Pakistan Association of Dermatologists (PAD). His contributions have significantly enhanced dermatology within the armed forces.</p>
                    </div>
                </div>
            </article>
            <!-- Section 5: Lt. General Mahboob Ahmad -->
            <article class="doctor-profile">
                <div class="doctor-image">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/179/original/an-pakistani-male-doctor-on-isolated-transparent-background-png.png" alt="Lt. General Mahboob Ahmad">
                    <span class="badge"><i class="fas fa-user-md"></i></span>
                </div>
                <div class="doctor-details">
                    <div class="doctor-name">
                        <h2>Dr. Mahboob Ahmad</h2>
                        <p class="title">Dermatologist</p>
                    </div>
                    <div class="doctor-info">
                        <p>Dr. Mahboob Ahmad is a prominent military dermatologist and former Vice President of PAD. His efforts have been crucial in integrating dermatology into military healthcare services in Pakistan.</p>
                    </div>
                </div>
            </article>
            <!-- Section 6: Dr. Dur-e-Kamil -->
            <article class="doctor-profile">
                <div class="doctor-image">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/018/original/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png" alt="Dr. Dur-e-Kamil">
                    <span class="badge"><i class="fas fa-user-md"></i></span>
                </div>
                <div class="doctor-details">
                    <div class="doctor-name">
                        <h2>Dr. Dur-e-Kamil</h2>
                        <p class="title">Dermatologist</p>
                    </div>
                    <div class="doctor-info">
                        <p>Dr. Dur-e-Kamil founded dermatology in Khyber Pakhtunkhwa. A 1955 KEMC graduate, he completed his fellowship in Canada in 1966 and established the dermatology department at Lady Reading Hospital, Peshawar.</p>
                    </div>
                </div>
            </article>
            <!-- Section 7: Prof. Tahir Saeed Haroon -->
            <article class="doctor-profile">
                <div class="doctor-image">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/045/non_2x/an-old-pakistani-male-doctor-on-isolated-transparent-background-png.png" alt="Prof. Tahir Saeed Haroon">
                    <span class="badge"><i class="fas fa-user-md"></i></span>
                </div>
                <div class="doctor-details">
                    <div class="doctor-name">
                        <h2>Prof. Tahir Saeed Haroon</h2>
                        <p class="title">Dermatologist</p>
                    </div>
                    <div class="doctor-info">
                        <p>Prof. Tahir Saeed Haroon is a leading figure in Pakistani dermatology. A 1961 KEMC graduate, he earned his MRCP from Glasgow in 1973, trained under Dr. Alan Lyell, and has advanced dermatology education and practice in Pakistan.</p>
                    </div>
                </div>
            </article>
            <!-- Section 8: Dr. Ashfaq Ahmad Khan -->
            <article class="doctor-profile">
                <div class="doctor-image">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/025/original/an-pakistani-male-doctor-on-isolated-transparent-background-png.png" alt="Dr. Ashfaq Ahmad Khan">
                    <span class="badge"><i class="fas fa-user-md"></i></span>
                </div>
                <div class="doctor-details">
                    <div class="doctor-name">
                        <h2>Dr. Ashfaq Ahmad Khan</h2>
                        <p class="title">Dermatologist</p>
                    </div>
                    <div class="doctor-info">
                        <p>Dr. Ashfaq Ahmad Khan is a notable dermatologist who has significantly contributed to developing structured postgraduate dermatology training programs in Pakistan.</p>
                    </div>
                </div>
            </article>
            <!-- Section 9: Dr. Sabrina Suhail -->
            <article class="doctor-profile">
                <div class="doctor-image">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/092/non_2x/an-pakistani-female-doctor-on-isolated-transparent-background-png.png" alt="Dr. Sabrina Suhail">
                    <span class="badge"><i class="fas fa-user-md"></i></span>
                </div>
                <div class="doctor-details">
                    <div class="doctor-name">
                        <h2>Dr. Sabrina Suhail</h2>
                        <p class="title">Dermatologist</p>
                    </div>
                    <div class="doctor-info">
                        <p>Dr. Sabrina Suhail succeeded Prof. Tahir Saeed Haroon at Mayo Hospital in 2002. She served as Editor of the Journal of Pakistan Association of Dermatologists for six years, advancing the field’s academic growth.</p>
                    </div>
                </div>
            </article>
            <!-- Section 10: Dr. Qurat ul ain Sajida -->
            <article class="doctor-profile">
                <div class="doctor-image">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/079/non_2x/an-pakistani-female-doctor-on-isolated-transparent-background-png.png" alt="Dr. Qurat ul ain Sajida">
                    <span class="badge"><i class="fas fa-user-md"></i></span>
                </div>
                <div class="doctor-details">
                    <div class="doctor-name">
                        <h2>Dr. Qurat ul ain Sajida</h2>
                        <p class="title">Dermatologist</p>
                    </div>
                    <div class="doctor-info">
                        <p>Dr. Qurat ul ain Sajida is a well-known dermatologist at Doctors Hospital, Lahore, highly regarded for her expertise in diagnosing and treating diverse skin conditions, earning numerous positive patient reviews.</p>
                    </div>
                </div>
            </article>
            <!-- Section 11: Dr. Ayesha Rehman -->
            <article class="doctor-profile">
                <div class="doctor-image">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/089/non_2x/an-pakistani-female-doctor-on-isolated-transparent-background-png.png" alt="Dr. Ayesha Rehman">
                    <span class="badge"><i class="fas fa-user-md"></i></span>
                </div>
                <div class="doctor-details">
                    <div class="doctor-name">
                        <h2>Dr. Ayesha Rehman</h2>
                        <p class="title">Dermatologist</p>
                    </div>
                    <div class="doctor-info">
                        <p>Dr. Ayesha Rehman brings over 12 years of experience to dermatology. She is recognized for her proficiency in various treatments and her dedication to patient care across Pakistan.</p>
                    </div>
                </div>
            </article>
            <!-- Section 12: Dr. Syeda Summaya Jamal -->
            <article class="doctor-profile">
                <div class="doctor-image">
                    <img src="https://static.vecteezy.com/system/resources/previews/046/680/104/non_2x/an-pakistani-female-doctor-on-isolated-transparent-background-png.png" alt="Dr. Syeda Summaya Jamal">
                    <span class="badge"><i class="fas fa-user-md"></i></span>
                </div>
                <div class="doctor-details">
                    <div class="doctor-name">
                        <h2>Dr. Syeda Summaya Jamal</h2>
                        <p class="title">Dermatologist</p>
                    </div>
                    <div class="doctor-info">
                        <p>Dr. Syeda Summaya Jamal, with over eight years of experience, practices at multiple locations in Karachi. She specializes in laser treatments, skin lightening, pigmentation, and burns surgery.</p>
                    </div>
                </div>
            </article>
        </section>
        <section style="padding-left: 122px; margin-top: 48px;">
            <a href="{{route('chatbox')}}" id="chatdoc">chat with Doctors</a>
        </section>
        
    </main>

    <footer>
        <div class="footer-links">
            <div class="column">
                <h3>The Company</h3>
                <ul>
                    <li><a href="#">Send a Case</a></li>
                    <li><a href="#">Review Your Case</a></li>
                    <li><a href="#">The Team</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>Get Involved</h3>
                <ul>
                    <li><a href="#">Press</a></li>
                    <li><a href="#">Partnerships</a></li>
                    <li><a href="#">Spot Cancer</a></li>
                </ul>
            </div>
            <div class="column">
                <h3>Resources</h3>
                <ul>
                    <li><a href="#">Skin Image Search</a></li>
                    <li><a href="#">Partner Program</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-info">
            <p>DermaScan Ai</p>
            <p></p>
            <p>
                <a href="#">Terms & Conditions</a> - 
                <a href="#">Website Terms of Use</a>
            </p>
            <p>
                <a href="#">Privacy Notice</a> - 
                <a href="#">Privacy Shield</a> - 
                <a href="#">Terms & Conditions Autoderm</a>
            </p>
        </div>
        <div class="social-media">
            <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://x.com/twitter?lang=en" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
        </div>
    </footer>
    <script src="{{asset('frontend/js/script.js')}}"></script>
</body>



