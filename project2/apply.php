<?php
/*
  apply.php - Solstice Community Energy Careers (fictional company)
  COS10026 Applied Web Project Part 2 - Group Webdev67, industry G03
  Page owner: Pham Duc Duy

  Converted from Part 1 apply.html by Le Cong Binh (RWP-140) so the whole
  site runs from index.php: the head, header/nav and footer now come from
  header.inc, nav.inc and footer.inc, and links point to .php pages.
  The page content below is unchanged from Part 1; the database features
  for this page are the page owner's Part 2 work.
  See ../apply.html (Part 1, repository root) for the original acknowledgements.
*/
$page_title       = "Apply";
$page_description = "Apply for a role at Solstice Community Energy, a fictional renewable energy company.";
$page_author      = "Pham Duc Duy";
$body_class       = "page-apply";
$page_css         = "    .page-intro { max-width: 40rem; }";

include "header.inc";
include "nav.inc";
?>

  <main id="main">
    <div class="container page-section">
      <h1 class="page-intro" style="color: #2c5e4f;">Apply now</h1>
      <!-- Inline CSS example (assesment requirement) -->
      <p id="description">Apply for a position at Solstice Community Energy. Complete our easy online application form to join our team in delivering sustainable renewable energy solutions across Australia.</p>
      <form action="https://mercury.swin.edu.au/it000000/formtest.php" method="post" class="apply_form">
        <fieldset class="information"> 
          <legend id="title_form">Personal Information</legend>

          <p class="full-width">
            <label for="job_reference">Job Reference <span class="required">*</span></label>
            <input type="text" id="job_reference" name="job_reference" pattern="[A-Za-z0-9]{5}" maxlength="5" required title="Please fill exactly 5 alphanumeric." placeholder="Ex: 'SCE01' or 'SCE02'...">
          </p>
        
          <p id="first_name_input">
            <label for="first_name">First Name <span class="required">*</span></label>
            <input type="text" id="first_name" name="first_name" pattern="[A-Za-z]{1,20}" maxlength="20" required title="Max 20 alpha">
          </p>
          
          <p id="last_name_input">
            <label for="last_name">Last Name <span class="required">*</span></label>
            <input type="text" id="last_name" name="last_name" pattern="[A-Za-z]{1,20}" maxlength="20" required title="Max 20 alpha">
          </p>
          
          <p>
            <label for="date_of_birth">Date of Birth <span class="required">*</span></label>
            <input type="text" id="date_of_birth" name="date_of_birth" pattern="\d{2}/\d{2}/\d{4}" maxlength="10" required title="Please fill in dd/mm/yyyy format" placeholder="dd/mm/yyyy">
          </p>
        
          <fieldset class="gender_form">
            <legend id="gender">Gender <span class="required">*</span></legend>
            <label><input type="radio" id="male" name="gender" value="male" required>Male</label>
            <label><input type="radio" id="female" name="gender" value="female">Female</label>
            <label><input type="radio" id="other" name="gender" value="other">Other</label>
          </fieldset>
      
          <p class="full-width">
            <label for="street_address">Street Address <span class="required">*</span></label>
            <input type="text" id="street_address" name="street_address" pattern="[A-Za-z0-9\s,\.\-\/]{1,40}" maxlength="40" required title="Max 40">
          </p>

          <p>
            <label for="suburb_town">Suburb/Town <span class="required">*</span></label>
            <input type="text" id="suburb_town" name="suburb_town" pattern="[A-Za-z0-9\s,\.\-\/]{1,40}" maxlength="40" required title="Max 40">
          </p>

          <p>
            <label for="state">State <span class="required">*</span></label>
            <select id="state" name="state" required>
              <option value="" disabled selected>Select a state</option>
              <option value="vic">VIC</option>
              <option value="nsw">NSW</option>
              <option value="qld">QLD</option>
              <option value="nt">NT</option>
              <option value="wa">WA</option>
              <option value="sa">SA</option>
              <option value="tas">TAS</option>
              <option value="act">ACT</option>
            </select>
          </p>

          <p>
            <label for="postcode">Postcode <span class="required">*</span></label>
            <input type="text" id="postcode" name="postcode" pattern="\d{4}" maxlength="4" required title="Please fill exactly 4 digits">
          </p>

          <p>
            <label for="email">Email <span class="required">*</span></label>
            <input type="email" id="email" name="email" required title="Should include @" placeholder="name@example.com">
          </p>

          <p>
            <label for="phone_numbers">Phone Numbers <span class="required">*</span></label>
            <input type="tel" id="phone_numbers" name="phone_numbers" pattern="\d{8,12}" maxlength="12" required title="Please fill 8-12 digits" placeholder="Ex: 0123456789">
          </p>

          <fieldset class="skills_form">
            <legend>Skills</legend>
            <label><input type="checkbox" id="html" name="skills[]" value="html">HTML</label>
            <label><input type="checkbox" id="css" name="skills[]" value="css">CSS</label>
            <label><input type="checkbox" id="js" name="skills[]" value="js">Javascript</label>
            
            <label class="full-width">Other Skills
              <textarea id="other_skills" name="other_skills" placeholder="Write any other skills here..."></textarea>
            </label>
          </fieldset>
          
        </fieldset> 
        
        <input type="submit" name="submit" id="submit" value="Apply">
        <input type="reset" name="reset" id="reset" value="Reset">
      </form>
    </div>
  </main>

<?php include "footer.inc"; ?>
