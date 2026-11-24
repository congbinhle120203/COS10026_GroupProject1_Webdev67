<?php include "header.inc"; ?>
<!-- 
  Acknowledgements:
  Author: Pham Duc Duy (COS10026 Group G03 / Webdev67)
  Target: apply.php - Job Application Form for Solstice Community Energy
  References: W3C HTML5 Specification, MDN Web Docs, Swinburne COS10026 Project Guidelines.
-->

  <main id="main">
    <div class="container page-section">
      <h1 class="page-intro" style="color: #2c5e4f;">Apply now</h1>
      <p id="description">Apply for a position at Solstice Community Energy. Complete our easy online application form to join our team in delivering sustainable renewable energy solutions across Australia.</p>
      <form action="process_eoi.php" method="post" class="apply_form" novalidate>
        <fieldset class="information"> 
          <legend id="title_form">Personal Information</legend>

          <p class="full-width">
            <label for="job_reference">Job Reference <span class="required">*</span></label>
            <input type="text" id="job_reference" name="job_reference" placeholder="Ex: 'SCE01' or 'SCE02'...">
          </p>
        
          <p id="first_name_input">
            <label for="first_name">First Name <span class="required">*</span></label>
            <input type="text" id="first_name" name="first_name">
          </p>
          
          <p id="last_name_input">
            <label for="last_name">Last Name <span class="required">*</span></label>
            <input type="text" id="last_name" name="last_name">
          </p>
          
          <p>
            <label for="date_of_birth">Date of Birth <span class="required">*</span></label>
            <input type="text" id="date_of_birth" name="date_of_birth" placeholder="dd/mm/yyyy">
          </p>
        
          <fieldset class="gender_form">
            <legend id="gender">Gender <span class="required">*</span></legend>
            <label><input type="radio" id="male" name="gender" value="male">Male</label>
            <label><input type="radio" id="female" name="gender" value="female">Female</label>
            <label><input type="radio" id="other" name="gender" value="other">Other</label>
          </fieldset>
      
          <p class="full-width">
            <label for="street_address">Street Address <span class="required">*</span></label>
            <input type="text" id="street_address" name="street_address">
          </p>

          <p>
            <label for="suburb_town">Suburb/Town <span class="required">*</span></label>
            <input type="text" id="suburb_town" name="suburb_town">
          </p>

          <p>
            <label for="state">State <span class="required">*</span></label>
            <select id="state" name="state">
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
            <input type="text" id="postcode" name="postcode">
          </p>

          <p>
            <label for="email">Email <span class="required">*</span></label>
            <input type="text" id="email" name="email" placeholder="name@example.com">
          </p>

          <p>
            <label for="phone_numbers">Phone Numbers <span class="required">*</span></label>
            <input type="text" id="phone_numbers" name="phone_numbers" placeholder="Ex: 0123456789">
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