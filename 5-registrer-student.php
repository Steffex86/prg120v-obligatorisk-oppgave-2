<?php  /* registrer-student */
/*
/*  Programmet lager et html-skjema for å registrere en student
/*  Programmet registrerer data (student) i databasen
*/
?> 

<h3>Registrer student </h3>

<form method="post" action="" id="registrerStudentSkjema" name="registrerStudentSkjema">
  Brukernavn <input type="text" id="brukernavn" name="brukernavn" required /> <br/>
  Fornavn <input type="text" id="fornavn" name="fornavn" required /> <br/>
  Etternavn <input type="text" id="etternavn" name="etternavn" required /> <br/>
  Klassekode <select name="klassekode" id="klassekode" required>
    <option value="">Velg klassekode</option>
    <?php include("dynamiske-funksjoner.php"); listeboksKlassekode(); ?>
  </select>  <br />
  <input type="submit" value="Registrer student" id="registrerStudentKnapp" name="registrerStudentKnapp" /> 
  <input type="reset" value="Nullstill" id="nullstill" name="nullstill" /> <br />
</form>

<?php 
  if (isset($_POST ["registrerStudentKnapp"]))
    {
      $brukernavn=$_POST ["brukernavn"];
      $fornavn=$_POST ["fornavn"];
      $etternavn=$_POST ["etternavn"];
      $klassekode=$_POST ["klassekode"];

      if (!$brukernavn || !$fornavn || !$etternavn || !$klassekode)
        {
          print ("brukernavn, fornavn, etternavn og klassekode m&aring; fylles ut");
        }
      else
        {
          include("db-tilkobling.php");  /* tilkobling til database serveren utført og valg av database foretatt */

          $sqlSetning="SELECT * FROM student WHERE brukernavn='$brukernavn';";
          $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          $antallRader=mysqli_num_rows($sqlResultat); 

          if ($antallRader!=0)  /* student er registrert fra før */
            {
              print ("Student er registrert fra f&oslash;r");
                        }
          else
            {
              $sqlSetning="INSERT INTO student VALUES('$brukernavn','$fornavn','$etternavn','$klassekode');";
              mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; registrere data i databasen");
                /* SQL-setning sendt til database-serveren */

              print ("F&oslash;lgende student er n&aring; registrert: $brukernavn $fornavn $etternavn $klassekode"); 
            }
        }
    }
?> 