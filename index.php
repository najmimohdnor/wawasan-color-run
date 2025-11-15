<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!------css style---->
    <link rel="stylesheet" href="landing.css">

    <!------ Icons-------->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

    <title>Wawasan Color Run | 2024 </title>
</head>

<body>
    
    <!----------------Sidebar----------------->
    <nav class="sidebar close">
        <header class="header">
            <div class="image-text">
                <span class="image">
                    <img src="logo.png" alt="logo">
                </span>  
                <div class="text header-text">
                    <span class="name">Wawasan</span>
                        <span class="event">Color Run 2024</span>
                </div>
            </div>
            <i class='bx bx-chevron-right toggle' ></i>
        </header>
    <!---------------Menu Bar --------------->
        <div class="menu-bar">
            <div class="menu">
                <li class="search-box">
                    <i class='bx bx-search icon' ></i>
                    <input class="search"type="search" placeholder="Search...">
                </li>
                <li class="nav-link">
                    <a href="signin.php">
                        <i class='bx bx-log-in-circle icon' ></i>
                        <span class="text nav-text">Login</span>
                        <button class="login" id="form-open">Login</button>
                    </a>
                    <span class="tooltip">Login</span>
                </li>
                    <hr class="rounded">
                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="#home">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Home</span>
                        </a>
                        <span class="tooltip">Home</span>
                    </li>
                    <li class="nav-link">
                        <a href="#about">
                            <i class='bx bx-info-circle icon' ></i>
                            <span class="text nav-text">About Us</span>
                        </a>
                        <span class="tooltip">About Us</span>
                    </li>
                <!------------- Nav Link --------------->    
                    <li class="nav-link">
                        <a href="#event-gallery">
                            <i class='bx bx-image icon' ></i>
                            <span class="text nav-text">Event Gallery</span>
                            
                        </a>
                        <span class="tooltip">Event Gallery</span>
                    </li>
                    <li class="nav-link">
                        <a href="#event-info">
                            <i class='bx bx-run icon' ></i>
                            <span class="text nav-text">Color Run 2024</span>
                        </a>
                        <span class="tooltip">Color Run 2024</span>
                    </li>
                    <li class="nav-link">
                        <a href="#faq">
                            <i class='bx bx-chat icon'></i>
                            <span class="text nav-text">FAQ</span>
                        </a>
                        <span class="tooltip">FAQ</span>
                    </li>
                    <li class="nav-link">
                        <a href="#contact-us">
                            <i class='bx bx-support icon' ></i>
                            <span class="text nav-text">Contact Us</span>
                        </a>
                        <span class="tooltip">Contact Us</span>
                    </li>
                </ul>
            </div>
            <div class="bottom-content">
                <hr class="rounded">
                <li class="mode">
                    <div class="moon-sun">
                        <i class='bx bx-moon icon moon' ></i>
                        <i class='bx bx-sun icon sun' ></i>
                    </div>
                    <span class="mode-text text">Light Mode</span>
                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>
            </div>
        </div>
    </nav>
    <!--- Home ---->
    <div class="home" id="home">
        <div class="text"></div>
            <div class="banner">
                <img src="banner.png" alt="Run" class="rounded">
            </div>
            <!---- Gallery -->
            <div class="slider">
                <div class="list">
                    <div class="item active">
                        <img src="Assets/img (1).jpg">
                        <div class="contents">
                            <p>Past Events</p>
                            <h2>Color Run 2023</h2>
                            <p>
                                Our team have been thrilled that COLOR RUN 2023 is a success and are honored for those who participates.
                                We will into this event for our upcoming COLOR RUN 2024 for improvements.
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="Assets/img (2).jpg">
                        <div class="contents">
                            <p>Location</p>
                            <h2>UNITEN Putrajaya</h2>
                            <p>
                                The events started at UNITEN Putrajaya. We would like to thank to those in charge in UNITEN Putrajaya
                                department for making their place our main event destination.
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="Assets/img (3).jpg">
                        <div class="contents">
                            <p>Participants</p>
                            <h2>1,500+ Joins</h2>
                            <p>
                                Accumualting around 300+ veterans, 1000+ adults and teenagers of the remaining has participating from around
                                the country.
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="Assets/img (4).jpg">
                        <div class="contents">
                            <p>Categories</p>
                            <h2>3KM, 5KM, 10KM</h2>
                            <p>
                                Since from a lot of the feedbacks, we will bring this categories along for our next COLOR RUN events and so forth!
                                Be ready and look out the chances for the future categories! Looking forward for your participation!
                            </p>
                        </div>
                    </div>
                    <div class="item">
                        <img src="Assets/img (5).jpg">
                        <div class="contents">
                            <p>Past Events</p>
                            <h2>Thank You!</h2>
                            <p>
                                We wishes you all the best for this 2024!
                            </p>
                        </div>
                    </div>
                </div>
                <div class="arrows">
                    <button id="prev"><</button>
                    <button id="next">></button>
                </div>
                <div class="thumbnail">
                    <div class="item active">
                        <img src="Assets/img (1).jpg">
                        <div class="content">
                        <h3>Past Events</h3>
                        </div>
                    </div>
                    <div class="item">
                        <img src="Assets/img (2).jpg">
                        <div class="content">
                        <h3>Location</h3>
                        </div>
                    </div>
                    <div class="item">
                        <img src="Assets/img (3).jpg">
                        <div class="content">
                            <h3>Participants</h3>
                        </div>
                    </div>
                    <div class="item">
                        <img src="Assets/img (4).jpg">
                        <div class="content">
                        <h3>Categories</h3>
                        </div>
                    </div>
                    <div class="item">
                        <img src="Assets/img (5).jpg">
                        <div class="content">
                        <h3>Thank You 2023</h3>
                        </div>
                    </div>
                </div>
            </div>
            <!-------- Countdown Timer ------>
            <section class="containers">
                <header><h1>Get <span></span> For,</h1></header> 
                <div spellcheck="false" class="font" contenteditable="true">
                    COLOR RUN
                </div><h3>21 January 2024</h3>
                    <p> Wait no more and be the earliest one to register! Registration is highly limited!</p>
                    <add-to-calendar-button name="Title" options="'Apple','Google'"location="World Wide Web"startDate="2024-01-12"endDate="2024-01-12"startTime="10:15"endTime="23:30"timeZone="America/Los_Angeles"></add-to-calendar-button>
                    <div class="time-content">
                    <div class="time days">
                        <span class="number"><h2>05</h2></span>
                        <span class="text">days</span>
                    </div>
                    <div class="time hours">
                        <span class="number"><h2>05</h2></span>
                        <span class="text">hours</span>
                    </div>
                        <div class="time minutes">
                        <span class="number"><h2>60</h2></span>
                        <span class="text">minutes</span>
                    </div>
                        <div class="time seconds">
                            <span class="number"><h2>60</h2></span>
                            <span class="text">seconds</span>
                        </div>
                    </div>
                <div class="calendar">
                </div>
            </section>
        </div>
    </div>
    <!---- About Us ------>
    <div class="about" id="about">
        <div class="containerss">
            <h1>Our Board Members<br></h1>
            <div class="card__container">
               <article class="card__article">
                  <img src="user1.jpg" alt="image" class="card__img">
   
                  <div class="card__data">
                     <span class="card__description">Project Leader</span>
                     <h2 class="card__title">Syukri Naim</h2>
                  </div>
               </article>
   
               <article class="card__article">
                  <img src="user3.jpg" alt="image" class="card__img">
   
                  <div class="card__data">
                     <span class="card__description">Project Designer</span>
                     <h2 class="card__title">Najmi</h2>
                  </div>
               </article>
                <article class="card__article">
                  <img src="user2.jpg" alt="image" class="card__img">
   
                  <div class="card__data">
                     <span class="card__description">Participants Functions Developer</span>
                     <h2 class="card__title">Vityasri</h2>
                  </div>
               </article>
               <article class="card__article">
                <img src="user4.jpg" alt="image" class="card__img">
 
                <div class="card__data">
                   <span class="card__description">Participants Functions Developer</span>
                   <h2 class="card__title">Barath</h2>
                </div>
             </article>
            </div>
         </div>
        <div class="content-about">
            <header>Where it all began.</header>
            <h1>The Wawasan Color Run</h1>
            <p>Our journey began with a profound passion for creating unforgettable experiences that transcend the ordinary. Rooted in the rich history of our organization, the Color Run has evolved from a mere concept to a spectacular celebration of unity, diversity, and boundless joy.
                The origins of this kaleidoscopic extravaganza trace back to the collective vision of our dedicated team, some of whom drew inspiration from their past experiences in organizing and participating in random marathon events. It was during one such marathon that the magic of celebrating the finish line with bursts of confetti and jubilant revelry left an indelible mark. Fueled by this inspiration, we envisioned an event that not only promotes physical well-being but also immerses participants in a riot of colors, creating an atmosphere of pure happiness.
                From the inception of the idea to the present day, the Color Run has grown into an annual spectacle that attracts participants from all walks of life. Our commitment to fostering a sense of community, health, and happiness remains unwavering. As organizers, we take pride in curating an experience that goes beyond just a run – it's a celebration of life, diversity, and the shared joy of crossing the finish line amidst an explosion of vibrant hues.
                Join us on this exhilarating journey where every step tells a story, and every burst of color symbolizes the unity that defines our community. The Wawasan UNITEN Color Run is not just an event; it's a testament to the power of collective dreams, inspiring everyone to embrace life with open arms and embrace the beauty of diversity.</p>
        </div>
        <div class="text" data-tilt>About Us</div>
    </div>
    
    <!---- Event Gallery --->
    <div class="eventgallery" id="event-gallery">
        <div class="text">Event Gallery</div>
        <div class="containerz">

            <h1 class="title">COLOR RUN 2023</h1>
        
            <div class="image-container">
                <img src="images/img-1.jpg" alt="">
                <img src="images/img-2.jpg" alt="">
                <img src="images/img-3.jpg" alt="">
                <img src="images/img-4.jpg" alt="">
                <img src="images/img-5.jpg" alt="">
                <img src="images/img-6.jpg" alt="">
                <img src="images/img-7.jpg" alt="">
                <img src="images/img-8.jpg" alt="">
                <img src="images/img-9.jpg" alt="">
            </div>
    </div>
    </div>
    <!---- Event Info --->
    <div class="eventinfo" id="event-info">
        <div class="text">Event Info</div>
        <div class="detailss">
            <h1>Wawasan Color Run 2024</h1>
            <br>
        <p><strong>Date:</strong> January 21, 2024</p>
        <br>
        <h2>Location:</h2>
        <br>
        <p>
            Start: UNITEN Putrajaya<br>
            Finish: Taman Botani Putrajaya
        </p>
        <br>
        <h2>Categories:</h2>
        <br>
        <ul>
            <li>3KM Fun Run</li>
            <li>5KM Color Run</li>
            <li>10KM Challenge Run</li>
        </ul>
        <br>
        <h2>Participants:</h2>
        <br>
        <p>Open for veterans, adults, and teenagers.</p>
        <br>
        <h2>Safety Precautions:</h2>
        <br>
        <ul>
            <li>Health and safety of participants are our top priority.</li>
            <li>All participants are required to wear masks before and after the race.</li>
            <li>Social distancing measures will be enforced at the start and finish areas.</li>
            <li>Hand sanitizing stations will be available throughout the event.</li>
            <li>Temperature checks will be conducted at the entrance.</li>
            <li>Color stations will be designed to ensure safe distancing.</li>
            <li>Medical personnel and first-aid stations will be on-site for any emergencies.</li>
        </ul>
        <br>
        <h2>Race Routes:</h2>
        <br>
        <ul>
            <li>The 3KM Fun Run will take you through scenic routes around UNITEN Putrajaya.</li>
            <li>The 5KM Color Run promises a vibrant and thrilling experience with colorful powder stations along the way.</li>
            <li>The 10KM Challenge Run will test your endurance as you navigate challenging terrains and stunning landscapes.</li>
        </ul>
        <br>
        <h2>Registration Information:</h2>
        <br>
        <ul>
            <li>Registration opens on <b>10 January 2024</b></li>
            <li>Early bird registration discounts available.</li>
            <li>All registered participants will receive a runner's kit, including:</li>
            <ul>
                <li>Colorful event t-shirt</li>
                <li>Finisher medal</li>
                <li>Race bib with a timing chip</li>
                <li>Color packets for the Color Run category</li>
            </ul>
        </ul>
        <br>
        <h2>Prizes:</h2>
        <ul>
            <li>Exciting prizes await the top finishers in each category.</li>
            <li>Best dressed awards for the most creatively dressed participants.</li>
        </ul>
        <br>
        <h2>Entertainment:</h2>
        <ul>
            <li>Live music and entertainment at the finish line.</li>
            <li>Food and refreshment stalls to satisfy your post-run cravings.</li>
            <li>Photo booths for capturing memorable moments.</li>
        </ul>
        <br>
        <h2>Support a Cause:</h2>
        <p>Proceeds from the event will be donated to a charitable cause.</p>
        <br>
        <p>Join us in celebrating health, fitness, and the joy of giving back to the community at the Wawasan Color Run 2024. We're committed to providing a safe and enjoyable experience for all participants. Register today and be part of this colorful journey!</p>
        </div>
    </div>
    
    <!---- FAQ -------->
    <div class="faq" id="faq">
        <div class="text">Frequently Asked Questions</div>
        <div class="container-faq">
            <div class="tab">
                <input type="radio" name="acc" id="acc1">
                <label for="acc1">
                    <h2>01</h2>
                    <h3>What is the minimum age to participate in the Wawasan Color Run 2024 – Malaysia?</h3>
                </label>
                <div class="content">
                    <br>
                    <p>There are different minimum age requirements for the different race categories.
                    <br>
                    ● 3KM Fun Run: Minimum 13 years as of date of Event.<br>
                    ● 5KM Colour Run: Minimum 13 years as of date of Event.<br>
                    ● 10KM Challenge Run: Minimum 18 years as of date of Event.<br>
                <br>
                <p class="small">Note: Participants age 17 years and above must be accompanied by an adult above 18 years old. </p>
                </ol></p>
                </div>
            </div>
            <div class="tab">
                <input type="radio" name="acc" id="acc2">
                <label for="acc2">
                    <h2>02</h2>
                    <h3>I couldn’t attend the physical race. Can I join virtually?</h3>
                </label>
                <div class="content">
                    <br>
                    <p>Thank you for your support, however there is no virtual run this year. We look forward to seeing you again in the future.</p>
                </div>
            </div>
            <div class="tab">
                <input type="radio" name="acc" id="acc3">
                <label for="acc3">
                    <h2>03</h2>
                    <h3>How do I know if my registration is successful?</h3>
                </label>
                <div class="content">
	            <br>
                    <p>Upon completion of registration, you will see a ‘success’ message on your screen.</p>
                </div>
            </div>
            <div class="tab">
                <input type="radio" name="acc" id="acc4">
                <label for="acc4">
                    <h2>04</h2>
                    <h3>Can I change my distance or category after I have completed my registration?</h3>
                </label>
                <div class="content">
                    <br>
                    <p>Unfortunately, you are not allowed to change your distance or category upon completing your registration.</p>
                </div>
            </div>
            <div class="tab">
                <input type="radio" name="acc" id="acc5">
                <label for="acc5">
                    <h2>05</h2>
                    <h3>Do I get a refund if I choose not to participate after completing my registration?</h3>
                </label>
                <div class="content">
                    <br>
                    <p>No. Registration fees are strictly non-refundable.</p>
                </div>
            </div>
            <div class="tab">
                <input type="radio" name="acc" id="acc6">
                <label for="acc6">
                    <h2>06</h2>
                    <h3>Do I need to be fully vaccinated to participate in the event?</h3>
                </label>
                <div class="content">
                    <br>
                    <p>Yes, you must be fully vaccinated to participate in the event. Proof of vaccination will be required on the event day.</p>
                </div>
            </div>
        </div>
    </div>
    <!---- Contact Us --->
    <div class="contactus" id="contact-us" >
        <div class="text">Contact Us</div>
            <div class="contact" >
                <div class="container">
                    <div class="left">
                        <div class="form-wrapper">
                            <div class="contact-heading">
                                <h1>We want to hear it from you<span>.</span></h1>
                                <span class="text1">Let's get in touch.</span>
                            </div>
                            <form action="https://api.web3forms.com/submit" method="POST" class="contact-form">
                                <input type="hidden" name="access_key" value="a6608e36-d560-4f4e-b776-79976f42b170">
                                <div class="input-wrap">
                                    <input class="contact-input"  autocomplete="off" name="First name: " type="text" required>
                                    <label>First name</label>
                                    <i class='bx bx-message-square-edit icon' ></i>
                                </div>

                                <div class="input-wrap">
                                    <input class="contact-input"  autocomplete="off" name="Last Name: " type="text" required>
                                    <label>Last name</label>
                                    <i class='bx bx-message-square-edit icon' ></i>
                                </div>

                                <div class="input-wrap w-100">
                                    <input class="contact-input"  autocomplete="off" name="Email: " type="email" required>
                                    <label>Email</label>
                                    <i class='bx bx-envelope icon' ></i>
                                </div>

                                <div class="input-wrap textarea w-100">
                                    <textarea id="Message"  autocomplete="off" name="Message:" class="contact-input"></textarea>
                                    <label>Message</label>
                                    <i class='bx bx-detail icon'></i>
                                </div>

                                <div class="contact-buttons">
                                    <button class="btn upload">
                                        <span>
                                            <i class='bx bx-paperclip'></i> Add attachment
                                        </span>
                                        <input type="file">
                                    </button>
                                    <button class="btn clear" style="display: none;">Clear</button>
                                    <input type="submit" value="Send message" class="btn">
                                </div>
                                <span class="file-name"></span>
                            </form>
                        </div>
                    </div>
                    <!---------- Flip Card ------>
                    <div class="right">
                        <div class="card">
                            <div class="card-inner">
                                <div class="front">
                                    <h1> Still need more to reach us? </h1>
                                    <h2> We've got you covered!</h2>
                                    <button>Hover Me</button>
                                </div>
                                <div class="back">
                                    <h1>Phone Number</h1>
                                    <p>Help desk:</p><h2>+60196053192</h2>
                                    <p>Headquarters:</p><h2>+60123456789</h2>
                                    <br>
                                    <h1>Email Address</h1>
                                    <p>wawasan_uniten@gmail.com</p>
                                    <br>
                                    <h1>Our Address</h1>
                                    <p>Universiti Tenaga Nasional (UNITEN), Putrajaya Campus, Jalan Kajang - Puchong, 43000 Kajang, Selangor</p>
                                </div>
                            </div>
                        </div>
                    </div>
    <!---------------------- Footer ------------>
    <div class="footer">
        <div class="footer-row">
          <div class="footer-col">
            <h4>Info</h4>
            <ul class="links">
              <li><a href="#">About Us</a></li>
              <li><a href="#">Contact Us</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>Explore</h4>
            <ul class="links">
              <li><a href="#">Event Gallery</a></li>
              <li><a href="#">Event Info</a></li>
              <li><a href="#">Our Partners</a></li>
              <li><a href="#">FAQs</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <h4>Newsletter</h4>
            <p>
              Subscribe to our newsletter for a weekly dose
              of news, updates, helpful tips, and
              exclusive offers.
            </p>
            <form action="#">
              <input type="text" placeholder="Your email" required>
              <button type="submit">SUBSCRIBE</button>
            </form>
            <div class="icons">
              <i class="fa-brands fa-facebook-f"></i>
              <i class="fa-brands fa-twitter"></i>
              <i class="fa-brands fa-linkedin"></i>
              <i class="fa-brands fa-github"></i>
            </div>
          </div>
        </div> 
        
                </div>
            </div>
        </div>
    </div>
    
        <script src="https://cdn.jsdelivr.net/npm/add-to-calendar-button@2" async defer></script>
        <script src="register.js"></script>
        <script src="script.js"></script>
        <script src="countdown.js"></script>
        <script src="gallery.js"></script>
        <script src="typing.js"></script>
        <script type="text/javascript" src="vanilla-tilt.js"></script>
    </body>
</html>