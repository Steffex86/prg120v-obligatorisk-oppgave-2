<?php  /* slett-klasse */
/*
/*  Programmet lager et skjema for å velge en klasse som skal slettes  
/*  Programmet sletter den valgte klassen
*/
?> 

<script src="funksjoner.js"> </script>

<h3>Slett klasse</h3>

<form method="post" action="" id="slettKlasseSkjema" name="slettKlasseSkjema" onSubmit="return bekreft()">
  Klasse 
  <select name="klasse" id="klasse">
    <option value="">Velg klasse</option>
    <?php include("dynamiske-funksjoner.php"); listeboksKlasse(); ?>
  </select>  <br/>
  <input type="submit" value="Slett klasse" name="slettKlasseKnapp" id="slettKlasseKnapp" /> 
</form>

<?php
  if (isset($_POST ["slettKlasseKnapp"]))
    {
      $klassekode=$_POST ["klasse"];	  
	  
      if (!$klassekode)
        {
          print ("Det er ikke valgt noe klasse");
        }
      else
        {	  		 
          include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */
        $sqlSetning = "SELECT klasssenavn, studiumkode FROM klasse WHERE klassekode='$klassekode'";
        $resultat = mysqli_query($db, $sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
          /* SQL-setning sendt til database-serveren */
           
        if ($rad = mysqli_fetch_array($resultat))
            $klasssenavn = $rad["klasssenavn"];
            $studiumkode = $rad["studiumkode"];
        try
        {
          $sqlSetning="DELETE FROM klasse WHERE klassekode='$klassekode';";
          mysqli_query($db,$sqlSetning);
          print ("F&oslash;lgende klasse er n&aring; slettet: $klassekode $klasssenavn $studiumkode <br />");
        }  
         catch (mysqli_sql_exception $e)
        {
          print("Feil ved sletting av klasse: <br/>
          " . $e->getMessage());
        }
        }
    }
?>