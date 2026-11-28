<?php
/*
  footer.inc - shared footer and the closing </body></html> for every page
  COS10026 Applied Web Project Part 2 - Group Webdev67 (G03)
  Author: Le Cong Binh (106419738)

  The brief asks for the GitHub link to be on the home page, so it lives here
  and appears on every page.

  GenAI: assisted by Claude (Anthropic), reviewed and tested by me. Prompt: "Shared footer"
*/
?>
  <!-- Footer: Jira board, GitHub repository and contact email -->
  <footer class="site-footer">
    <div class="container footer-inner">
      <ul class="footer-links">
        <li>
          <a href="https://defesttosiro.atlassian.net/jira/software/projects/RWP/boards/2/backlog" target="_blank" rel="noopener noreferrer">
            Project board (Jira) <span class="visually-hidden">(opens in a new tab)</span>
          </a>
        </li>
        <li>
          <a href="https://github.com/congbinhle120203/COS10026_GroupProject1_Webdev67" target="_blank" rel="noopener noreferrer">
            Source code (GitHub) <span class="visually-hidden">(opens in a new tab)</span>
          </a>
        </li>
        <li><a href="mailto:info@solstice-community-energy.example">info@solstice-community-energy.example</a></li>
        <li><a href="login.php">Staff login</a></li>
      </ul>
      <p class="footer-country">We acknowledge the Traditional Custodians of the lands where we work. <a href="jobs.php#ack-heading">Read our Acknowledgment of Country</a>.</p>
      <p>&copy; <?php echo date("Y"); ?> Solstice Community Energy (COS10026 Group Webdev67).</p>
    </div>
  </footer>

</body>
</html>
