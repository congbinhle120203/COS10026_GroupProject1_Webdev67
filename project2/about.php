<?php
// about.php - Solstice Community Energy Careers (Part 2)
// Author: Vu Duc Thai An

//   WHAT CHANGED FROM PART 1 (about.html)
//   - Shared head, header/nav and footer come from header.inc, nav.inc, footer.inc.
//   - These parts are now loaded from MySQL (database webdev67_db):
//       member contributions and quotes -> about table
//   - Links now point to .php pages (for example apply.php).
//   - If MySQL is not running, the page still loads and shows a short notice
//     where the live data would be.

//   ACKNOWLEDGEMENTS
//   - Page structure inspired by buffer.com/about. No text or images were copied.
//   - The company, figures and info on this page are fictional except for the team members.
//   - Group photo: photo of the team members and our teacher taken by a classmate.
//   - GenAI: assisted by Claude (Anthropic), reviewed and tested by me.
//     Prompt: "Convert my about.html to PHP and load the member contributions from MySQL"


$page_title       = "About";
$page_description = "Meet the student team behind this fictional recruitment website.";
$page_author      = "Vu Duc Thai An";
$body_class       = "page-about";
$page_css         = "    h1 { color: #1b2a23; }";

require_once "settings.php";
require_once "functions.inc";
$conn = db_connect($host, $user, $pwd, $sql_db);
// Read member contribution from the database.
$members = db_fetch_rows($conn, "SELECT full_name, student_id, role, part1_work, part2_work,
    quote, quote_language, quote_translation, quote_author
    FROM about ORDER BY sort_order");

include "header.inc";
include "nav.inc";
?>


  <main id="main">



    <div class="container page-section">

        <!-- HEADER CARD OF THE PAGE TO BE CONSISTENT WITH THE JOB PAGE -->
        <header class="header-card">
            <h1>About Us</h1>

            <p class="SubTitle">Discover more about our company.</p>
        </header>

        <hr>


        <section class="section">
            <!-- Group's Class Day/Time using nested list FOR PAGE'S REQUIREMENT -->

            <h2>Introduction</h2>

            <p class="SubTitle">Some information about us we would like to share with you.</p>

            <div class="section-row">

                <div class="group-content">

                    <h2>Who We Are</h2>

                    <div class="para-card">
                        <p>We are the digital team at Solstice Community Energy,
                            a member-owned co-operative founded in 2016 in Bendigo, Victoria.
                            We build and run community solar farms, rooftop programs and batteries
                            with local councils, so households share in the benefits of clean power.
                            Today we are owned by more than 2,400 member-owners and power more than
                            5,900 homes. Our digital team builds the web portals residents use to
                            track their own solar generation.</p>
                    </div>

                    <div class="section-row">

                        <!-- INFORMATION CARD -->
                        <div class="info-card">
                            <h3 class = "card-title">Group Name</h3>
                            <p class = "group-name">Webdev67</p>
                        </div>

                        <!-- INFORMATION CARD -->
                        <!-- Class Day/time using nested list! -->
                        <div class="info-card">
                            <h3 class = "card-title">Class Day/Time</h3>

                            <ol>
                                <li>Thursday
                                    <ol>
                                        <li>7AM - 10AM</li>
                                    </ol>
                                </li>
                            </ol>
                        </div>

                    </div>

                </div>

                <div class="group-photo">
                    <!-- Figure with border and caption! -->
                    <figure class="GroupPhoto">
                        <!-- Group Photo -->

                        <figcaption>Webdev67</figcaption>
                        <img src="./images/group-photo.jpg" alt="Webdev67 team members and Mr Wilson at the center">
                    
                    </figure>
                </div>

            </div>

            <hr>
            <!-- WHAT OUR TEAM DOES section -->
            <h2>What Our Digital Team Does</h2>

            <div class="para-card">
                <p>As a team of web developers and IT professionals, we build simple, user-friendly web portals. These web applications allow residents to easily track their daily solar generation and manage their clean power systems.</p>
            </div>

            <hr>

            <!-- LIFE ON OUR TEAM section -->
            <h2>Life on Our Team</h2>

            <div class="para-card">
                <p>We are an active team of software and grid engineers who work from our offices in Hawthorn (Melbourne) and Bendigo, with hybrid options. Our junior developers receive weekly code reviews and strong mentorship from senior engineers to help them grow while making a real impact on the community.</p>
            </div>

        </section>


        <section class="section">
            <!-- Members' Contribution and Quotes in VN and EN translation -->

            <h2>Members Contribution and Quotes</h2>

            <p class="SubTitle">The work we do and the thoughts we share.</p>

            <dl class="member-section">

                <!-- Loop to print each member contribution information from database -->

                <?php if ($members === null || count($members) == 0) { ?>

                    <p class="db-notice">Member information is not available right now. Please try again later.</p>

                <?php } else { for ($i = 0; $i < count($members); $i++) { $m = $members[$i]; ?>
                    <div class="member">
                        <dt class="member-info">
                            <p class="StudentName"><?php echo e($m['full_name']); ?></p>
                            <p class="StudentID">ID: <?php echo e($m['student_id']); ?></p>
                        </dt>
                        <dd class="contributions">


                            <p class="member-role"><?php echo e($m['role']); ?></p>


                            <p class="work-part">Part 1</p>

                            <?php $part1 = explode('|', $m['part1_work']); ?>
                            <ol>
                                <?php for ($j = 0; $j < count($part1); $j++) { ?>
                                    <li><?php echo e($part1[$j]); ?></li>
                                <?php } ?>
                            </ol>

                            <p class="work-part">Part 2</p>

                            <?php $part2 = explode('|', $m['part2_work']); ?>
                            <ol>
                                <?php for ($j = 0; $j < count($part2); $j++) { ?>
                                    <li><?php echo e($part2[$j]); ?></li>
                                <?php } ?>
                            </ol>


                        </dd>
                        <dd class="quote">
                            <p lang="<?php echo e($m['quote_language']); ?>">"<?php echo e($m['quote']); ?>"</p>
                            <p>"<?php echo e($m['quote_translation']); ?>"</p>
                            <p class="quote-author"><?php echo e($m['quote_author']); ?></p>
                        </dd>
                    </div>
                <?php } } ?>

            </dl>

        </section>



        <section class="section">
            <!-- Fun Fact Section -->
            <h2>Fun Facts</h2>

            <p class="SubTitle">Here are some fun facts about us.</p>


            <div class="FunFact">

                <table class="FunFactTable">
                    <caption>Fun Facts About Webdev67</caption>

                    <thead>
                        <tr>
                            <th scope="col">Member</th>
                            <th scope="col">Hometown</th>
                            <th scope="col">Dream Job</th>
                            <th scope="col">Coding Snack</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="table-name">Cong Binh</td>
                            <td>Dong Nai</td>
                            <td>Audio Machine Learning Engineer</td>
                            <td>Iced milk coffee</td>
                        </tr>

                        <tr>
                            <td class="table-name">Thai An</td>
                            <td>Ho Chi Minh City</td>
                            <td>AI Engineer</td>
                            <td>Chocolate Drinks</td>
                        </tr>

                        <tr>
                            <td class="table-name">Gia Huy</td>
                            <td>Ho Chi Minh City</td>
                            <td>AI Engineer</td>
                            <td>Instant noodles</td>
                        </tr>

                        <tr>
                            <td class="table-name">Duc Duy</td>
                            <td>Dong Nai</td>
                            <td>Cybersecurity Analyst</td>
                            <td>Bubble milk tea</td>
                        </tr>
                    </tbody>
                </table>

            </div>

        </section>

        <section class="floating-section">
            <!-- NAV to Apply page at the bottom -->
            <div class="join-section">

                <h2>Come Work With Us</h2>

                <p>We are always looking for great people to help us build tools that actually make a difference. If you want to use your coding skills to solve real problems and learn from a caring team, you will fit right in. Plus, we give you the freedom to work from home or join us in the office—whatever works best for you.</p>

                <p>
                    <a class="button" href="apply.php">Apply Now</a>
                </p>

            </div>

        </section>



    </div>


  </main>




<?php include "footer.inc"; ?>