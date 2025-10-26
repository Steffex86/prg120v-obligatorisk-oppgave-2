<?php  /* vis-alle-klasser */
/*
/*  Programmet skriver ut alle registrerte klasser
*/
  include("db-tilkobling.php");  /* tilkobling til database-serveren utført og valg av database foretatt */

  $sqlSetning="SELECT * FROM klasse;";
  
  $sqlResultat=mysqli_query($db,$sqlSetning) or die ("ikke mulig &aring; hente data fra databasen");
    /* SQL-setning sendt til database-serveren */
	
  $antallRader=mysqli_num_rows($sqlResultat);  /* antall rader i resultatet beregnet */

  print ("<h3>Klasser</h3>");
  print ("<table border=1>");  
  print ("<tr> <th align=center>Klassekode</th> <th align=center>Klassenavn</th> <th align=center>Studiumkode</th> </tr>"); 

  for ($r=1;$r<=$antallRader;$r++)
    {
      $rad=mysqli_fetch_array($sqlResultat);  /* ny rad hentet fra spørringsresultatet */
      $klassekode=$rad["klassekode"];
      $klasssenavn=$rad["klasssenavn"];
      $studiumkode=$rad["studiumkode"];

      print ("<tr>
                <td align=center> $klassekode </td>
                <td align=center> $klasssenavn </td>
                <td align=center> $studiumkode </td>
            </tr>" );
    }
  print ("</table>"); 
?>