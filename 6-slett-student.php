<?php  /* slett-student */
/*
/*  Programmet lager et skjema for å velge en student som skal slettes  
/*  Programmet sletter den valgte studenten
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett student</h3>

<form method="post" action="" id="slettStudentSkjema" name="slettStudentSkjema" onSubmit="return bekreft()">
  Student 
    <select name="student" id="student">
    <option value="">Velg student</option>
    <?php include("dynamiske-funksjoner.php"); listeboksStudent(); ?>
  </select>  <br/>
  <input type="submit" value="Slett student" name="slettStudentKnapp" id="slettStudentKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettStudentKnapp"]))
    {
      $brukernavn=$_POST ["student"];
	  
      if (!$brukernavn)
        {
          print ("Det er ikke valgt noe student");
        }
      else
        {	  		 
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */
	        
          $sqlSetning = "SELECT fornavn, etternavn, klassekode FROM student WHERE brukernavn='$brukernavn';";
          $resultat = mysqli_query($db, $sqlSetning);
          $rad = mysqli_fetch_array($resultat);

          $fornavn = $rad["fornavn"];
          $etternavn = $rad["etternavn"];
          $klassekode = $rad["klassekode"];

          $sqlSetning="DELETE FROM student WHERE brukernavn='$brukernavn';";
          mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; slette data i databasen");
            /* SQL-setning sendt til database-serveren */
		
          print ("F&oslash;lgende student er n&aring; slettet: $brukernavn $fornavn $etternavn $klassekode  <br />");
        }	
    }
?>